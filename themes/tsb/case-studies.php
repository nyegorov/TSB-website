<?php
/*
 * Template name: Case Studies
 */
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
 
        <?php // Display blog posts on any page @ http://m0n.co/l
        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query('showposts=50');?>

		<table> 
		<?php for($r = 0; $r<5 && $wp_query->have_posts(); $r++)	{?>
			<tr>
			<?php for($c = 0; $c < 3 && $wp_query->have_posts(); $c++) { $wp_query->the_post(); ?>
				<td>
				<?php 
				$attachments = get_posts( array(
    	        	'post_type' => 'attachment',
	    	        'posts_per_page' => -1,
    	    	    'post_parent' => $post->ID,
	            	'exclude'     => get_post_thumbnail_id()
	    		) );
    			if ( $attachments ) echo wp_get_attachment_image( $attachments[0]->ID, array(120,80));
				?>	
				</td>
			<?php } ?>
			</tr>
		<?php } ?>
		</table>
 
        <?php wp_reset_postdata(); ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>