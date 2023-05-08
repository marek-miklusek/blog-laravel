(function($) {

    $('#add-form, #edit-form')
    .find('.add-files a').on('click', function() {
        var input = $(this).prev();
        input.clone().insertAfter(input);
    });

}(jQuery));