jQuery(document).ready(function ($) {
// http://kevindees.cc/2011/08/add-a-thick-box-media-uploader-in-wordpress/
/* Add Uploader.
 * 
 * Attach on click event to button enabling thickbox uploader
 * built into wordpress. Uses jQuery like selector for 
 * strings parameters. Targets must be one element. This 
 * function allows for multiple uploaders per page when 
 * editor is present.
 * 
 * (required)
 * @para1 string -> form button's id to open uploader box
 * @para2 string -> form input's id where image url will go
 * 
 * Example: set_uploader('#button', '#field')
 * 
 * Usage: Added function call to end of this file inside the 
 * ready function. See example for calling the function.
 */
function set_uploader(button, field) {
  // make sure both button and field are in the DOM
  if($(button) && $(field)) {
    // when button is clicked show thick box
    $(button).click(function() {
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
      
      // when the thick box is opened set send to editor button
      set_send(field); 
      return false;
    });
  }
}

/* Setup Send Button
 * 
 * Add image url to the set_uploader() field parameters element
 * when send or "Insert into Post" is clicked; setting the value
 * to the image's path.
 * 
 * (required)
 * @para1 string -> form field id
 *
 * Example: set_url('#filed')
 * 
 * Usage: needed by the set_uploader, no calls outside needed
 */
function set_send(field) {
  // store send_to_event so at end of function normal editor works
  window.original_send_to_editor = window.send_to_editor;
  
  // override function so you can have multiple uploaders pre page
  window.send_to_editor = function(html) {
    imgurl = $('img',html).attr('src');
    $(field).val(imgurl);
    tb_remove();
    // Set normal uploader for editor
    window.send_to_editor = window.original_send_to_editor;
  };
}

// place set_uploader functions below, button then field
// set_uploader('#image_button', '#cf_block_image');
set_uploader('#fon_mb_slider_img_button', '#fon_mb_slider_img');
});