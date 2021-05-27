<?php

/***** Add Support for Infinite Scroll *****/

if (!function_exists('mh_magazine_infinite_scroll')) {
	function mh_magazine_infinite_scroll() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['loop_layout'] === 'layout3' || $mh_magazine_options['loop_layout'] === 'layout5') {
			$layout = 'mh_magazine_infinite_scroll_render';
		} else {
			$layout = 'mh_magazine_loop_layout';
		}
		add_theme_support('infinite-scroll', array(
    		'container' => 'main-content',
			'footer_widgets' => array('mh-footer-1', 'mh-footer-2', 'mh-footer-3', 'mh-footer-4'),
			'render' => $layout,
		));
	}
}
add_action('after_setup_theme', 'mh_magazine_infinite_scroll');

/***** Add Infinite Scroll Support for Complex Archive Layouts *****/

if (!function_exists('mh_magazine_infinite_scroll_render')) {
	function mh_magazine_infinite_scroll_render() {
		while (have_posts()) : the_post();
			get_template_part('content', 'list');
		endwhile;
	}
}

?>