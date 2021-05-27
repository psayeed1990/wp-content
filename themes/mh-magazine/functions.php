<?php

/***** Fetch Theme Data & Options *****/

$mh_magazine_data = wp_get_theme('mh-magazine');
$mh_magazine_version = $mh_magazine_data['Version'];
$mh_magazine_options = get_option('mh_magazine_options');

/***** Custom Hooks *****/

function mh_html_class() {
    do_action('mh_html_class');
}
function mh_before_header() {
    do_action('mh_before_header');
}
function mh_after_header() {
    do_action('mh_after_header');
}
function mh_before_page_content() {
    do_action('mh_before_page_content');
}
function mh_after_page_content() {
    do_action('mh_after_page_content');
}
function mh_before_post_content() {
    do_action('mh_before_post_content');
}
function mh_after_post_content() {
    do_action('mh_after_post_content');
}
function mh_post_header() {
    do_action('mh_post_header');
}
function mh_post_content_top() {
    do_action('mh_post_content_top');
}
function mh_post_content_bottom() {
    do_action('mh_post_content_bottom');
}
function mh_loop_content() {
    do_action('mh_loop_content');
}
function mh_before_footer() {
    do_action('mh_before_footer');
}
function mh_after_footer() {
    do_action('mh_after_footer');
}
function mh_before_container_close() {
    do_action('mh_before_container_close');
}

/***** Theme Setup *****/

if (!function_exists('mh_magazine_theme_setup')) {
	function mh_magazine_theme_setup() {
		load_theme_textdomain('mh-magazine', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
		add_theme_support('post-thumbnails');
		add_theme_support('post-formats', array('image', 'video', 'gallery', 'audio'));
		add_theme_support('custom-background', array('default-color' => 'f7f7f7'));
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '000', 'width' => 1080, 'height' => 250, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('custom-logo', array('width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_magazine_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_magazine_custom_menus')) {
	function mh_magazine_custom_menus() {
		register_nav_menus(array(
			'mh_header_nav' => esc_html__('Header Navigation', 'mh-magazine'),
			'mh_social_nav' => esc_html__('Social Icons in Header', 'mh-magazine'),
			'mh_main_nav' => esc_html__('Main Navigation', 'mh-magazine'),
			'mh_extra_nav' => esc_html__('Additional Navigation (below Main Navigation)', 'mh-magazine'),
			'mh_footer_nav' => esc_html__('Footer Navigation', 'mh-magazine'),
			'mh_social_widget' => esc_html__('MH Social Widget', 'mh-magazine')
		));
	}
}
add_action('after_setup_theme', 'mh_magazine_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_magazine_image_sizes')) {
	function mh_magazine_image_sizes() {
		add_image_size('mh-magazine-slider', 1030, 438, true);
		add_image_size('mh-magazine-content', 678, 381, true);
		add_image_size('mh-magazine-large', 678, 509, true);
		add_image_size('mh-magazine-medium', 326, 245, true);
		add_image_size('mh-magazine-small', 80, 60, true);
	}
}
add_action('after_setup_theme', 'mh_magazine_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_magazine_content_width')) {
	function mh_magazine_content_width() {
		global $content_width;
		$mh_magazine_options = mh_magazine_theme_options();
		if (!isset($content_width)) {
			if ($mh_magazine_options['sidebars'] == 'no') {
				$content_width = 1030;
			} elseif (is_page_template('template-full.php')) {
				if ($mh_magazine_options['sidebars'] == 'two') {
					$content_width = 1381;
				} else {
					$content_width = 1030;
				}
			} else {
				$content_width = 678;
			}
		}
	}
}
add_action('template_redirect', 'mh_magazine_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_magazine_scripts')) {
	function mh_magazine_scripts() {
		global $mh_magazine_version;
		wp_enqueue_style('mh-magazine', get_stylesheet_uri(), false, $mh_magazine_version);
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), $mh_magazine_version);
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_magazine_scripts');

