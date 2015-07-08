//  @codekit-prepend "plugins.js";
//  @codekit-prepend "scripts.js";
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
        var app = angular.module( 'Bojanini', [] );

        app.controller( 'ContactController', function() {
            this.
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

        if ( $( 'form' ).exists() ) {
            if ( true ) {

            }
        }
    } );

} ) ( jQuery, window, document );