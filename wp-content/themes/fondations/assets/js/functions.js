function fon_random_cities(el) {
    if(!el) return;
    // if('relative' != el.getStyle('position') || 'absolute' != el.getStyle('position')) el.setStyle('position', 'relative');
    var w = el.getWidth();

    var nb = Number.random(42, 200);
    console.log(nb);

    while(nb > 0) {
        // max width: 100
        // min height: 20
        // max bottom: 0
        // min left: 0
        // max left: w-100
        var shadow_style = {
            'position': 'absolute',
            'bottom': (Number.random(10, 100)/10)*4-40,
            'left': (Number.random(10, 100)/10)*(w/11)-50,
            'width': 10*(Number.random(10, 100)/10),
            'height': 15*(Number.random(10, 100)/10),
            'background': '#0f2c2b',
            'opacity': Number.random(1, 4)/10,
            'z-index': 1
        }
        var shadow = new Element('div')
                     .setStyles(shadow_style);
        // Insert
        shadow.inject(el);
        nb--;
    }
}