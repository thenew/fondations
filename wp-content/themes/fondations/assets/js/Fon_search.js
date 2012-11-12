// Exemple of DOM
// <form method="get" action="">
//     <div id="ajax-search-autocomplete"></div>
//     <input type="text" name="s" id="ajax-search-input" spellcheck="false" autocomplete="off" aria-autocomplete="list" aria-haspopup="true"/>
//     <button type="submit">Search</button>
// </form>

// AJAX search
var Fon_search = new Class({
    Implements: [Options,Events],
    options:{ 
        input_id: 'fon-s-input',
        autocomplete_id: 'fon-s-autocomplete',
        results_id: 'fon-s-results'
    },
    initialize: function(options) {
        var fs = this, opt = this.options;
        opt = Object.merge(opt, options);
        if(!$(opt.input_id) || !$(opt.autocomplete_id) || !$(opt.results_id)) return;
        fs.setElements();
        fs.setEvents();
    },
    setElements: function() {
        var fs = this, opt = this.options;
        // DOM
        fs.input = $(opt.input_id);
        fs.form = $(opt.input_id).getParent('form');
        fs.results_box = $(opt.results_id);
        fs.autocomplete_box = $(opt.autocomplete_id);
        // Variables
        fs.old_s,
        fs.actual_autoc,
        fs.true_actual_autoc,
        // fs.match_post,
        fs.previous_reponse,
        fs.delay = 0;
    },
    setEvents: function() {
        var fs = this, opt = this.options;
        var input_keydown = fs.input_nav.bind(fs);
        var input_keyup = fs.handle_search.bind(fs);
        var results = fs.results_nav.bind(fs);
        fs.input.addEvents({
            keydown: input_keydown,
            keyup: function(e) {
                clearTimeout(fs.delay);
                fs.delay = setTimeout(function() {
                    input_keyup(e);
                }, 100);
            }
        });
        // Results box Events
        fs.results_box.addEvents({
            keyup: results
        });

    },
    handle_search: function(e) {
        var fs = this, opt = this.options;
        var s = e.target.value;
        if(s != "") {
            // if the search keywords is not new
            if(s == fs.old_s) {
                fs.clear();
            }else {
                fs.old_s = s;
                var request = new Request.JSON({
                    url: fs.form.get('action'),
                    method: fs.form.get('method'),
                    data: {'ajax':1, 's':s},
                    onRequest: function(){
                        fs.form.addClass('loading');
                    },
                    onSuccess: function(response){
                        if(response.error && response.error == "no results") {
                            fs.clear();
                        }else {
                            fs.autocomplete(response, s);
                        }
                    }
                }).send();
            }
        }
    },
    autocomplete: function(response, s) {
        var fs = this, opt = this.options;
        var post1_t = response.posts[0].title;
        var post1_t_true = post1_t;
        // if search keywords doesn't match the first result
        if(s.toLowerCase() != post1_t.toLowerCase().slice(0, s.length)) {
            fs.clear();
        } else {
            // Transform case of the autocomplete title to match search
            post1_t = fs.match_case(s, post1_t);
            if (fs.actual_autoc != post1_t) {
                fs.autocomplete_box.set('html', post1_t);
                fs.actual_autoc = post1_t;
                fs.true_actual_autoc = post1_t_true;
            }
        }
        // fs.match_post = response.tpl_match_post;

        // populate list results if response is different
        // if(fs.previous_reponse != response.tpl) {
            var posts_list = new Element('ul');
            response.posts.each(function(el,i){
                new Element('a',
                    {'href': el.permalink, 'html': el.title}
                ).inject(new Element('li').inject(posts_list)); 
            });
            fs.results_box.set('html', '');
            posts_list.inject(fs.results_box);
        // }
        // fs.previous_reponse = response.tpl;

    },
    input_nav: function(e) {
        var fs = this, opt = this.options;
        // TAB & right
        // TODO right limiter au curseur a droite
        if(fs.actual_autoc != "" && (e.code == 9 || e.key == "tab" || e.code == 39 || e.key == "right")) {
            // fill input with the correct title (true case)
            fs.input.value = fs.true_actual_autoc;
            // fs.input.value = fs.results_box.getElement('li a').get('html');
            fs.post_url = fs.results_box.getElement('li a').get('href');
            fs.clear();
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
    results_nav: function(e) {
        var fs = this, opt = this.options;
        if(e.code == 9 || e.key == "tab" || e.code == 40 || e.key == "down") {
            fs.results_box.getElement('li a').focus();
        }
        if(e.code == 38 || e.key == "up") {
            fs.input.focus();
        }
    },
    clear: function(e) {
        var fs = this, opt = this.options;
        fs.autocomplete_box.set('html', '');
        fs.actual_autoc = "";
        fs.results_box.set('html', '');
    },
    /**
      *
      * Transform each letter case of transform string to
      * match the reference string
      *
      * @param {String} ref
      * @param {String} transform
      * @return {String} transformed transform
      *
      */
    match_case: function(ref, transform) {
        var fs = this, opt = this.options;
        if(!ref || !transform) return;
        // for each search value letter we match the case with letter from post1 title
        for (var i = 1; i <= ref.length; i++) {
            var ref_letter = ref.slice(i-1, i);
            var l_index = i;
            var corr_letter = transform.slice(l_index-1, l_index);
            // if is lowercase
            if(ref_letter.toUpperCase() != ref_letter) {
                corr_letter = corr_letter.toLowerCase();
            }else {
                corr_letter = corr_letter.toUpperCase();
            }
            transform = transform.slice(0, l_index-1) + corr_letter + transform.slice(l_index);
        };
        return transform;
    }
});