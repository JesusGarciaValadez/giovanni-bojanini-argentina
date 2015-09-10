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
(function ($, window, document, undefined) {
    //  Revisa la disponibilidad de localStorage
    var storage;
    if('localStorage' in window && window.localStorage !== null) {
        storage = localStorage;
    } else {
        try {
            if (localStorage.getItem) {
                storage = localStorage;
            }
        } catch(e) {
            storage = {};
        }
    }

    //  When DOM is loaded
    // $(function () {

    // });

    (function () {
        var app = angular.module('BojaApp', []);

        app.controller('ContactController', function($scope, $http) {
            $scope.form                = this;
            $scope.form.response       = '';
            $scope.form.form           = document.getElementsByClassName('contact-form');
            $scope.form.url            = $scope.form.form[ 0 ].action + '?action=contact';
            $scope.form.received       = false;
            $scope.contact             = {};

            /*
            $scope.form.processForm = function (e) {
                e.preventDefault();
                e.stopPropagation();

                $scope.form.received = true;
                $scope.form.response = 'Recibiendo…';

                $http( $scope.form.url, { firstName: $scope.contact.firstName } )
                .success(function (data) {
                    console.log(data);

                    if (!data.success) {
                        $scope.form.response = "Hubo un error. Por favor, intenta de nuevo.";
                    } else {
                        $scope.form.response = data.message;
                    }
                });
            };
            */

            $scope.form.submitForm      = function (e) {
                e.preventDefault();
                e.stopPropagation();

                $scope.form.received = true;
                $scope.form.response = 'Recibiendo…';

                $.ajax($scope.form.url, {
                    converters: {
                        "* text": window.String,
                        "text html": true,
                        "text json": jQuery.parseJSON,
                        "text xml": jQuery.parseXML
                    },
                    data: {
                        firstName:  $scope.contact.firstName,
                        lastName:   $scope.contact.lastName,
                        email:      $scope.contact.email,
                        city:       $scope.contact.city,
                        message:    $scope.contact.message
                    },
                    type: 'POST',
                    dataType: 'json'
                }).done(function (responseText) {
                    $scope.form.response = responseText.message;
                    $( '.response' ).text( $scope.form.response );
                }).fail(function () {
                    $scope.form.response = "Hubo un error. Por favor, intenta de nuevo.";
                });
            };
        });
    })();

    //  When page is finished loaded
    $(document).ready(function () {
        // if ($('.flexisel').exists()) {
        //     $(".flexisel").flexisel({
        //         visibleItems: 1,
        //         animationSpeed: 100,
        //         autoPlay: true,
        //         autoPlaySpeed: 6000,
        //         pauseOnHover: false,
        //         clone: true,
        //         enableResponsiveBreakpoints: false
        //     });
        // }

        // if ($('.nbs-flexisel-container').exists()) {
        //     $('.nbs-flexisel-container').addClass('clearfix' );
        // }

        if ($('.gallery').exists()) {
            var _height = $(window).innerHeight() + 'px';
            $('window').on('resize', function (e) {
                e.preventDefault();
                e.stopPropagation();
                _height = $(window).innerHeight() + 'px';
                $('.gallery').height(_height);
            });
        }
    });

}) (jQuery, window, document);