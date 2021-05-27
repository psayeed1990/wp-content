<?php

/***** Add Custom Color Options to Customizer *****/

function mh_magazine_color_options($wp_customize) {

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_magazine_options[color_bg_header]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_bg_inner]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_1]', array('default' => '#2a2a2a', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_2]', array('default' => '#e64946', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_3]', array('default' => '#f5f5f5', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_text_general]', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_text_1]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_text_2]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_text_3]', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_text_meta]', array('default' => '#979797', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_magazine_options[color_links', array('default' => '#e64946', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_magazine_options[color_links_hover', array('default' => '#e64946', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    /***** Add Controls *****/

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_bg_header', array('label' => esc_html__('Background Header', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_bg_header]', 'priority' => 50)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_bg_inner', array('label' => esc_html__('Background Inner', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_bg_inner]', 'priority' => 51)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-magazine'), 1), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_1]', 'priority' => 52)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-magazine'), 2), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_2]', 'priority' => 53)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_3', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-magazine'), 3), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_3]', 'priority' => 54)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_general', array('label' => esc_html__('Text: General', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_text_general]', 'priority' => 55)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_1', array('label' => sprintf(esc_html_x('Text: Colored Sections (Color %d)', 'options panel', 'mh-magazine'), 1), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_text_1]', 'priority' => 56)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_2', array('label' => sprintf(esc_html_x('Text: Colored Sections (Color %d)', 'options panel', 'mh-magazine'), 2), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_text_2]', 'priority' => 57)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_3', array('label' => sprintf(esc_html_x('Text: Colored Sections (Color %d)', 'options panel', 'mh-magazine'), 3), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_text_3]', 'priority' => 58)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_meta', array('label' => esc_html__('Text: Post Meta', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_text_meta]', 'priority' => 59)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links', array('label' => esc_html__('Links: Content on Posts/Pages', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_links]', 'priority' => 60)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links_hover', array('label' => esc_html__('Links: Hover Color', 'mh-magazine'), 'section' => 'colors', 'settings' => 'mh_magazine_options[color_links_hover]', 'priority' => 61)));
}
add_action('customize_register', 'mh_magazine_color_options');

/***** Default Custom Colors *****/

if (!function_exists('mh_magazine_custom_colors')) {
	function mh_magazine_custom_colors() {
		$custom_colors = wp_parse_args(
			get_option('mh_magazine_options', array()),
			mh_magazine_default_colors()
		);
		return $custom_colors;
	}
}

if (!function_exists('mh_magazine_default_colors')) {
	function mh_magazine_default_colors() {
		$default_colors = array(
			'color_bg_header' => '#ffffff',
			'color_bg_inner' => '#ffffff',
			'color_1' => '#2a2a2a',
			'color_2' => '#e64946',
			'color_3' => '#f5f5f5',
			'color_text_general' => '#000000',
			'color_text_1' => '#ffffff',
			'color_text_2' => '#ffffff',
			'color_text_3' => '#000000',
			'color_text_meta' => '#979797',
			'color_links' => '#e64946',
			'color_links_hover' => '#e64946'
		);
		return $default_colors;
	}
}

/***** Custom Colors CSS Output *****/

