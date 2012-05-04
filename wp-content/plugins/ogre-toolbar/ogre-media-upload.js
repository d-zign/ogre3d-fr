jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  })
}
});


jQuery(document).ready(function()
{
	jQuery('#upload_image_button').click(function()
	{
		formfield = jQuery('#upload_image').attr('name');
		tb_show('', 'ogre-media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	 
	window.send_to_editor = function(html)
	{
		imgurl = jQuery('img', html).attr('src');
		jQuery('#area1').insertAtCaret('<img src="' + imgurl + '" />');
		tb_remove();
	}
});