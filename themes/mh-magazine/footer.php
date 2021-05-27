<?php mh_before_footer(); ?>
<?php mh_magazine_footer_widgets(); ?>
<?php if (has_nav_menu('mh_footer_nav')) { ?>
	<div class="mh-footer-nav-mobile"></div>
	<nav class="mh-navigation mh-footer-nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
		<div class="mh-container mh-container-inner clearfix">
			<?php wp_nav_menu(array('theme_location' => 'mh_footer_nav', 'fallback_cb' => '')); ?>
		</div>
	</nav>
<?php } ?>
<div class="mh-copyright-wrap">
	<div class="mh-container mh-container-inner clearfix">
		<p class="mh-copyright">
			<?php mh_magazine_copyright_notice(); ?>
		</p>
	</div>
</div>
<?php mh_after_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>