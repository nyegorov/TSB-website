<?php
/*
 * Template name: Case Studies
 */
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
 
        <?php // Display blog posts on any page @ http://m0n.co/l
		$done = false;
        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query('category=project');
		#get_posts( array('orderby' => 'date', 'order' => 'ASC', 'category' => 'project'));
		?>

		<article class="page type-page status-publish hentry"><div class="entry-content">
		<table class="gallery"> 
		<?php for($r=0; $r<5 && !$done; $r++)	{?>
			<tr class="gallery-columns-3">
			<?php for($c=0; $c<3 && !$done; $c++) { if(have_posts()) { the_post(); ?>
				<td class="gallery-item">
					<figure><a href="<?php echo esc_url( the_permalink()); ?>">
					<?php echo get_the_post_thumbnail( null, array(300, 200), array( 'class' => 'gallery-icon') ); ?></a></figure>
				</td>
			<?php } else { $done = true;} } ?>
			</tr>
		<?php } ?>
		</table></div></article>
 
        <?php wp_reset_postdata(); ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>