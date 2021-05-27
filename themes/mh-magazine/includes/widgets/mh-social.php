<?php

/***** MH Social *****/

class mh_magazine_social extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_social', esc_html_x('MH Social', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_social',
				'description' => esc_html__('MH Social widget to display linked social media icons in sidebar or footer.', 'mh-magazine'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '');
        $instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			}
			if (has_nav_menu('mh_social_widget')) { ?>
				<nav class="mh-social-icons mh-social-widget clearfix">
					<?php wp_nav_menu(array('theme_location' => 'mh_social_widget', 'link_before' => '<i class="fa fa-mh-social"></i><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav><?php
			} else {
				esc_html_e('Create a custom menu under "Appearance => Menus" in your WordPress dashboard to display social icons in this widget.', 'mh-magazine');
			}
		echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('Stay connected', 'mh-magazine'));
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p><?php
    }
}

?>