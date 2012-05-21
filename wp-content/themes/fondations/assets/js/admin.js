jQuery(document).ready(function ($) {

    // Color Picker for js file
    $('.pickcolor').click( function(e) {
        colorPicker = jQuery(this).next('div');
        input = jQuery(this).prev('input');
        // $(colorPicker).farbtastic(input);
        $.farbtastic(colorPicker, function(a) {
            input.val(a);
        });
        colorPicker.show();
        e.preventDefault();
        $(document).mousedown( function() {
            $(colorPicker).hide();
        });
    });


});
