<?php

/***** MH Custom Pages *****/

class mh_magazine_custom_pages extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_custom_pages', esc_html_x('MH Custom Pages', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_custom_pages',
				'description' => esc_html__('MH Custom Pages Widget to display pages based on page IDs.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'none', 'excerpt_length' => 35, 'thumbnails' => 'show_thumbs');
        $instance = wp_parse_args($instance, $defaults);
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) { echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">'; }
						echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link'])) { echo '</a>'; }
				echo $args['after_title'];
			}
			$instance['thumbnails'] == 'show_thumbs' || $instance['thumbnails'] == 'hide_large' ? $cp_no_image = '' : $cp_no_image = ' mh-custom-posts-no-image'; ?>
			<ul class="mh-custom-posts-widget mh-custom-pages-widget<?php echo esc_attr($cp_no_image); ?> clearfix"><?php
				$counter = 1;
				$page_ids = explode(',', $instance['pages']);
				$page_ids = array_map('absint', $page_ids);
				$widget_loop = new WP_Query(array('post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in'));
				while ($widget_loop->have_posts()) : $widget_loop->the_post();
					if ($counter == 1 && $instance['excerpt'] == 'first' || $instance['excerpt'] == 'all') : ?>
						<li <?php post_class('mh-custom-posts-item mh-custom-posts-large clearfix'); ?>>
							<?php if ($instance['thumbnails'] == 'show_thumbs' || $instance['thumbnails'] == 'hide_small') : ?>
								<figure class="mh-custom-posts-thumb-xl">
									<a class="mh-thumb-icon mh-thumb-icon-small-mobile" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('mh-magazine-medium');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
										} ?>
									</a>
								</figure>
							<?php endif; ?>
							<div class="mh-custom-posts-content">
								<div class="mh-custom-posts-header">
									<h3 class="mh-custom-posts-xl-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
								</div>
								<?php mh_magazine_custom_excerpt($instance['excerpt_length']); ?>
							</div>
						</li><?php
					else : ?>
						<li <?php post_class('mh-custom-posts-item mh-custom-posts-small clearfix'); ?>>
							<?php if ($cp_no_image == '') : ?>
								<figure class="mh-custom-posts-thumb">
									<a class="mh-thumb-icon mh-thumb-icon-small" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('mh-magazine-small');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-small.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
										} ?>
									</a>
								</figure>
							<?php endif; ?>
							<div class="mh-custom-posts-header">
								<div class="mh-custom-posts-small-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
							</div>
						</li><?php
					endif;
					$counter++;
				endwhile;
				wp_reset_postdata(); ?>
			</ul><?php
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
		if (!empty($new_instance['pages'])) {
			$instance['pages'] = mh_magazine_sanitize_id_list($new_instance['pages']);
		}
  		if ('none' !== $new_instance['excerpt']) {
			if (in_array($new_instance['excerpt'], array('first', 'all'))) {
				$instance['excerpt'] = $new_instance['excerpt'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		if ('show_thumbs' !== $new_instance['thumbnails']) {
			if (in_array($new_instance['thumbnails'], array('hide_thumbs', 'hide_large', 'hide_small'))) {
				$instance['thumbnails'] = $new_instance['thumbnails'];
			}
		}
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'none', 'excerpt_length' => 35, 'thumbnails' => 'show_thumbs');
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
        	<label for="<?php echo esc_attr($this->get_field_id('pages')); ?>"><?php esc_html_e('Filter Pages by ID (comma separated):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['pages']); ?>" name="<?php echo esc_attr($this->get_field_name('pages')); ?>" id="<?php echo esc_attr($this->get_field_id('pages')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Display Excerpts:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>">
				<option value="first" <?php selected('first', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for first Page', 'mh-magazine'); ?></option>
				<option value="all" <?php selected('all', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for all Pages', 'mh-magazine'); ?></option>
				<option value="none" <?php selected('none', $instance['excerpt']); ?>><?php esc_html_e('No Excerpts', 'mh-magazine'); ?></option>
			</select>
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Custom Excerpt Length in Words:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('thumbnails')); ?>"><?php esc_html_e('Thumbnails:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('thumbnails')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('thumbnails')); ?>">
				<option value="show_thumbs" <?php selected('show_thumbs', $instance['thumbnails']); ?>><?php esc_html_e('Show all Thumbnails', 'mh-magazine'); ?></option>
				<option value="hide_thumbs" <?php selected('hide_thumbs', $instance['thumbnails']); ?>><?php esc_html_e('Hide all Thumbnails', 'mh-magazine'); ?></option>
				<option value="hide_large" <?php selected('hide_large', $instance['thumbnails']); ?>><?php esc_html_e('Hide only large Thumbnails', 'mh-magazine'); ?></option>
				<option value="hide_small" <?php selected('hide_small', $instance['thumbnails']); ?>><?php esc_html_e('Hide only small Thumbnails', 'mh-magazine'); ?></option>
			</select>
        </p><?php
    }
}

?>