<?php
/*
 * Template name: Aktuelles
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

        <?php

		$done = false;
        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query('category=project');?>

		<?php while( $wp_query->have_posts()) : $wp_query->the_post(); ?>
			<article class="page type-page status-publish hentry"><div class="entry-content">
			<a name="post<?php echo the_ID(); ?>"/>
			<?php 
				twentyfifteen_post_thumbnail();
				the_date('d. F Y', '<b>', '</b>');
				the_title('<h1>', '</h1>');
				the_content();
				if(has_tag()) the_tags('<div class="post-status">Status: ', ', ', '</div>');?>
			</div></article>
		<?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
