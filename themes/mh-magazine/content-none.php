<?php /* The template for displaying a "Nothing Found" message. */ ?>
<header class="page-header">
	<h1 class="page-title">
		<?php esc_html_e('Nothing found', 'mh-magazine'); ?>
	</h1>
</header>
<div class="entry-content mh-widget">
	<?php if (is_search()) { ?>
		<div class="mh-box">
			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mh-magazine'); ?></p>
		</div>
	<?php } else { ?>
		<div class="mh-box">
			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mh-magazine'); ?></p>
		</div>
	<?php } ?>
	<h4 class="mh-widget-title mh-404-search">
		<span class="mh-widget-title-inner">
			<?php esc_html_e('Search', 'mh-magazine'); ?>
		</span>
	</h4>
	<?php get_search_form(); ?>
</div>
<div class="mh-404-columns clearfix">
	<div class="mh-sidebar mh-home-sidebar mh-home-area-3"><?php
		$instance = array('title' => esc_html__('Latest Articles', 'mh-magazine'), 'postcount' => 5, 'order' => 'date', 'excerpt' => 'first', 'sticky' => 1);
		$args = array('before_widget' => '<div class="mh-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>');
		the_widget('mh_magazine_custom_posts', $instance , $args); ?>
	</div>
	<div class="mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-4"><?php
		$instance = array('title' => esc_html__('Popular Articles', 'mh-magazine'), 'postcount' => 5, 'order' => 'comment_count', 'excerpt' => 'first', 'sticky' => 1);
		$args = array('before_widget' => '<div class="mh-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>');
		the_widget('mh_magazine_custom_posts', $instance , $args); ?>
	</div>
</div>