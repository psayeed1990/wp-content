<?php

/***** Add CSS classes to HTML tag *****/

if (!function_exists('mh_magazine_html_class')) {
	function mh_magazine_html_class() {
		$mh_magazine_options = mh_magazine_theme_options();
		echo ' mh-' . esc_attr($mh_magazine_options['sidebars']) . '-sb';
	}
}
add_action('mh_html_class', 'mh_magazine_html_class');

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_magazine_body_class')) {
	function mh_magazine_body_class($classes) {
		$mh_magazine_options = mh_magazine_theme_options();
		$classes[] = 'mh-' . esc_attr($mh_magazine_options['site_layout']) . '-layout';
		$classes[] = 'mh-' . esc_attr($mh_magazine_options['sb_position']) . '-sb';
		$classes[] = 'mh-loop-' . esc_attr($mh_magazine_options['loop_layout']);
		$classes[] = 'mh-widget-' . esc_attr($mh_magazine_options['widget_layout']);
		if ($mh_magazine_options['header_transparent'] === 'enable') {
			$classes[] = 'mh-header-transparent';
		}
		if ($mh_magazine_options['post_meta_cat_loop'] === 'disable') {
			$classes[] = 'mh-loop-hide-caption';
		}
		return $classes;
	}
}
add_filter('body_class', 'mh_magazine_body_class');

/***** Add CSS classes to posts in grid widget / related posts *****/

if (!function_exists('mh_magazine_post_grid_class')) {
	function mh_magazine_post_grid_class() {
		if (!in_the_loop()) {
			post_class('mh-posts-grid-item clearfix');
		} else {
			$post_id = get_the_ID();
			$format = get_post_format($post_id);
			$post_format = $format ? $format : 'standard';
			echo 'class="post-' . $post_id . ' format-' . $post_format . ' mh-posts-grid-item clearfix"';
		}
	}
}

/***** Remove hentry CSS class from pages and custom widgets *****/

if (!function_exists('mh_magazine_remove_hentry')) {
	function mh_magazine_remove_hentry($classes) {
		if (is_page() || !in_the_loop()) {
        	$classes = array_diff($classes, array('hentry'));
    	}
		return $classes;
	}
}
add_filter('post_class', 'mh_magazine_remove_hentry');

/***** Add CSS classes to comments *****/

if (!function_exists('mh_magazine_comment_class')) {
	function mh_magazine_comment_class($classes) {
		$classes[] = 'entry-content';
		return $classes;
	}
}
add_filter('comment_class', 'mh_magazine_comment_class');

/***** Add header widget area *****/

if (!function_exists('mh_magazine_header_widget')) {
	function mh_magazine_header_widget() {
		if (is_active_sidebar('mh-header-1')) {
			echo '<aside class="mh-container mh-header-widget-1">' . "\n";
				dynamic_sidebar('mh-header-1');
			echo '</aside>' . "\n";
		}
	}
}
add_action('mh_before_header', 'mh_magazine_header_widget');

/***** Add HTML markup for main site container *****/

if (!function_exists('mh_magazine_boxed_container_open')) {
	function mh_magazine_boxed_container_open() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['site_layout'] == 'boxed') {
			echo '<div class="mh-container mh-container-outer">' . "\n";
		}
	}
}
add_action('mh_before_header', 'mh_magazine_boxed_container_open');

if (!function_exists('mh_magazine_boxed_container_close')) {
	function mh_magazine_boxed_container_close() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['site_layout'] == 'boxed') {
			mh_before_container_close();
			echo '</div><!-- .mh-container-outer -->' . "\n";
		}
	}
}
add_action('mh_after_footer', 'mh_magazine_boxed_container_close');

if (!function_exists('mh_magazine_wide_container_open')) {
	function mh_magazine_wide_container_open() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['site_layout'] == 'wide') {
			echo '<div class="mh-container mh-container-outer">' . "\n";
		}
	}
}
add_action('mh_after_header', 'mh_magazine_wide_container_open');

if (!function_exists('mh_magazine_wide_container_close')) {
	function mh_magazine_wide_container_close() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['site_layout'] == 'wide') {
			mh_before_container_close();
			echo '</div><!-- .mh-container-outer -->' . "\n";
		}
	}
}
add_action('mh_before_footer', 'mh_magazine_wide_container_close');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

