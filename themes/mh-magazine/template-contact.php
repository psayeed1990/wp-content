<?php /* Template Name: Contact */ ?>
<?php $mh_magazine_options = mh_magazine_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-main clearfix">
    	<div id="main-content" class="mh-content" role="main"><?php
    		while (have_posts()) : the_post();
				mh_before_page_content(); ?>
				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="page-header">
						<?php the_title('<h1 class="entry-title page-title">', '</h1>'); ?>
					</header>
					<div class="entry-content clearfix">
						<?php the_content(); ?>
					</div>
				</article><?php
			endwhile; ?>
        </div>
        <?php if ($mh_magazine_options['sidebars'] != 'no') { ?>
        	<aside class="mh-widget-col-1 mh-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><?php
	        	if (is_active_sidebar('mh-contact')) {
					dynamic_sidebar('mh-contact');
				} else { ?>
					<div class="mh-widget mh-contact mh-sidebar-empty">
						<h4 class="mh-widget-title">
							<span class="mh-widget-title-inner">
								<?php _ex('Contact Sidebar', 'widget area name', 'mh-magazine'); ?>
							</span>
						</h4>
						<div class="textwidget">
							<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . _x('Contact Sidebar', 'widget area name', 'mh-magazine') . '</em>'); ?>
						</div>
					</div><?php
				} ?>
			</aside>
		<?php } ?>
    </div>
    <?php if ($mh_magazine_options['sidebars'] == 'two') { ?>
    	<aside class="mh-widget-col-1 mh-sidebar-2 mh-sidebar-wide mh-margin-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><?php
	        if (is_active_sidebar('mh-contact-2')) {
				dynamic_sidebar('mh-contact-2');
			} else { ?>
				<div class="mh-widget mh-contact-2 mh-sidebar-empty">
					<h4 class="mh-widget-title">
						<span class="mh-widget-title-inner">
							<?php printf(_x('Contact Sidebar %d', 'widget area name', 'mh-magazine'), 2); ?>
						</span>
					</h4>
					<div class="textwidget">
						<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Contact Sidebar %d', 'widget area name', 'mh-magazine'), 2) . '</em>'); ?>
					</div>
				</div><?php
			} ?>
		</aside>
    <?php } ?>
</div>
<?php get_footer(); ?>