
function fonWove() {

    var colors = [
        '#0ff1CE',
        '#BADA55',
        '#C0FFEE',
        '#CDE0FC',
        '#EC2B60',
        '#CABEB3',
        '#BF3E3E'
    ];
    var prevColor = colors[1];

    var directions = [
        'top',
        // 'right',
        // 'bottom',
        'left'
    ];
    var prevDirection = directions[1];

    // directionAnimations = {
    //     'top': { 'top': '200%' },
    //     'bottom': { 'top': '-100%' },
    //     'left': { 'left': '200%' },
    //     'right': { 'left': '-100%' },
    // };

    var prevDelay = 100;
    var count = 0;

    $$('.wove').each(function(wrap) {

        // Shuffle
        var color = colors[Number.random(0, colors.length-1)];
        while( color === prevColor ) {
            color = colors[Number.random(0, colors.length-1)];
        }
        prevColor = color;

        var direction = directions[Number.random(0, directions.length-1)];
        while( direction === prevDirection ) {
            direction = directions[Number.random(0, directions.length-1)];
        }
        prevDirection = direction;

        var directionGap = 0;
        // var directionAnimation = directionAnimations->direction;
        switch (direction) {
            case 'top':
            case 'bottom':
                directionGap = wrap.getHeight();
                break;
            case 'left':
            case 'right':
                directionGap = wrap.getWidth();
                break;
        }

        // var directionAnimation = {};
        // switch (direction) {
        //     case 'top':
        //         directionAnimation = { 'top': directionGap };
        //         break;
        //     case 'bottom':
        //         directionAnimation = { 'top': '-100%' };
        //         break;
        //     case 'left':
        //         directionAnimation = { 'left': directionGap };
        //         break;
        //     case 'right':
        //         directionAnimation = { 'left': '-100%' };
        //         break;
        // }


        count++;
        var delay = prevDelay + ( 200 * ( 1 /count ) );
        prevDelay = delay;

        wrap.setStyles({
            'position': 'relative',
            'overflow': 'hidden'
        });
        var img = wrap.getElement('img');
        if(!img) return;

        var mask = new Element('div', {'class': 'wove-mask'}).inject(wrap, 'bottom');


        mask.setStyles({
            'position': 'absolute',
            // 'top': 0,
            // 'left': 0,
            'width': '100%',
            'height': '100%',
            'background-color': color
            // 'height': 0,
            // 'overflow': 'hidden'
        });


        switch (direction) {
            case 'top':
                mask.setStyles({
                    'left': 0,
                    'top': 0
                });
                break;
            case 'bottom':
                mask.setStyles({
                    'left': 0,
                    'bottom': 0
                });
                break;
            case 'left':
                mask.setStyles({
                    'top': 0,
                    'left': 0
                });
                break;
            case 'right':
                mask.setStyles({
                    'top': 0,
                    'right': 0
                });
                break;
        }



        setTimeout(function() {
            var myImage = Asset.image(img.get('src'), {
                onLoad: function() {

                    var openFx = new Fx.Morph(mask, {
                        duration: 200,
                        transition: Fx.Transitions.Cubic.easeInOut,
                        onComplete: function() {
                        }
                    });
                    var propAnim = {};
                    propAnim[direction] = directionGap;
                    openFx.start(propAnim);

                }
            });
        }, delay);
    });
}