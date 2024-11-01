<?php defined('ABSPATH') or die; ?>
<div class="wrap wrap-openai-descgen">
	<?php settings_errors(); ?>
	<h1>
		<?php _e('Virtualbadge.io Certificate Validator', 'virtual-badge-certificate'); ?>
	</h1>
	<span class="shortcode-definition"
		style="padding: 10px 100px; display: inline-block; font-size: 16px; text-align: center;">

		This plugin can only be used by clients of Virtualbadge.io with the necessary permissions.
		Your plan needs to allow for “Validation in your website”. You may check if you have the required permissions
		on the Virtualbadge.io website by scrolling down to “Validation” in the Feature List: https://www.virtualbadge.io/pricing#feature-list.

	</span>
	<span class="shortcode-definition"
		style="padding: 10px; display: inline-block; font-size: 24px; font-weight: bold; text-align: center;">
		Shortcode:
		<div
			style="margin: 10px; padding: 10px; border: 2px dashed #c5c9d4; color: #616367; display: inline-block; font-size: 20px; font-weight: bold; font-weight: bold; width: fit-content">
			[VBCertValidator]
		</div>
	</span>
	<form method="POST" action="options.php">
		<?php settings_fields(VIRTUAL_BARGE_VERTIFICATE_OPTSGROUP_NAME); ?>
		<?php do_settings_sections(VIRTUAL_BARGE_VERTIFICATE_OPTSGROUP_NAME); ?>
		<table class="form-table">
			<tr class="openai-descgen">
				<th>
					<?php _e('Identifier', 'virtual-badge-certificate'); ?>
				</th>
				<td>
					<input type="text" name="<?php echo VIRTUAL_BARGE_VERTIFICATE_OPTIONS_NAME . '[identifier]'; ?>"
						value="<?php esc_attr_e($this->get_option('identifier')); ?>" class="regular-text"
						placeholder="<?php esc_attr_e('Format: VB-XXXXXXXXX-XXXX', 'virtual-badge-certificate'); ?>"
						pattern="VB-[A-Za-z0-9]{9}-[A-Za-z0-9]{4}"
						title="<?php esc_attr_e('Valid format is VB-XXXXXXXXX-XXXX', 'virtual-badge-certificate'); ?>" />
				</td>
			</tr>
			<tr class="openai-descgen">
				<th>
					<?php _e('Language', 'virtual-badge-certificate'); ?>
				</th>
				<td>
					<?php $lang = $this->get_option('lang'); ?>
					<select name="<?php echo VIRTUAL_BARGE_VERTIFICATE_OPTIONS_NAME . '[lang]'; ?>">
						<option value="en" <?php esc_attr_e($lang == 'en' ? 'selected' : ''); ?>><?php esc_html_e('English', 'virtual-badge-certificate'); ?></option>
						<option value="de" <?php esc_attr_e($lang == 'de' ? 'selected' : ''); ?>><?php esc_html_e('German', 'virtual-badge-certificate'); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
	<div
		style="display: flex; flex-direction: column; flex-wrap: nowrap; max-width: 1004px; margin: auto; align-items: center;">
		<span class="shortcode-definition"
			style="padding: 10px; display: inline-block; font-size: 24px; font-weight: bold; text-align: center;">
			Embed the Virtualbadge.io certificate validator into your own website in 6 easy steps
		</span>
		<span class="shortcode-definition"
			style="padding: 10px 100px; display: inline-block; font-size: 16px; text-align: center;">
			If you want to implement the certificate validator into your WordPress website, just follow this short
			guide and you will be able to host your own Virtualbadge.io certificate validator in no time.
		</span>
		<hr style="width: 100%; text-align:center">
		<div style="display: flex; flex-direction: row; flex-wrap: nowrap;">
			<div class="descrition-container" style="display: flex; flex-direction: column; flex-wrap: nowrap;">
				<span class="shortcode-definition" style="display: inline-block; font-size: 16px; padding-right: 32px;">
					<ol>
						<li>Create a new default page by hovering over “Pages” in the left-hand menu bar and then
							clicking “Add New”.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_1.png", __FILE__); ?>"
									style="height: 100%; width: 600px; object-fit: contain" alt="New Page" />
							</div>
						</li>
						<li>Go to the “List View” and remove all the unnecessary blocks.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_2.png", __FILE__); ?>"
									style="height: 100%; width: 850px; object-fit: contain" alt="List view button" />
							</div>
						</li>
						<li>Click on the blue plus button to add a new block and choose “Group” which you will find in
							the design category.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_3.png", __FILE__); ?>"
									style="height: 100%; width: 400px; object-fit: contain" alt="New Page" />
							</div>
						</li>
						<li>Select the group on your page and change the alignment to full width.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_4.png", __FILE__); ?>"
									style="height: 100%; width: 850px; object-fit: contain"
									alt="Change to full width" />
							</div>
						</li>
						<li>Click on the group one more time to receive options on what to insert into the group. There
							you need to choose “Custom HTML”.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_5.png", __FILE__); ?>"
									style="height: 100%; width: 850px; object-fit: contain"
									alt="Add custom html element" />
							</div>
						</li>
						<li>Select the Custom HTML block and insert the code ( [VBCertValidator] ) into the input field.
							<div
								style="width: 100%; display: flex; justify-content: center; margin-top: 15px; margin-bottom: 30px;">
								<img src="<?php echo plugins_url("assets/picture_6.png", __FILE__); ?>"
									style="height: 100%; width: 850px; object-fit: contain"
									alt="Add short code element" />
							</div>
						</li>
						<li>That’s it! Now you can enjoy the certificate validation page in your own WordPress website.
					</ol>
				</span>
			</div>
		</div>
		<hr style="width: 100%; text-align:center">
	</div>
</div>