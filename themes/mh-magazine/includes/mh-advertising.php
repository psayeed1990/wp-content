<?php

/***** Include Content Ad on Posts *****/

if (!function_exists('mh_magazine_content_ad')) {
	function mh_magazine_content_ad($content) {
		if (is_singular('post') && is_main_query()) {
			global $post;
			$mh_magazine_options = mh_magazine_theme_options();
			$ad_position = 1;
			$paragraphs = explode("<p", $content);
			$counter = 0;
			foreach($paragraphs as $paragraph) {
				if ($counter == 0) {
					$content = $paragraph;
				}
				if ($counter > 0) {
					$content .= '<p' . $paragraph;
				}
				if ($counter == $ad_position) {
           			if (!get_post_meta($post->ID, 'mh-no-ad', true)) {
			   			if (get_post_meta($post->ID, 'mh-alt-ad', true)) {
				   			$adcode = '<div class="mh-content-ad">' . do_shortcode(get_post_meta($post->ID, 'mh-alt-ad', true)) . '</div>' . "\n";
				   		} else {
							$adcode = !empty($mh_magazine_options['content_ad']) ? '<div class="mh-content-ad">' . do_shortcode($mh_magazine_options['content_ad']) . '</div>' . "\n" : '';
						}
						$content .= $adcode;
					}
				}
				$counter++;
			}
			return $content;
		} else {
			return $content;
		}
	}
}
add_filter('the_content', 'mh_magazine_content_ad');

/***** Include Fixed Ads on Archives *****/

if (!function_exists('mh_magazine_archive_ads')) {
	function mh_magazine_archive_ads() {
		$mh_magazine_options = mh_magazine_theme_options();
		$adcode = empty($mh_magazine_options['loop_ad']) ? '' : '<div class="mh-loop-ad">' . do_shortcode($mh_magazine_options['loop_ad']) . '</div>' . "\n";
		echo $adcode;
	}
}

/***** Include Ads between Posts on Archives *****/

if (!function_exists('mh_magazine_loop_ads')) {
	function mh_magazine_loop_ads($post) {
		global $wp_query;
		$mh_magazine_options = mh_magazine_theme_options();
		$woocommerce = '';
		$adcount = empty($mh_magazine_options['loop_ad_no']) ? 3 : $mh_magazine_options['loop_ad_no'];
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			if (is_woocommerce()) {
				$woocommerce = true;
			}
		}
		if ($mh_magazine_options['loop_layout'] === 'layout1' || $mh_magazine_options['loop_layout'] === 'layout2' || $mh_magazine_options['loop_layout'] === 'layout3') {
			if (is_archive() && in_the_loop() && !is_feed() && !$woocommerce || is_home() && in_the_loop() && !is_feed()) {
				if ($wp_query->post != $post)
				return;
				if ($wp_query->current_post === 0)
				return;
				if ($wp_query->current_post % $adcount === 0) {
					mh_magazine_archive_ads();
				}
			}
		}
	}
}
add_action('the_post', 'mh_magazine_loop_ads');

?>