if (!function_exists('mh_magazine_media_queries')) {
	function mh_magazine_media_queries() {
		echo '<!--[if lt IE 9]>' . "\n";
		echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
		echo '<![endif]-->' . "\n";
	}
}
add_action('wp_head', 'mh_magazine_media_queries');

/***** Custom Header *****/

if (!function_exists('mh_magazine_custom_header')) {
	function mh_magazine_custom_header() {
		echo '<div class="mh-custom-header clearfix">' . "\n";
			if (get_header_image()) {
				echo '<a class="mh-header-image-link" href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
					echo '<img class="mh-header-image" src="' . esc_url(get_header_image()) . '" height="' . esc_attr(get_custom_header()->height) . '" width="' . esc_attr(get_custom_header()->width) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
				echo '</a>' . "\n";
			}
			if (function_exists('has_custom_logo') && has_custom_logo() || display_header_text() || is_active_sidebar('mh-header-2')) {
				echo '<div class="mh-header-columns mh-row clearfix">' . "\n";
					if (function_exists('has_custom_logo') && has_custom_logo() || display_header_text()) {
						is_active_sidebar('mh-header-2') ? $header_cols = 'mh-col-1-3' : $header_cols = 'mh-col-1-1';
						echo '<div class="' . esc_attr($header_cols) . ' mh-site-identity">' . "\n";
							echo '<div class="mh-site-logo" role="banner" itemscope="itemscope" itemtype="http://schema.org/Brand">' . "\n";
								if (function_exists('the_custom_logo')) {
									the_custom_logo();
								}
								if (display_header_text()) {
									if (get_header_textcolor() != get_theme_support('custom-header', 'default-text-color')) {
										echo '<style type="text/css" id="mh-header-css">';
											echo '.mh-header-title, .mh-header-tagline { color: #' . esc_attr(get_header_textcolor()) . '; }';
										echo '</style>' . "\n";
									}
									echo '<div class="mh-header-text">' . "\n";
										if (is_front_page()) {
											$header_title_before = '<h1 class="mh-header-title">';
											$header_title_after = '</h1>' . "\n";
											$header_tagline_before = '<h2 class="mh-header-tagline">';
											$header_tagline_after = '</h2>' . "\n";
										} else {
											$header_title_before = '<h2 class="mh-header-title">';
											$header_title_after = '</h2>' . "\n";
											$header_tagline_before = '<h3 class="mh-header-tagline">';
											$header_tagline_after = '</h3>' . "\n";
										}
										echo '<a class="mh-header-text-link" href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
											if (get_bloginfo('name')) {
												echo $header_title_before . esc_attr(get_bloginfo('name')) . $header_title_after;
											}
											if (get_bloginfo('description')) {
												echo $header_tagline_before . esc_attr(get_bloginfo('description')) . $header_tagline_after;
											}
										echo '</a>' . "\n";
									echo '</div>' . "\n";
								}
							echo '</div>' . "\n";
						echo '</div>' . "\n";
					}
					if (is_active_sidebar('mh-header-2')) {
						function_exists('has_custom_logo') && has_custom_logo() || display_header_text() ? $header_widget_class = 'mh-col-2-3 mh-header-widget-2' : $header_widget_class = 'mh-col-1-1 mh-header-widget-2 mh-header-widget-2-full';
						echo '<aside class="' . esc_attr($header_widget_class) . '">' . "\n";
							dynamic_sidebar('mh-header-2');
						echo '</aside>' . "\n";
					}
				echo '</div>' . "\n";
			}
		echo '</div>' . "\n";
	}
}

/***** Modify Prefix of Titles on Archives *****/

if (!function_exists('mh_magazine_archive_title_prefix')) {
	function mh_magazine_archive_title_prefix($title) {
		if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
	        $title = sprintf(esc_html__('Articles by %s', 'mh-magazine'), '<span class="vcard">' . get_the_author() . '</span>');
        }
		return $title;
	}
}
add_filter('get_the_archive_title', 'mh_magazine_archive_title_prefix');

/***** Archive Layouts *****/

