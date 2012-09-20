/*
--- 

script: mootools.resizableTextarea.js

description: Resizable (as in webkit) textarea for MooTools

license: MIT-style license

authors:
- Sergii Kashcheiev

requires:
- core/1.2.4: Events
- core/1.2.4: Options

provides: [resizableBox]

...
https://github.com/ginger/resizableTextarea
*/
var resizableBox = new Class({
  Version: "1.1",
  Implements: [Options],
  options: {
    handler: ".handler",
    modifiers: {x: true, y: true},
    size: {x:[50, 500], y:[50, 500]},
    onResizeClass: "resize",
    onStart: function(current) {},
    onEnd: function(current) {},
    onResize: function(current) {}
  },
  initialize: function(holder, options) {
    this.holder = holder;
    this.setOptions(options);
    
    this.holder.each(function(el, i) {
      el.box = el.getElement("div");
      el.box.height = el.box.getHeight();
      
     
        if(this.options.size.y[0] > this.options.size.y[1]) {
          this.options.size.y[0] = this.options.size.y[1];
        }
        if(el.box.height < this.options.size.y[0]) {
          el.box.setStyle("height", this.options.size.y[0]);
          el.box.height = this.options.size.y[0];
        }
        else if(el.box.height > this.options.size.y[1]) {
          el.box.setStyle("height", this.options.size.y[1]);
          el.box.height = this.options.size.y[1];
        }
      
      el.handler = el.getElement(this.options.handler);
      if(el.handler == null) {
        el.handler = new Element("span", {
          "class": "handler"
        });
        el.handler.inject(el.box, "before");
      }
      el.box.setStyles({"resize": "none"});
      // el.handler.top = el.box.height - el.handler.getPosition(el).y;
      el.handler.pressed = false;

      el.handler.addEvent("mousedown", function(e) {

        document.addEvent("mousemove", function(e) { el.handler.fireEvent("mousemove", e) });
        document.addEvent("mouseup", function() { el.handler.fireEvent("mouseup") });
        el.handler.pressed = true;
        // el.handler.y = e.page.y - el.handler.getPosition().y - el.handler.top;
        el.addClass(this.options.onResizeClass);
        this.options.onStart(el);


        var initPageY = e.page.y;


      }.bind(this));
      
      el.handler.addEvent("mouseup", function() {
        if (!(document.uniqueID && document.compatMode && !window.XMLHttpRequest)) {
          document.onmousedown = null;
          document.onselectstart = null;
        }
        if (Browser.Engine.trident) { el.handler.releaseCapture(); }
        else  {
          document.removeEvent("mousemove", function(e) { el.handler.fireEvent("mousemove", e) });
          document.removeEvent("mouseup", function() { el.handler.fireEvent("mousemove") });
        }
        el.handler.pressed = false;
        el.removeClass(this.options.onResizeClass);
        this.options.onEnd(el);
      }.bind(this));
      
      el.handler.addEvent("mousemove", function(e) {
        if(el.handler.pressed) {
         
            // console.log('page : '+e.page.y);
            // console.log('position : '+el.getPosition().y);
            // console.log('handler : '+el.handler.y);
            el.box.newHeight = el.box.height - (e.page.y-(window.getHeight()-el.box.height))-31;
             // e.page.y - el.getPosition().y - el.handler.y;
            // console.log('newHeight : '+el.box.newHeight);
            if(el.box.newHeight < this.options.size.y[1] && el.box.newHeight > this.options.size.y[0])
              el.box.newHeight = el.box.newHeight;
            else if(el.box.newHeight <= this.options.size.y[0])
              el.box.newHeight = this.options.size.y[0];
            else el.box.newHeight = this.options.size.y[1];
            
            el.box.setStyle("height", el.box.newHeight);
            // el.handler.setStyle("top", el.box.newHeight - el.handler.top - el.getStyle("border-top-width").toInt());
          this.options.onResize(el);
        }
      }.bind(this));
    }.bind(this));
  }
});