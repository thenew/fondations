window.addEvent('domready',function(){

  // key S to search
  function keyControl(event){
    var searchInput = document.getElementById('fon_dbar_search');
    if (event.key == 's'){
      // filter input field focused
      // thanks to madrobby https://github.com/madrobby/keymaster/blob/master/keymaster.js
      var tagName = (event.target || event.srcElement).tagName;
      var filter = !(tagName == 'INPUT' || tagName == 'SELECT' || tagName == 'TEXTAREA');
      if (filter){
        event.stop();
        // focus to our input
        searchInput.focus();
      }
    }
  }
  document.addEvent('keydown', keyControl, false);


  // AJAX delete log
  if($('fon_debug_log_form')) {
    $('fon_debug_log_form').addEvent('submit', function(e) {
      e.stop();
      var ajax_delete = new Request({
        url: this.action,
        method: this.method,
        onRequest: function() {
          $('fon_debug_log').addClass('loading').morph({'opacity': '.6'});
        },
        onSuccess: function(response) {
          // FX delete debug log element
          var delete_fx = new Fx.Morph($('fon_debug_log'), {
            onComplete: function() {
              this.element.destroy(); 
            }
          });
          delete_fx.start({'height': 0});
        }
      }).send(this.toQueryString());
    });
  }

  // resize debug log
  if(document.getElementById('fon_debug_log')){
    var resizable_debug_bar = new resizableBox($$(".fon_debug_toolbar"), {
      handler: ".handler",
      modifiers: {x: false, y: true},
      size: {y:[30, 300]}
    });
  }


});