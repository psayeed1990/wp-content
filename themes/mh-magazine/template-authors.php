<?php /* Template Name: Authors */ ?>
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
			endwhile;
            $users = get_users('orderby=post_count&order=DESC');
			foreach ($users as $current) {
				if (!in_array('subscriber', $current->roles)) {
					$authors[] = $current;
				}
			}
			foreach ($authors as $author) {
				$mh_author_box_ID = $author->ID;
				get_template_part('content', 'author-box');
			} ?>
        </div>
		<?php get_sidebar(); ?>
    </div>
    <?php mh_magazine_second_sidebar(); ?>
</div>
<?php get_footer(); ?>