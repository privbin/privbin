import anime from 'animejs/lib/anime.es.js';
window.anime = anime;

require('./bootstrap');
require('alpinejs');

const bootstrap = window.bootstrap = require('bootstrap');
const $ = window.$ = window.jQuery = jQuery = require('jquery/src/jquery');
const waves = window.waves = require('jquery-waves/src/js/jquery-waves');

$(function () {
    $('.dropdown-hover').each(function () {
        const $this = $(this);
        const trigger = $this.find('[data-bs-toggle="dropdown"]')[0];
        const dropdown = new bootstrap.Dropdown(trigger);
        let backdrop = $('<div class="dropdown-backdrop"></div>');
        let closeTimer = null;

        $this[0].addEventListener('show.bs.dropdown', function () {
            $('body').prepend(backdrop);
        });
        $this[0].addEventListener('hide.bs.dropdown', function () {
            backdrop.remove();
        });

        $this.mouseenter(function () {
            dropdown.show();
            clearTimeout(closeTimer);
        });

        $this.mouseleave(function () {
            closeTimer = setTimeout(function () {
                dropdown.hide();
            }, 500);
        });
    });

    $('.expires-selector').each(function () {
        const $this = $(this);
        $this.find('.expires-item').click(function (event) {
            event.preventDefault();
            const $value = $(this).data('value');
            const $text = $(this).text();
            $('.expires-text').text($text);
            $('.expires-value').val($value);
        });
        $this.find('.expires-item[data-selected]').each(function () {
            const $value = $(this).data('value');
            const $text = $(this).text();
            $('.expires-text').text($text);
            $('.expires-value').val($value);
        });
    });

    $('iframe').on('load', function() {
        this.style.height = this.contentDocument.body.scrollHeight + 'px';
    });

    $(window).resize(function () {
        $('iframe').each(function() {
            this.style.height = this.contentDocument.body.scrollHeight + 'px';
        });
    });
});

