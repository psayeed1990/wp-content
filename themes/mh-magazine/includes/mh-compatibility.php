<?php

/***** Deprecated functionality *****/

/** Page Title Output - Scheduled for removal in MH Magazine v3.9.0 **/

if (!function_exists('mh_magazine_page_title')) {
	function mh_magazine_page_title() {
		if (!is_front_page()) {
			echo '<header class="page-header">' . "\n";
				echo '<h1 class="page-title">';
					if (is_archive()) {
						if (is_category() || is_tax()) {
							single_cat_title();
						} elseif (is_tag()) {
							single_tag_title();
						} elseif (is_author()) {
							global $author;
							$user_info = get_userdata($author);
							printf(_x('Articles by %s', 'post author', 'mh-magazine'), esc_attr($user_info->display_name));
						} elseif (is_day()) {
							echo get_the_date();
						} elseif (is_month()) {
							echo get_the_date('F Y');
						} elseif (is_year()) {
							echo get_the_date('Y');
						} elseif (is_post_type_archive()) {
							global $post;
							$post_type = get_post_type_object(get_post_type($post));
							echo esc_attr($post_type->labels->name);
						} else {
							_e('Archives', 'mh-magazine');
						}
					} else {
						if (is_home()) {
							echo esc_attr(get_the_title(get_option('page_for_posts', true)));
						} elseif (is_404()) {
							_e('Page not found (404)', 'mh-magazine');
						} elseif (is_search()) {
							printf(__('Search Results for %s', 'mh-magazine'), esc_attr(get_search_query()));
						} else {
							the_title();
						}
					}
				echo '</h1>' . "\n";
			echo '</header>' . "\n";
		}
	}
}

/** Post Meta (Loop) - Scheduled for removal in MH Magazine v3.9.0 **/

if (!function_exists('mh_magazine_loop_meta')) {
	function mh_magazine_loop_meta() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['post_meta_date'] === 'enable') {
			echo '<span class="mh-meta-date updated"><i class="fa fa-clock-o"></i>' . get_the_date() . '</span>' . "\n";
		}
		if ($mh_magazine_options['post_meta_author'] === 'enable' && in_the_loop()) {
			echo '<span class="mh-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";
		}
		if ($mh_magazine_options['post_meta_comments'] === 'enable') {
			echo '<span class="mh-meta-comments"><i class="fa fa-comment-o"></i>';
				mh_magazine_comment_count();
			echo '</span>' . "\n";
		}
	}
}

/** Custom Commentlist - Scheduled for removal in MH Magazine v3.9.0 **/

if (!function_exists('mh_magazine_comments')) {
	function mh_magazine_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class('mh-comment-item'); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="mh-comment-body">
				<footer class="mh-comment-footer clearfix">
					<figure class="mh-comment-gravatar">
						<?php echo get_avatar($comment->comment_author_email, 80); ?>
					</figure>
					<div class="mh-meta mh-comment-meta">
						<div class="vcard author mh-comment-meta-author">
							<span class="fn"><?php echo get_comment_author_link(); ?></span>
						</div>
						<a class="mh-comment-meta-date" href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
							<?php printf(esc_html__('%1$s at %2$s', 'mh-magazine'), get_comment_date(),  get_comment_time()); ?>
						</a>
					</div>
				</footer>
				<?php if ($comment->comment_approved == '0') { ?>
					<div class="mh-comment-info">
						<?php esc_html_e('Your comment is awaiting moderation.', 'mh-magazine') ?>
					</div>
				<?php } ?>
				<div class="entry-content mh-comment-content">
					<?php comment_text() ?>
				</div>
				<div class="mh-meta mh-comment-meta-links"><?php
					edit_comment_link(esc_html__('Edit', 'mh-magazine'), '  ', '');
					if (comments_open() && $args['max_depth'] != $depth) {
						comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					} ?>
                </div>
			</article><?php
	}
}

/** Add custom CSS field only if it already contains data - Scheduled for removal **/

if (!function_exists('mh_magazine_custom_css_field')) {
	function mh_magazine_custom_css_field($wp_customize) {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['custom_css'] != '') {
			$wp_customize->add_section('mh_magazine_css', array('title' => esc_html__('Custom CSS', 'mh-magazine'), 'priority' => 8, 'panel' => 'mh_magazine_theme_options'));
			$wp_customize->add_setting('mh_magazine_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));
			$wp_customize->add_control('custom_css', array('label' => esc_html__('Custom CSS', 'mh-magazine'), 'section' => 'mh_magazine_css', 'settings' => 'mh_magazine_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
		}
	}
}
add_action('customize_register', 'mh_magazine_custom_css_field');

?>