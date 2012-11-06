window.addEvent('domready',function(){
    fon_e404();
});

function fon_e404() {
    // random_squares();
    random_shapes("square");
    random_shapes("triangle");
    // random_shapes("round");
}


function fon_color_rand(){
    // var array = ["a","b","c","d","e","f","0","1","2","3","4","5","6","7","8","9"];
    // var color = "";
    // var i = 6;
    // while(i) {
    //     var color = color + array[Number.random(0, array.length)];
    //     i--;
    // }
    // return "#" + color;
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