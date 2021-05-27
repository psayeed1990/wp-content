<?php

/***** MH Tabbed *****/

class mh_magazine_tabbed extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_magazine_tabbed', esc_html_x('MH Tabbed', 'widget name', 'mh-magazine'),
			array(
				'classname' => 'mh_magazine_tabbed',
				'description' => esc_html__('MH Tabbed widget showing your latest posts, tags and comments.', 'mh-magazine')
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'postcount' => 10, 'tags' => 25, 'comments' => 3);
        $instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<div class="mh-tabbed-widget">
				<div class="mh-tab-buttons clearfix">
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-1">
						<span><i class="fa fa-newspaper-o"></i></span>
					</a>
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-2">
						<span><i class="fa fa-tags"></i></span>
					</a>
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-3">
						<span><i class="fa fa-comments-o"></i></span>
					</a>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-1" class="mh-tab-content mh-tab-posts"><?php
					$latest_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $instance['postcount'], 'ignore_sticky_posts' => 1));
					if ($latest_posts->have_posts()) {
						echo '<ul class="mh-tab-content-posts">' . "\n";
							while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
								<li <?php post_class('mh-tab-post-item'); ?>>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</li><?php
							endwhile;
						echo '</ul>' . "\n";
					}
					wp_reset_postdata(); ?>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-2" class="mh-tab-content mh-tab-cloud">
                	<div class="tagcloud mh-tab-content-cloud">
	                	<?php wp_tag_cloud(array('number' => $instance['tags'], 'smallest' => 12, 'largest' => 12, 'unit' => 'px')); ?>
					</div>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-3" class="mh-tab-content mh-tab-comments"><?php
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query(array('number' => $instance['comments'], 'status' => 'approve'));
					if ($comments) {
						echo '<ul class="mh-tab-content-comments">';
							foreach ($comments as $comment) { ?>
								<li class="mh-tab-comment-item">
									<span class="mh-tab-comment-avatar">
										<?php echo get_avatar($comment->comment_author_email, 24); ?>
									</span>
									<span class="mh-tab-comment-author">
										<?php echo esc_attr($comment->comment_author) . ': '; ?>
									</span>
									<a href="<?php echo esc_url(get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID); ?>">
										<span class="mh-tab-comment-excerpt">
											<?php comment_excerpt($comment->comment_ID); ?>
										</span>
									</a>
								</li><?php
							}
						echo '</ul>';
					} else {
						esc_html_e('No comments found', 'mh-magazine');
					} ?>
				</div>
			</div><?php
		echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
		}
		if (0 !== absint($new_instance['tags'])) {
			$instance['tags'] = absint($new_instance['tags']);
		}
		if (0 !== absint($new_instance['comments'])) {
			$instance['comments'] = absint($new_instance['comments']);
		}
        return $instance;
    }
    function form($instance) {
		$defaults = array('title' => '', 'postcount' => 10, 'tags' => 25, 'comments' => 3);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_html_e('Tag Count:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['tags']); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('comments')); ?>"><?php esc_html_e('Comment Count:', 'mh-magazine'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['comments']); ?>" name="<?php echo esc_attr($this->get_field_name('comments')); ?>" id="<?php echo esc_attr($this->get_field_id('comments')); ?>" />
	    </p><?php
    }
}

?>