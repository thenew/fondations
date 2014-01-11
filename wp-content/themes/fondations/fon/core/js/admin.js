jQuery(document).ready(function ($) {

    jQuery('.fon-dynamic-add-button').each(function(i, el) {
        el = jQuery(el);
        var c = 1;
        var id = el.attr('data-target');
        var newId = id;
        var target = jQuery( '#' + newId );
        var name = target.attr('name');
        var newName = name + '[]';

        el.on('click', function(event) {
            event.preventDefault();
            button = jQuery(this);
            var max = button.attr('data-max');

            newId = id + '_' + (++c);
            target.clone()
                .attr( 'id', newId )
                .attr( 'name', newName )
                .insertAfter(target);

            // after
            button.attr('data-target', newId);
            if( max && c >= parseInt( max, 10 ) ) {
                button.attr('disabled', 'disabled');
            }
            target.attr('name', newName );


        });
    });

});
