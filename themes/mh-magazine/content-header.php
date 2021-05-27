<?php $mh_magazine_options = mh_magazine_theme_options(); ?>
<div class="mh-header-nav-mobile clearfix"></div>
<?php if ($mh_magazine_options['header_top_left'] === 'navigation' && has_nav_menu('mh_header_nav') || $mh_magazine_options['header_top_left'] !== 'disable' || $mh_magazine_options['header_top_right'] === 'social' && has_nav_menu('mh_social_nav') || $mh_magazine_options['header_top_right'] !== 'disable') { ?>
	<div class="mh-preheader">
    	<div class="mh-container mh-container-inner mh-row clearfix">
			<?php if ($mh_magazine_options['header_top_left'] === 'navigation' && has_nav_menu('mh_header_nav') || $mh_magazine_options['header_top_left'] !== 'disable') { ?>
				<div class="mh-header-bar-content mh-header-bar-top-left mh-col-2-3 clearfix">
					<?php if ($mh_magazine_options['header_top_left'] === 'navigation' && has_nav_menu('mh_header_nav')) { ?>
						<nav class="mh-navigation mh-header-nav mh-header-nav-top clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array('theme_location' => 'mh_header_nav')); ?>
						</nav>
					<?php } elseif ($mh_magazine_options['header_top_left'] === 'date') { ?>
						<div class="mh-header-date mh-header-date-top">
							<?php echo date_i18n(get_option('date_format')); ?>
						</div>
					<?php } elseif ($mh_magazine_options['header_top_left'] === 'ticker') { ?>
						<div class="mh-header-ticker mh-header-ticker-top">
							<?php get_template_part('content', 'ticker-top'); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if ($mh_magazine_options['header_top_right'] === 'social' && has_nav_menu('mh_social_nav') || $mh_magazine_options['header_top_right'] !== 'disable') { ?>
				<div class="mh-header-bar-content mh-header-bar-top-right mh-col-1-3 clearfix">
					<?php if ($mh_magazine_options['header_top_right'] === 'social' && has_nav_menu('mh_social_nav')) { ?>
						<nav class="mh-social-icons mh-social-nav mh-social-nav-top clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array('theme_location' => 'mh_social_nav', 'link_before' => '<i class="fa fa-mh-social"></i><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
						</nav>
					<?php } elseif ($mh_magazine_options['header_top_right'] === 'date') { ?>
						<div class="mh-header-date mh-header-date-top">
							<?php echo date_i18n(get_option('date_format')); ?>
						</div>
					<?php } elseif ($mh_magazine_options['header_top_right'] === 'search') { ?>
						<aside class="mh-header-search mh-header-search-top">
							<?php get_search_form(); ?>
						</aside>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<header class="mh-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="mh-container mh-container-inner clearfix">
		<?php mh_magazine_custom_header(); ?>
	</div>
	<div class="mh-main-nav-wrap">
		<nav class="mh-navigation mh-main-nav mh-container mh-container-inner clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array('theme_location' => 'mh_main_nav')); ?>
		</nav>
	</div>
	<?php if (has_nav_menu('mh_extra_nav')) { ?>
		<div class="mh-extra-nav-wrap">
			<div class="mh-extra-nav-bg">
				<nav class="mh-navigation mh-extra-nav mh-container mh-container-inner clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'mh_extra_nav')); ?>
				</nav>
			</div>
		</div>
	<?php } ?>
</header>
<?php if ($mh_magazine_options['header_bottom_left'] !== 'disable' || $mh_magazine_options['header_bottom_left'] === 'navigation' && has_nav_menu('mh_header_nav') || $mh_magazine_options['header_bottom_right'] !== 'disable' || $mh_magazine_options['header_bottom_right'] === 'social' && has_nav_menu('mh_social_nav')) { ?>
	<div class="mh-subheader">
		<div class="mh-container mh-container-inner mh-row clearfix">
			<?php if ($mh_magazine_options['header_bottom_left'] !== 'disable' || $mh_magazine_options['header_bottom_left'] === 'navigation' && has_nav_menu('mh_header_nav')) { ?>
				<div class="mh-header-bar-content mh-header-bar-bottom-left mh-col-2-3 clearfix">
					<?php if ($mh_magazine_options['header_bottom_left'] === 'ticker') { ?>
						<div class="mh-header-ticker mh-header-ticker-bottom">
							<?php get_template_part('content', 'ticker-bottom'); ?>
						</div>
					<?php } elseif ($mh_magazine_options['header_bottom_left'] === 'date') { ?>
						<div class="mh-header-date mh-header-date-bottom">
							<?php echo date_i18n(get_option('date_format')); ?>
						</div>
					<?php } elseif ($mh_magazine_options['header_bottom_left'] === 'navigation' && has_nav_menu('mh_header_nav')) { ?>
						<nav class="mh-navigation mh-header-nav mh-header-nav-bottom clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array('theme_location' => 'mh_header_nav')); ?>
						</nav>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if ($mh_magazine_options['header_bottom_right'] !== 'disable' || $mh_magazine_options['header_bottom_right'] === 'social' && has_nav_menu('mh_social_nav')) { ?>
				<div class="mh-header-bar-content mh-header-bar-bottom-right mh-col-1-3 clearfix">
					<?php if ($mh_magazine_options['header_bottom_right'] === 'search') { ?>
						<aside class="mh-header-search mh-header-search-bottom">
							<?php get_search_form(); ?>
						</aside>
					<?php } elseif ($mh_magazine_options['header_bottom_right'] === 'date') { ?>
						<div class="mh-header-date mh-header-date-bottom">
							<?php echo date_i18n(get_option('date_format')); ?>
						</div>
					<?php } elseif ($mh_magazine_options['header_bottom_right'] === 'social' && has_nav_menu('mh_social_nav')) { ?>
						<nav class="mh-social-icons mh-social-nav mh-social-nav-bottom clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array('theme_location' => 'mh_social_nav', 'link_before' => '<i class="fa fa-mh-social"></i><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
						</nav>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>