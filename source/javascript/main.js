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
            contact.received    = false;
            contact.form        = document.getElementsByTagName( 'form' );
            contact.url         = contact.form[0].action + '?action=contact';
            contact.response    = '';

            contact.submit      = function ( e ) {
                e.preventDefault();
                e.stopPropagation();

                $.ajax( contact.url, {
                    converters: {
                            "* text": window.String,
                            "text html": true,
                            "text json": jQuery.parseJSON,
                            "text xml": jQuery.parseXML
                    },
                    data: {
                        firstName:  contact.firstName,
                        lastName:   contact.lastName,
                        email:      contact.email,
                        city:       contact.city,
                        message:    contact.message
                    },
                    type: 'POST',
                    dataType: 'json'
                } ).done( function ( responseText ) {
                    contact.response = responseText.message;
                    contact.received = true;
                } ).fail( function ( ) {
                    contact.response = 'Hubo un error. Por favor, intenta de nuevo.';
                    contact.received = true;
                } );
            };
        } );
    } )();

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
                e.preventDefault();
                e.stopPropagation();
                _height = $( window ).innerHeight() + 'px';
                $( '.gallery' ).height( _height );
            } );
        }
    } );

} ) ( jQuery, window, document );