<?php /* Default template for displaying post content */
$mh_magazine_options = mh_magazine_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clearfix"><?php
		the_title('<h1 class="entry-title">', '</h1>');
		mh_post_header(); ?>
	</header>
	<?php dynamic_sidebar('mh-posts-1'); ?>
	<div class="entry-content clearfix"><?php
		mh_post_content_top();
		the_content();
		mh_post_content_bottom(); ?>
	</div><?php
	if ($mh_magazine_options['tags'] === 'enable') {
		the_tags('<div class="entry-tags clearfix"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul></div>');
	}
	dynamic_sidebar('mh-posts-2'); ?>
</article>