<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage TSB
 * @since TSB 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
<div></div><div><?php echo get_custom('company_name');?></div><div style="width:1px;padding:0"></div><div><?php echo get_custom('company_address');?></div><div><?php echo get_custom('company_tel');?><br><?php echo get_custom('company_email');?></div>
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

<?php if(is_admin_bar_showing()) { ?>
<script> jQuery(window).load(function() { jQuery('html').css('height', 'calc(100% - 32px)');	}); </script>
<?php } ?>

<div class="gdpr">
	<table cellspacing="20">
<?php if(!wp_is_mobile()) { ?>
	<tr>
	<td>Cookies helfen uns bei der Bereitstellung unserer Website. Durch die Nutzung der Website erklären Sie sich damit einverstanden, dass wir Cookies setzen.</td>
	<td width="40"><a href="kontakt/datenschutz">Datenschutzerklärung</a></td>
	<td width="40"><div class="gdpr-ok" onclick="gdpr_confirm()">OK</div></td>
	</tr>
<?php } else {?>
	<tr>
		<td colspan="2">Cookies helfen uns bei der Bereitstellung unserer Website. Durch die Nutzung der Website erklären Sie sich damit einverstanden, dass wir Cookies setzen.</td>
	</tr>
	<tr>
		<td width="40"><a href="kontakt/datenschutz">Datenschutzerklärung</a></td>
		<td width="40" align="right" style="text-align: right"><div class="gdpr-ok" onclick="gdpr_confirm()">OK</div></td>
	</tr>
<?php }?>
	</table>
</div>

</body>
</html>
