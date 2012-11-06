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
        }
        var shadow = new Element('div')
                     .setStyles(shadow_style_default)
                     .setStyles(shadow_style);
        // Insert
        shadow.inject(el);
        nb--;
    }
}