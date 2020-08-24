require('./bootstrap');

require('unpoly');

require('bootstrap-datepicker');

const Ladda = require('ladda');
const Swal = require('sweetalert2');

up.compiler('button[type=submit]', (element) => {
    Ladda.bind(element);
});

up.compiler('[data-toggle="tooltip"]', (element) => {
    $(element).tooltip();
});

up.compiler('[data-toggle="popover"]', (element) => {
    $(element).popover();
});

up.compiler('[data-toggle="popover"]', (element) => {
    $(element).datepicker();
});

up.compiler('[up-flash]', (element, data) => {
    Swal.fire({
        icon: data.level,
        title: data.title,
        text: data.message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
});

up.compiler('[poll]', (element) => {
    let interval = parseInt(element.getAttribute('poll') || 5000);

    let timer = setInterval(() => {
        // If there's a focused element in the poll, we'll prevent updating.
        if (element.querySelector('[focused=true]')) {
            return;
        }

        if (! document.hidden) {
            up.reload(element);
        }

    }, interval);

    return function() {
        clearInterval(timer)
    };
});
