<div id="tsb" class="tsb-block">
	<div><span id="tsb1" class="tsb">T<div id="tsb1-txt" class="tsb-txt">&nbsp;homas</div></span><span id="tsb2" class="tsb">S<div id="tsb2-txt" class="tsb-txt">chneider</div></span></div>
	<span id="tsb3" class="tsb">B<div id="tsb3-txt" class="tsb-txt">aumanagement</div></span>
</div>

<?php if(is_front_page()) { ?>
<div id="cover"></div>
<?php } ?>

<script> 
window.onbeforeunload = function () {
//  window.scrollTo(0, 0);
}
window.onload = function () { 
	document.getElementById('tsb').style.visibility = 'visible';
<?php if(is_front_page()) { ?>
	jQuery('#tsb').show();
	init_tsb(["tsb1", "tsb2", "tsb3"], true); 
	jQuery(window).scrollTop(0);
	jQuery('.tsb-txt')
		.delay(1000)
		.animate( {opacity: 0}, 500, 'swing')
		.animate( {width: 0},   500, 'swing', function() {
			jQuery('#cover').animate({ opacity:0}, 500, 'swing', function() {
				jQuery('.tsb-txt').css('opacity', '1');
				jQuery('#cover').css('visibility', 'hidden');
			});
		});	
<?php } else { ?>
	init_tsb(["tsb1", "tsb2", "tsb3"], false); 
<?php } ?>
} 
</script>
