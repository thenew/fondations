window.addEvent('domready',function(){

    // AJAX search
    var fon_search = new Fon_search();

    new dkJSUSlider($('fon-slider'), {
        showNavigation: false,
        showPagination: false,
        autoSlide: false,
        autoSlideDuration: 5000,
        transitionType: 'horizontal'
        // gallery: 'fon-slider-gallery',
        // galleryItemsPerPage: 4,
    });

});