if (!function_exists('mh_magazine_loop_layout')) {
	function mh_magazine_loop_layout() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['loop_layout'] === 'layout1') {
			while (have_posts()) : the_post();
				get_template_part('content', 'list');
			endwhile;
		} elseif ($mh_magazine_options['loop_layout'] === 'layout2') {
			while (have_posts()) : the_post();
				get_template_part('content', 'large');
			endwhile;
		} elseif ($mh_magazine_options['loop_layout'] === 'layout3') {
			$counter = 1;
			while (have_posts()) : the_post();
				if ($counter === 1) {
					get_template_part('content', 'large');
				} else {
					get_template_part('content', 'list');
				}
				$counter++;
			endwhile;
		} elseif ($mh_magazine_options['loop_layout'] === 'layout4') {
			global $wp_query;
			$counter = 1;
			$max_posts = $wp_query->post_count;
			$post_cols = $mh_magazine_options['sidebars'] != 'disable' ? 2 : 3;
			while (have_posts()) : the_post();
				if ($counter === 1) {
					echo '<div class="mh-row mh-posts-grid clearfix">' . "\n";
				}
				if ($counter >= 1) {
					echo '<div class="mh-col-1-' . absint($post_cols) . ' mh-posts-grid-col clearfix">' . "\n";
						get_template_part('content', 'grid');
					echo '</div>' . "\n";
				}
				if ($counter % absint($post_cols) === 0 && $counter != $max_posts) {
					echo '</div>' . "\n";
					if ($counter === absint($post_cols) || $counter % absint($post_cols * 3) === 0) {
						mh_magazine_archive_ads();
					}
					echo '<div class="mh-row mh-posts-grid mh-posts-grid-more clearfix">' . "\n";
				}
				if ($counter >= 1 && $counter === $max_posts) {
					echo '</div>' . "\n";
				}
				$counter++;
			endwhile;
		} elseif ($mh_magazine_options['loop_layout'] === 'layout5') {
			global $wp_query;
			$counter = 1;
			$max_posts = $wp_query->post_count;
			while (have_posts()) : the_post();
				if ($counter === 1) {
					get_template_part('content', 'large');
				}
				if ($counter === 1 && $max_posts > 1) {
					mh_magazine_archive_ads();
					echo '<div class="mh-row mh-posts-grid mh-loop-grid clearfix">' . "\n";
				}
				if ($counter > 1 && $counter <= 4) {
					echo '<div class="mh-col-1-3 mh-posts-grid-col clearfix">' . "\n";
						get_template_part('content', 'grid');
					echo '</div>' . "\n";
				}
				if ($counter === 4 && $max_posts >= 4 || $counter > 1 && $counter < 4 && $counter === $max_posts) {
					echo '</div>' . "\n";
				}
				if ($counter >= 5) {
					get_template_part('content', 'list');
				}
				if ($counter >= 5 && $counter % 3 === 0) {
					mh_magazine_archive_ads();
				}
				$counter++;
			endwhile;
		}
	}
}

/***** Subheading on Posts *****/

if (!function_exists('mh_magazine_subheading')) {
	function mh_magazine_subheading() {
		global $post;
		if (get_post_meta($post->ID, "mh-subheading", true)) {
			echo '<div class="mh-subheading-top"></div>' . "\n";
			echo '<h2 class="mh-subheading">' . esc_attr(get_post_meta($post->ID, "mh-subheading", true)) . '</h2>' . "\n";
		}
	}
}
add_action('mh_post_header', 'mh_magazine_subheading');

/***** Post Meta *****/

