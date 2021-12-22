require('./bootstrap');
$( document ).ready(function() {
    $('#name_days').select2({
        ajax: {
            url: '/ajax_names',
            dataType: 'json'
        }
    });
});

