(function ($) {
	//Shortcut for fancyBox object
	var F = $.fancybox;

	//Add helper object
	F.helpers.dotNavi = {

    afterLoad: function (opts, obj) {
      var list = $("#fancyboy-dotnavi");

      if (!list.length) {
        list = $('<ul id="fancyboy-dotnavi">');

        for (var i = 0; i < obj.group.length; i++) {
          $('<li data-index="' + i + '"><label></label></li>').click(function() {
            $.fancybox.jumpto($(this).data('index'));
          }).appendTo(list);
        }

        list.appendTo('body');
      }

      list.find('li').removeClass('active').eq(obj.index).addClass('active');
		},

		beforeClose: function () {
      $("#fancyboy-dotnavi").remove();
    }
	}

}(jQuery));
