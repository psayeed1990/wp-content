<?php

/***** Breadcrumbs *****/

if (!function_exists('mh_magazine_breadcrumb')) {
	function mh_magazine_breadcrumb() {
		if (!is_home() && !is_front_page()) {
			global $post;
			$mh_magazine_options = mh_magazine_theme_options();
			if ($mh_magazine_options['breadcrumbs'] == 'enable') {
				$delimiter = '<span class="mh-breadcrumb-delimiter"><i class="fa fa-angle-right"></i></span>';
				$before_link = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
				$before_title = '<span itemprop="title">';
				$close_span = '</span>';
				echo '<nav class="mh-breadcrumb">' . $before_link . '<a href="' . esc_url(home_url()) . '" itemprop="url">' . $before_title . esc_html__('Home', 'mh-magazine') . $close_span . '</a>' . $close_span . $delimiter;
					if (is_single() && get_post_type() == 'post' && !is_attachment()) {
						$category = get_the_category();
						$category_id = $category[0]->cat_ID;
						$parent_id = $category[0]->category_parent;
						$parents = get_category_parents($parent_id, true, $delimiter);
						if ($parent_id != 0) {
							echo $parents;
						}
						echo $before_link . '<a href="' . esc_url(get_category_link($category_id)) . '" itemprop="url">' . $before_title . esc_attr($category[0]->name) . $close_span . '</a>' . $close_span . $delimiter;
						the_title();
					} elseif (is_attachment()) {
						echo esc_html__('Media', 'mh-magazine') . $delimiter;
						the_title();
					} elseif (is_page()) {
						if ($post->post_parent) {
							$parents = get_post_ancestors($post->ID);
							$parents = array_reverse($parents);
							foreach ($parents as $parent_id) {
								echo $before_link . '<a href="' . esc_url(get_permalink($parent_id)) . '" itemprop="url">' . $before_title . esc_attr(get_the_title($parent_id)) . $close_span . '</a>' . $close_span . $delimiter;
							}
						}
						the_title();
					} elseif (is_category() || is_tax()) {
						$term = get_queried_object();
						$term_id = $term->term_id;
						if (is_category()) {
							$term_id = get_category($term_id);
							$parents = get_category($term_id->parent);
							if ($term_id->parent != 0) {
								echo get_category_parents($parents, true, $delimiter);
							}
						} elseif (is_tax()) {
							$taxonomy = get_taxonomy($term->taxonomy);
							echo esc_attr($taxonomy->labels->name) . $delimiter;
						}
						echo single_cat_title('', false);
					} elseif (is_tag()) {
						echo single_term_title('', false);
					} elseif (is_author()) {
						global $author;
						$user_info = get_userdata($author);
						echo esc_html__('Authors', 'mh-magazine') . $delimiter . esc_attr($user_info->display_name);
					} elseif (is_404()) {
						echo esc_html__('Page not found (404)', 'mh-magazine');
					} elseif (is_search()) {
						echo esc_html__('Search', 'mh-magazine') . $delimiter . esc_attr(get_search_query());
					} elseif (is_date()) {
						$arc_year = get_the_time('Y');
						$arc_month = get_the_time('F');
						$arc_month_num = get_the_time('m');
						$arc_day = get_the_time('d');
						$arc_day_full = get_the_time('l');
						$url_year = get_year_link($arc_year);
						$url_month = get_month_link($arc_year, $arc_month_num);
						if (is_day()) {
							echo $before_link . '<a href="' . $url_year . '" title="' . esc_html__('Yearly Archives', 'mh-magazine') . '" itemprop="url">' . $before_title . $arc_year . $close_span . '</a>' . $close_span . $delimiter;
							echo $before_link . '<a href="' . $url_month . '" title="' . esc_html__('Monthly Archives', 'mh-magazine') . '" itemprop="url">' . $before_title . $arc_month . $close_span . '</a>' . $close_span . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
						} elseif (is_month()) {
							echo $before_link . '<a href="' . $url_year . '" title="' . esc_html__('Yearly Archives', 'mh-magazine') . '" itemprop="url">' . $before_title . $arc_year . $close_span . '</a>' . $close_span . $delimiter . $arc_month;
						} elseif (is_year()) {
							echo $arc_year;
						}
					} elseif (is_single() && get_post_type() != 'post' || is_post_type_archive(get_post_type())) {
						$post_type_data = get_post_type_object(get_post_type());
						$post_type_name = $post_type_data->labels->name;
						if (is_single() && get_post_type() != 'post') {
							$post_type_slug = $post_type_data->rewrite['slug'];
							$permalinks = get_option('permalink_structure');
							if ($permalinks == '') {
								echo $before_link . '<a href="' . esc_url(home_url()) . '?post_type=' . $post_type_slug . get_post_type() .'" itemprop="url">' . $before_title . esc_attr($post_type_name) . $close_span . '</a>' . $close_span . $delimiter;
							} else {
								echo $before_link . '<a href="' . esc_url(home_url()) . '/' . $post_type_slug . '/" itemprop="url">' . $before_title . esc_attr($post_type_name) . $close_span . '</a>' . $close_span . $delimiter;
							}
							the_title();
						} elseif (is_post_type_archive(get_post_type())) {
							echo esc_attr($post_type_name);
						}
					}
				echo '</nav>' . "\n";
			}
		}
	}
}
add_action('mh_before_post_content', 'mh_magazine_breadcrumb');
add_action('mh_before_page_content', 'mh_magazine_breadcrumb');

?>