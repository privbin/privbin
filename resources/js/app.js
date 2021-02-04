import anime from 'animejs/lib/anime.es.js';
window.anime = anime;

require('./bootstrap');
require('alpinejs');

const $ = window.$ = window.jQuery = jQuery = require('jquery/src/jquery');
const waves = window.waves = require('jquery-waves/src/js/jquery-waves');
const ace = window.ace = require('ace-builds');

window.define = ace.define;
window.require = ace.require;

$(function () {
    if ($("#editor").length > 0) {
        let editor = ace.edit("editor");
        ace.config.set('basePath', '/vendor/ace/');
        // editor.setTheme("ace/theme/clouds_midnight");
        editor.setTheme("ace/theme/dracula");
        editor.session.setMode("ace/mode/text");
        editor.setOptions({
            selectionStyle: "line",
            highlightActiveLine: true,
            highlightSelectedWord: true,
            readOnly: false,
            cursorStyle: "wide",
            behavioursEnabled: true,
            wrapBehavioursEnabled: true,
            enableMultiselect: true,

            highlightGutterLine: true,
            animatedScroll: true,
            showInvisibles: true,
            showPrintMargin: true,
            printMarginColumn: 80,
            fadeFoldWidgets: true,
            showFoldWidgets: true,
            showLineNumbers: true,
            showGutter: true,
            displayIndentGuides: true,
            // fontSize: number or css font-size string
            // fontFamily: css font-family value
            maxLines: Infinity, // Infinity
            minLines: 15,

            firstLineNumber: 1,
            newLineMode: "auto",
            tabSize: 4,

            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
            enableSnippets: true,
// the following option requires ext-emmet.js and the emmet library
            enableEmmet: true,
// the following option requires ext-elastic_tabstops_lite.js
            useElasticTabstops: true,
        });
        editor.setShowFoldWidgets(true);
        editor.setAnimatedScroll(true);
        editor.setAutoScrollEditorIntoView(true);
        editor.setBehavioursEnabled(true);
        editor.setDisplayIndentGuides(true);
        editor.setHighlightActiveLine(true);
        editor.setHighlightGutterLine(true);
        editor.setHighlightSelectedWord(true);
        editor.setShowInvisibles(true);
        editor.setShowPrintMargin(true);
        editor.setFontSize(16);
        window.editor = editor;
    }

    $('textarea.ace_text-input').focus(function () {
        $(this).parent('.ace_editor').addClass("border-purple-500").removeClass("border-gray-900");
    }).blur(function () {
        $(this).parent('.ace_editor').removeClass("border-purple-500").addClass("border-gray-900");
    });

    $('.ace_editor').addClass("border-gray-900");

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

