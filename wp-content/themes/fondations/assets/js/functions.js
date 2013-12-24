function fon_random_cities(el) {
    if(!el) return;
    // if('relative' != el.getStyle('position') || 'absolute' != el.getStyle('position')) el.setStyle('position', 'relative');
    var w = el.getWidth();
    var h = el.getHeight();

    var nb = Number.random(42, 100);
    var shadow_style_default = {
        'position': 'absolute',
        'background': '#0f2c2b',
        // 'box-shadow': '0 0  #0f2c2b'
        'z-index': 1
    };

    while(nb > 0) {
        var left = (Number.random(10, 100)/10)*(w/11)-50;
        // si l'obj est au centre avec une marge de 150px
        // coeff de rapprochitude du milieu
        var centriste = (left - (w/2))/(w/2);
        if(centriste < 0) centriste = -centriste;
        // entre 0 et 1
        var height = centriste*h-Number.random(0, h/5);
        var shadow_style = {
            // 'bottom': (Number.random(10, 100)/10)*4-40,
            'bottom': 0,
            'left': left,
            'width': 10*(Number.random(10, 100)/10),
            'height': height,
            'opacity': Number.random(1, 4)/10,
            'box-shadow': '0 0 '+Number.random(5, 30)+'px rgba(15,44,43, '+Number.random(1, 8)/10+')'
        };
        var shadow = new Element('div')
                     .setStyles(shadow_style_default)
                     .setStyles(shadow_style);
        // Insert
        shadow.inject(el);
        nb--;
    }
}


function fon_color_rand(){
    return "#" + Math.random().toString(16).slice(2, 8);
}

function random_shapes(shape, el, min, max) {
    if(!shape || ("triangle" != shape && "round" != shape)) shape = 'square';
    if(!el) el = document.body;
    if(!min) min = 42;
    if(!max) max = 100;
    var w = el.getWidth();
    var h = el.getHeight();
    var nb = Number.random(min, max);

    // Defaults and shapes styles
    var shape_style_default = {};
    if("triangle" == shape) {
        var shape_style_default = {
            'height': 0,
            'border': '20px solid transparent',
            'border-right-color': '#fff'
        };
    } else if("round" == shape) {
        var shape_style_default = {
            '-webkit-border-radius': '50%',
            '-moz-border-radius': '50%',
            'border-radius': '50%'
        };
    }

    // generated divs
    while(nb > 0) {
        var width = 10*(Number.random(10, 100)/10);
        var left = w*(Number.random(0, 100)/100)-width;
        var bottom = h*(Number.random(0, 100)/100);
        var color = fon_color_rand();

        var shape_style = {
            'bottom': bottom,
            'left': left,
            '-webkit-transform': 'rotate('+Number.random(0, 179)+'deg)',
            '-moz-transform': 'rotate('+Number.random(0, 179)+'deg)',
            '-ms-transform': 'rotate('+Number.random(0, 179)+'deg)',
            '-o-transform': 'rotate('+Number.random(0, 179)+'deg)',
            'transform': 'rotate('+Number.random(0, 179)+'deg)',
            'opacity': Number.random(1, 5)/10
        }

        if("triangle" == shape) {
            var special_shape_style = {
                'border-width': width,
                'border-right-color': color,
            };
        } else {
            var special_shape_style = {
            'width': width,
            'height': 10*(Number.random(10, 100)/10),
            'background': color,
            };
        }
        shape_style = Object.merge(shape_style, special_shape_style);

        var div = new Element('div')
                     .addClass('e404-shape '+shape)
                     .setStyles(shape_style_default)
                     .setStyles(shape_style);
        div.inject(el);
        nb--;
    }
}

// replace images with hi-res version
$$('*[data-full-src]').each(function(el) {
    var full = el.get('data-full-src');
    var myImage = Asset.image(full, {
        onLoad: function() {

            var oldBg = el.getStyle('background-image');
            if( oldBg !== 'none') {
                setTimeout(function() {
                        el.setStyles({
                            'background-image': 'url('+full+'), ' + oldBg
                        });
                }, 200);
                setTimeout(function() {
                        el.setStyles({
                            'background-image': 'url('+full+')'
                        });
                }, 1000);
            }

        }
    });
});