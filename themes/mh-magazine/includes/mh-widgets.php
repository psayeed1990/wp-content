<?php

/***** Register Widgets *****/

function mh_magazine_register_widgets() {
	register_widget('mh_magazine_facebook_page');
	register_widget('mh_magazine_custom_posts');
	register_widget('mh_magazine_custom_pages');
	register_widget('mh_magazine_posts_grid');
	register_widget('mh_magazine_posts_large');
	register_widget('mh_magazine_posts_list');
	register_widget('mh_magazine_posts_stacked');
	register_widget('mh_magazine_posts_horizontal');
	register_widget('mh_magazine_posts_digest');
	register_widget('mh_magazine_posts_focus');
	register_widget('mh_magazine_posts_lineup');
	register_widget('mh_magazine_nip');
	register_widget('mh_magazine_recent_comments');
	register_widget('mh_magazine_slider');
	register_widget('mh_magazine_custom_slider');
	register_widget('mh_magazine_spotlight');
	register_widget('mh_magazine_carousel');
	register_widget('mh_magazine_authors');
	register_widget('mh_magazine_social');
	register_widget('mh_magazine_author_bio');
	register_widget('mh_magazine_youtube');
	register_widget('mh_magazine_tabbed');
	register_widget('mh_magazine_category_columns');
}
add_action('widgets_init', 'mh_magazine_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-custom-pages.php');
require_once('widgets/mh-posts-grid.php');
require_once('widgets/mh-posts-large.php');
require_once('widgets/mh-posts-list.php');
require_once('widgets/mh-posts-stacked.php');
require_once('widgets/mh-posts-horizontal.php');
require_once('widgets/mh-posts-digest.php');
require_once('widgets/mh-posts-focus.php');
require_once('widgets/mh-posts-lineup.php');
require_once('widgets/mh-nip.php');
require_once('widgets/mh-recent-comments.php');
require_once('widgets/mh-slider.php');
require_once('widgets/mh-custom-slider.php');
require_once('widgets/mh-spotlight.php');
require_once('widgets/mh-carousel.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-social.php');
require_once('widgets/mh-author-bio.php');
require_once('widgets/mh-youtube.php');
require_once('widgets/mh-tabbed.php');
require_once('widgets/mh-category-columns.php');

?>