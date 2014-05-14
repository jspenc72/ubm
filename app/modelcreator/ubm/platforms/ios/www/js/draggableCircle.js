$(function() {
				$(".circleBase").draggable();
			});
			$(function() {
				$('.bxslider').bxSlider({
					speed : 100,
				});
			});
			$(document).on("click", ".show-page-loading-msg", function() {
				var $this = $("#page_loading_message"), theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme, msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text, textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible, textonly = !!$this.jqmData("textonly");
				html = $this.jqmData("html") || "";

				$.mobile.loading("show", {
					text : msgText,
					textVisible : textVisible,
					theme : theme,
					textonly : textonly,
					html : html
				});
			}).on("click", ".hide-page-loading-msg", function() {
				$.mobile.loading("hide");
			});