function mh_magazine_custom_colors_css() {
	$mh_magazine_colors = mh_magazine_custom_colors();
	if ($mh_magazine_colors['color_bg_header'] != '#ffffff' || $mh_magazine_colors['color_bg_inner'] != '#ffffff' || $mh_magazine_colors['color_1'] != '#2a2a2a' || $mh_magazine_colors['color_2'] != '#e64946' || $mh_magazine_colors['color_3'] != '#f5f5f5' || $mh_magazine_colors['color_text_general'] != '#000000' || $mh_magazine_colors['color_text_1'] != '#ffffff' || $mh_magazine_colors['color_text_2'] != '#ffffff' || $mh_magazine_colors['color_text_3'] != '#000000' || $mh_magazine_colors['color_text_meta'] != '#979797' || $mh_magazine_colors['color_links'] != '#e64946' || $mh_magazine_colors['color_links_hover'] != '#e64946') {
    	$mh_magazine_hex_1 = $mh_magazine_colors['color_1'];
		$mh_magazine_hex_2 = $mh_magazine_colors['color_2'];
		list($mh_magazine_hex_1_red, $mh_magazine_hex_1_green, $mh_magazine_hex_1_blue) = sscanf($mh_magazine_hex_1, "#%02x%02x%02x");
		list($mh_magazine_hex_2_red, $mh_magazine_hex_2_green, $mh_magazine_hex_2_blue) = sscanf($mh_magazine_hex_2, "#%02x%02x%02x");
    	echo '<style type="text/css">' . "\n";
			if ($mh_magazine_colors['color_bg_header'] != '#ffffff') {
    			echo '.mh-header { background: ' . $mh_magazine_colors['color_bg_header'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_bg_inner'] != '#ffffff') {
    			echo '.mh-wrapper, .mh-widget-layout8 .mh-widget-title-inner, #mh-mobile .mh-slider-layout4 .mh-slider-caption { background: ' . $mh_magazine_colors['color_bg_inner'] . '; }' . "\n";
    			echo '.mh-breadcrumb, .entry-header .entry-meta, .mh-subheading-top, .mh-author-box, .mh-author-box-avatar, .mh-post-nav, .mh-comment-list .comment-body, .mh-comment-list .avatar, .mh-ping-list .mh-ping-item, .mh-ping-list .mh-ping-item:first-child, .mh-loop-description, .mh-loop-ad, .mh-sitemap-list > li, .mh-sitemap-list .children li, .mh-widget-layout7 .mh-widget-title, .mh-custom-posts-item, .mh-posts-large-item, .mh-posts-list-item, #mh-mobile .mh-posts-grid, #mh-mobile .mh-posts-grid-col, #mh-mobile .mh-posts-digest-wrap, #mh-mobile .mh-posts-digest-item, #mh-mobile .mh-posts-focus-item, .mh-category-column-item, .mh-user-item, .widget_archive li, .widget_categories li, .widget_pages li a, .widget_meta li, .widget_nav_menu .menu > li, .widget_rss li, .widget_recent_entries li, .recentcomments, .mh-box, table, td, th, pre { border-color: rgba(255, 255, 255, 0.3); }' . "\n";
    			echo '#mh-mobile .mh-posts-stacked-overlay-small { border-color: ' . $mh_magazine_colors['color_bg_inner'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_1'] != '#2a2a2a') {
    			echo '.mh-navigation li:hover, .mh-navigation ul li:hover > ul, .mh-main-nav-wrap, .mh-main-nav, .mh-social-nav li a:hover, .entry-tags li, .mh-slider-caption, .mh-widget-layout8 .mh-widget-title .mh-footer-widget-title-inner, .mh-widget-col-1 .mh-slider-caption, .mh-widget-col-1 .mh-posts-lineup-caption, .mh-carousel-layout1, .mh-spotlight-widget, .mh-social-widget li a, .mh-author-bio-widget, .mh-footer-widget .mh-tab-comment-excerpt, .mh-nip-item:hover .mh-nip-overlay, .mh-widget .tagcloud a, .mh-footer-widget .tagcloud a, .mh-footer, .mh-copyright-wrap, input[type=submit]:hover, #infinite-handle span:hover { background: ' . $mh_magazine_colors['color_1'] . '; }' . "\n";
				echo '.mh-extra-nav-bg { background: rgba(' . $mh_magazine_hex_1_red . ', ' . $mh_magazine_hex_1_green . ', ' . $mh_magazine_hex_1_blue . ', 0.2); }' . "\n";
				echo '.mh-slider-caption, .mh-posts-stacked-title, .mh-posts-lineup-caption { background: ' . $mh_magazine_colors['color_1'] . '; background: rgba(' . $mh_magazine_hex_1_red . ', ' . $mh_magazine_hex_1_green . ', ' . $mh_magazine_hex_1_blue . ', 0.8); }' . "\n";
				echo '@media screen and (max-width: 900px) { #mh-mobile .mh-slider-caption, #mh-mobile .mh-posts-lineup-caption { background: rgba(' . $mh_magazine_hex_1_red . ', ' . $mh_magazine_hex_1_green . ', ' . $mh_magazine_hex_1_blue . ', 1); } }' . "\n";
				echo '.slicknav_menu, .slicknav_nav ul, #mh-mobile .mh-footer-widget .mh-posts-stacked-overlay { border-color: ' . $mh_magazine_colors['color_1'] . '; }' . "\n";
				echo '.mh-copyright, .mh-copyright a { color: #fff; }' . "\n";
			}
			if ($mh_magazine_colors['color_2'] != '#e64946') {
				echo '.mh-widget-layout4 .mh-widget-title { background: ' . $mh_magazine_colors['color_2'] . '; background: rgba(' . $mh_magazine_hex_2_red . ', ' . $mh_magazine_hex_2_green . ', ' . $mh_magazine_hex_2_blue . ', 0.6); }' . "\n";
    			echo '.mh-preheader, .mh-wide-layout .mh-subheader, .mh-ticker-title, .mh-main-nav li:hover, .mh-footer-nav, .slicknav_menu, .slicknav_btn, .slicknav_nav .slicknav_item:hover, .slicknav_nav a:hover, .mh-back-to-top, .mh-subheading, .entry-tags .fa, .entry-tags li:hover, .mh-widget-layout2 .mh-widget-title, .mh-widget-layout4 .mh-widget-title-inner, .mh-widget-layout4 .mh-footer-widget-title, .mh-widget-layout5 .mh-widget-title-inner, .mh-widget-layout6 .mh-widget-title, #mh-mobile .flex-control-paging li a.flex-active, .mh-image-caption, .mh-carousel-layout1 .mh-carousel-caption, .mh-tab-button.active, .mh-tab-button.active:hover, .mh-footer-widget .mh-tab-button.active, .mh-social-widget li:hover a, .mh-footer-widget .mh-social-widget li a, .mh-footer-widget .mh-author-bio-widget, .tagcloud a:hover, .mh-widget .tagcloud a:hover, .mh-footer-widget .tagcloud a:hover, .mh-posts-stacked-item .mh-meta, .page-numbers:hover, .mh-loop-pagination .current, .mh-comments-pagination .current, .pagelink, a:hover .pagelink, input[type=submit], #infinite-handle span { background: ' . $mh_magazine_colors['color_2'] . '; }' . "\n";
				echo '.mh-main-nav-wrap .slicknav_nav ul, blockquote, .mh-widget-layout1 .mh-widget-title, .mh-widget-layout3 .mh-widget-title, .mh-widget-layout5 .mh-widget-title, .mh-widget-layout8 .mh-widget-title:after, #mh-mobile .mh-slider-caption, .mh-carousel-layout1, .mh-spotlight-widget, .mh-author-bio-widget, .mh-author-bio-title, .mh-author-bio-image-frame, .mh-video-widget, .mh-tab-buttons, textarea:hover, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover { border-color: ' . $mh_magazine_colors['color_2'] . '; }' . "\n";
				echo '.mh-dropcap, .mh-carousel-layout1 .flex-direction-nav a, .mh-carousel-layout2 .mh-carousel-caption, .mh-posts-digest-small-category, .mh-posts-lineup-more, .bypostauthor .fn:after, .mh-comment-list .comment-reply-link:before, #respond #cancel-comment-reply-link:before { color: ' . $mh_magazine_colors['color_2'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_3'] != '#f5f5f5') {
    			echo '.mh-subheader, .page-numbers, a .pagelink, .mh-widget-layout3 .mh-widget-title, .mh-widget .search-form, .mh-tab-button, .mh-tab-content, .mh-nip-widget, .mh-magazine-facebook-page-widget, .mh-social-widget, .mh-posts-horizontal-widget, .mh-ad-spot, .mh-info-spot { background: ' . $mh_magazine_colors['color_3'] . '; }' . "\n";
				echo '.mh-tab-post-item { border-color: rgba(255, 255, 255, 0.3); }' . "\n";
				echo '.mh-tab-comment-excerpt { background: rgba(255, 255, 255, 0.6); }' . "\n";
			}
			if ($mh_magazine_colors['color_text_general'] != '#000000') {
    			echo 'body, a, blockquote, blockquote cite, .post .entry-title, .page-title, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, .wp-caption-text, #respond .comment-reply-title, #respond #cancel-comment-reply-link, #respond .logged-in-as a, .mh-ping-list .mh-ping-item a, .mh-widget-layout1 .mh-widget-title, .mh-widget-layout7 .mh-widget-title, .mh-widget-layout8 .mh-widget-title, .mh-slider-layout4 .mh-slider-caption, .mh-slider-layout4 .mh-slider-caption a, .mh-slider-layout4 .mh-slider-caption a:hover { color: ' . $mh_magazine_colors['color_text_general'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_text_1'] != '#ffffff') {
    			echo '#mh-mobile .mh-header-nav li:hover a, .mh-main-nav li a, .mh-extra-nav li:hover a, .mh-footer-nav li:hover a, .mh-social-nav li:hover .fa-mh-social, .mh-main-nav-wrap .slicknav_menu a, .mh-main-nav-wrap .slicknav_menu a:hover, .entry-tags a, .mh-slider-caption, .mh-slider-caption a, .mh-slider-caption a:hover, .mh-spotlight-widget, #mh-mobile .mh-spotlight-widget a, #mh-mobile .mh-spotlight-widget a:hover, .mh-spotlight-widget .mh-spotlight-meta, .mh-posts-stacked-title a, .mh-posts-stacked-title a:hover, .mh-posts-lineup-widget a, .mh-posts-lineup-widget a:hover, .mh-posts-lineup-caption, .mh-footer-widget .mh-tabbed-widget, .mh-footer-widget .mh-tabbed-widget a, .mh-footer-widget .mh-tabbed-widget a:hover, .mh-author-bio-title, .mh-author-bio-text, .mh-social-widget .fa-mh-social, .mh-footer, .mh-footer a, .mh-footer a:hover, .mh-footer .mh-meta, .mh-footer .mh-meta a, .mh-footer .mh-meta a:hover, .mh-footer .wp-caption-text, .mh-widget-layout1 .mh-widget-title.mh-footer-widget-title, .mh-widget-layout1 .mh-widget-title.mh-footer-widget-title a, .mh-widget-layout3 .mh-widget-title.mh-footer-widget-title, .mh-widget-layout3 .mh-widget-title.mh-footer-widget-title a, .mh-widget-layout7 .mh-widget-title.mh-footer-widget-title, .mh-widget-layout7 .mh-widget-title.mh-footer-widget-title a, .mh-widget-layout8 .mh-widget-title.mh-footer-widget-title, .mh-widget-layout8 .mh-widget-title.mh-footer-widget-title a, .mh-copyright, .mh-copyright a, .mh-copyright a:hover, .tagcloud a, .mh-tabbed-widget .tagcloud a, input[type=submit]:hover, #infinite-handle span:hover { color: ' . $mh_magazine_colors['color_text_1'] . '; }' . "\n";
				echo '.mh-main-nav-wrap .slicknav_menu .slicknav_icon-bar { background: ' . $mh_magazine_colors['color_text_1'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_text_2'] != '#ffffff') {
    			echo '.mh-header-nav-top li a, .mh-wide-layout .mh-header-nav-bottom li a, .mh-main-nav li:hover > a, .mh-footer-nav li a, .mh-social-nav-top .fa-mh-social, .mh-wide-layout .mh-social-nav-bottom .fa-mh-social, .slicknav_nav a, .slicknav_nav a:hover, .slicknav_nav .slicknav_item:hover, .slicknav_menu .slicknav_menutxt, .mh-header-date-top, .mh-wide-layout .mh-header-date-bottom, .mh-ticker-title, .mh-boxed-layout .mh-ticker-item-top a, .mh-wide-layout .mh-ticker-item a, .mh-subheading, .entry-tags .fa, .entry-tags a:hover, .mh-content .current, .page-numbers:hover, .pagelink, a:hover .pagelink, .mh-back-to-top, .mh-back-to-top:hover, .mh-widget-layout2 .mh-widget-title, .mh-widget-layout2 .mh-widget-title a, .mh-widget-layout4 .mh-widget-title-inner, .mh-widget-layout4 .mh-widget-title a, .mh-widget-layout5 .mh-widget-title, .mh-widget-layout5 .mh-widget-title a, .mh-widget-layout6 .mh-widget-title, .mh-widget-layout6 .mh-widget-title a, .mh-image-caption, .mh-carousel-layout1 .mh-carousel-caption, .mh-footer-widget .mh-author-bio-title, .mh-footer-widget .mh-author-bio-text, .mh-social-widget li:hover .fa-mh-social, .mh-footer-widget .mh-social-widget .fa-mh-social, #mh-mobile .mh-tab-button.active, .mh-tab-button.active:hover, .tagcloud a:hover, .mh-widget .tagcloud a:hover, .mh-footer-widget .tagcloud a:hover, .mh-posts-stacked-item .mh-meta, .mh-posts-stacked-item .mh-meta a, .mh-posts-stacked-item .mh-meta a:hover, input[type=submit], #infinite-handle span { color: ' . $mh_magazine_colors['color_text_2'] . '; }' . "\n";
				echo '.slicknav_menu .slicknav_icon-bar { background: ' . $mh_magazine_colors['color_text_2'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_text_3'] != '#000000') {
    			echo '.mh-header-nav-bottom li a, .mh-social-nav-bottom .fa-mh-social, .mh-boxed-layout .mh-ticker-item-bottom a, .mh-header-date-bottom, .page-numbers, a .pagelink, .mh-widget-layout3 .mh-widget-title, .mh-widget-layout3 .mh-widget-title a, .mh-tabbed-widget, .mh-tabbed-widget a, .mh-posts-horizontal-title a { color: ' . $mh_magazine_colors['color_text_3'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_text_meta'] != '#979797') {
    			echo '.mh-meta, .mh-meta a, .mh-breadcrumb, .mh-breadcrumb a, .mh-comment-list .comment-meta, .mh-comment-list .comment-meta a, .mh-comment-list .comment-reply-link, .mh-user-data, .widget_rss .rss-date, .widget_rss cite { color: ' . $mh_magazine_colors['color_text_meta'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_links'] != '#e64946') {
    			echo '.entry-content a { color: ' . $mh_magazine_colors['color_links'] . '; }' . "\n";
			}
			if ($mh_magazine_colors['color_links_hover'] != '#e64946') {
    			echo 'a:hover, .entry-content a:hover, #respond a:hover, #respond #cancel-comment-reply-link:hover, #respond .logged-in-as a:hover, .mh-comment-list .comment-meta a:hover, .mh-ping-list .mh-ping-item a:hover, .mh-meta a:hover, .mh-breadcrumb a:hover, .mh-tabbed-widget a:hover { color: ' . $mh_magazine_colors['color_links_hover'] . '; }' . "\n";
			}
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_magazine_custom_colors_css');

?>