<?php

/***** MH Posts Digest *****/

class mh_magazine_posts_digest extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_magazine_posts_digest', esc_html_x('MH Posts Digest', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_posts_digest',
				'description' => esc_html__('MH Posts Digest widget to display 2 large featured posts with thumbnails and an overview of posts with post titles and excerpts.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'excerpt' => 'enable', 'excerpt_length' => 35, 'category_label' => 1, 'sticky' => 1);
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
		if ('date' !==  $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		if (1 === $instance['sticky']) {
			$query_args['ignore_sticky_posts'] = true;
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
				echo '<div class="mh-posts-digest-widget clearfix">' . "\n";
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						if ($counter === 1) {
							echo '<div class="mh-row mh-posts-digest-wrap mh-posts-digest-large clearfix">' . "\n";
						}
						if ($counter <= 2) { ?>
							<article <?php post_class('mh-col-1-2 mh-posts-digest-item mh-posts-digest-item-large clearfix'); ?>>
								<figure class="mh-posts-digest-thumb">
									<a class="mh-thumb-icon" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('mh-magazine-content');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
										} ?>
									</a>
								</figure>
								<h3 class="mh-posts-digest-title mh-posts-digest-title-large">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h3>
								<?php if ($instance['category_label'] == 1) { ?>
									<div class="mh-image-caption mh-posts-digest-caption">
										<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
									</div>
								<?php } ?>
								<?php mh_magazine_post_meta(); ?>
								<?php if ($instance['excerpt'] == 'enable' || $instance['excerpt'] == 'enable_large') { ?>
									<div class="mh-posts-digest-excerpt clearfix">
										<?php mh_magazine_custom_excerpt($instance['excerpt_length']); ?>
									</div>
								<?php } ?>
							</article><?php
						}
						if ($counter === 1 && $counter === $max_posts || $counter === 2) {
							echo '</div>' . "\n";
						}
						if ($counter === 3) {
							echo '<div class="mh-row mh-posts-digest-wrap mh-posts-digest-small clearfix">' . "\n";
						}
						if ($counter >= 3) { ?>
							<article <?php post_class('mh-col-1-3 mh-posts-digest-item mh-posts-digest-item-small clearfix'); ?>>
								<?php if ($instance['category_label'] == 1) { ?>
									<div class="mh-posts-digest-small-category">
										<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
									</div>
								<?php } ?>
								<h3 class="mh-posts-digest-title mh-posts-digest-title-small">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h3>
								<?php mh_magazine_post_meta(); ?>
								<?php if ($instance['excerpt'] == 'enable' || $instance['excerpt'] == 'enable_small') { ?>
									<div class="mh-posts-digest-excerpt clearfix">
										<?php mh_magazine_custom_excerpt($instance['excerpt_length']); ?>
									</div>
								<?php } ?>
							</article><?php
						}
						if ($counter > 2 && ($counter - 2) % 3 === 0 && $counter !== $max_posts) {
							echo '</div>' . "\n";
							echo '<div class="mh-row mh-posts-digest-wrap mh-posts-digest-small mh-posts-digest-more clearfix">' . "\n";
						}
						if ($counter >= 3 && $counter === $max_posts) {
							echo '</div>' . "\n";
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
		if ('enable' !== $new_instance['excerpt']) {
			if (in_array($new_instance['excerpt'], array('enable_large', 'enable_small', 'disable'))) {
				$instance['excerpt'] = $new_instance['excerpt'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['category_label'] = (!empty($new_instance['category_label'])) ? 1 : 0;
		$instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'excerpt' => 'enable', 'excerpt_length' => 35, 'category_label' => 1, 'sticky' => 1);
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
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Display Excerpts:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>">
				<option value="enable" <?php selected('enable', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for all Posts', 'mh-magazine'); ?></option>
				<option value="enable_large" <?php selected('enable_large', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for large Posts', 'mh-magazine'); ?></option>
				<option value="enable_small" <?php selected('enable_small', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for small Posts', 'mh-magazine'); ?></option>
				<option value="disable" <?php selected('disable', $instance['excerpt']); ?>><?php esc_html_e('No Excerpts', 'mh-magazine'); ?></option>
			</select>
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Custom Excerpt Length in Words:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('category_label')); ?>" name="<?php echo esc_attr($this->get_field_name('category_label')); ?>" type="checkbox" value="1" <?php checked(1, $instance['category_label']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('category_label')); ?>"><?php esc_html_e('Display Category', 'mh-magazine'); ?></label>
		</p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('sticky')); ?>" name="<?php echo esc_attr($this->get_field_name('sticky')); ?>" type="checkbox" value="1" <?php checked(1, $instance['sticky']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('sticky')); ?>"><?php esc_html_e('Ignore Sticky Posts', 'mh-magazine'); ?></label>
		</p><?php
    }
}

?>