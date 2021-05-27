<?php

if (!defined('ABSPATH')) {
	exit;
}

/***** Display Welcome Notice *****/

if (!function_exists('mh_magazine_admin_notice')) {
	function mh_magazine_admin_notice() {
		global $pagenow, $mh_magazine_version;
		if (current_user_can('edit_theme_options') && 'index.php' === $pagenow && !get_option('mh_magazine_notice_welcome') || current_user_can('edit_theme_options') && 'themes.php' === $pagenow && isset($_GET['activated']) && !get_option('mh_magazine_notice_welcome')) {
			wp_enqueue_style('mh-magazine-admin-notice', get_template_directory_uri() . '/admin/admin-notice.css', array(), $mh_magazine_version);
			mh_magazine_welcome_notice();
		}
	}
}
add_action('admin_notices', 'mh_magazine_admin_notice');

/***** Hide Welcome Notice *****/

if (!function_exists('mh_magazine_hide_notice')) {
	function mh_magazine_hide_notice() {
		if (isset($_GET['mh-magazine-hide-notice']) && isset($_GET['_mh_magazine_notice_nonce'])) {
			if (!wp_verify_nonce($_GET['_mh_magazine_notice_nonce'], 'mh_magazine_hide_notices_nonce')) {
				wp_die(__('Action failed. Please refresh the page and retry.', 'mh-magazine'));
			}
			if (!current_user_can('edit_theme_options')) {
				wp_die(__('You do not have the necessary permission to perform this action.', 'mh-magazine'));
			}
			$hide_notice = sanitize_text_field($_GET['mh-magazine-hide-notice']);
			update_option('mh_magazine_notice_' . $hide_notice, 1);
		}
	}
}
add_action('wp_loaded', 'mh_magazine_hide_notice');

/***** Content of Welcome Notice *****/

if (!function_exists('mh_magazine_welcome_notice')) {
	function mh_magazine_welcome_notice() {
		global $mh_magazine_data; ?>
		<div class="notice notice-success mh-welcome-notice">
			<a class="notice-dismiss mh-welcome-notice-hide" href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('mh-magazine-hide-notice', 'welcome')), 'mh_magazine_hide_notices_nonce', '_mh_magazine_notice_nonce')); ?>">
				<span class="screen-reader-text">
					<?php echo esc_html__('Dismiss this notice.', 'mh-magazine'); ?>
				</span>
			</a>
			<p><?php printf(esc_html__('Thanks for using %s by MH Themes! To get started please make sure you visit our %swelcome page%s.', 'mh-magazine'), '<strong>' . $mh_magazine_data['Name'] . ' WordPress Theme</strong>', '<a href="' . esc_url(admin_url('themes.php?page=magazine')) . '">', '</a>'); ?></p>
			<p class="mh-welcome-notice-button">
				<a class="button-primary" href="<?php echo esc_url(admin_url('themes.php?page=magazine')); ?>">
					<?php printf(esc_html__('Get Started with %s', 'mh-magazine'), $mh_magazine_data['Name']); ?>
				</a>
			</p>
		</div><?php
	}
}

/***** Theme Info Page / Welcome Page *****/

