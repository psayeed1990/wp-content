<?php

/***** MH Category Columns *****/

class mh_magazine_category_columns extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_magazine_category_columns', esc_html_x('MH Category Columns', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_category_columns',
				'description' => esc_html__('MH Category Columns widget to display columns with posts from specific categories.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'link' => '', 'cats' => '', 'columns' => 4, 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'image_size' => 'normal', 'sticky' => 1, 'category_label' => 1);
        $instance = wp_parse_args($instance, $defaults);
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) { echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">'; }
						echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link'])) { echo '</a>'; }
				echo $args['after_title'];
			}
			if (!empty($instance['cats'])) {
				$ids_to_include = array();
				$category_ids = explode(',', $instance['cats']);
				$category_ids = array_map('trim', $category_ids);
				$sorted_ids = mh_magazine_sort_id_list($category_ids);
				if (!empty($sorted_ids['include'])) {
					$ids_to_include = $sorted_ids['include'];
				}
			} else {
				$ids_to_include = '';
			}
			if ($ids_to_include) {
				$counter_cats = 1;
				$cats = $ids_to_include;
				$max_cats = count($cats);
				echo '<div class="mh-category-columns-widget mh-category-columns-image-' . esc_attr($instance['image_size']) . ' clearfix">' . "\n";
					foreach ($cats as $cat) {
						if ($counter_cats === 1) {
							echo '<div class="mh-row clearfix mh-category-columns mh-category-columns-start">' . "\n";
						}
						echo '<div class="mh-col-1-' . absint($instance['columns']) . ' mh-category-column clearfix">' . "\n";
							$widget_posts = new WP_Query(array('category__in' => $cat, 'posts_per_page' => $instance['postcount'], 'offset' => $instance['offset'], 'orderby' => $instance['order'], 'ignore_sticky_posts' => $instance['sticky']));
							$counter_posts = 1;
							$max_posts = $widget_posts->post_count;
							while ($widget_posts->have_posts()) : $widget_posts->the_post();
								if ($counter_posts === 1) {
									echo '<ul class="mh-category-column-posts clearfix">' . "\n";
								}
								if ($counter_posts >= 1) { ?>
									<li <?php post_class('mh-category-column-item'); ?>>
										<?php if ($counter_posts === 1) { ?>
											<figure class="mh-category-column-thumb">
												<a class="mh-thumb-icon" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
													if (has_post_thumbnail()) {
														if ($instance['image_size'] == 'normal') {
															the_post_thumbnail('mh-magazine-medium');
														} else {
															the_post_thumbnail('mh-magazine-large');
														}
													} else {
														if ($instance['image_size'] == 'normal') {
															echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-medium.png') . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
														} else {
															echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-large.png') . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
														}
													} ?>
												</a>
												<?php if ($instance['category_label'] == 1) { ?>
													<div class="mh-image-caption mh-category-column-caption">
														<?php echo esc_attr(get_cat_name($cat)) ?>
													</div>
												<?php } ?>
											</figure>
										<?php } ?>
										<h3 class="mh-category-column-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
												<?php the_title(); ?>
											</a>
										</h3>
									</li><?php
								}
								if ($counter_posts === $max_posts) {
									echo '</ul>' . "\n";
								}
								$counter_posts++;
							endwhile;
							wp_reset_postdata();
						echo '</div>' . "\n";
						if ($counter_cats % $instance['columns'] == 0 && $counter_cats != $max_cats) {
							echo '</div>' . "\n";
							echo '<div class="mh-row clearfix mh-category-columns mh-category-columns-more">' . "\n";
						}
						if ($counter_cats === $max_cats) {
							echo '</div>' . "\n";
						}
						$counter_cats++;
					}
				echo '</div>' . "\n";
			}
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
        if (!empty($new_instance['cats'])) {
			$instance['cats'] = mh_magazine_sanitize_id_list($new_instance['cats']);
		}
		if (4 !== $new_instance['columns']) {
			if (in_array($new_instance['columns'], array(2, 3, 5))) {
				$instance['columns'] = $new_instance['columns'];
			}
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
		if ('normal' !== $new_instance['image_size']) {
			if (in_array($new_instance['image_size'], array('large'))) {
				$instance['image_size'] = $new_instance['image_size'];
			}
		}
		$instance['category_label'] = (!empty($new_instance['category_label'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'link' => '', 'cats' => '', 'columns' => 4, 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'image_size' => 'normal', 'category_label' => 1);
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
        	<label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_html_e('Multiple Categories Filter by ID:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo esc_attr($this->get_field_name('cats')); ?>" id="<?php echo esc_attr($this->get_field_id('cats')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('columns')); ?>"><?php esc_html_e('Number of Columns:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('columns')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('columns')); ?>">
				<option value="2" <?php selected(2, $instance['columns']); ?>>2</option>
				<option value="3" <?php selected(3, $instance['columns']); ?>>3</option>
				<option value="4" <?php selected(4, $instance['columns']); ?>>4</option>
				<option value="5" <?php selected(5, $instance['columns']); ?>>5</option>
			</select>
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
			<input id="<?php echo esc_attr($this->get_field_id('category_label')); ?>" name="<?php echo esc_attr($this->get_field_name('category_label')); ?>" type="checkbox" value="1" <?php checked(1, $instance['category_label']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('category_label')); ?>"><?php esc_html_e('Display Category', 'mh-magazine'); ?></label>
		</p><?php
    }
}

?>