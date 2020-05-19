require('./bootstrap');
require('bootstrap-datepicker');

const ladda = require('ladda');
const turbolinks = require('turbolinks');
const feather = require('feather-icons');

// Boot Turbolinks...
turbolinks.start();

// Persist scroll position with Turbolinks.
turbolinks.scroll = {};

document.addEventListener("livewire:load", function(event) {
    window.livewire.hook('afterDomUpdate', () => {
        feather.replace();
    });
});

document.addEventListener('turbolinks:load', () => {
    feather.replace();

    // Enable ladda.
    ladda.bind('button[type=submit]');

    // Capture scroll position on specific links.
    let elements = document.querySelectorAll("[data-turbolinks-scroll]");

    elements.forEach((element) => {
        element.addEventListener("click", () => {
            turbolinks.scroll['top'] = document.scrollingElement.scrollTop;
        });

        element.addEventListener("submit", () => {
            turbolinks.scroll['top'] = document.scrollingElement.scrollTop;
        });
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    $('.datepicker').datepicker();
});

document.addEventListener('turbolinks:render', () => {
    if (turbolinks.scroll['top']) {
        document.scrollingElement.scrollTo(0, Turbolinks.scroll['top']);
    }

    turbolinks.scroll = {};
});
