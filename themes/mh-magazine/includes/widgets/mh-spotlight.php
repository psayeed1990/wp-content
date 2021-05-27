<?php

/***** MH Spotlight *****/

class mh_magazine_spotlight extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_spotlight', esc_html_x('MH Spotlight', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_spotlight',
				'description' => esc_html__('MH Spotlight / Featured widget for use on homepage template.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$mh_magazine_options = mh_magazine_theme_options();
    	$defaults = array('title' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'offset' => 0, 'order' => 'date', 'image_size' => 'normal', 'excerpt_length' => 35, 'excerpt' => 0, 'meta' => 0);
		$instance = wp_parse_args($instance, $defaults);
		$query_args = array();
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
		if ('date' !== $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		$query_args['posts_per_page'] = 1;
		$query_args['ignore_sticky_posts'] = 1;
		$spotlight_loop = new WP_Query($query_args);
        echo $args['before_widget'];
			while ($spotlight_loop->have_posts()) : $spotlight_loop->the_post(); ?>
				<article <?php post_class('mh-spotlight-widget'); ?>>
					<figure class="mh-spotlight-thumb">
						<a class="mh-thumb-icon" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
							if (has_post_thumbnail()) {
								if ($instance['image_size'] == 'normal') {
									the_post_thumbnail('mh-magazine-content');
								} else {
									the_post_thumbnail('mh-magazine-slider');
								}
							} else {
								if ($instance['image_size'] == 'normal') {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
								} else {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-slider.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
								}
							} ?>
						</a>
						<?php if (!empty($instance['title'])) { ?>
							<div class="mh-image-caption mh-spotlight-caption">
								<?php echo esc_html(apply_filters('widget_title', $instance['title'])); ?>
							</div>
						<?php } ?>
					</figure>
					<div class="mh-spotlight-content">
						<h2 class="mh-spotlight-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<?php if ($instance['meta'] == 0) { ?>
							<p class="mh-meta mh-spotlight-meta">
								<?php $category = get_the_category(); printf(_x('by %1$s in %2$s', 'post meta', 'mh-magazine'), get_the_author(), esc_attr($category[0]->cat_name)); ?>
								<?php if ($mh_magazine_options['post_meta_comments'] == 'enable') { ?>
									<span class="mh-spotlight-comments">
										<i class="fa fa-comment-o"></i><?php mh_magazine_comment_count(); ?>
									</span>
								<?php } ?>
							</p>
						<?php } ?>
						<?php if ($instance['excerpt'] == 0) { ?>
							<?php mh_magazine_custom_excerpt($instance['excerpt_length']); ?>
						<?php } ?>
					</div>
				</article><?php
			endwhile;
			wp_reset_postdata();
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
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
		if ('normal' !== $new_instance['image_size']) {
			if (in_array($new_instance['image_size'], array('large'))) {
				$instance['image_size'] = $new_instance['image_size'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['excerpt'] = (!empty($new_instance['excerpt'])) ? 1 : 0;
		$instance['meta'] = (!empty($new_instance['meta'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('In the Spotlight', 'mh-magazine'), 'category' => 0, 'cats' => '', 'tags' => '', 'offset' => 0, 'order' => 'date', 'image_size' => 'normal', 'excerpt_length' => 35, 'excerpt' => 0, 'meta' => 0);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
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
				<option value="date" <?php selected('date', $instance['order']); ?>><?php esc_html_e('Latest Posts', 'mh-magazine'); ?></option>
				<option value="rand" <?php selected('rand', $instance['order']); ?>><?php esc_html_e('Random Posts', 'mh-magazine'); ?></option>
				<option value="comment_count" <?php selected('comment_count', $instance['order']); ?>><?php esc_html_e('Popular Posts', 'mh-magazine'); ?></option>
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
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('meta')); ?>" name="<?php echo esc_attr($this->get_field_name('meta')); ?>" type="checkbox" value="1" <?php checked(1, $instance['meta']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('meta')); ?>"><?php esc_html_e('Disable Post Meta', 'mh-magazine'); ?></label>
		</p><?php
    }
}

?>