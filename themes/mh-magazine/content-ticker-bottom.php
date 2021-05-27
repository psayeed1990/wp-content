<?php /* Template for displaying content of news ticker below header */
$mh_magazine_options = mh_magazine_theme_options();
$ticker_loop = new WP_Query(array('posts_per_page' => $mh_magazine_options['ticker_posts'], 'cat' => $mh_magazine_options['ticker_cats'], 'tag' => $mh_magazine_options['ticker_tags'], 'offset' => $mh_magazine_options['ticker_offset'], 'ignore_sticky_posts' => $mh_magazine_options['ticker_sticky'])); ?>
<div class="mh-ticker-bottom">
	<?php if ($mh_magazine_options['ticker_title']) { ?>
		<div class="mh-ticker-title mh-ticker-title-bottom">
			<?php echo esc_attr($mh_magazine_options['ticker_title']) . '<i class="fa fa-chevron-right"></i>'; ?>
		</div>
	<?php } ?>
	<div class="mh-ticker-content mh-ticker-content-bottom">
		<ul id="mh-ticker-loop-bottom"><?php
			while ($ticker_loop->have_posts()) : $ticker_loop->the_post(); ?>
				<li class="mh-ticker-item mh-ticker-item-bottom">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<span class="mh-ticker-item-date mh-ticker-item-date-bottom">
                        	<?php echo '[ ' . get_the_date() . ' ]'; ?>
                        </span>
						<span class="mh-ticker-item-title mh-ticker-item-title-bottom">
							<?php the_title(); ?>
						</span>
						<?php if (has_category()) { ?>
							<span class="mh-ticker-item-cat mh-ticker-item-cat-bottom">
								<i class="fa fa-caret-right"></i>
								<?php $category = get_the_category(); ?>
								<?php echo esc_attr($category[0]->cat_name); ?>
							</span>
						<?php } ?>
					</a>
				</li><?php
			endwhile;
			wp_reset_postdata(); ?>
		</ul>
	</div>
</div>