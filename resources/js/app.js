import anime from 'animejs/lib/anime.es.js';
window.anime = anime;

require('./bootstrap');
require('alpinejs');

const $ = window.$ = window.jQuery = jQuery = require('jquery/src/jquery');
const waves = window.waves = require('jquery-waves/src/js/jquery-waves');

$(function () {
    $('iframe').on('load', function() {
        this.style.height = this.contentDocument.body.scrollHeight + 'px';
    });

    $(window).resize(function () {
        $('iframe').each(function() {
            this.style.height = this.contentDocument.body.scrollHeight + 'px';
        });
    });

    window.openModal = function (selector) {
        let modal = $(selector);
        let backdrop = modal.find('.backdrop');
        let dialog = modal.find('[role=dialog][aria-modal=true]');
        modal.removeClass('hidden');

        backdrop
            .addClass('ease-out').addClass('duration-300').addClass('opacity-0')
            .removeClass('ease-in').removeClass('duration-200').removeClass('opacity-75');

        dialog
            .addClass('ease-out').addClass('duration-300').addClass('opacity-0').addClass('translate-y-4').addClass('sm:translate-y-0').addClass('sm:scale-95')
            .removeClass('ease-in').removeClass('duration-200').removeClass('opacity-100').removeClass('translate-y-0').removeClass('sm:scale-100')

        setTimeout(function () {
            backdrop
                .addClass('opacity-75')
                .removeClass('opacity-0');

            dialog
                .addClass('opacity-100').addClass('translate-y-0').addClass('sm:scale-100')
                .removeClass('opacity-0').removeClass('translate-y-4').removeClass('sm:translate-y-0').removeClass('sm:scale-95')
        }, 50);
    };

    window.closeModal = function (selector) {
        let modal = $(selector);
        let backdrop = modal.find('.backdrop');
        let dialog = modal.find('[role=dialog][aria-modal=true]');

        backdrop
            .removeClass('ease-out').removeClass('duration-300').removeClass('opacity-0')
            .addClass('ease-in').addClass('duration-200').addClass('opacity-75');

        dialog
            .removeClass('ease-out').removeClass('duration-300').removeClass('opacity-0').removeClass('translate-y-4').removeClass('sm:translate-y-0').removeClass('sm:scale-95')
            .addClass('ease-in').addClass('duration-200').addClass('opacity-100').addClass('translate-y-0').addClass('sm:scale-100')

        setTimeout(function () {
            backdrop
                .removeClass('opacity-75')
                .addClass('opacity-0');

            dialog
                .removeClass('opacity-100').removeClass('translate-y-0').removeClass('sm:scale-100')
                .addClass('opacity-0').addClass('translate-y-4').addClass('sm:translate-y-0').addClass('sm:scale-95')

            setTimeout(function () {
                modal.addClass('hidden');
            }, 300);
        }, 5);
    }
});

