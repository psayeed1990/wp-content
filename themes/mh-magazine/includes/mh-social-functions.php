<?php

/***** Load Facebook Script (SDK) *****/

if (!function_exists('mh_magazine_facebook_sdk')) {
	function mh_magazine_facebook_sdk() {
		$mh_magazine_options = mh_magazine_theme_options();
		if (is_active_widget('', '', 'mh_magazine_facebook_page')) {
			global $locale; ?>
			<div id="fb-root"></div>
			<script>
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/<?php echo esc_attr($locale); ?>/sdk.js#xfbml=1&version=v2.9";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script> <?php
		}
	}
}
add_action('wp_footer', 'mh_magazine_facebook_sdk');

/***** Social Buttons on Posts *****/

if (!function_exists('mh_magazine_social_top')) {
	function mh_magazine_social_top() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['social_buttons'] == 'enable' || $mh_magazine_options['social_buttons'] == 'top_social') {
			echo '<div class="mh-social-top">' . "\n";
				get_template_part('content', 'social');
			echo '</div>' . "\n";
		}
	}
}
add_action('mh_post_content_top', 'mh_magazine_social_top');

if (!function_exists('mh_magazine_social_bottom')) {
	function mh_magazine_social_bottom() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['social_buttons'] == 'enable' || $mh_magazine_options['social_buttons'] == 'bottom_social') {
			echo '<div class="mh-social-bottom">' . "\n";
				get_template_part('content', 'social');
			echo '</div>' . "\n";
		}
	}
}
add_action('mh_post_content_bottom', 'mh_magazine_social_bottom');

?>