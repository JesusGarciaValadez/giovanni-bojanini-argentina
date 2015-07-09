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
            var _length;

            contact.validateFirstName = function ( ) {
                _length = contact.firstName.length;
                contact.valid = !contact._validateMinLength( _length, 2 );
                contact.valid = !contact._validateMaxLength( _length, 140 );
                return contact.valid;
            };

            contact.validateLastName = function ( ) {
                _length = contact.lastName.length;
                contact.valid = !contact._validateMinLength( _length, 2 );
                contact.valid = !contact._validateMaxLength( _length, 140 );
                contact.valid = !contact._validateMail( contact.lastName );
                return contact.valid;
            };

            contact.validateEmail = function ( ) {
                _length = contact.email.length;
                contact.valid = !contact._validateMinLength( _length, 2 );
                contact.valid = !contact._validateMaxLength( _length, 140 );
                return contact.valid;
            };

            contact.validateCity = function ( ) {
                _length = contact.city.length;
                contact.valid = !contact._validateMinLength( _length, 2 );
                contact.valid = !contact._validateMaxLength( _length, 140 );
                return contact.valid;
            };

            contact.validateMessage = function () {
                _length = contact.message.length;
                contact.valid = !contact._validateMinLength( _length, 2 );
                contact.valid = !contact._validateMaxLength( _length, 140 );
                return contact.valid;
            }

            contact._validateMail = function(mail) {
                return(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(mail)) ? true : false;
            };
            contact._validateNumber = function(numberToCheck) {
                return /^\d+[^a-zA-Z]+$/.test(parseInt(numberToCheck));
            };
            contact._validateRange = function(rangeTo, rangeFrom, valueToCheck) {
                return(rangeTo >= valueToCheck && rangeFrom <= valueToCheck) ? true : false;
            };
            contact._validateMinLength = function(minLength, valueToCheck) {
                return(minLength < valueToCheck) ? true : false;
            };
            contact._validateMaxLength = function(maxLength, valueToCheck) {
                return(valueToCheck <= maxLength) ? true : false;
            };
            contact._validateDate = function(dateToCheck) {
                return(!/Invalid|NaN/.test(new Date(dateToCheck).toUTCString())) ? true : false;
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