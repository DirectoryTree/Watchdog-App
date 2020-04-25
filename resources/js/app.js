require('./bootstrap');
import * as Ladda from 'ladda';

Ladda.bind('button[type=submit]');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
});
