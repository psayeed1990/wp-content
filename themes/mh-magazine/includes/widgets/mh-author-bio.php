<?php

/***** MH Author Bio *****/

class mh_magazine_author_bio extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_author_bio', esc_html_x('MH Author Bio', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_author_bio',
				'description' => esc_html__('MH Author Bio widget to display author avatar and biographical info.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
		$defaults = array('title' => '', 'user' => 0);
		$instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget']; ?>
			<div class="mh-author-bio-widget">
				<?php if (!empty($instance['title'])) { ?>
					<h4 class="mh-author-bio-title">
						<?php echo esc_html(apply_filters('widget_title', $instance['title'])); ?>
					</h4>
				<?php } ?>
        		<figure class="mh-author-bio-avatar mh-author-bio-image-frame">
        			<a href="<?php echo esc_url(get_author_posts_url($instance['user'])); ?>">
        				<?php echo get_avatar($instance['user'], 120); ?>
					</a>
				</figure>
				<?php if (get_the_author_meta('description', $instance['user'])) { ?>
					<div class="mh-author-bio-text">
						<?php echo wp_kses_post(get_the_author_meta('description', $instance['user'])); ?>
					</div>
				<?php } ?>
			</div><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['user'])) {
			$instance['user'] = absint($new_instance['user']);
		}
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('About me', 'mh-magazine'), 'user' => 0);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php esc_html_e('Select User:', 'mh-magazine'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('user')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('user')); ?>"><?php
            	$roles = new WP_User_Query(array('role__in' => array('administrator', 'editor', 'author', 'contributor')));
				$users = $roles->get_results();
            	foreach ($users as $user) { ?>
            		<option value="<?php echo absint($user->ID); ?>" <?php selected($user->ID, $instance['user']); ?>><?php echo esc_html($user->display_name); ?></option><?php
            	} ?>
            </select>
		</p><?php
    }
}

?>