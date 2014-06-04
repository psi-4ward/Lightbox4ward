(function ($) {
	//Shortcut for fancyBox object
	var F = $.fancybox;

	//Add helper object
	F.helpers.count = {


    beforeLoad: function (opts, obj) {

		},


		onUpdate: function (opts, obj) {
      if(obj.group.length < 2) {
        obj.helpers.count = false;
        return;
      }

      $('<span class="count">(' + (obj.index+1) + '/' + obj.group.length + ')</span>').insertAfter(obj.outer);
		},

		beforeClose: function () {
		}
	}

}(jQuery));