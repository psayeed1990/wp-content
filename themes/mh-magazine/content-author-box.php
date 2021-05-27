<?php /* Template for displaying author box content */
if (!is_page_template('template-authors.php')) {
	$mh_author_box_ID = get_the_author_meta('ID');
} else {
	global $mh_author_box_ID;
}
$mh_magazine_options = mh_magazine_theme_options();
$username = get_the_author_meta('display_name', $mh_author_box_ID);
$userposts = count_user_posts($mh_author_box_ID);
$website = get_the_author_meta('user_url', $mh_author_box_ID);
$facebook = get_the_author_meta('facebook', $mh_author_box_ID);
$instagram = get_the_author_meta('instagram', $mh_author_box_ID);
$twitter = get_the_author_meta('twitter', $mh_author_box_ID);
$googleplus = get_the_author_meta('googleplus', $mh_author_box_ID);
$youtube = get_the_author_meta('youtube', $mh_author_box_ID);
$linkedin = get_the_author_meta('linkedin', $mh_author_box_ID);
$xing = get_the_author_meta('xing', $mh_author_box_ID); ?>
<div class="mh-author-box clearfix">
	<figure class="mh-author-box-avatar">
		<?php echo get_avatar($mh_author_box_ID, 125); ?>
	</figure>
	<div class="mh-author-box-header">
		<span class="mh-author-box-name">
			<?php printf(esc_html__('About %s', 'mh-magazine'), $username); ?>
		</span>
		<?php if (!is_author()) { ?>
			<span class="mh-author-box-postcount">
				<a href="<?php echo esc_url(get_author_posts_url($mh_author_box_ID)); ?>" title="<?php printf(esc_html__('More articles written by %s', 'mh-magazine'), $username); ?>'">
					<?php esc_html(printf(_n('%s Article', '%s Articles', $userposts, 'mh-magazine'), $userposts)); ?>
				</a>
			</span>
		<?php } ?>
	</div>
	<?php if (get_the_author_meta('description', $mh_author_box_ID)) { ?>
		<div class="mh-author-box-bio">
			<?php echo wp_kses_post(get_the_author_meta('description', $mh_author_box_ID)); ?>
		</div>
	<?php } else { ?>
		<div class="mh-author-box-bio">
			<?php esc_html_e('The author has not yet added any personal or biographical info to his author profile.', 'mh-magazine'); ?>
		</div>
	<?php }
	if ($mh_magazine_options['author_contact'] === 'enable') {
		if ($website || $facebook || $instagram || $twitter || $googleplus || $youtube || $linkedin || $xing) { ?>
			<div class="mh-author-box-contact">
				<?php if ($website) { ?>
					<a class="mh-author-box-website" href="<?php echo esc_url($website); ?>" title="<?php printf(esc_html__('Visit the website of %s', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-globe"></i>
						<span class="screen-reader-text"><?php esc_html_e('Website', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($facebook) { ?>
					<a class="mh-author-box-facebook" href="<?php echo esc_url($facebook); ?>" title="<?php printf(esc_html__('Follow %s on Facebook', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-facebook"></i>
						<span class="screen-reader-text"><?php esc_html_e('Facebook', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($instagram) { ?>
					<a class="mh-author-box-instagram" href="<?php echo esc_url($instagram); ?>" title="<?php printf(esc_html__('Follow %s on Instagram', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-instagram"></i>
						<span class="screen-reader-text"><?php esc_html_e('Instagram', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($twitter) { ?>
					<a class="mh-author-box-twitter" href="<?php echo esc_url($twitter); ?>" title="<?php printf(esc_html__('Follow %s on Twitter', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-twitter"></i>
						<span class="screen-reader-text"><?php esc_html_e('Twitter', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($googleplus) { ?>
					<a class="mh-author-box-google" href="<?php echo esc_url($googleplus); ?>" title="<?php printf(esc_html__('Follow %s on Google+', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-google-plus"></i>
						<span class="screen-reader-text"><?php esc_html_e('Google+', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($youtube) { ?>
					<a class="mh-author-box-youtube" href="<?php echo esc_url($youtube); ?>" title="<?php printf(esc_html__('Follow %s on YouTube', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-youtube-play"></i>
						<span class="screen-reader-text"><?php esc_html_e('YouTube', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($linkedin) { ?>
					<a class="mh-author-box-linkedin" href="<?php echo esc_url($linkedin); ?>" title="<?php printf(esc_html__('Follow %s on LinkedIn', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-linkedin"></i>
						<span class="screen-reader-text"><?php esc_html_e('LinkedIn', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
				<?php if ($xing) { ?>
					<a class="mh-author-box-xing" href="<?php echo esc_url($xing); ?>" title="<?php printf(esc_html__('Follow %s on Xing', 'mh-magazine'), $username); ?>" target="_blank">
						<i class="fa fa-xing"></i>
						<span class="screen-reader-text"><?php esc_html_e('Xing', 'mh-magazine'); ?></span>
					</a>
				<?php } ?>
			</div><?php
		}
	} ?>
</div>