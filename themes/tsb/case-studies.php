<?php
/*
 * Template name: Case Studies
 */
?>
<?php get_header(); ?>
<script>
jQuery(window).load(function() {
    topMenu = jQuery("#case-menu"),
    gallery = jQuery("#case-gallery"),
    // All list items
    menuItems    = topMenu.find("a");
    galleryItems = gallery.find("img");
    // Anchors corresponding to menu items
	menuItems.mouseenter(function() { 
		//jQuery(this).parent().addClass("current-menu-item");
		jQuery('#gal'+this.id.substr(4)).css('opacity', '1');
	});
	menuItems.mouseleave(function() { 
		//jQuery(this).parent().removeClass("current-menu-item");
		jQuery('#gal'+this.id.substr(4)).css('opacity', '');
	});

    // Images corresponding to gallery items
	galleryItems.mouseenter(function() { jQuery('#post'+this.id.substr(3)).parent().addClass("current-menu-item");});
	galleryItems.mouseleave(function() { jQuery('#post'+this.id.substr(3)).parent().removeClass("current-menu-item");});
});

</script>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
 
	<?php 
	$done = false;
	$columns = intval(get_custom('case_study_columns'));
    $temp = $wp_query; $wp_query= null;
    $wp_query = new WP_Query(); $wp_query->query(array('category_name' => 'case-study'));
	?>

	<article class="page type-page status-publish hentry"><div class="entry-content">
	<div id="case-gallery" class="gallery gallery-columns-<?php echo $columns;?>"><?php 
	if($wp_query->have_posts()) { 
		while($wp_query->have_posts() )	{ 
			$wp_query->the_post();
			echo '<figure class="gallery-item"><div class="gallery-icon landscape"><a href="'; the_permalink(); echo '">';
			echo get_the_post_thumbnail( null, 'large', array( 'class' => 'gallery-icon', 'id' => 'gal'.get_the_ID()) );
			echo '</a></div></figure>';
		} 
	}?></div></div></article>

	<?php wp_reset_postdata(); ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>