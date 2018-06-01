/* global screenReaderText */

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value) {
  value = encodeURIComponent(value);
  document.cookie = name + "=" + value;
}

/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var $body, $window, $sidebar, adminbarOffset, top = false,
	    bottom = false, windowWidth, windowHeight, lastWindowPos = 0,
	    topOffset = 0, bodyHeight, sidebarHeight, resizeTimer,
	    secondary, button;

	function initMainNavigation( container ) {
		// Add dropdown toggle that display child menu items.
		container.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggle-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this );
			e.preventDefault();

			if(_this.hasClass('toggle-on'))
				// click on opened menu
				_this.next('.sub-menu').slideToggle(250, function() {
					_this.toggleClass( 'toggle-on' );
					_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
					_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				});
			else	{
				// click on closed menu
				_this.siblings('.toggled-on').slideUp(250);
				_this.next('.sub-menu').slideToggle(250, function() {
					_this.siblings().removeClass('toggle-on');
					_this.siblings().removeClass('toggled-on');
					_this.toggleClass( 'toggle-on' );
					_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
					_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				});
			}
		} );
	}
	initMainNavigation( $( '.main-navigation' ) );

	// Re-initialize the main navigation when it is updated, persisting any existing submenu expanded states.
	$( document ).on( 'customize-preview-menu-refreshed', function( e, params ) {
		if ( 'primary' === params.wpNavMenuArgs.theme_location ) {
			initMainNavigation( params.newContainer );

			// Re-sync expanded states from oldContainer.
			params.oldContainer.find( '.dropdown-toggle.toggle-on' ).each(function() {
				var containerId = $( this ).parent().prop( 'id' );
				$( params.newContainer ).find( '#' + containerId + ' > .dropdown-toggle' ).triggerHandler( 'click' );
			});
		}
	});

	secondary = $( '#secondary' );
	button = $( '.site-branding' ).find( '.secondary-toggle' );

	// Enable menu toggle for small screens.
	( function() {
		var menu, widgets, social;
		if ( ! secondary.length || ! button.length ) {
			return;
		}

		// Hide button if there are no widgets and the menus are missing or empty.
		menu    = secondary.find( '.nav-menu' );
		widgets = secondary.find( '#widget-area' );
		social  = secondary.find( '#social-navigation' );
		if ( ! widgets.length && ! social.length && ( ! menu.length || ! menu.children().length ) ) {
			button.hide();
			return;
		}

		button.on( 'click.tsb', function() {
			secondary.toggleClass( 'toggled-on' );
			secondary.trigger( 'resize' );
			$( this ).toggleClass( 'toggled-on' );
			if ( $( this, secondary ).hasClass( 'toggled-on' ) ) {
				$( this ).attr( 'aria-expanded', 'true' );
				secondary.attr( 'aria-expanded', 'true' );
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
				secondary.attr( 'aria-expanded', 'false' );
			}
		} );
	} )();

	/**
	 * @summary Add or remove ARIA attributes.
	 * Uses jQuery's width() function to determine the size of the window and add
	 * the default ARIA attributes for the menu toggle if it's visible.
	 * @since TSB 1.1
	 */
	function onResizeARIA() {
		if ( 955 > $window.width() ) {
			button.attr( 'aria-expanded', 'false' );
			secondary.attr( 'aria-expanded', 'false' );
			button.attr( 'aria-controls', 'secondary' );
		} else {
			button.removeAttr( 'aria-expanded' );
			secondary.removeAttr( 'aria-expanded' );
			button.removeAttr( 'aria-controls' );
		}
	}

	// Sidebar scrolling.
	function resize() {
		windowWidth = $window.width();

		if ( 955 > windowWidth ) {
			top = bottom = false;
			$sidebar.removeAttr( 'style' );
		}
	}

	function scroll() {
		var windowPos = $window.scrollTop();

		if ( 955 > windowWidth ) {
			return;
		}

		sidebarHeight = $sidebar.height();
		windowHeight  = $window.height();
		bodyHeight    = $body.height();

		if ( sidebarHeight + adminbarOffset > windowHeight ) {
			if ( windowPos > lastWindowPos ) {
				if ( top ) {
					top = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! bottom && windowPos + windowHeight > sidebarHeight + $sidebar.offset().top && sidebarHeight + adminbarOffset < bodyHeight ) {
					bottom = true;
					$sidebar.attr( 'style', 'position: fixed; bottom: 0;' );
				}
			} else if ( windowPos < lastWindowPos ) {
				if ( bottom ) {
					bottom = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! top && windowPos + adminbarOffset < $sidebar.offset().top ) {
					top = true;
					$sidebar.attr( 'style', 'position: fixed;' );
				}
			} else {
				top = bottom = false;
				topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
				$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
			}
		} else if ( ! top ) {
			top = true;
			$sidebar.attr( 'style', 'position: fixed;' );
		}

		lastWindowPos = windowPos;
	}

	function resizeAndScroll() {
		resize();
		scroll();
	}

	$( document ).ready( function() {
		$body          = $( document.body );
		$window        = $( window );
		$sidebar       = $( '#sidebar' ).first();
		adminbarOffset = $body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

		$window
			.on( 'scroll.tsb', scroll )
			.on( 'load.tsb', onResizeARIA )
			.on( 'resize.tsb', function() {
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( resizeAndScroll, 500 );
				onResizeARIA();
			} );
		$sidebar.on( 'click.tsb keydown.tsb', 'button', resizeAndScroll );

		resizeAndScroll();

		for ( var i = 1; i < 6; i++ ) {
			setTimeout( resizeAndScroll, 100 * i );
		}
	} );

} )( jQuery );

