 // AJAX search



var Fon_search = new Class({
    initialize : function(options){
        this.options = options;
        var maclass = this, opt = this.options;
        
        this.setElements();
        this.setEvents();
    },
    setElements : function(){
        var maclass = this, opt = this.options;
       
    },
});


if($('searchform')) {
    // DOM
    var form = $('searchform');
    var input = form.getElement('input[type="text"]');
    // HTML Elements
    var results_box = new Element('div', {'class': 'ajax-results-box'});
    results_box.inject(form);
    var autocomplete_box = new Element('div', {'class': 'ajax-autocomplete-box'});
    autocomplete_box.inject(input, "before");
    // Variables
    var old_s = "";
    var actual_autoc = autocomplete_box.get('html');

    // "Change" input Event
    input.addEvents({
        keydown: function(e){
            // TAB
            if(e.code == 9 || e.key == "tab" && actual_autoc != "") {
                // fill input with the correct title (true case)
                input.value = results_box.getElement('li a').get('html');
                var post_url = results_box.getElement('li a').get('href');
                autocomplete_box.set('html', '');
                results_box.set('html', '');
                form.getElement('button')
                    .removeClass('loading')
                    .set('html', 'GO');
                form.removeEvents().addEvent('submit', function(e) {
                    e.stop();
                    document.location.href = post_url;
                });
            }
            if(e.code == 40 || e.key == "down") {
                results_box.getElement('li a').focus();
            }
            
            if(e.code == 38 || e.key == "up") {
                input.focus();
            }


        },
        keyup: function(e){
            // search value
            var s = e.target.value;
            if(s != "") {
                // if the search keywords is new
                if(s != old_s) {
                    old_s = s;
                    // AJAX request
                    var request = new Request.JSON({
                        url: form.get('action'),
                        method: form.get('method'),
                        data: {'ajax':1, 's':s},
                        onRequest: function(){
                            form.getElement('button').addClass('loading');
                        },
                        onSuccess: function(r){
                            if(r.error) {
                                autocomplete_box.set('html', '');
                            } else {
                                var post1_t = r.posts[0].title;
                                // autocomplete
                                
                                // Test case of the letter
                                for (var i = 1; i <= s.length; i++) {
                                    var test_letter = s.slice(i-1, i);
                                    var l_index = i;
                                    var corr_letter = post1_t.slice(l_index-1, l_index);
                                    // is lowercase
                                    if(test_letter.toUpperCase() != test_letter) {
                                        corr_letter = corr_letter.toLowerCase();
                                    }else {
                                        corr_letter = corr_letter.toUpperCase();
                                    }
                                    post1_t = post1_t.slice(0, l_index-1) + corr_letter + post1_t.slice(l_index);
                                };

                                // if search keywords match the first result
                                if(s.toLowerCase() == post1_t.toLowerCase().slice(0, s.length)) {
                                    if (actual_autoc != post1_t) {
                                        autocomplete_box.set('html', post1_t);
                                    }
                                } else {
                                    autocomplete_box.set('html', '');
                                }

                                // list results
                                var posts_list = new Element('ul');
                                r.posts.each(function(el,i){
                                    new Element('a',
                                        {'href': el.permalink, 'html': el.title}
                                    ).inject(new Element('li').inject(posts_list)); 
                                });
                                results_box.set('html', '');
                                posts_list.inject(results_box);
                            }
                        }
                    }).send();
                }
            } else {
                autocomplete_box.set('html', '');
            }
            actual_autoc = autocomplete_box.get('html');
        }
    });

    // Results box Events
    results_box.addEvents({
        keyup: function(e){
            if(e.code == 9 || e.key == "tab" || e.code == 40 || e.key == "down") {
                results_box.getElement('li a').focus();
            }
            if(e.code == 38 || e.key == "up") {
                input.focus();
            }
        }
    });

}