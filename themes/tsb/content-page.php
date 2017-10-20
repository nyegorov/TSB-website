<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage TSB
 * @since TSB 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail(); ?>
	<div class="entry-content"><?php the_content(); ?></div>
</article><!-- #post-## -->
