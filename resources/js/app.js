require('./bootstrap');
import * as Ladda from 'ladda';
import Turbolinks from 'turbolinks';

// Boot Turbolinks...
Turbolinks.start();

// Persist scroll position with Turbolinks.
Turbolinks.scroll = {};

document.addEventListener('turbolinks:load', () => {
    // Enable ladda.
    Ladda.bind('button[type=submit]');

    let elements = document.querySelectorAll("[data-turbolinks-scroll]");

    elements.forEach((element) => {
        element.addEventListener("click", () => {
            Turbolinks.scroll['top'] = document.scrollingElement.scrollTop;
        });

        element.addEventListener("submit", () => {
            Turbolinks.scroll['top'] = document.scrollingElement.scrollTop;
        });
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
});

document.addEventListener('turbolinks:render', () => {
    if (Turbolinks.scroll['top']) {
        document.scrollingElement.scrollTo(0, Turbolinks.scroll['top']);
    }

    Turbolinks.scroll = {};
});