if (!function_exists('mh_magazine_post_meta')) {
	function mh_magazine_post_meta() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['post_meta_date'] === 'enable' || $mh_magazine_options['post_meta_author'] === 'enable' && in_the_loop() || $mh_magazine_options['post_meta_cat'] === 'enable' && in_the_loop() && is_singular() || $mh_magazine_options['post_meta_comments'] === 'enable') {
			echo '<div class="mh-meta entry-meta">' . "\n";
				if ($mh_magazine_options['post_meta_date'] === 'enable') {
					echo '<span class="entry-meta-date updated"><i class="fa fa-clock-o"></i><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_date() . '</a></span>' . "\n";
				}
				if ($mh_magazine_options['post_meta_author'] === 'enable' && in_the_loop()) {
					echo '<span class="entry-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";
				}
				if ($mh_magazine_options['post_meta_cat'] === 'enable' && in_the_loop() && is_singular()) {
					echo '<span class="entry-meta-categories"><i class="fa fa-folder-open-o"></i>' . get_the_category_list(', ', '') . '</span>' . "\n";
				}
				if ($mh_magazine_options['post_meta_comments'] === 'enable') {
					echo '<span class="entry-meta-comments"><i class="fa fa-comment-o"></i>';
						mh_magazine_comment_count();
					echo '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}
add_action('mh_post_header', 'mh_magazine_post_meta');

/***** Comment Count Link *****/

if (!function_exists('mh_magazine_comment_count')) {
	function mh_magazine_comment_count() {
		comments_popup_link(esc_html_x('0', 'comment count', 'mh-magazine'), esc_html_x('1', 'comment count', 'mh-magazine'), esc_html_x('%', 'comment count', 'mh-magazine'), 'mh-comment-count-link');
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_magazine_featured_image')) {
	function mh_magazine_featured_image() {
		global $page, $post;
		$mh_magazine_options = mh_magazine_theme_options();
		if (has_post_thumbnail() && $page == '1' && $mh_magazine_options['featured_image'] === 'enable' && !get_post_meta($post->ID, 'mh-no-image', true)) {
			if ($mh_magazine_options['sidebars'] === 'disable' || is_page_template('template-full.php')) {
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mh-magazine-slider');
			} else {
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mh-magazine-content');
			}
			if ($mh_magazine_options['link_featured_image'] === 'enable') {
				$att_url_begin = '<a href="' . esc_url(get_attachment_link(get_post_thumbnail_id())) . '">';
				$att_url_end = '</a>';
			} else {
				$att_url_begin = '';
				$att_url_end = '';
			}
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<figure class="entry-thumbnail">' . "\n";
				echo $att_url_begin . '<img src="' . esc_url($thumbnail[0]) . '" alt="' . esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) . '" title="' . esc_attr(get_post(get_post_thumbnail_id())->post_title) . '" />' . $att_url_end . "\n";
				if ($caption_text) {
					echo '<figcaption class="wp-caption-text">' . wp_kses_post($caption_text) . '</figcaption>' . "\n";
				}
			echo '</figure>' . "\n";
		}
	}
}
add_action('mh_post_content_top', 'mh_magazine_featured_image');

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_magazine_paginated_posts')) {
	function mh_magazine_paginated_posts($content) {
		if (is_singular() && in_the_loop()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clearfix">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => esc_html__('&raquo;', 'mh-magazine'), 'previouspagelink' => esc_html__('&laquo;', 'mh-magazine'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_magazine_paginated_posts', 1);

/***** Author box *****/

if (!function_exists('mh_magazine_author_box')) {
	function mh_magazine_author_box() {
		$mh_magazine_options = mh_magazine_theme_options();
		$mh_author_box_ID = get_the_author_meta('ID');
		if ($mh_magazine_options['author_box'] == 'enable' && get_the_author_meta('description', $mh_author_box_ID) && !is_attachment() || is_page_template('template-authors.php')) {
			get_template_part('content', 'author-box');
		}
	}
}
add_action('mh_after_post_content', 'mh_magazine_author_box');

/***** Post / Attachment Navigation *****/

if (!function_exists('mh_magazine_postnav')) {
	function mh_magazine_postnav() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['post_nav'] === 'enable') {
			global $post;
			$parent_post = get_post($post->post_parent);
			$attachment = is_attachment();
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			if (!empty($prev_post) || !empty($next_post) || $attachment) {
				echo '<nav class="mh-post-nav mh-row clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">' . "\n";
					if (!empty($prev_post) || $attachment) {
						echo '<div class="mh-col-1-2 mh-post-nav-item mh-post-nav-prev">' . "\n";
							if ($attachment) {
								if (wp_attachment_is_image()) {
									$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
									$count = count($attachments);
									if ($count == 1) {
										echo '<a href="' . esc_url(get_permalink($parent_post)) . '">' . '<span>' . esc_html__('Back to article', 'mh-magazine') . '</span>' . '</a>';
									} else {
										previous_image_link('%link', '<span>' . esc_html__('Previous', 'mh-magazine') . '</span>');
									}
								} else {
									echo '<a href="' . esc_url(get_permalink($parent_post)) . '">' . '<span>' . esc_html__('Back to article', 'mh-magazine') . '</span>' . '</a>';
								}
							} else {
								$prev_thumb = get_the_post_thumbnail($prev_post->ID, 'mh-magazine-small');
								previous_post_link('%link', $prev_thumb . '<span>' . esc_html__('Previous', 'mh-magazine') . '</span>' . '<p>%title</p>');
							}
						echo '</div>' . "\n";
					}
					if (!empty($next_post) || $attachment) {
						echo '<div class="mh-col-1-2 mh-post-nav-item mh-post-nav-next">' . "\n";
							if ($attachment) {
								next_image_link('%link', '<span>' . esc_html__('Next', 'mh-magazine') . '</span>');
							} else {
								$next_thumb = get_the_post_thumbnail($next_post->ID, 'mh-magazine-small');
								next_post_link('%link', $next_thumb . '<span>' . esc_html__('Next', 'mh-magazine') . '</span>' . '<p>%title</p>');
							}
						echo '</div>' . "\n";
					}
				echo '</nav>' . "\n";
			}
		}
	}
}
add_action('mh_after_post_content', 'mh_magazine_postnav');

/***** Related Content *****/

if (!function_exists('mh_magazine_related_content')) {
	function mh_magazine_related_content() {
		global $post;
		$mh_magazine_options = mh_magazine_theme_options();
		$tags = wp_get_post_tags($post->ID);
		if ($mh_magazine_options['related_content'] === 'enable' && $tags) {
			$tag_ids = array();
			foreach($tags as $tag) $tag_ids[] = $tag->term_id;
			$related = new wp_query(array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page' => 3, 'ignore_sticky_posts' => 1, 'orderby' => 'rand'));
			if ($related->have_posts()) {
				echo '<section class="mh-related-content">' . "\n";
					echo '<h3 class="mh-widget-title mh-related-content-title">' . "\n";
						echo '<span class="mh-widget-title-inner">';
							esc_html_e('Related Articles', 'mh-magazine');
						echo '</span>';
					echo '</h3>' . "\n";
					echo '<div class="mh-related-wrap mh-row clearfix">' . "\n";
						while ($related->have_posts()) : $related->the_post();
							echo '<div class="mh-col-1-3 mh-posts-grid-col clearfix">' . "\n";
								get_template_part('content', 'grid');
							echo '</div>' . "\n";
						endwhile;
					echo '</div>' . "\n";
				echo '</section>' . "\n";
				wp_reset_postdata();
			}
		}
	}
}
add_action('mh_after_post_content', 'mh_magazine_related_content');

/***** Custom Excerpts *****/

if (!function_exists('mh_magazine_excerpt_length')) {
	function mh_magazine_excerpt_length($length) {
		$mh_magazine_options = mh_magazine_theme_options();
		$excerpt_length = absint($mh_magazine_options['excerpt_length']);
		return $excerpt_length;
	}
}
add_filter('excerpt_length', 'mh_magazine_excerpt_length', 999);

if (!function_exists('mh_magazine_excerpt_more')) {
	function mh_magazine_excerpt_more() {
		global $post;
		$mh_magazine_options = mh_magazine_theme_options();
		return ' <a class="mh-excerpt-more" href="' . esc_url(get_permalink($post->ID)) . '" title="' . the_title_attribute('echo=0') . '">' . esc_attr($mh_magazine_options['excerpt_more']) . '</a>';
	}
}
add_filter('excerpt_more', 'mh_magazine_excerpt_more');

if (!function_exists('mh_magazine_excerpt_markup')) {
	function mh_magazine_excerpt_markup($excerpt) {
		$markup = '<div class="mh-excerpt">' . $excerpt . '</div>';
		return $markup;
	}
}
add_filter('the_excerpt', 'mh_magazine_excerpt_markup');

/***** Excerpt for Widgets with Custom Excerpt Length *****/

if (!function_exists('mh_magazine_custom_excerpt')) {
	function mh_magazine_custom_excerpt($excerpt_length = 35) {
		if (has_excerpt()) {
			the_excerpt();
		} else {
			$excerpt = get_the_content('');
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
			echo '<div class="mh-excerpt">' . wp_trim_words($excerpt, $excerpt_length, mh_magazine_excerpt_more()) . '</div>';
		}
	}
}

/***** Add More-Link to Manual Excerpts *****/

if (!function_exists('mh_magazine_manual_excerpt')) {
	function mh_magazine_manual_excerpt($excerpt) {
		$excerpt_more = '';
		if (has_excerpt() && !is_attachment()) {
			$excerpt_more = mh_magazine_excerpt_more();
		}
		return $excerpt . $excerpt_more;
	}
}
add_filter('get_the_excerpt', 'mh_magazine_manual_excerpt');

/***** Enable Custom Excerpts for Pages *****/

if (!function_exists('mh_magazine_excerpt_pages')) {
	function mh_magazine_excerpt_pages() {
		add_post_type_support('page', 'excerpt');
	}
}
add_action('init', 'mh_magazine_excerpt_pages');

/***** Custom Comment Fields *****/

if (!function_exists('mh_magazine_comment_fields')) {
	function mh_magazine_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . esc_html__('Name ', 'mh-magazine') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . esc_html__('Email ', 'mh-magazine') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'mh-magazine') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
			'cookies' 	=>  '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'mh-magazine') . '</label></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_magazine_comment_fields');

/***** Pagination *****/

if (!function_exists('mh_magazine_pagination')) {
	function mh_magazine_pagination() {
		if (get_the_posts_pagination()) {
			echo '<div class="mh-loop-pagination clearfix">';
				the_posts_pagination(array(
					'mid_size' => 1,
					'prev_text' => esc_html__('&laquo;', 'mh-magazine'),
					'next_text' => esc_html__('&raquo;', 'mh-magazine'),
				));
			echo '</div>';
		}
	}
}

/***** Second Sidebar *****/

if (!function_exists('mh_magazine_second_sidebar')) {
	function mh_magazine_second_sidebar() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['sidebars'] == 'two') {
			echo '<aside class="mh-widget-col-1 mh-sidebar-2 mh-sidebar-wide" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">' . "\n";
				if (is_active_sidebar('mh-sidebar-2')) {
					dynamic_sidebar('mh-sidebar-2');
				} else {
					echo '<div class="mh-widget mh-sidebar-empty">' . "\n";
						echo '<h4 class="mh-widget-title">' . "\n";
							echo '<span class="mh-widget-title-inner">';
								printf(_x('Sidebar %d', 'widget area name', 'mh-magazine'), 2);
							echo '</span>';
						echo '</h4>' . "\n";
						echo '<div class="textwidget">' . "\n";
							printf(esc_html__('Please navigate to %1s in your WordPress dashboard and add some widgets into the %1s widget area.', 'mh-magazine'), '<strong>' . __('Appearance &#8594; Widgets', 'mh-magazine') . '</strong>', '<em>' . sprintf(_x('Sidebar %d', 'widget area name', 'mh-magazine'), 2) . '</em>') . "\n";
						echo '</div>' . "\n";
					echo '</div>' . "\n";
				}
			echo '</aside>' . "\n";
    	}
	}
}

/***** Footer Widget Areas *****/

if (!function_exists('mh_magazine_footer_widgets')) {
	function mh_magazine_footer_widgets() {
		$footer_1 = ''; $footer_2 = ''; $footer_3 = ''; $footer_4 = ''; $footer_class = ''; $footer_columns = 0;
		if (is_active_sidebar('mh-footer-1')) {
			$footer_1 = 1; $footer_columns++;
		}
		if (is_active_sidebar('mh-footer-2')) {
			$footer_2 = 1; $footer_columns++;
		}
		if (is_active_sidebar('mh-footer-3')) {
			$footer_3 = 1; $footer_columns++;
		}
		if (is_active_sidebar('mh-footer-4')) {
			$footer_4 = 1; $footer_columns++;
		}
		if ($footer_columns === 4) {
			$footer_class = 'mh-col-1-4 mh-widget-col-1 mh-footer-4-cols ';
		} elseif ($footer_columns === 3) {
			$footer_class = 'mh-col-1-3 mh-widget-col-1 mh-footer-3-cols ';
		} elseif ($footer_columns === 2) {
			$footer_class = 'mh-col-1-2 mh-widget-col-2 mh-footer-2-cols ';
		} else {
			$footer_class = 'mh-col-1-1 mh-home-wide ';
		}
		if ($footer_1 || $footer_2 || $footer_3 || $footer_4) {
			echo '<footer class="mh-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">' . "\n";
				echo '<div class="mh-container mh-container-inner mh-footer-widgets mh-row clearfix">' . "\n";
					if ($footer_1) {
						echo '<div class="' . esc_attr($footer_class) . ' mh-footer-area mh-footer-1">' . "\n";
							dynamic_sidebar('mh-footer-1');
						echo '</div>' . "\n";
					}
					if ($footer_2) {
						echo '<div class="' . esc_attr($footer_class) . ' mh-footer-area mh-footer-2">' . "\n";
							dynamic_sidebar('mh-footer-2');
						echo '</div>' . "\n";
					}
					if ($footer_3) {
						echo '<div class="' . esc_attr($footer_class) . ' mh-footer-area mh-footer-3">' . "\n";
							dynamic_sidebar('mh-footer-3');
						echo '</div>' . "\n";
					}
					if ($footer_4) {
						echo '<div class="' . esc_attr($footer_class) . ' mh-footer-area mh-footer-4">' . "\n";
							dynamic_sidebar('mh-footer-4');
						echo '</div>' . "\n";
					}
				echo '</div>' . "\n";
			echo '</footer>' . "\n";
		}
	}
}

/***** Add Back to Top Button *****/

if (!function_exists('mh_magazine_back_to_top')) {
	function mh_magazine_back_to_top() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['back_to_top'] == 'enable') {
			echo '<a href="#" class="mh-back-to-top"><i class="fa fa-chevron-up"></i></a>' . "\n";
		}
	}
}
add_action('mh_before_container_close', 'mh_magazine_back_to_top');

