window.addEvent('domready',function(){

  // key S to search
  var searchInput = document.getElementById('fon_dbar_search');
  if (document.activeElement != searchInput){
    document.addEvent('keydown', function(e){
      if (e.key == 's' && document.activeElement != searchInput){
        e.stop();
        searchInput.focus();
      }
    });
  }

  // resize debug log
  if($('.fon_debug_log')){
    var resizable_debug_bar = new resizableBox($$(".fon_debug_toolbar"), {
      handler: ".handler",
      modifiers: {x: false, y: true},
      size: {y:[30, 300]}
    });
  }


});