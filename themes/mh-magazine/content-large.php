<?php /* Template for displaying content in MH Posts Large widget and on archives */
$mh_magazine_options = mh_magazine_theme_options(); ?>
<article <?php post_class('mh-posts-large-item clearfix'); ?>>
	<figure class="mh-posts-large-thumb">
		<a class="mh-thumb-icon" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				if ($mh_magazine_options['sidebars'] === 'disable') {
					the_post_thumbnail('mh-magazine-slider');
				} else {
					the_post_thumbnail('mh-magazine-content');
				}
			} else {
				if ($mh_magazine_options['sidebars'] === 'disable') {
					echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-slider.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
				} else {
					echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
				}
			} ?>
		</a>
		<?php if (has_category()) { ?>
			<div class="mh-image-caption mh-posts-large-caption">
				<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
			</div>
		<?php } ?>
	</figure>
	<div class="mh-posts-large-content clearfix">
		<header class="mh-posts-large-header">
			<h3 class="entry-title mh-posts-large-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php mh_magazine_post_meta(); ?>
		</header>
		<div class="mh-posts-large-excerpt clearfix">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>