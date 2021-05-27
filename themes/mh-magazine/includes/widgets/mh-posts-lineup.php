<?php

/***** MH Posts Lineup *****/

class mh_magazine_posts_lineup extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_magazine_posts_lineup', esc_html_x('MH Posts Lineup', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_posts_lineup',
				'description' => esc_html__('MH Posts Lineup widget to display one large featured post and a list of additional posts.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'image_size' => 'large', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		$query_args['posts_per_page'] = $instance['postcount'];
		$query_args['ignore_sticky_posts'] = $instance['sticky'];
		if (!empty($instance['cats'])) {
			$category_ids = explode(',', $instance['cats']);
			$category_ids = array_map('trim', $category_ids);
			$sorted_ids = mh_magazine_sort_id_list($category_ids);
		}
		if (0 === $instance['category']) {
			if (!empty($sorted_ids['exclude'])) {
				$query_args['category__not_in'] = $sorted_ids['exclude'];
			}
		} else {
			$ids_to_include = array();
			if (!empty($sorted_ids['include'])) {
				$ids_to_include = $sorted_ids['include'];
			}
			$ids_to_include[] = $instance['category'];
			$query_args['category__in'] = $ids_to_include;
		}
		if (!empty($instance['tags'])) {
			$tag_slugs = explode(',', $instance['tags']);
			$tag_slugs = array_map('trim', $tag_slugs);
			$query_args['tag_slug__in'] = $tag_slugs;
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if ('date' !==  $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		$widget_posts = new WP_Query($query_args);
		$max_posts = $widget_posts->post_count;
        echo $args['before_widget'];
			if ($widget_posts->have_posts()) :
				$counter = 1;
				if (!empty($instance['title'])) {
					echo $args['before_title'];
						if (!empty($instance['link'])) {
							echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">';
						} elseif ($instance['category'] != 0) {
							echo '<a href="' . esc_url(get_category_link($instance['category'])) . '" class="mh-widget-title-link">';
						}
						echo esc_html(apply_filters('widget_title', $instance['title']));
						if (!empty($instance['link']) || $instance['category'] != 0) {
							echo '</a>';
						}
					echo $args['after_title'];
				}
				echo '<div class="mh-posts-lineup-widget mh-posts-lineup-' . esc_attr($instance['image_size']) . ' clearfix">' . "\n";
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						if ($counter === 1) { ?>
							<article <?php post_class('mh-posts-lineup-item clearfix'); ?>>
								<figure class="mh-posts-lineup-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											if ($instance['image_size'] == 'large') {
												the_post_thumbnail('mh-magazine-slider');
											} else {
												the_post_thumbnail('mh-magazine-content');
											}
										} else {
											if ($instance['image_size'] == 'large') {
												echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-slider.png') . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
											} else {
												echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-content.png') . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
											}
										} ?>
									</a>
								</figure>
								<?php if ($instance['category'] != 0) { ?>
									<div class="mh-image-caption mh-posts-lineup-category">
										<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
									</div>
								<?php } ?>
								<div class="mh-posts-lineup-caption">
									<div class="mh-posts-lineup-content">
										<h2 class="mh-posts-lineup-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
												<?php the_title(); ?>
											</a>
										</h2><?php
										if ($instance['excerpt'] === 0) {
											mh_magazine_custom_excerpt($instance['excerpt_length']);
										}
						}
						if ($counter === 2) {
							echo '<ul class="mh-posts-lineup-more">' . "\n";
						}
						if ($counter > 1) { ?>
							<li <?php post_class('mh-posts-lineup-more-item'); ?>>
								<h3 class="mh-posts-lineup-more-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h3>
							</li><?php
						}
						if ($counter > 1 && $counter === $max_posts) {
							echo '</ul>' . "\n";
						}
						if ($counter === $max_posts) {
							echo '</div>' . "\n";
							echo '</div>' . "\n";
							echo '</article>' . "\n";
						}
						$counter++;
					endwhile;
					wp_reset_postdata();
				echo '</div>' . "\n";
			endif;
		echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if (!empty($new_instance['link'])) {
			$instance['link'] = esc_url_raw($new_instance['link']);
		}
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
        if (!empty($new_instance['cats'])) {
			$instance['cats'] = mh_magazine_sanitize_id_list($new_instance['cats']);
		}
		if (!empty($new_instance['tags'])) {
			$tag_slugs = explode(',', $new_instance['tags']);
			$tag_slugs = array_map('sanitize_title', $tag_slugs);
			$instance['tags'] = implode(', ', $tag_slugs);
		}
		if (0 !== absint($new_instance['offset'])) {
			if (absint($new_instance['offset']) > 50) {
				$instance['offset'] = 50;
			} else {
				$instance['offset'] = absint($new_instance['offset']);
			}
		}
		if ('date' !== $new_instance['order']) {
			if (in_array($new_instance['order'], array('rand', 'comment_count'))) {
				$instance['order'] = $new_instance['order'];
			}
		}
		if ('large' !== $new_instance['image_size']) {
			if (in_array($new_instance['image_size'], array('normal'))) {
				$instance['image_size'] = $new_instance['image_size'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['excerpt'] = (!empty($new_instance['excerpt'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'offset' => 0, 'order' => 'date', 'image_size' => 'large', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link Title to custom URL (optional):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['link']); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'mh-magazine'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
            	<option value="0" <?php selected(0, $instance['category']); ?>><?php esc_html_e('All', 'mh-magazine'); ?></option><?php
            		$categories = get_categories();
            		foreach ($categories as $cat) { ?>
            			<option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $instance['category']); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option><?php
            		} ?>
            </select>
            <small><?php _e('Select a category to display posts from.', 'mh-magazine'); ?></small>
		</p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_html_e('Multiple Categories Filter by ID:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo esc_attr($this->get_field_name('cats')); ?>" id="<?php echo esc_attr($this->get_field_id('cats')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_html_e('Filter Posts by Tags (e.g. lifestyle):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Posts (max. 50):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Post Order:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="date" <?php selected('date', $instance['order']); ?>><?php esc_html_e('Latest Posts', 'mh-magazine') ?></option>
				<option value="rand" <?php selected('rand', $instance['order']); ?>><?php esc_html_e('Random Posts', 'mh-magazine') ?></option>
				<option value="comment_count" <?php selected('comment_count', $instance['order']); ?>><?php esc_html_e('Popular Posts', 'mh-magazine') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('image_size')); ?>"><?php esc_html_e('Image size:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('image_size')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('image_size')); ?>">
				<option value="normal" <?php selected('normal', $instance['image_size']); ?>><?php esc_html_e('Normal', 'mh-magazine'); ?></option>
				<option value="large" <?php selected('large', $instance['image_size']); ?>><?php esc_html_e('Large', 'mh-magazine'); ?></option>
			</select>
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Custom Excerpt Length in Words:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>" type="checkbox" value="1" <?php checked(1, $instance['excerpt']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Disable Excerpt', 'mh-magazine'); ?></label>
		</p><?php
    }
}

?>