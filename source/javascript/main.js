//  @codekit-prepend "plugins.js";
/**
 *
 *  @function
 *  @description:   Anonimous function autoexecutable
 *  @params jQuery $.- An jQuery object instance
 *  @params window window.- A Window object Instance
 *  @author: @_Chucho_
 *
 */
( function ( $, window, document, undefined ) {
    //  Revisa la disponibilidad de localStorage
    var storage;
    if( 'localStorage' in window && window.localStorage !== null ) {
        storage = localStorage;
    } else {
        try {
            if ( localStorage.getItem ) {
                storage = localStorage;
            }
        } catch( e ) {
            storage = {};
        }
    }

    //  When DOM is loaded
    // $( function ( ) {

    // } );

    ( function () {
        var app = angular.module( 'BojaApp', [] );

        app.controller( 'ContactController', function() {
            var contact = this;
            contact.firstName   = '';
            contact.lastName    = '';
            contact.email       = '';
            contact.city        = '';
            contact.valid       = false;

            contact.validateFirstName = function ( value ) {
                console.log( contact.firstName );
            };

            contact.validateLastName = function ( value ) {

            };

            contact.validateEmail = function ( value ) {

            };

            contact.validateCity = function ( value ) {

            };
        } );
    } )()

    //  When page is finished loaded
    $( document ).ready( function () {
        if ( $( '.flexisel' ).exists() ) {
            $( ".flexisel" ).flexisel( {
                visibleItems: 1,
                animationSpeed: 100,
                autoPlay: true,
                autoPlaySpeed: 6000,
                pauseOnHover: false,
                clone: true,
                enableResponsiveBreakpoints: false
            } );
        }

        if ( $( '.nbs-flexisel-container' ).exists() ) {
            $( '.nbs-flexisel-container' ).addClass( 'clearfix'  );
        }

        if ( $( '.gallery' ).exists() ) {
            var _height = $( window ).innerHeight() + 'px';
            $( 'window' ).on( 'resize', function ( e ) {
                _height = $( window ).innerHeight() + 'px';position()
                $( '.gallery' ).height( _height );
            } );
        }
    } );

} ) ( jQuery, window, document );