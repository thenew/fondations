jQuery(document).ready(function ($) {

    // input range
    jQuery('.input-range').each(function(i, el) {
        el = jQuery(el);
        var valueEl = el.siblings('.input-range-value')[0];
        valueEl = jQuery(valueEl).find('.value');
        valueEl = jQuery(valueEl);
        el.on('change', function(event) {
            console.log(el.attr('value'));
            valueEl.text(el.attr('value'));
        });
    });

/* ----------------------------------------------------------
   Profile
   Dynamic input
   ------------------------------------------------------- */

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


/* ----------------------------------------------------------
   Filou
   ------------------------------------------------------- */

    jQuery('#filou_size_min').on('change', function(event) {
        var value = jQuery(this).attr('value');

        // iterate imgs
        jQuery('.images-wall .item').each(function(i, item) {
            item = jQuery(item);
            var w = item.data('width');
            var h = item.data('height');
            if( h < value || w < value ) {
                item.addClass('outrange');
                item.find('.checkbox').attr('checked', false);
            } else {
                item.removeClass('outrange');
            }
        });
    });


    // dynamic-height
   /* $$('.js-dynamic-height').each(function(thumb) {
        var w = thumb.get('data-width').toInt();
        var h = thumb.get('data-height').toInt();
        if(!w || !h) return;
        var realW = thumb.getWidth();
        var ratio = realW / w;
        var realH = h * ratio;

        thumb.setStyles({
            'height': realH
        });
    });*/


});

jQuery( window ).load(function() {

/* ----------------------------------------------------------
   Filou
   ------------------------------------------------------- */

    // masonry
    var $container = jQuery('#js-packery');
    $container.packery({
      // options
      itemSelector: '.item',
      gutter: 10,
      columnWidth: '.item'
    });

});