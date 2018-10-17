/**
 * RDMobile - v0.1.0 - 2018-09-28
 * RDMobile WP Plugin for supporting mobile Phone and WhatsApp button on mobile view website.
 * https://reezhdesign.com
 *
 * Copyright (c) 2018 ReeZh Design
 * Licensed GPLv2+
 */
window.RDM = window.RDM || {};

( function( window, document, $, plugin ) {
	var $c = {};

	plugin.init = function() {
		plugin.cache();
		plugin.bindEvents();
		// plugin.detectFontAwesome();
	};

	plugin.cache = function() {
		$c.window = $( window );
		$c.body = $( document.body );
	};

	plugin.bindEvents = function() {
	};

	plugin.css = function( element, property ) {
		return window.getComputedStyle( element, null ).getPropertyValue( property );
	};

	plugin.detectFontAwesome = function() {
		var span = document.createElement( 'span' ),
			message = document.getElementById( 'rdmobile' );

		span.className = 'fa';
		span.style.display = 'none';
		document.body.insertBefore( span, document.body.firstChild );

		if ( 'FontAwesome' === this.css( span, 'font-family' ) ) {
			message.innerHTML += '<i class="fa fa-arrow-up"></i>';
			message.innerHTML += ' Yay, Font Awesome loaded!';
		} else {
			message.innerHTML += '<i class="fa fa-arrow-down"></i>';
			message.innerHTML += ' Oops, Font Awesome didn\'t load!';
		}
		document.body.removeChild( span );
	};

	$( plugin.init );
}( window, document, jQuery, window.RDM ) );
