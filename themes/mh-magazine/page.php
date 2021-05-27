<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-main clearfix">
    	<div id="main-content" class="mh-content" role="main" itemprop="mainContentOfPage"><?php
    		while (have_posts()) : the_post();
				mh_before_page_content();
				get_template_part('content', 'page');
				mh_after_page_content();
				comments_template();
			endwhile; ?>
        </div>
		<?php get_sidebar(); ?>
    </div>
    <?php mh_magazine_second_sidebar(); ?>
</div>
<?php get_footer(); ?>