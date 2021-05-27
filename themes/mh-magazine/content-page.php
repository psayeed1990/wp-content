<?php /* Default template for displaying page content */ ?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title('<h1 class="entry-title page-title">', '</h1>'); ?>
	</header>
	<?php dynamic_sidebar('mh-pages-1'); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
	<?php dynamic_sidebar('mh-pages-2'); ?>
</article>