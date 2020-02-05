
$(document).ready(function() {
    $('#save-form').click(function(event) {
        var form = $('#capture-form');
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.addClass('was-validated');
    });
});