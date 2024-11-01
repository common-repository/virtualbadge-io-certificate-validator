<?php
/*
Plugin Name: Virtualbadge.io Certificate Validator
Description: Easily verify the authenticity of Virtualbdge.io certificates on your website with our white-label plugin. Boost organic traffic and trust by integrating the Virtualbdge.io certificate validator seamlessly into your website.
Version:     1.0.1
Author:      Virtualbadge.io
Author URI:  https://www.virtualbadge.io
Text Domain: Virtualbadge
License:	 GNU GPLv3
Domain Path: /languages
*/

defined('ABSPATH') or die;

define('VIRTUAL_BARGE_VERTIFICATE_FILE', __FILE__);
define('VIRTUAL_BARGE_VERTIFICATE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('VIRTUAL_BARGE_VERTIFICATE_OPTSGROUP_NAME', 'virtual_badge_certificate_optsgroup');
define('VIRTUAL_BARGE_VERTIFICATE_OPTIONS_NAME', 'virtual_badge_certificate_options');
define('VIRTUAL_BARGE_VERTIFICATE_VER', '1.0.0');

if (!class_exists('Virtual_Badge_Certificate')) {
	class Virtual_Badge_Certificate
	{
		public static function get_instance()
		{
			if (self::$instance == null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private static $instance = null;

		private function __clone()
		{
		}

		public function __wakeup()
		{
		}

		private function __construct()
		{
			// Actions
			add_action('init', array($this, 'init'));
			add_action('admin_init', array($this, 'register_settings'));
			add_action('admin_menu', array($this, 'add_menu_item'));
			add_action('wp_enqueue_scripts', array($this, 'register_assets'));

			// Filters
			add_filter('script_loader_tag', array($this, 'add_async_defer_attributes'), 10, 2);

			// Shortcode
			add_shortcode('VBCertValidator', array($this, 'output_shortcode'));
		}

		public function init()
		{
			load_plugin_textdomain('virtual-badge-certificate', false, dirname(plugin_basename(__FILE__)) . '/languages');
		}

		public function register_settings()
		{
			register_setting(VIRTUAL_BARGE_VERTIFICATE_OPTSGROUP_NAME, VIRTUAL_BARGE_VERTIFICATE_OPTIONS_NAME);
		}

		public function add_menu_item()
		{
			add_menu_page(
				__('Certificate Validator', 'virtual-badge-certificate'),
				__('Certificate Validator', 'virtual-badge-certificate'),
				'manage_options',
				'openai-descgen',
				array($this, 'render_options_page'),
				'dashicons-media-text'
			);
		}

		public function render_options_page()
		{
			require(__DIR__ . '/options.php');
		}

		public function register_assets()
		{
			$lang = $this->get_option('lang');

			wp_register_script('virtual-badge-certificate', 'https://static.virtualbadge.io/js/vb-certificate-v1.js', array(), null, false);
			wp_localize_script(
				'virtual-badge-certificate',
				'_vb_identifier',
				array(
					'identifier' => $this->get_option('identifier'),
					'default_lg' => empty($lang) ? 'en' : $lang
				)
			);
		}

		public function output_shortcode($atts, $content, $tag)
		{
			if (empty($this->get_option('identifier')))
				return __('Empty identifier');
			wp_enqueue_script('virtual-badge-certificate');

			ob_start();
			require(__DIR__ . '/widget.php');
			return ob_get_clean();
		}

		public function add_async_defer_attributes($tag, $handle)
		{
			if ($handle == 'virtual-badge-certificate') {
				return preg_replace('/>\s*<\/script>/', ' defer></script>', $tag);
			}

			return $tag;
		}

		private function get_option($option_name, $default = '')
		{
			if (is_null($this->options))
				$this->options = (array) get_option(VIRTUAL_BARGE_VERTIFICATE_OPTIONS_NAME, array());
			if (isset($this->options[$option_name]))
				return $this->options[$option_name];
			return $default;
		}
	}

	Virtual_Badge_Certificate::get_instance();
}