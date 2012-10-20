// Exemple of DOM
// <form id="searchform" class="fon-form search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
//     <input type="text" value="" name="s" id="s" placeholder="Search posts" spellcheck="false" required autocomplete="off" aria-autocomplete="list" aria-haspopup="true"/>
//     <button type="submit">Search</button>
// </form>

// AJAX search
var Fon_search = new Class({
    Implements: [Options,Events],
    options:{ 
        id: 'searchform'
    },
    initialize: function(){
        var fs = this, opt = this.options;
        if(!$(opt.id)) return;
        fs.setElements();
        fs.setEvents();
    },
    setElements: function(){
        var fs = this, opt = this.options;
        // DOM
        fs.form = $(opt.id);
        fs.input = fs.form.getElement('input[type="text"]');
        // HTML Elements
        fs.results_box = new Element('div', {'class': 'ajax-results-box'});
        fs.results_box.inject(fs.form);
        fs.autocomplete_box = new Element('div', {'class': 'ajax-autocomplete-box'});
        fs.autocomplete_box.inject(fs.input, "before");
        // Variables
        fs.old_s = "";
        fs.actual_autoc = "";
        // fs.actual_autoc = fs.autocomplete_box.get('html');
    },
    setEvents: function(){
        var fs = this, opt = this.options;
        // functions
        var input_keydown = fs.input_nav.bind(fs);
        var input_keyup = fs.search.bind(fs);
        var results = fs.results_nav.bind(fs);
        // events
        fs.input.addEvents({
            keydown: input_keydown,
            keyup: input_keyup
        });
        // Results box Events
        fs.results_box.addEvents({
            keyup: results
        });

    },
    search: function(e){
        var fs = this, opt = this.options;
        var s = e.target.value;
        if(s != "") {
            // if the search keywords is new
            if(s != fs.old_s) {
                fs.old_s = s;
                                // fs.actual_autoc = "";
                // AJAX request
                var request = new Request.JSON({
                    url: fs.form.get('action'),
                    method: fs.form.get('method'),
                    data: {'ajax':1, 's':s},
                    onRequest: function(){
                        fs.form.getElement('button').addClass('loading');
                    },
                    onSuccess: function(r){
                        if(r.error) {
                            fs.autocomplete_box.set('html', '');
                            fs.actual_autoc = "";
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
                                if (fs.actual_autoc != post1_t) {
                                    fs.autocomplete_box.set('html', post1_t);
                                    fs.actual_autoc = post1_t;
                                }
                            } else {
                                fs.autocomplete_box.set('html', '');
                                fs.actual_autoc = "";
                            }

                            // list results
                            var posts_list = new Element('ul');
                            r.posts.each(function(el,i){
                                new Element('a',
                                    {'href': el.permalink, 'html': el.title}
                                ).inject(new Element('li').inject(posts_list)); 
                            });
                            fs.results_box.set('html', '');
                            posts_list.inject(fs.results_box);
                        }
                    }
                }).send();
                // un get au lieu
                // http://net.tutsplus.com/tutorials/javascript-ajax/checking-username-availability-with-mootools-and-request-json/?search_index=7
            }
        } else {
            fs.autocomplete_box.set('html', '');
            fs.actual_autoc = "";
        }
        console.log(fs.actual_autoc);
    },
    input_nav: function(e){
        var fs = this, opt = this.options;
        // TAB
        if(fs.actual_autoc != "" && (e.code == 9 || e.key == "tab")) {
            // fill input with the correct title (true case)
            fs.input.value = fs.results_box.getElement('li a').get('html');
            fs.post_url = fs.results_box.getElement('li a').get('href');
            fs.autocomplete_box.set('html', '');
            fs.results_box.set('html', '');
            fs.form.getElement('button')
                   .removeClass('loading')
                   .set('html', 'GO');
            // submit redirect
            fs.form.removeEvents().addEvent('submit', function(e) {
                e.stop();
                window.location.href = fs.post_url;
            });
        }
        // Move focus in posts list
        if(e.code == 40 || e.key == "down") {
            fs.results_box.getElement('li a').focus();
        }
        
        if(e.code == 38 || e.key == "up") {
            fs.input.focus();
        }
    },
    results_nav: function(e){
        var fs = this, opt = this.options;
        if(e.code == 9 || e.key == "tab" || e.code == 40 || e.key == "down") {
            fs.results_box.getElement('li a').focus();
        }
        if(e.code == 38 || e.key == "up") {
            fs.input.focus();
        }
    }
});