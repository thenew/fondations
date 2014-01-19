function getImgSize(imgSrc, item, value) {
    var newImg = new Image();

    newImg.onload = function() {
        var h = newImg.height;
        var w = newImg.width;
        item.attr('data-width', w);
        item.attr('data-height', h);
        jQuery(item.find('.infos')[0]).text( w + 'x' + h );

        if( h < value || w < value ) {
            item.addClass('outrange');
            item.find('.checkbox').attr('checked', false);
        } else {
            item.removeClass('outrange');
        }


        var $packeryContainer = jQuery('#js-packery');
        $packeryContainer.packery({
          itemSelector: '.item',
          gutter: 10
        });


    };
    newImg.src = imgSrc; // this must be done AFTER setting onload
}

jQuery(document).ready(function ($) {

    // input range
    jQuery('.input-range').each(function(i, el) {
        el = jQuery(el);
        var valueEl = el.siblings('.input-range-value')[0];
        valueEl = jQuery(valueEl).find('.value');
        valueEl = jQuery(valueEl);
        el.on('change', function(event) {
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

            if( w && h ) {
                if( h < value || w < value ) {
                    item.addClass('outrange');
                    item.find('.checkbox').attr('checked', false);
                } else {
                    item.removeClass('outrange');
                }
            } else {

                var img = item.find('img');
                getImgSize(img.attr('src'), item, value);

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
    var $packeryContainer = jQuery('#js-packery');
    if( $packeryContainer.find('.item').length > 1) {
        $packeryContainer.packery({
          itemSelector: '.item',
          gutter: 10
          // columnWidth: '.item'
        });
    }

});