/***** Modify Appearance of WP Tag Cloud Widget *****/

if (!function_exists('mh_magazine_custom_tag_cloud')) {
	function mh_magazine_custom_tag_cloud($args) {
		$args['smallest'] = 12;
		$args['largest'] = 12;
		$args['unit'] = 'px';
		return $args;
	}
}
add_filter('widget_tag_cloud_args', 'mh_magazine_custom_tag_cloud');

/***** Fix links of carousel widget to work on mobile devices *****/

if (!function_exists('mh_magazine_carousel_fix')) {
	function mh_magazine_carousel_fix() {
		if (wp_is_mobile() && is_active_widget('', '', 'mh_magazine_carousel')) {
			echo '<style type="text/css">.flex-direction-nav { display: none; }</style>';
		}
	}
}
add_action('wp_head', 'mh_magazine_carousel_fix');

/***** Footer Copyright Notice *****/

if (!function_exists('mh_magazine_copyright_notice')) {
	function mh_magazine_copyright_notice() {
		$mh_magazine_options = mh_magazine_theme_options();
		if (empty($mh_magazine_options['copyright'])) {
			printf(esc_html__('Copyright &copy; %1$s | MH Magazine WordPress Theme by %2$s', 'mh-magazine'), date("Y"), '<a href="' . esc_url('https://www.mhthemes.com/') . '" title="Premium WordPress Themes" rel="nofollow">MH Themes</a>');
		} else {
			echo $mh_magazine_options['copyright'];
		}
	}
}

/***** Add Tracking Code *****/

if (!function_exists('mh_magazine_trackingcode')) {
	function mh_magazine_trackingcode() {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['tracking_code']) {
			echo $mh_magazine_options['tracking_code'];
		}
	}
}
add_filter('wp_footer', 'mh_magazine_trackingcode');

/***** Add Featured Image Size to Media Gallery Selection *****/

if (!function_exists('mh_magazine_image_selection')) {
	function mh_magazine_image_selection($sizes) {
		$mh_magazine_options = mh_magazine_theme_options();
		if ($mh_magazine_options['sidebars'] == 'disable') {
			$custom_sizes = array('mh-magazine-slider' => 'Featured Image (large)', 'mh-magazine-content' => 'Featured Image (normal)');
		} else {
			$custom_sizes = array('mh-magazine-content' => 'Featured Image');
		}
		return array_merge($sizes, $custom_sizes);
	}
}
add_filter('image_size_names_choose', 'mh_magazine_image_selection');

?>