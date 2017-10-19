<?php
/*
 * Template name: Aktuelles
 */
?>

<? get_header(); ?>

<script>
var lastId, topMenu, topMenuHeight, menuItems, scrollItems;

var onScroll = function(){
   // Get container scroll position
   var fromTop = jQuery(this).scrollTop()+300;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if (jQuery(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[0];
   var id = cur && cur.length ? cur[0].id : scrollItems[scrollItems.length-1][0].id;
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("current-menu-item")
         .end().filter("[href='#"+id+"']").parent().addClass("current-menu-item");
   };
}

// Cache selectors
jQuery(window).load(function() {
    topMenu = jQuery("#calendar-menu"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a");
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
		var item = jQuery(jQuery(this).attr("href"));
		if (item.length) { return item; }
    });
	onScroll();
});

// Bind to scroll
jQuery(window).scroll(onScroll);
	
</script>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php

	$done = false;
    $temp = $wp_query; $wp_query= null;
    $wp_query = new WP_Query(); $wp_query->query(array('category_name' => 'actual'));?>

	<?php while( $wp_query->have_posts()) : $wp_query->the_post(); ?>
		<article class="page type-page status-publish hentry"><div class="entry-content">
		<a id="post<?php the_ID();?>"></a>
		<?php 
			the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
			the_date('d. F Y', '<br><br><br><h1>', '</h1>');
			the_title('<h3>', '</h3>');
			echo '<hr>';
			the_content();
			$tags = get_the_tags();
			if(!empty($tags))	echo '<div class="post-status">Status: ' . $tags[0]->name . '</div>'; ?>
		</div></article>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