function on_tsb_scroll()	{
	jQuery('#tsb').css("opacity", Math.max(0, 200 - jQuery(document).scrollTop()) / 200);
};

function init_tsb(ids, dont_close)	{
	var tsb = {	blocks: [] };
	var widen = function(b, state, force)	 { 
		if(state)	{
			b.text.animate( {width: b.width}, 200, 'swing', function() { 
				jQuery.each(tsb.blocks, function(i, o) {if(b.id != o.id)	widen(o, false); });
			});
		}	else {
			b.text.stop(); 
			if(force)	b.text.css('width', '0');	else b.text.animate( {width: 0}, 200, 'swing');
		}
	};

	jQuery.each(ids, function(i, id) { 
		var o_block = jQuery('#'+id);
		var o_text  = jQuery('#'+id+'-txt');
		tsb.blocks[i] = {
			id:    id,
			text:  o_text,
			block: o_block,
			width: o_text.innerWidth(),
		}
		if(!dont_close) widen(tsb.blocks[i], false, true);
		o_block.mouseenter(function() {
			id = this.id;
			jQuery.each(tsb.blocks, function(i, o) { widen(o, o.id == id, false);});
		});
		o_block.mouseleave(function() {
			id = this.id;
			jQuery.each(tsb.blocks, function(i, o) { if(o.id == id) widen(o, false, false) });
		});	
	});

	jQuery(window).scroll(on_tsb_scroll);
	on_tsb_scroll();
}

function showmenu(show)	{
	var sidebar = jQuery('.sidebar');
	var menu    = jQuery('.secondary');
	var body    = jQuery('body');
	if(show)	{
		body.addClass('stop-scrolling');
		sidebar.css('width',  '100%');
		sidebar.css('height', '100%');
	}	else	{
		body.removeClass('stop-scrolling');
		sidebar.css('width',  '0');
		sidebar.css('height', '0');
	}
	menu.css('visibility', show ? 'visible' : 'hidden');
}

function gdpr_confirm() { setCookie("gdpr_ok", "1"); jQuery(".gdpr").hide();	}

window.addEventListener("load", function() { if(getCookie("gdpr_ok") != "1") jQuery(".gdpr").show(); });
