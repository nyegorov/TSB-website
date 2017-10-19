<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<table><tr>
			<td></td>
			<td><?php echo get_custom('company_name');?></td>
			<td><?php echo get_custom('company_address');?></td>
			<td><?php echo get_custom('company_tel');?><br><?php echo get_custom('company_email');?></td>
			</tr></table>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
