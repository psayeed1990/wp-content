<?php

/***** MH Slider *****/

class mh_magazine_slider extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_slider', esc_html_x('MH Slider', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_slider',
				'description' => esc_html__('MH Slider widget for use on homepage template.', 'mh-magazine')
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'image_size' => 'large', 'slider_layout' => 'layout1', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
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
		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if ('date' !== $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		if (1 === $instance['sticky']) {
			$query_args['ignore_sticky_posts'] = true;
		}
		$slider_loop = new WP_Query($query_args);
		echo $args['before_widget']; ?>
        	<div class="flexslider mh-slider-widget <?php echo 'mh-slider-' . esc_attr($instance['image_size']) . ' mh-slider-' . esc_attr($instance['slider_layout']); ?>">
				<ul class="slides"><?php
					while ($slider_loop->have_posts()) : $slider_loop->the_post(); ?>
						<li class="mh-slider-item">
							<article <?php post_class(); ?>>
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
								<div class="mh-image-caption mh-slider-category">
									<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
								</div>
								<div class="mh-slider-caption">
									<div class="mh-slider-content">
										<h2 class="mh-slider-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_title(); ?>
											</a>
										</h2>
										<?php if ($instance['excerpt'] == 0) { ?>
											<?php mh_magazine_custom_excerpt($instance['excerpt_length']); ?>
										<?php } ?>
									</div>
								</div>
							</article>
						</li><?php
					endwhile;
					wp_reset_postdata(); ?>
				</ul>
			</div><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
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
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
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
		if ('layout1' !== $new_instance['slider_layout']) {
			if (in_array($new_instance['slider_layout'], array('layout2', 'layout3', 'layout4', 'layout5'))) {
				$instance['slider_layout'] = $new_instance['slider_layout'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['excerpt'] = (!empty($new_instance['excerpt'])) ? 1 : 0;
		$instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
    	$defaults = array('category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'image_size' => 'large', 'slider_layout' => 'layout1', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
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
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
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
	    	<label for="<?php echo esc_attr($this->get_field_id('slider_layout')); ?>"><?php esc_html_e('Slider Layout:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('slider_layout')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('slider_layout')); ?>">
				<option value="layout1" <?php selected('layout1', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 1); ?></option>
				<option value="layout2" <?php selected('layout2', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 2); ?></option>
				<option value="layout3" <?php selected('layout3', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 3); ?></option>
				<option value="layout4" <?php selected('layout4', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 4); ?></option>
				<option value="layout5" <?php selected('layout5', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 5); ?></option>
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
			<input id="<?php echo esc_attr($this->get_field_id('sticky')); ?>" name="<?php echo esc_attr($this->get_field_name('sticky')); ?>" type="checkbox" value="1" <?php checked(1, $instance['sticky']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('sticky')); ?>"><?php esc_html_e('Ignore Sticky Posts', 'mh-magazine'); ?></label>
		</p><?php
    }
}

?>