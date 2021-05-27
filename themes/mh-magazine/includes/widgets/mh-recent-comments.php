<?php

/***** MH Recent Comments *****/

class mh_magazine_recent_comments extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_recent_comments', esc_html_x('MH Recent Comments', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_recent_comments',
				'description' => esc_html__('MH Recent Comments widget to display your recent comments including user avatars.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'number' => 5, 'offset' => 0, 'avatar_size' => 48);
		$instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="mh-user-widget mh-recent-comments-widget clearfix"><?php
				$comments = get_comments(array('number' => absint($instance['number']), 'offset' => absint($instance['offset']), 'status' => 'approve', 'type' => 'comment'));
				if ($comments) {
					foreach ($comments as $comment) { ?>
						<li class="mh-user-item clearfix"><?php
							if ($instance['avatar_size'] != 'no_avatar') { ?>
								<figure class="mh-user-avatar">
									<a href="<?php echo esc_url(get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID); ?>" title="<?php echo esc_attr($comment->comment_author); ?>">
										<?php echo get_avatar($comment->comment_author_email, absint($instance['avatar_size'])); ?>
									</a>
								</figure><?php
							} ?>
							<div class="mh-user-meta">
								<span class="mh-recent-comments-author">
									<?php printf(_x('%1$s on %2$s', 'comment widget', 'mh-magazine'), esc_attr($comment->comment_author), ''); ?>
								</span>
								<a class="mh-recent-comments-link" href="<?php echo esc_url(get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID); ?>" title="<?php echo esc_attr($comment->comment_author) . ' | ' . esc_attr(get_the_title($comment->comment_post_ID)); ?>">
									<?php echo esc_attr(get_the_title($comment->comment_post_ID)); ?>
								</a>
							</div>
						</li><?php
					}
				} ?>
			</ul><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['number'])) {
			$instance['number'] = absint($new_instance['number']);
		}
		if (0 !== absint($new_instance['offset'])) {
			$instance['offset'] = absint($new_instance['offset']);
		}
		if (48 !== $new_instance['avatar_size']) {
			if (in_array($new_instance['avatar_size'], array(16, 32, 64, 'no_avatar'))) {
				$instance['avatar_size'] = $new_instance['avatar_size'];
			}
		}
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('Recent Comments', 'mh-magazine'), 'number' => 5, 'offset' => 0, 'avatar_size' => 48);
		$instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Limit Comment Number:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['number']); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" id="<?php echo esc_attr($this->get_field_id('number')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Comments (Offset):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('avatar_size')); ?>"><?php esc_html_e('Avatar Size in px:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('avatar_size')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('avatar_size')); ?>">
				<option value="16" <?php selected(16, $instance['avatar_size']); ?>><?php echo '16 x 16'; ?></option>
				<option value="32" <?php selected(32, $instance['avatar_size']); ?>><?php echo '32 x 32'; ?></option>
				<option value="48" <?php selected(48, $instance['avatar_size']); ?>><?php echo '48 x 48'; ?></option>
				<option value="64" <?php selected(64, $instance['avatar_size']); ?>><?php echo '64 x 64'; ?></option>
				<option value="no_avatar" <?php selected('no_avatar', $instance['avatar_size']); ?>><?php esc_html_e('No Avatars', 'mh-magazine') ?></option>
			</select>
        </p><?php
    }
}

?>