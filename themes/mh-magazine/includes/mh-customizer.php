<?php

function mh_magazine_customizer($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Magazine_Support extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="mh-magazine-thumb">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/mh_magazine.png" alt="MH Magazine" />
        	</p>
        	<p class="mh-button">
				<a href="https://www.mhthemes.com/support/documentation-mh-magazine/" target="_blank" class="button button-primary">
					<?php esc_html_e('Theme Documentation', 'mh-magazine'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/support/documentation-mh-magazine/#demo-content" target="_blank" class="button button-secondary">
					<?php esc_html_e('Replicate Theme Demos', 'mh-magazine'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/support/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Support Center', 'mh-magazine'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/support/installation-service/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Installation Service', 'mh-magazine'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/themes/showcase/" target="_blank" class="button button-secondary">
					<?php esc_html_e('MH Themes Showcase', 'mh-magazine'); ?>
				</a>
			</p><?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_magazine_theme_options', array('title' => esc_html__('Theme Options', 'mh-magazine'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_magazine_general', array('title' => esc_html__('General', 'mh-magazine'), 'priority' => 1, 'panel' => 'mh_magazine_theme_options'));
	$wp_customize->add_section('mh_magazine_layout_general', array('title' => esc_html__('Layout - General', 'mh-magazine'), 'priority' => 2, 'panel' => 'mh_magazine_theme_options'));
	$wp_customize->add_section('mh_magazine_layout_header', array('title' => esc_html__('Layout - Header', 'mh-magazine'), 'priority' => 3, 'panel' => 'mh_magazine_theme_options'));
	$wp_customize->add_section('mh_magazine_layout_content', array('title' => esc_html__('Layout - Posts/Pages', 'mh-magazine'), 'priority' => 4, 'panel' => 'mh_magazine_theme_options'));
	$wp_customize->add_section('mh_magazine_layout_meta', array('title' => esc_html__('Layout - Post Meta', 'mh-magazine'), 'priority' => 5, 'panel' => 'mh_magazine_theme_options'));
	$wp_customize->add_section('mh_magazine_ads', array('title' => esc_html__('Advertising', 'mh-magazine'), 'priority' => 7, 'panel' => 'mh_magazine_theme_options'));
    $wp_customize->add_section('mh_magazine_tracking', array('title' => esc_html__('Tracking Code', 'mh-magazine'), 'priority' => 9, 'panel' => 'mh_magazine_theme_options'));
    $wp_customize->add_section('mh_magazine_support', array('title' => esc_html__('Theme Support', 'mh-magazine'), 'priority' => 10, 'panel' => 'mh_magazine_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_magazine_options[excerpt_length]', array('default' => 35, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_magazine_options[excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_magazine_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));

	$wp_customize->add_setting('mh_magazine_options[site_layout]', array('default' => 'boxed', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[sidebars]', array('default' => 'one', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[sb_position]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[loop_layout]', array('default' => 'layout1', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[widget_layout]', array('default' => 'layout1', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[back_to_top]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));

	$wp_customize->add_setting('mh_magazine_options[header_transparent]', array('default' => 'disable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[header_top_left]', array('default' => 'navigation', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[header_top_right]', array('default' => 'social', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[header_bottom_left]', array('default' => 'ticker', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[header_bottom_right]', array('default' => 'search', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[ticker_title]', array('default' => esc_html__('News Ticker', 'mh-magazine'), 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_magazine_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_magazine_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_magazine_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_magazine_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_magazine_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));

    $wp_customize->add_setting('mh_magazine_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[link_featured_image]', array('default' => 'disable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[social_buttons]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[tags]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[author_contact]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_magazine_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));

	$wp_customize->add_setting('mh_magazine_options[post_meta_date]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[post_meta_author]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[post_meta_cat]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[post_meta_cat_loop]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_magazine_options[post_meta_comments]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));

	$wp_customize->add_setting('mh_magazine_options[content_ad]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));
	$wp_customize->add_setting('mh_magazine_options[loop_ad]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));
	$wp_customize->add_setting('mh_magazine_options[loop_ad_no]', array('default' => 3, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));

    $wp_customize->add_setting('mh_magazine_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));
    $wp_customize->add_setting('mh_magazine_options[support]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-magazine'), 'section' => 'mh_magazine_general', 'settings' => 'mh_magazine_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-magazine'), 'section' => 'mh_magazine_general', 'settings' => 'mh_magazine_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-magazine'), 'section' => 'mh_magazine_general', 'settings' => 'mh_magazine_options[copyright]', 'priority' => 3, 'type' => 'text'));

    $wp_customize->add_control('site_layout', array('label' => esc_html__('Site Layout', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[site_layout]', 'priority' => 1, 'type' => 'select', 'choices' => array('boxed' => esc_html__('Boxed', 'mh-magazine'), 'wide' => esc_html__('Wide', 'mh-magazine'))));
	$wp_customize->add_control('sidebars', array('label' => esc_html__('Number of Sidebars', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[sidebars]', 'priority' => 2, 'type' => 'select', 'choices' => array('one' => esc_html__('One Sidebar', 'mh-magazine'), 'two' => esc_html__('Two Sidebars', 'mh-magazine'), 'disable' => esc_html__('No Sidebars', 'mh-magazine'))));
    $wp_customize->add_control('sb_position', array('label' => esc_html__('Position of default Sidebar', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[sb_position]', 'priority' => 3, 'type' => 'select', 'choices' => array('left' => esc_html__('Left', 'mh-magazine'), 'right' => esc_html__('Right', 'mh-magazine'))));
	$wp_customize->add_control('loop_layout', array('label' => esc_html__('Archives', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[loop_layout]', 'priority' => 4, 'type' => 'select', 'choices' => array('layout1' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 1), 'layout2' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 2), 'layout3' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 3), 'layout4' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 4), 'layout5' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 5))));
    $wp_customize->add_control('widget_layout', array('label' => esc_html__('Widget Titles', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[widget_layout]', 'priority' => 5, 'type' => 'select', 'choices' => array('layout1' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 1), 'layout2' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 2), 'layout3' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 3), 'layout4' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 4), 'layout5' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 5), 'layout6' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 6), 'layout7' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 7), 'layout8' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 8))));
	$wp_customize->add_control('back_to_top', array('label' => esc_html__('Back to Top Button', 'mh-magazine'), 'section' => 'mh_magazine_layout_general', 'settings' => 'mh_magazine_options[back_to_top]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));

    $wp_customize->add_control('header_transparent', array('label' => esc_html__('Transparent Header', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[header_transparent]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('header_top_left', array('label' => esc_html__('Header Bar Content (Top - Left)', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[header_top_left]', 'priority' => 2, 'type' => 'select', 'choices' => array('navigation' => esc_html__('Navigation', 'mh-magazine'), 'date' => esc_html__('Date', 'mh-magazine'), 'ticker' => esc_html__('News Ticker', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
	$wp_customize->add_control('header_top_right', array('label' => esc_html__('Header Bar Content (Top - Right)', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[header_top_right]', 'priority' => 3, 'type' => 'select', 'choices' => array('social' => esc_html__('Social Icons', 'mh-magazine'), 'date' => esc_html__('Date', 'mh-magazine'), 'search' => esc_html__('Search', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
	$wp_customize->add_control('header_bottom_left', array('label' => esc_html__('Header Bar Content (Bottom - Left)', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[header_bottom_left]', 'priority' => 4, 'type' => 'select', 'choices' => array('navigation' => esc_html__('Navigation', 'mh-magazine'), 'date' => esc_html__('Date', 'mh-magazine'), 'ticker' => esc_html__('News Ticker', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
	$wp_customize->add_control('header_bottom_right', array('label' => esc_html__('Header Bar Content (Bottom - Right)', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[header_bottom_right]', 'priority' => 5, 'type' => 'select', 'choices' => array('social' => esc_html__('Social Icons', 'mh-magazine'), 'date' => esc_html__('Date', 'mh-magazine'), 'search' => esc_html__('Search', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_title]', 'priority' => 6, 'type' => 'text'));
    $wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_posts]', 'priority' => 7, 'type' => 'text'));
    $wp_customize->add_control('ticker_cats', array('label'=> esc_html__('Custom Categories (use ID - e.g. 3,5,9):', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_cats]', 'priority' => 8, 'type' => 'text'));
    $wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_tags]', 'priority' => 9, 'type' => 'text'));
    $wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_offset]', 'priority' => 10, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'mh-magazine'), 'section' => 'mh_magazine_layout_header', 'settings' => 'mh_magazine_options[ticker_sticky]', 'priority' => 11, 'type' => 'checkbox'));

    $wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[breadcrumbs]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
	$wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[featured_image]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('link_featured_image', array('label' => esc_html__('Link Featured Image to Attachment', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[link_featured_image]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('social_buttons', array('label' => esc_html__('Social Buttons on Posts', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[social_buttons]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Top and bottom', 'mh-magazine'), 'top_social' => esc_html__('Top of posts', 'mh-magazine'), 'bottom_social' => esc_html__('Bottom of posts', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('tags', array('label' => esc_html__('Tags on Posts', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[tags]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[author_box]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('author_contact', array('label' => esc_html__('Author Box Contact', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[author_contact]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('related_content', array('label' => esc_html__('Related Articles', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[related_content]', 'priority' => 8, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-magazine'), 'section' => 'mh_magazine_layout_content', 'settings' => 'mh_magazine_options[post_nav]', 'priority' => 9, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));

	$wp_customize->add_control('post_meta_date', array('label' => esc_html__('Post Meta: Date', 'mh-magazine'), 'section' => 'mh_magazine_layout_meta', 'settings' => 'mh_magazine_options[post_meta_date]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Post Meta: Author', 'mh-magazine'), 'section' => 'mh_magazine_layout_meta', 'settings' => 'mh_magazine_options[post_meta_author]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Post Meta: Categories on Posts', 'mh-magazine'), 'section' => 'mh_magazine_layout_meta', 'settings' => 'mh_magazine_options[post_meta_cat]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('post_meta_cat_loop', array('label' => esc_html__('Post Meta: Categories on Archives', 'mh-magazine'), 'section' => 'mh_magazine_layout_meta', 'settings' => 'mh_magazine_options[post_meta_cat_loop]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));
    $wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Post Meta: Comment Count', 'mh-magazine'), 'section' => 'mh_magazine_layout_meta', 'settings' => 'mh_magazine_options[post_meta_comments]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-magazine'), 'disable' => esc_html__('Disable', 'mh-magazine'))));

	$wp_customize->add_control('content_ad', array('label' => esc_html__('Ad Code for Content Ad on Posts', 'mh-magazine'), 'section' => 'mh_magazine_ads', 'settings' => 'mh_magazine_options[content_ad]', 'priority' => 1, 'type' => 'textarea'));
	$wp_customize->add_control('loop_ad', array('label' => esc_html__('Ad Code for Ads on Archives', 'mh-magazine'), 'section' => 'mh_magazine_ads', 'settings' => 'mh_magazine_options[loop_ad]', 'priority' => 2, 'type' => 'textarea'));
	$wp_customize->add_control('loop_ad_no', array('label'=> esc_html__('Display Ad every x Posts on Archives (applies to Layout 1, 2 and 3)', 'mh-magazine'), 'section' => 'mh_magazine_ads', 'settings' => 'mh_magazine_options[loop_ad_no]', 'priority' => 3, 'type' => 'text'));

    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mh-magazine'), 'section' => 'mh_magazine_tracking', 'settings' => 'mh_magazine_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));
	$wp_customize->add_control(new MH_Magazine_Support($wp_customize, 'support', array('section' => 'mh_magazine_support', 'settings' => 'mh_magazine_options[support]', 'priority' => 1)));

}
add_action('customize_register', 'mh_magazine_customizer');

/***** Data Sanitization *****/

function mh_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_sanitize_select($input) {
    $valid = array(
        'one' => esc_html__('One Sidebar', 'mh-magazine'),
        'two' => esc_html__('Two Sidebars', 'mh-magazine'),
        'enable' => esc_html__('Enable', 'mh-magazine'),
        'disable' => esc_html__('Disable', 'mh-magazine'),
        'left' => esc_html__('Left', 'mh-magazine'),
        'right' => esc_html__('Right', 'mh-magazine'),
        'boxed' => esc_html__('Boxed', 'mh-magazine'),
        'wide' => esc_html__('Wide', 'mh-magazine'),
        'navigation' => esc_html__('Navigation', 'mh-magazine'),
        'date' => esc_html__('Date', 'mh-magazine'),
        'ticker' => esc_html__('News Ticker', 'mh-magazine'),
    	'social' => esc_html__('Social Icons', 'mh-magazine'),
        'search' => esc_html__('Search', 'mh-magazine'),
        'layout1' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 1),
        'layout2' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 2),
        'layout3' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 3),
        'layout4' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 4),
        'layout5' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 5),
        'layout6' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 6),
        'layout7' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 7),
        'layout8' => sprintf(esc_html_x('Layout %d', 'options panel', 'mh-magazine'), 8),
        'top_social' => esc_html__('Top of Posts', 'mh-magazine'),
        'bottom_social' => esc_html__('Bottom of Posts', 'mh-magazine')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_magazine_theme_options')) {
	function mh_magazine_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_magazine_options', array()),
			mh_magazine_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_magazine_default_options')) {
	function mh_magazine_default_options() {
		$default_options = array(
			'excerpt_length' => 35,
			'excerpt_more' => '[...]',
			'copyright' => '',
			'site_layout' => 'boxed',
			'sidebars' => 'one',
			'sb_position' => 'right',
			'loop_layout' => 'layout1',
			'widget_layout' => 'layout1',
			'back_to_top' => 'enable',
			'header_transparent' => 'disable',
			'header_top_left' => 'navigation',
			'header_top_right' => 'social',
			'header_bottom_left' => 'ticker',
			'header_bottom_right' => 'search',
			'ticker_title' => esc_html__('News Ticker', 'mh-magazine'),
			'ticker_posts' => 5,
			'ticker_cats' => '',
			'ticker_tags' => '',
			'ticker_offset' => '',
			'ticker_sticky' => 0,
			'breadcrumbs' => 'enable',
			'featured_image' => 'enable',
			'link_featured_image' => 'disable',
			'social_buttons' => 'enable',
			'tags' => 'enable',
			'author_box' => 'enable',
			'author_contact' => 'enable',
			'related_content' => 'enable',
			'post_nav' => 'enable',
			'post_meta_date' => 'enable',
			'post_meta_author' => 'enable',
			'post_meta_cat' => 'enable',
			'post_meta_cat_loop' => 'enable',
			'post_meta_comments' => 'enable',
			'content_ad' => '',
			'loop_ad' => '',
			'loop_ad_no' => 3,
			'custom_css' => '',
			'tracking_code' => '',
			'support' => ''
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_magazine_customizer_css() {
	wp_enqueue_style('mh-customizer', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_magazine_customizer_css');

/***** Custom CSS Output *****/

function mh_magazine_custom_css() {
	$mh_magazine_options = mh_magazine_theme_options();
	if ($mh_magazine_options['custom_css']) {
    	echo '<style type="text/css">';
    		echo $mh_magazine_options['custom_css'];
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_magazine_custom_css');

?>