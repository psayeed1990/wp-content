<?php /* Template Name: Homepage */ ?>
<?php $mh_magazine_options = mh_magazine_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-wrapper mh-home clearfix">
	<div class="mh-main mh-home-main">
		<?php dynamic_sidebar('mh-home-1'); ?>
		<?php if (is_active_sidebar('mh-home-2') || is_active_sidebar('mh-home-3') || is_active_sidebar('mh-home-4') || is_active_sidebar('mh-home-5') || is_active_sidebar('mh-home-6')) : ?>
			<div class="mh-home-columns clearfix">
				<div id="main-content" class="mh-content mh-home-content">
		    		<?php dynamic_sidebar('mh-home-2'); ?>
					<?php if (is_active_sidebar('mh-home-3') || is_active_sidebar('mh-home-4')) : ?>
						<div class="clearfix">
							<?php if (is_active_sidebar('mh-home-3')) { ?>
								<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-3">
									<?php dynamic_sidebar('mh-home-3'); ?>
								</div>
							<?php } elseif (is_active_sidebar('mh-home-4')) { ?>
								<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-3">
									<div class="mh-widget mh-home-3 mh-sidebar-empty">
										<h4 class="mh-widget-title">
											<span class="mh-widget-title-inner">
												<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 3); ?>
											</span>
										</h4>
										<div class="textwidget">
											<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 3) . '</em>'); ?>
										</div>
									</div>
								</div>
							<?php } ?>
							<?php if (is_active_sidebar('mh-home-4')) { ?>
								<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-4">
									<?php dynamic_sidebar('mh-home-4'); ?>
								</div>
							<?php } elseif (is_active_sidebar('mh-home-3')) { ?>
								<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-4">
									<div class="mh-widget mh-home-4 mh-sidebar-empty">
										<h4 class="mh-widget-title">
											<span class="mh-widget-title-inner">
												<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 4); ?>
											</span>
										</h4>
										<div class="textwidget">
											<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 4) . '</em>'); ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php endif; ?>
					<?php dynamic_sidebar('mh-home-5'); ?>
				</div>
				<?php if (is_active_sidebar('mh-home-6')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-6">
						<?php dynamic_sidebar('mh-home-6'); ?>
					</div>
				<?php } elseif (is_active_sidebar('mh-home-2') || is_active_sidebar('mh-home-3') || is_active_sidebar('mh-home-4') || is_active_sidebar('mh-home-5')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-6">
						<div class="mh-widget mh-home-6 mh-sidebar-empty">
							<h4 class="mh-widget-title">
								<span class="mh-widget-title-inner">
									<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 6); ?>
								</span>
							</h4>
							<div class="textwidget">
								<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 6) . '</em>'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php dynamic_sidebar('mh-home-7'); ?>
		<?php if (is_active_sidebar('mh-home-8') || is_active_sidebar('mh-home-9') || is_active_sidebar('mh-home-10')) : ?>
			<div class="mh-home-columns clearfix">
	    		<?php if (is_active_sidebar('mh-home-8')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-8">
						<?php dynamic_sidebar('mh-home-8'); ?>
					</div>
				<?php } elseif (is_active_sidebar('mh-home-9') || is_active_sidebar('mh-home-10')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-home-area-8">
						<div class="mh-widget mh-home-8 mh-sidebar-empty">
							<h4 class="mh-widget-title">
								<span class="mh-widget-title-inner">
									<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 8); ?>
								</span>
							</h4>
							<div class="textwidget">
								<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 8) . '</em>'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('mh-home-9')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-9">
						<?php dynamic_sidebar('mh-home-9'); ?>
					</div>
				<?php } elseif (is_active_sidebar('mh-home-8') || is_active_sidebar('mh-home-10')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-9">
						<div class="mh-widget mh-home-9 mh-sidebar-empty">
							<h4 class="mh-widget-title">
								<span class="mh-widget-title-inner">
									<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 9); ?>
								</span>
							</h4>
							<div class="textwidget">
								<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 9) . '</em>'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('mh-home-10')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-10">
						<?php dynamic_sidebar('mh-home-10'); ?>
					</div>
				<?php } elseif (is_active_sidebar('mh-home-8') || is_active_sidebar('mh-home-9')) { ?>
					<div class="mh-widget-col-1 mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-10">
						<div class="mh-widget mh-home-10 mh-sidebar-empty">
							<h4 class="mh-widget-title">
								<span class="mh-widget-title-inner">
									<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 10); ?>
								</span>
							</h4>
							<div class="textwidget">
								<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 10) . '</em>'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php dynamic_sidebar('mh-home-11'); ?>
	</div>
	<?php if ($mh_magazine_options['sidebars'] == 'two') { ?>
		<div class="mh-widget-col-1 mh-sidebar-2 mh-home-sidebar-2 mh-sidebar-wide"><?php
	        if (is_active_sidebar('mh-home-12')) {
				dynamic_sidebar('mh-home-12');
			} else { ?>
				<div class="mh-widget mh-home-12 mh-sidebar-empty">
					<h4 class="mh-widget-title">
						<span class="mh-widget-title-inner">
							<?php printf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 12); ?>
						</span>
					</h4>
					<div class="textwidget">
						<?php printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Home %d - 1/3 Width', 'widget area name', 'mh-magazine'), 12) . '</em>'); ?>
					</div>
				</div><?php
			} ?>
		</div>
	<?php } ?>
</div>
<?php get_footer(); ?>