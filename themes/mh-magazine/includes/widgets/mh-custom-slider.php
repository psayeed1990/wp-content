<?php

/***** MH Custom Slider *****/

class mh_magazine_custom_slider extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_magazine_custom_slider', esc_html_x('MH Custom Slider', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_custom_slider',
				'description' => esc_html__('MH Custom Slider widget to display custom content for use on homepage template.', 'mh-magazine')
			)
		);
	}
    function widget($args, $instance) {
    	$mh_magazine_options = mh_magazine_theme_options();
    	$default_Image = esc_url(get_template_directory_uri() . '/images/placeholder-slider.png');
    	$defaults = array(
    		'title1' => '', 'url1' => '', 'image1' => $default_Image, 'excerpt1' => '', 'target1' => 0,
    		'title2' => '', 'url2' => '', 'image2' => $default_Image, 'excerpt2' => '', 'target2' => 0,
    		'title3' => '', 'url3' => '', 'image3' => $default_Image, 'excerpt3' => '', 'target3' => 0,
    		'title4' => '', 'url4' => '', 'image4' => $default_Image, 'excerpt4' => '', 'target4' => 0,
    		'title5' => '', 'url5' => '', 'image5' => $default_Image, 'excerpt5' => '', 'target5' => 0,
    		'slider_layout' => 'layout1'
    	);
        $instance = wp_parse_args($instance, $defaults);
		$slide1 = array('title' => $instance['title1'], 'url' => $instance['url1'], 'image' => $instance['image1'], 'excerpt' => $instance['excerpt1'], 'target' => $instance['target1']);
		$slide2 = array('title' => $instance['title2'], 'url' => $instance['url2'], 'image' => $instance['image2'], 'excerpt' => $instance['excerpt2'], 'target' => $instance['target2']);
		$slide3 = array('title' => $instance['title3'], 'url' => $instance['url3'], 'image' => $instance['image3'], 'excerpt' => $instance['excerpt3'], 'target' => $instance['target3']);
		$slide4 = array('title' => $instance['title4'], 'url' => $instance['url4'], 'image' => $instance['image4'], 'excerpt' => $instance['excerpt4'], 'target' => $instance['target4']);
		$slide5 = array('title' => $instance['title5'], 'url' => $instance['url5'], 'image' => $instance['image5'], 'excerpt' => $instance['excerpt5'], 'target' => $instance['target5']);
		$slides = array($slide1, $slide2, $slide3, $slide4, $slide5);
		echo $args['before_widget']; ?>
        	<div class="flexslider mh-slider-widget <?php echo 'mh-slider-' . esc_attr($instance['slider_layout']); ?>">
				<ul class="slides"><?php
					foreach($slides as $slide) {
						if ($slide['title'] || $slide['image'] != $default_Image || $slide['excerpt']) {
							$slide['target'] == 1 ? $link_target = ' target="_blank"' : $link_target = ''; ?>
							<li class="mh-slider-item">
								<article>
									<a href="<?php echo esc_url($slide['url']); ?>" title="<?php echo esc_attr($slide['title']); ?>"<?php echo $link_target; ?>>
										<img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>" />
									</a>
									<?php if ($slide['title'] || $slide['excerpt']) { ?>
										<div class="mh-slider-caption">
											<div class="mh-slider-content">
												<?php if ($slide['title']) { ?>
													<h2 class="mh-slider-title">
														<a href="<?php echo esc_url($slide['url']); ?>" title="<?php echo esc_attr($slide['title']); ?>"<?php echo $link_target; ?>>
															<?php echo esc_attr($slide['title']); ?>
														</a>
													</h2>
												<?php } ?>
												<?php if ($slide['excerpt']) { ?>
													<div class="mh-slider-excerpt mh-excerpt">
														<?php echo esc_attr($slide['excerpt']); ?>
														<a class="mh-excerpt-more" href="<?php echo esc_url($slide['url']); ?>" title="<?php echo esc_attr($slide['title']); ?>"<?php echo $link_target; ?>>
															<?php echo esc_attr($mh_magazine_options['excerpt_more']); ?>
														</a>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</article>
							</li><?php
						}
					} ?>
				</ul>
			</div><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
       	$instance = array();
	   	if (!empty($new_instance['title1'])) {
			$instance['title1'] = sanitize_text_field($new_instance['title1']);
		}
		if (!empty($new_instance['url1'])) {
			$instance['url1'] = esc_url_raw($new_instance['url1']);
		}
		if (!empty($new_instance['image1'])) {
			$instance['image1'] = esc_url_raw($new_instance['image1']);
		}
		if (!empty($new_instance['excerpt1'])) {
			$instance['excerpt1'] = mh_sanitize_text($new_instance['excerpt1']);
		}
		$instance['target1'] = (!empty($new_instance['target1'])) ? 1 : 0;
		if (!empty($new_instance['title2'])) {
			$instance['title2'] = sanitize_text_field($new_instance['title2']);
		}
		if (!empty($new_instance['url2'])) {
			$instance['url2'] = esc_url_raw($new_instance['url2']);
		}
		if (!empty($new_instance['image2'])) {
			$instance['image2'] = esc_url_raw($new_instance['image2']);
		}
		if (!empty($new_instance['excerpt2'])) {
			$instance['excerpt2'] = mh_sanitize_text($new_instance['excerpt2']);
		}
		$instance['target2'] = (!empty($new_instance['target2'])) ? 1 : 0;
		if (!empty($new_instance['title3'])) {
			$instance['title3'] = sanitize_text_field($new_instance['title3']);
		}
		if (!empty($new_instance['url3'])) {
			$instance['url3'] = esc_url_raw($new_instance['url3']);
		}
		if (!empty($new_instance['image3'])) {
			$instance['image3'] = esc_url_raw($new_instance['image3']);
		}
		if (!empty($new_instance['excerpt3'])) {
			$instance['excerpt3'] = mh_sanitize_text($new_instance['excerpt3']);
		}
		$instance['target3'] = (!empty($new_instance['target3'])) ? 1 : 0;
		if (!empty($new_instance['title4'])) {
			$instance['title4'] = sanitize_text_field($new_instance['title4']);
		}
		if (!empty($new_instance['url4'])) {
			$instance['url4'] = esc_url_raw($new_instance['url4']);
		}
		if (!empty($new_instance['image4'])) {
			$instance['image4'] = esc_url_raw($new_instance['image4']);
		}
		if (!empty($new_instance['excerpt4'])) {
			$instance['excerpt4'] = mh_sanitize_text($new_instance['excerpt4']);
		}
		$instance['target4'] = (!empty($new_instance['target4'])) ? 1 : 0;
		if (!empty($new_instance['title5'])) {
			$instance['title5'] = sanitize_text_field($new_instance['title5']);
		}
		if (!empty($new_instance['url5'])) {
			$instance['url5'] = esc_url_raw($new_instance['url5']);
		}
		if (!empty($new_instance['image5'])) {
			$instance['image5'] = esc_url_raw($new_instance['image5']);
		}
		if (!empty($new_instance['excerpt5'])) {
			$instance['excerpt5'] = mh_sanitize_text($new_instance['excerpt5']);
		}
		$instance['target5'] = (!empty($new_instance['target5'])) ? 1 : 0;
		if ('layout1' !== $new_instance['slider_layout']) {
			if (in_array($new_instance['slider_layout'], array('layout2', 'layout3', 'layout4', 'layout5'))) {
				$instance['slider_layout'] = $new_instance['slider_layout'];
			}
		}
	   	return $instance;
    }
    function form($instance) {
		$defaults = array(
			'title1' => '', 'url1' => '', 'image1' => '', 'excerpt1' => '', 'target1' => 0,
			'title2' => '', 'url2' => '', 'image2' => '', 'excerpt2' => '', 'target2' => 0,
			'title3' => '', 'url3' => '', 'image3' => '', 'excerpt3' => '', 'target3' => 0,
			'title4' => '', 'url4' => '', 'image4' => '', 'excerpt4' => '', 'target4' => 0,
			'title5' => '', 'url5' => '', 'image5' => '', 'excerpt5' => '', 'target5' => 0,
			'slider_layout' => 'layout1'
		);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p class="widget-separator"><?php printf(esc_html('Slide %d:', 'mh-magazine'), 1); ?></p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title1')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title1']); ?>" name="<?php echo esc_attr($this->get_field_name('title1')); ?>" id="<?php echo esc_attr($this->get_field_id('title1')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('url1')); ?>"><?php esc_html_e('Custom URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url1']); ?>" name="<?php echo esc_attr($this->get_field_name('url1')); ?>" id="<?php echo esc_attr($this->get_field_id('url1')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('image1')); ?>"><?php esc_html_e('Custom Image URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image1']); ?>" name="<?php echo esc_attr($this->get_field_name('image1')); ?>" id="<?php echo esc_attr($this->get_field_id('image1')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt1')); ?>"><?php esc_html_e('Custom Excerpt:', 'mh-magazine'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="<?php _e('Enter Custom Excerpt', 'mh-magazine') ?>" name="<?php echo esc_attr($this->get_field_name('excerpt1')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt1')); ?>"><?php echo esc_attr($instance['excerpt1']); ?></textarea>
	    </p>
	    <p>
      		<input id="<?php echo esc_attr($this->get_field_id('target1')); ?>" name="<?php echo esc_attr($this->get_field_name('target1')); ?>" type="checkbox" value="1" <?php checked('1', $instance['target1']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('target1')); ?>"><?php esc_html_e('Open Links in new Window / Tab', 'mh-magazine'); ?></label>
    	</p>
    	<p class="widget-separator"><?php printf(esc_html('Slide %d:', 'mh-magazine'), 2); ?></p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title2')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title2']); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" id="<?php echo esc_attr($this->get_field_id('title2')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('url2')); ?>"><?php esc_html_e('Custom URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url2']); ?>" name="<?php echo esc_attr($this->get_field_name('url2')); ?>" id="<?php echo esc_attr($this->get_field_id('url2')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('image2')); ?>"><?php esc_html_e('Custom Image URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image2']); ?>" name="<?php echo esc_attr($this->get_field_name('image2')); ?>" id="<?php echo esc_attr($this->get_field_id('image2')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt2')); ?>"><?php esc_html_e('Custom Excerpt:', 'mh-magazine'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="<?php _e('Enter Custom Excerpt', 'mh-magazine') ?>" name="<?php echo esc_attr($this->get_field_name('excerpt2')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt2')); ?>"><?php echo esc_attr($instance['excerpt2']); ?></textarea>
	    </p>
	    <p>
      		<input id="<?php echo esc_attr($this->get_field_id('target2')); ?>" name="<?php echo esc_attr($this->get_field_name('target2')); ?>" type="checkbox" value="1" <?php checked('1', $instance['target2']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('target2')); ?>"><?php esc_html_e('Open Links in new Window / Tab', 'mh-magazine'); ?></label>
    	</p>
    	<p class="widget-separator"><?php printf(esc_html('Slide %d:', 'mh-magazine'), 3); ?></p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title3')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title3']); ?>" name="<?php echo esc_attr($this->get_field_name('title3')); ?>" id="<?php echo esc_attr($this->get_field_id('title3')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('url3')); ?>"><?php esc_html_e('Custom URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url3']); ?>" name="<?php echo esc_attr($this->get_field_name('url3')); ?>" id="<?php echo esc_attr($this->get_field_id('url3')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('image3')); ?>"><?php esc_html_e('Custom Image URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image3']); ?>" name="<?php echo esc_attr($this->get_field_name('image3')); ?>" id="<?php echo esc_attr($this->get_field_id('image3')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt3')); ?>"><?php esc_html_e('Custom Excerpt:', 'mh-magazine'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="<?php _e('Enter Custom Excerpt', 'mh-magazine') ?>" name="<?php echo esc_attr($this->get_field_name('excerpt3')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt3')); ?>"><?php echo esc_attr($instance['excerpt3']); ?></textarea>
	    </p>
	    <p>
      		<input id="<?php echo esc_attr($this->get_field_id('target3')); ?>" name="<?php echo esc_attr($this->get_field_name('target3')); ?>" type="checkbox" value="1" <?php checked('1', $instance['target3']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('target3')); ?>"><?php esc_html_e('Open Links in new Window / Tab', 'mh-magazine'); ?></label>
    	</p>
    	<p class="widget-separator"><?php printf(esc_html('Slide %d:', 'mh-magazine'), 4); ?></p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title4')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title4']); ?>" name="<?php echo esc_attr($this->get_field_name('title4')); ?>" id="<?php echo esc_attr($this->get_field_id('title4')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('url4')); ?>"><?php esc_html_e('Custom URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url4']); ?>" name="<?php echo esc_attr($this->get_field_name('url4')); ?>" id="<?php echo esc_attr($this->get_field_id('url4')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('image4')); ?>"><?php esc_html_e('Custom Image URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image4']); ?>" name="<?php echo esc_attr($this->get_field_name('image4')); ?>" id="<?php echo esc_attr($this->get_field_id('image4')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt4')); ?>"><?php esc_html_e('Custom Excerpt:', 'mh-magazine'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="<?php _e('Enter Custom Excerpt', 'mh-magazine') ?>" name="<?php echo esc_attr($this->get_field_name('excerpt4')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt4')); ?>"><?php echo esc_attr($instance['excerpt4']); ?></textarea>
	    </p>
	    <p>
      		<input id="<?php echo esc_attr($this->get_field_id('target4')); ?>" name="<?php echo esc_attr($this->get_field_name('target4')); ?>" type="checkbox" value="1" <?php checked('1', $instance['target4']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('target4')); ?>"><?php esc_html_e('Open Links in new Window / Tab', 'mh-magazine'); ?></label>
    	</p>
    	<p class="widget-separator"><?php printf(esc_html('Slide %d:', 'mh-magazine'), 5); ?></p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title5')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title5']); ?>" name="<?php echo esc_attr($this->get_field_name('title5')); ?>" id="<?php echo esc_attr($this->get_field_id('title5')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('url5')); ?>"><?php esc_html_e('Custom URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url5']); ?>" name="<?php echo esc_attr($this->get_field_name('url5')); ?>" id="<?php echo esc_attr($this->get_field_id('url5')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('image5')); ?>"><?php esc_html_e('Custom Image URL:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image5']); ?>" name="<?php echo esc_attr($this->get_field_name('image5')); ?>" id="<?php echo esc_attr($this->get_field_id('image5')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt5')); ?>"><?php esc_html_e('Custom Excerpt:', 'mh-magazine'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="<?php _e('Enter Custom Excerpt', 'mh-magazine') ?>" name="<?php echo esc_attr($this->get_field_name('excerpt5')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt5')); ?>"><?php echo esc_attr($instance['excerpt5']); ?></textarea>
	    </p>
	    <p>
      		<input id="<?php echo esc_attr($this->get_field_id('target5')); ?>" name="<?php echo esc_attr($this->get_field_name('target5')); ?>" type="checkbox" value="1" <?php checked('1', $instance['target5']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('target5')); ?>"><?php esc_html_e('Open Links in new Window / Tab', 'mh-magazine'); ?></label>
    	</p>
    	<p class="widget-separator"><?php esc_html_e('Slider Settings:', 'mh-magazine'); ?></p>
    	<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('slider_layout')); ?>"><?php esc_html_e('Slider Layout:', 'mh-magazine'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('slider_layout')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('slider_layout')); ?>">
				<option value="layout1" <?php selected('layout1', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 1); ?></option>
				<option value="layout2" <?php selected('layout2', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 2); ?></option>
				<option value="layout3" <?php selected('layout3', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 3); ?></option>
				<option value="layout4" <?php selected('layout4', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 4); ?></option>
				<option value="layout5" <?php selected('layout5', $instance['slider_layout']); ?>><?php printf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 5); ?></option>
			</select>
        </p><?php
    }
}

?>