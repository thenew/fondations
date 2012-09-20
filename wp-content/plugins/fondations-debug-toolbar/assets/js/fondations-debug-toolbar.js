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


  // resize debug log
  if(document.getElementById('fon_debug_log')){
    var resizable_debug_bar = new resizableBox($$(".fon_debug_toolbar"), {
      handler: ".handler",
      modifiers: {x: false, y: true},
      size: {y:[30, 300]}
    });
  }


});