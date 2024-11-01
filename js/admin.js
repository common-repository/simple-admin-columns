/*
 * WSNB Admin v1.0
 * WPFlask.com
 *
 * Copyright (c) 2015-2016 WPFlask.com
 *
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 */

( function( $ ) {
	"use strict";

	var wpflaskSimpleAdminColumns = {

		// Tab Init
		tabInit: function() {

			// Location Hash
			var locationHash = '';

			/**
			 * 1. Direct Link or Bookmark
			 * 2. Cookie
			 */
			if ( '' !== window.location.hash ) {
				locationHash = window.location.hash;
			} else if ( 'undefined' !== typeof( Cookies.get( 'wpflask-sac-tab' ) ) ) {
				locationHash = Cookies.get( 'wpflask-sac-tab' );
			}

			// Tab Panel
			if ( '' !== locationHash ) {
				wpflaskSimpleAdminColumns.tabPanel( locationHash );
			}

		},

		// Tab Click
		tabClick: function() {

			// Tab Control
			$( '.nav-tab' ).off( 'click' ).on( 'click', function( e ) {

				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// Location Hash
				var locationHash = $( this ).attr( 'href' );

				// Tab Panel
				wpflaskSimpleAdminColumns.tabPanel( locationHash );

			} );

		},

		// Tab Panel
		tabPanel: function( locationHash  ) {

			// Expected Hash Format: #top#xyz
			var targetHash     = locationHash.split( '#top' );
			var targetTabPanel = targetHash[1];
			var targetTab      = targetTabPanel + '-tab';

			// Hash Validation
			if ( $( targetTabPanel ).length && $( targetTab ).length ) {

				// Tab Logic
				$( '.nav-tab' ).removeClass( 'nav-tab-active' );
				$( targetTab ).addClass( 'nav-tab-active' );

				// Tab Panel Logic
				$( '.nav-tab-section' ).hide();
				$( targetTabPanel ).show();

				// Set Cookie
				Cookies.set( 'wpflask-sac-tab', locationHash );

				// Change Location
				window.location.hash = locationHash;

			}

		}

	};

	// Document Ready
	$( document ).ready( function() {

		// Tab Init
		wpflaskSimpleAdminColumns.tabInit();

		// Tab Click
		wpflaskSimpleAdminColumns.tabClick();

	} );

} )( jQuery );
