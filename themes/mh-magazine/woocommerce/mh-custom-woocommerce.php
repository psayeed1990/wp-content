<?php

/***** Declare WooCommerce Compatibility *****/

add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

/***** Register WooCommerce Sidebar *****/

function mh_woocommerce_sb_init() {
	register_sidebar(array('name' => esc_html_x('WooCommerce', 'widget area name', 'mh-magazine'), 'id' => 'mh-woocommerce', 'description' => esc_html__('Widget area (sidebar) on WooCommerce pages', 'mh-magazine'), 'before_widget' => '<div id="%1$s" class="mh-widget sb-woocommerce %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
}
add_action('widgets_init', 'mh_woocommerce_sb_init');

/***** Custom WooCommerce Markup *****/

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

function mh_themes_wrapper_start() { ?>
	<div class="mh-wrapper clearfix">
		<div class="mh-main clearfix">
			<div id="main-content" class="mh-content entry-content" role="main"> <?php
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'mh_themes_wrapper_start', 10);

function mh_themes_wrapper_end() { ?>
			</div>
			<?php $mh_magazine_options = mh_magazine_theme_options(); ?>
			<?php if ($mh_magazine_options['sidebars'] != 'no') { ?>
				<aside class="mh-widget-col-1 mh-sidebar mh-woocommerce-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><?php
					if (is_active_sidebar('mh-woocommerce')) {
						dynamic_sidebar('mh-woocommerce');
					} else { ?>
						<div class="mh-widget mh-sidebar-empty">
							<h4 class="mh-widget-title">
								<span class="mh-widget-title-inner">
									<?php _ex('WooCommerce', 'widget area name', 'mh-magazine'); ?>
								</span>
							</h4>
							<div class="textwidget">
								<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . _x('WooCommerce', 'widget area name', 'mh-magazine') . '</em>'); ?>
							</div>
						</div><?php
					} ?>
	  			</aside>
	  		<?php } ?>
	  	</div>
	  	<?php mh_magazine_second_sidebar(); ?>
  	</div> <?php
}
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'mh_themes_wrapper_end', 10);

/***** Load Custom WooCommerce CSS *****/

function mh_woocommerce_css() {
    wp_register_style('mh-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.css');
    wp_enqueue_style('mh-woocommerce');
}
add_action('wp_enqueue_scripts', 'mh_woocommerce_css');

?>