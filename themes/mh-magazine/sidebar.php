<?php /* Template for default sidebar */
$mh_magazine_options = mh_magazine_theme_options();
if ($mh_magazine_options['sidebars'] != 'disable') { ?>
	<aside class="mh-widget-col-1 mh-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><?php
		if (is_active_sidebar('mh-sidebar')) {
			dynamic_sidebar('mh-sidebar');
		} else { ?>
			<div class="mh-widget mh-sidebar-empty">
				<h4 class="mh-widget-title">
					<span class="mh-widget-title-inner">
						<?php _ex('Sidebar', 'widget area name', 'mh-magazine'); ?>
					</span>
				</h4>
				<div class="textwidget">
					<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . _x('Sidebar', 'widget area name', 'mh-magazine') . '</em>'); ?>
				</div>
			</div><?php
		} ?>
	</aside><?php
} ?>