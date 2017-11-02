<div id="tsb" class="tsb-block">
<?php if(wp_is_mobile()) { ?>
	<!--<div><span id="tsb1" class="tsb">T</span><span id="tsb2" class="tsb">S</span></div>
	<span id="tsb3" class="tsb">B</span>-->
	TS<br>B
<?php } else { ?>
	<div><span id="tsb1" class="tsb">T<div id="tsb1-txt" class="tsb-txt">&nbsp;homas</div></span><span id="tsb2" class="tsb">S<div id="tsb2-txt" class="tsb-txt">chneider</div></span></div>
	<span id="tsb3" class="tsb">B<div id="tsb3-txt" class="tsb-txt">aumanagement</div></span>
<?php } ?>
</div>


<?php if(is_front_page() && !wp_is_mobile()) { ?>
<div id="cover"></div>
<?php } ?>

<script> 
window.onload = function () { 
	document.getElementById('tsb').style.visibility = 'visible';
<?php if(is_front_page() && !wp_is_mobile()) { ?>
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
