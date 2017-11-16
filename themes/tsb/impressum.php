<?php
/*
 * Template name: Impressum
 */
get_header(); ?>

	<script>
		jQuery('body').css('background-color', '#FF9F2C');
		document.getElementById('tsb').style.display = 'none';
		jQuery(window).load(function() {
			jQuery('#menu_icon').attr("src", "<?php echo get_stylesheet_directory_uri();?>/icons/menu_black.svg");
		});
	</script>

	<div id="primary" class="content-area impressum">
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
