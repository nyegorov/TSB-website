<?php
/*
 * Template name: Impressum
 */
get_header(); ?>

	<script>
		jQuery('body').css('background-color', '#FF9F2C');
		document.getElementById('tsb').style.display = 'none';
		jQuery(window).load(function() {
			jQuery('h1').css('color', '#000000');
			jQuery('h1').css('padding-bottom', '5px');
			jQuery('#menu_icon').attr("src", "<?php echo get_stylesheet_directory_uri();?>/icons/menu_black.svg");
			jQuery('.site-content').css('padding-top', '80px'); 
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
