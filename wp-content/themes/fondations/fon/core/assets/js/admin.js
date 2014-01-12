jQuery(document).ready(function ($) {

    // dynamic buttons
    jQuery('.fon-dynamic-add-button').each(function(i, el) {
        el = jQuery(el);

        var id = el.attr('data-target');
        var newId = id;

        var target = jQuery( '#' + newId );
        var name = target.attr('name');
        var newName = name;

        // last
        var lastInputId = el.attr('data-last');
        var lastInput = jQuery( '#' + lastInputId );

        if( lastInputId === '' ) {
            newName = name + '[]';
            lastInput = target;
        }

        // count dynamic input number
        var c = jQuery('[name="'+name+'"]').length;
        var max = el.attr('data-max');

        el.on('click', function(event) {
            event.preventDefault();
            button = jQuery(this);

            newId = id + '_' + (++c);

            // Clone
            target.clone()
                .attr( 'id', newId )
                .attr( 'name', newName )
                .html( '' )
                .insertAfter(lastInput);

            // after
            if( max && c >= parseInt( max, 10 ) ) {
                button.attr('disabled', 'disabled');
            }
            target.attr('name', newName );

            // change the last input
            lastInput = jQuery('#'+newId);

        });
    });

});
