<?php
/*
 * Template name: Impressum
 */
get_header(); ?>

	<script>
		jQuery('body').css('background-color', '#FF9F2C');
		document.getElementById('tsb').style.display = 'none';
		jQuery(window).load(function() {
			jQuery('h1').css('color', '#FFFFFF');
			jQuery('h1').css('padding-bottom', '0');
			jQuery('.site-content').css('padding-top', '250px'); 
		});
	</script>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) :
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
			<div class="entry-content"><?php the_content(); ?></div>
			<?php endwhile;
		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