if (!function_exists('mh_magazine_add_theme_info_page')) {
	function mh_magazine_add_theme_info_page() {
		add_theme_page(esc_html__('Welcome to MH Magazine', 'mh-magazine'), esc_html__('Theme Info', 'mh-magazine'), 'edit_theme_options', 'magazine', 'mh_magazine_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_magazine_add_theme_info_page');

if (!function_exists('mh_magazine_display_theme_info_page')) {
	function mh_magazine_display_theme_info_page() {
		global $mh_magazine_data; ?>
		<div class="theme-info-wrap">
			<h1>
				<?php printf(esc_html__('Welcome to %1s %2s', 'mh-magazine'), $mh_magazine_data['Name'], $mh_magazine_data['Version']); ?>
			</h1>
			<div class="mh-row theme-intro clearfix">
				<div class="mh-col-1-4">
					<img class="theme-screenshot" src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_html_e('Theme Screenshot', 'mh-magazine'); ?>" />
				</div>
				<div class="mh-col-3-4 theme-description">
					<?php echo esc_html($mh_magazine_data['Description']); ?>
				</div>
			</div>
			<hr>
			<div class="theme-links clearfix">
				<p>
					<strong><?php esc_html_e('Important Links:', 'mh-magazine'); ?></strong>
					<a href="<?php echo esc_url('https://www.mhthemes.com/themes/mh/magazine/'); ?>" target="_blank">
						<?php esc_html_e('Theme Info Page', 'mh-magazine'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.mhthemes.com/support/'); ?>" target="_blank">
						<?php esc_html_e('Support Center', 'mh-magazine'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.youtube.com/user/MHthemesEN'); ?>" target="_blank">
						<?php esc_html_e('Video Tutorials', 'mh-magazine'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.mhthemes.com/themes/showcase/'); ?>" target="_blank">
						<?php esc_html_e('MH Themes Showcase', 'mh-magazine'); ?>
					</a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3>
					<?php printf(esc_html__('Getting Started with %s', 'mh-magazine'), $mh_magazine_data['Name']); ?>
				</h3>
				<div class="mh-row clearfix">
					<div class="mh-col-1-2">
						<div class="section">
							<h4>
								<span class="dashicons dashicons-welcome-learn-more"></span>
								<?php esc_html_e('Theme Documentation', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Do you need support with the configuration of %s? Usually you can find all necessary information to configure your theme in the theme documentation. In addition you can find several WordPress tutorials in our support center. For further assistance, please contact our support staff.', 'mh-magazine'), $mh_magazine_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/documentation-mh-magazine/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Theme Documentation', 'mh-magazine'); ?>
								</a>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Support Center', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<span class="dashicons dashicons-admin-generic"></span>
								<?php esc_html_e('Replicate Theme Demos', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('%s is a flexible WordPress theme for various topics and content genres. We have created several theme demos to show what is possible with this theme, just by using the included features, options and custom widgets. You can configure your theme to replicate these demo layouts.',  'mh-magazine'), $mh_magazine_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/themes/mh/magazine/#demos'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Theme Demos', 'mh-magazine'); ?>
								</a>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/documentation-mh-magazine/#demo-content'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Replicate Theme Demos', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<span class="dashicons dashicons-admin-appearance"></span>
								<?php esc_html_e('Theme Options', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'mh-magazine'), $mh_magazine_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary">
									<?php esc_html_e('Customize Theme', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
					</div>
					<div class="mh-col-1-2">
						<div class="section">
							<h4>
								<span class="dashicons dashicons-cart"></span>
								<?php esc_html_e('Upgrade to Lifetime Updates and Support', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php esc_html_e('If you have purchased a single WordPress theme and now want to gain access to all WordPress themes by MH Themes including lifetime updates and support, you can upgrade to MH Themes Lifetime right away.', 'mh-magazine'); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/buy/lifetime-upgrade'); ?>" target="_blank" class="button button-primary">
									<?php esc_html_e('Upgrade to MH Themes Lifetime', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<span class="dashicons dashicons-sos"></span>
								<?php esc_html_e('Theme Installation / Configuration Service', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php esc_html_e('In case you are new to WordPress and if you do not want to install and configure the theme by yourself, then we also offer an installation service. We can configure the theme for you to replicate the layout of the theme demo.', 'mh-magazine'); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/installation-service/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Installation Service', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<span class="dashicons dashicons-images-alt"></span>
								<?php esc_html_e('MH Themes Showcase', 'mh-magazine'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Would you like to see what other users are doing with their WordPress theme? In the MH Themes Showcase you can see several examples of user sites that are running %s WordPress theme. If you like, you can add your website to the showcase as well.', 'mh-magazine'), $mh_magazine_data['Name']); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/themes/showcase/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('MH Themes Showcase', 'mh-magazine'); ?>
								</a>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/how-to-add-sites-to-showcase/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Add Website to Showcase', 'mh-magazine'); ?>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(esc_html__('%1s WordPress theme is proudly brought to you by %2s.', 'mh-magazine'), $mh_magazine_data['Name'], '<a target="_blank" href="https://www.mhthemes.com/" title="MH Themes">MH Themes</a>'); ?></p>
			</div>
		</div> <?php
	}
}

/***** Custom Meta Boxes *****/

if (!function_exists('mh_add_meta_boxes')) {
	function mh_add_meta_boxes() {
		add_meta_box('mh_post_details', esc_html__('Post Options', 'mh-magazine'), 'mh_post_options', 'post', 'normal', 'high');
	}
}
add_action('add_meta_boxes', 'mh_add_meta_boxes');

if (!function_exists('mh_post_options')) {
	function mh_post_options() {
		global $post;
		wp_nonce_field('mh_meta_box_nonce', 'meta_box_nonce');
		echo '<p>';
		echo '<label for="mh-subheading">' . esc_html__("Subheading (will be displayed below post title)", 'mh-magazine') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-subheading" id="mh-subheading" placeholder="Enter subheading" value="' . esc_attr(get_post_meta($post->ID, 'mh-subheading', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="mh-alt-ad">' . esc_html__("Alternative ad code (this will overwrite the global content ad code)", 'mh-magazine') . '</label>';
		echo '<br />';
		echo '<textarea name="mh-alt-ad" id="mh-alt-ad" cols="60" rows="3" placeholder="Enter alternative ad code for this post">' . get_post_meta($post->ID, 'mh-alt-ad', true) . '</textarea>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<input type="checkbox" id="mh-no-ad" name="mh-no-ad"'; echo checked(get_post_meta($post->ID, 'mh-no-ad', true), 'on'); echo '/>';
		echo '<label for="mh-no-ad">' . esc_html__('Disable Content Ad for this Post', 'mh-magazine') . '</label>';
		echo '</p>';
		echo '<p>';
		echo '<input type="checkbox" id="mh-no-image" name="mh-no-image"'; echo checked(get_post_meta($post->ID, 'mh-no-image', true), 'on'); echo '/>';
		echo '<label for="mh-no-image">' . esc_html__('Disable Featured Image for this Post', 'mh-magazine') . '</label>';
		echo '</p>';
	}
}

if (!function_exists('mh_save_meta_boxes')) {
	function mh_save_meta_boxes($post_id, $post) {
		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'mh_meta_box_nonce')) {
			return $post->ID;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        	return $post->ID;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post->ID;
			}
		}
		elseif (!current_user_can('edit_post', $post_id)) {
			return $post->ID;
		}
		if ('post' == $_POST['post_type']) {
			$meta_data['mh-subheading'] = esc_attr($_POST['mh-subheading']);
			$meta_data['mh-alt-ad'] = $_POST['mh-alt-ad'];
			$meta_data['mh-no-ad'] = isset($_POST['mh-no-ad']) ? esc_attr($_POST['mh-no-ad']) : '';
			$meta_data['mh-no-image'] = isset($_POST['mh-no-image']) ? esc_attr($_POST['mh-no-image']) : '';
		}
		foreach ($meta_data as $key => $value) {
			if ($post->post_type == 'revision') return;
			$value = implode(',', (array)$value);
			if (get_post_meta($post->ID, $key, FALSE)) {
				update_post_meta($post->ID, $key, $value);
			} else {
				add_post_meta($post->ID, $key, $value);
			}
			if (!$value) delete_post_meta($post->ID, $key);
		}
	}
}
add_action('save_post', 'mh_save_meta_boxes', 10, 2 );

/***** Additional Fields User Profiles *****/

if (!function_exists('mh_user_profile')) {
    function mh_user_profile($user_contact) {
		$user_contact['facebook'] = esc_html__('Facebook', 'mh-magazine');
		$user_contact['instagram'] = esc_html__('Instagram', 'mh-magazine');
		$user_contact['twitter'] = esc_html__('Twitter', 'mh-magazine');
		$user_contact['googleplus'] = esc_html__('Google+', 'mh-magazine');
		$user_contact['youtube'] = esc_html__('YouTube', 'mh-magazine');
		$user_contact['linkedin'] = esc_html__('LinkedIn', 'mh-magazine');
		$user_contact['xing'] = esc_html__('Xing', 'mh-magazine');
		return $user_contact;
    }
    add_filter('user_contactmethods', 'mh_user_profile');
}

?>