if (!function_exists('mh_magazine_admin_scripts')) {
	function mh_magazine_admin_scripts($hook) {
		if ('appearance_page_magazine' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_magazine_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_magazine_widgets_init')) {
	function mh_magazine_widgets_init() {
		$mh_magazine_options = mh_magazine_theme_options();
		register_sidebar(array('name' => esc_html_x('Sidebar', 'widget area name', 'mh-magazine'), 'id' => 'mh-sidebar', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		if ($mh_magazine_options['sidebars'] == 'two') {
			register_sidebar(array('name' => sprintf(esc_html_x('Sidebar %d', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-sidebar-2', 'description' => esc_html__('Second sidebar on single posts, pages and archives.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		}
		register_sidebar(array('name' => sprintf(esc_html_x('Header %d - Advertisement', 'widget area name', 'mh-magazine'), 1), 'id' => 'mh-header-1', 'description' => esc_html__('Advertisement position located above the header, suitable for a single text widget.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-header-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Header %d - Advertisement', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-header-2', 'description' => esc_html__('Widget area on top of the site.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-header-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-magazine'), 1), 'id' => 'mh-home-1', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-1 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 2/3 Width', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-home-2', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-2 mh-widget-col-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 3), 'id' => 'mh-home-3', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 4), 'id' => 'mh-home-4', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-4 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 2/3 Width', 'widget area name', 'mh-magazine'), 5), 'id' => 'mh-home-5', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-5 mh-widget-col-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 6), 'id' => 'mh-home-6', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-6 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-magazine'), 7), 'id' => 'mh-home-7', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-7 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 8), 'id' => 'mh-home-8', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-8 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 9), 'id' => 'mh-home-9', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-9 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 10), 'id' => 'mh-home-10', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-10 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-magazine'), 11), 'id' => 'mh-home-11', 'description' => esc_html__('Widget area on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-11 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		if ($mh_magazine_options['sidebars'] == 'two') {
			register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 12), 'id' => 'mh-home-12', 'description' => esc_html__('Sidebar on homepage.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-12 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		}
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d - Advertisement', 'widget area name', 'mh-magazine'), 1), 'id' => 'mh-posts-1', 'description' => esc_html__('Widget area above single post content.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-posts-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d - Advertisement', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-posts-2', 'description' => esc_html__('Widget area below single post content.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-posts-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d - Advertisement', 'widget area name', 'mh-magazine'), 1), 'id' => 'mh-pages-1', 'description' => esc_html__('Widget area above single page content.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-pages-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d - Advertisement', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-pages-2', 'description' => esc_html__('Widget area below single page content.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-pages-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/4 Width', 'widget area name', 'mh-magazine'), 1), 'id' => 'mh-footer-1', 'description' => esc_html__('Widget area in footer.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-widget-title mh-footer-widget-title"><span class="mh-widget-title-inner mh-footer-widget-title-inner">', 'after_title' => '</span></h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/4 Width', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-footer-2', 'description' => esc_html__('Widget area in footer.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-widget-title mh-footer-widget-title"><span class="mh-widget-title-inner mh-footer-widget-title-inner">', 'after_title' => '</span></h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/4 Width', 'widget area name', 'mh-magazine'), 3), 'id' => 'mh-footer-3', 'description' => esc_html__('Widget area in footer.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-widget-title mh-footer-widget-title"><span class="mh-widget-title-inner mh-footer-widget-title-inner">', 'after_title' => '</span></h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/4 Width', 'widget area name', 'mh-magazine'), 4), 'id' => 'mh-footer-4', 'description' => esc_html__('Widget area in footer.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-widget-title mh-footer-widget-title"><span class="mh-widget-title-inner mh-footer-widget-title-inner">', 'after_title' => '</span></h6>'));
		register_sidebar(array('name' => esc_html_x('Contact Sidebar', 'widget area name', 'mh-magazine'), 'id' => 'mh-contact', 'description' => esc_html__('Widget area (sidebar) on contact page template.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-contact %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		if ($mh_magazine_options['sidebars'] == 'two') {
			register_sidebar(array('name' => sprintf(esc_html_x('Contact Sidebar %d', 'widget area name', 'mh-magazine'), 2), 'id' => 'mh-contact-2', 'description' => esc_html__('2nd widget area (sidebar) on contact page template.', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-contact-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
		}
	}
}
add_action('widgets_init', 'mh_magazine_widgets_init');

/***** Include additional files *****/

require_once('includes/mh-breadcrumb.php');
require_once('includes/mh-customizer.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-custom-colors.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-social-functions.php');
require_once('includes/mh-advertising.php');
require_once('includes/mh-helper-functions.php');
require_once('includes/mh-compatibility.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

/***** Check if Jetpack plugin is installed *****/

if (class_exists('Jetpack')) {
	require_once('includes/mh-jetpack.php');
}

/***** Check if WooCommerce plugin is installed and active *****/

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if (is_plugin_active('woocommerce/woocommerce.php')) {
	require_once('woocommerce/mh-custom-woocommerce.php');
}

?>