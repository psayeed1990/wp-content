<?php /* Template for displaying content in MH Posts Grid widget and on archives */ ?>
<article <?php mh_magazine_post_grid_class(); ?>>
	<figure class="mh-posts-grid-thumb">
		<a class="mh-thumb-icon mh-thumb-icon-small-mobile" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-magazine-medium');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
			} ?>
		</a>
		<?php if (has_category()) { ?>
			<div class="mh-image-caption mh-posts-grid-caption">
				<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
			</div>
		<?php } ?>
	</figure>
	<h3 class="entry-title mh-posts-grid-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h3>
	<?php mh_magazine_post_meta(); ?>
	<div class="mh-posts-grid-excerpt clearfix">
		<?php the_excerpt(); ?>
	</div>
</article>