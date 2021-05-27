<?php /* Template for share buttons. */
$title = htmlspecialchars(urlencode(html_entity_decode(get_the_title())));
$url = urlencode(get_permalink($post->ID)); ?>
<div class="mh-share-buttons clearfix">
	<a class="mh-facebook" href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $url; ?>&t=<?php echo $title; ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php esc_html_e('Share on Facebook', 'mh-magazine'); ?>">
		<span class="mh-share-button"><i class="fa fa-facebook"></i></span>
	</a>
	<a class="mh-twitter" href="#" onclick="window.open('https://twitter.com/share?text=<?php echo $title; ?>:&url=<?php echo $url; ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php esc_html_e('Tweet This Post', 'mh-magazine'); ?>">
		<span class="mh-share-button"><i class="fa fa-twitter"></i></span>
	</a>
	<a class="mh-linkedin" href="#" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&source=<?php esc_attr(get_bloginfo('name')); ?>', 'linkedinShare', 'width=626,height=436'); return false;" title="<?php esc_html_e('Share on LinkedIn', 'mh-magazine'); ?>">
		<span class="mh-share-button"><i class="fa fa-linkedin"></i></span>
	</a>
	<a class="mh-pinterest" href="#" onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&media=<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-thumb'); echo esc_url($thumb['0']); ?>&description=<?php echo $title; ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php esc_html_e('Pin This Post', 'mh-magazine'); ?>">
		<span class="mh-share-button"><i class="fa fa-pinterest"></i></span>
	</a>
	<a class="mh-googleplus" href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php echo $url; ?>', 'googleShare', 'width=626,height=436'); return false;" title="<?php esc_html_e('Share on Google+', 'mh-magazine'); ?>" target="_blank">
		<span class="mh-share-button"><i class="fa fa-google-plus"></i></span>
	</a>
	<a class="mh-email" href="mailto:?subject=<?php echo htmlspecialchars(rawurlencode(html_entity_decode(get_the_title()))); ?>&amp;body=<?php echo $url; ?>" title="<?php esc_html_e('Send this article to a friend', 'mh-magazine'); ?>" target="_blank">
		<span class="mh-share-button"><i class="fa fa-envelope-o"></i></span>
	</a>
	<a class="mh-print" href="javascript:window.print()" title="<?php esc_html_e('Print this article', 'mh-magazine'); ?>">
		<span class="mh-share-button"><i class="fa fa-print"></i></span>
	</a>
</div>