window.addEvent('domready',function(){

    // AJAX search
    var fon_search = new Fon_search();

    // Fondations home header paysage
    fon_random_cities($$('.home-logo')[0]);


    new dkJSUSlider($('fon-slider'), {
        showNavigation: false,
        showPagination: false,
        autoSlide: false,
        autoSlideDuration: 5000,
        transitionType: 'horizontal'
    });

});