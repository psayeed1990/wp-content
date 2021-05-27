<?php /*
Template Name: Full Width
Template Post Type: post, page
*/ ?>
<?php get_header(); ?>
<div class="mh-wrapper clearfix" role="main" itemprop="mainContentOfPage"><?php
	while (have_posts()) : the_post();
		if (is_page()) {
			mh_before_page_content();
			get_template_part('content', 'page');
		} else {
			mh_before_post_content();
			get_template_part('content', 'single');
			mh_after_post_content();
		}
		comments_template();
	endwhile; ?>
</div>
<?php get_footer(); ?>