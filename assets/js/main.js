$(document).ready(function () {
    $('#banner_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            url: {
                required: true,
                minlength: 3
            },
            type: {
                required: true,
                minlength: 3
            },
            target: {
                required: true,
                minlength: 3
            },
            status: {
                required: true,
            },
            image: {
                required: true,
            },
        }
    });
});