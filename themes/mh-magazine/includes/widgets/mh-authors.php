<?php

/***** MH Authors *****/

class mh_magazine_authors extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_authors', esc_html_x('MH Authors', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_authors',
				'description' => esc_html__('MH Authors widget to display a list of authors including the number of published posts.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC', 'avatar_size' => 48);
		$instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		if (!empty($instance['authorcount'])) {
			$query_args['number'] = $instance['authorcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if (0 !== $instance['role']) {
			$query_args['role'] = $instance['role'];
		}
		if ('ASC' !== $instance['order']) {
			$query_args['order'] = $instance['order'];
		}
		$query_args['orderby'] = $instance['orderby'];
		$wp_user_query = new WP_User_Query($query_args);
		$authors = $wp_user_query->get_results();
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="mh-user-widget mh-authors-widget clearfix"><?php
				if (!empty($authors)) {
					foreach ($authors as $author) {
						$author_ID = $author->ID; ?>
						<li class="mh-user-item clearfix">
							<?php if ($instance['avatar_size'] != 'no_avatar') { ?>
								<figure class="mh-user-avatar">
									<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(__('Articles by %s', 'mh-magazine'), esc_attr($author->display_name)); ?>">
										<?php echo get_avatar($author_ID, absint($instance['avatar_size'])); ?>
									</a>
								</figure>
							<?php } ?>
							<div class="mh-user-meta">
								<a class="mh-user-author-name" href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(__('Articles by %s', 'mh-magazine'), esc_attr($author->display_name)); ?>">
									<?php echo esc_attr($author->display_name); ?>
								</a>
								<p class="mh-user-data">
									<?php printf(_x('published %d articles', 'author post count', 'mh-magazine'), count_user_posts($author_ID)); ?>
								</p>
							</div>
						</li><?php
					}
				} else {
					_e('No authors found', 'mh-magazine');
				} ?>
			</ul><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['authorcount'])) {
			$instance['authorcount'] = absint($new_instance['authorcount']);
		}
		if (0 !== absint($new_instance['offset'])) {
			$instance['offset'] = absint($new_instance['offset']);
		}
		if (0 !== $new_instance['role']) {
			if (in_array($new_instance['role'], array('administrator', 'editor', 'author', 'contributor', 'subscriber'))) {
				$instance['role'] = $new_instance['role'];
			}
		}
		if ('post_count' !== $new_instance['orderby']) {
			if (in_array($new_instance['orderby'], array('display_name'))) {
				$instance['orderby'] = $new_instance['orderby'];
			}
		}
		if ('DESC' !== $new_instance['order']) {
			if (in_array($new_instance['order'], array('ASC'))) {
				$instance['order'] = $new_instance['order'];
			}
		}
		if (48 !== $new_instance['avatar_size']) {
			if (in_array($new_instance['avatar_size'], array(16, 32, 64, 'no_avatar'))) {
				$instance['avatar_size'] = $new_instance['avatar_size'];
			}
		}
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => esc_html__('Authors', 'mh-magazine'), 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC', 'avatar_size' => 48);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('authorcount')); ?>"><?php esc_html_e('Limit Author Number:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['authorcount']); ?>" name="<?php echo esc_attr($this->get_field_name('authorcount')); ?>" id="<?php echo esc_attr($this->get_field_id('authorcount')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Authors (Offset):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('role')); ?>"><?php esc_html_e('User Role:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('role')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('role')); ?>">
				<option value="0" <?php selected(0, $instance['role']); ?>><?php esc_html_e('All Users', 'mh-magazine'); ?></option>
				<option value="administrator" <?php selected('administrator', $instance['role']); ?>><?php esc_html_e('Administrator', 'mh-magazine'); ?></option>
				<option value="editor" <?php selected('editor', $instance['role']); ?>><?php esc_html_e('Editor', 'mh-magazine'); ?></option>
				<option value="author" <?php selected('author', $instance['role']); ?>><?php esc_html_e('Author', 'mh-magazine'); ?></option>
				<option value="contributor" <?php selected('contributor', $instance['role']); ?>><?php esc_html_e('Contributor', 'mh-magazine'); ?></option>
				<option value="subscriber" <?php selected('subscriber', $instance['role']); ?>><?php esc_html_e('Subscriber', 'mh-magazine'); ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order Authors by:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
				<option value="post_count" <?php selected('post_count', $instance['orderby']); ?>><?php esc_html_e('Number of Posts', 'mh-magazine'); ?></option>
				<option value="display_name" <?php selected('display_name', $instance['orderby']); ?>><?php esc_html_e('User Name', 'mh-magazine'); ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="ASC" <?php selected('ASC', $instance['order']); ?>><?php esc_html_e('Ascending', 'mh-magazine'); ?></option>
				<option value="DESC" <?php selected('DESC', $instance['order']); ?>><?php esc_html_e('Descending', 'mh-magazine'); ?></option>
			</select>
        </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('avatar_size')); ?>"><?php esc_html_e('Avatar Size in px:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('avatar_size')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('avatar_size')); ?>">
				<option value="16" <?php selected(16, $instance['avatar_size']); ?>><?php echo '16 x 16'; ?></option>
				<option value="32" <?php selected(32, $instance['avatar_size']); ?>><?php echo '32 x 32'; ?></option>
				<option value="48" <?php selected(48, $instance['avatar_size']); ?>><?php echo '48 x 48'; ?></option>
				<option value="64" <?php selected(64, $instance['avatar_size']); ?>><?php echo '64 x 64'; ?></option>
				<option value="no_avatar" <?php selected('no_avatar', $instance['avatar_size']); ?>><?php esc_html_e('No Avatars', 'mh-magazine'); ?></option>
			</select>
        </p><?php
    }
}

?>