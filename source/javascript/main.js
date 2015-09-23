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
        });
    })();

    //  When page is finished loaded
    $(document).ready(function () {
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