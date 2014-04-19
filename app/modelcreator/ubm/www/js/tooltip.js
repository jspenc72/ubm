function tooltipContentCreator (activeUUID) {
		$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_OjectDetail.php?callback=?', {//JSONP Request to Open Items Page setup tables
		key : window.key,
		activeUUID : activeUUID
	}, function(res, status) {
			$(".hidden_tooltip").empty();
		$.each(res, function(i, item) {
			if (item.object_type = "MD") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			} else if (item.object_type = "PS") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "<strong>Age Requirements: </strong><br>" + item.age_requirements + "<strong>Education Requirements: </strong><br>" + item.education_requirements + "</span>");
			} else if (item.object_type = "JD") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			} else if (item.object_type = "PL") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			} else if (item.object_type = "PR") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			} else if (item.object_type = "ST") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			} else if (item.object_type = "TK") {
			$("#hidden_tooltip").append("<span><strong>UUID: </strong><br>" + activeUUID + "<strong>Title: </strong><br>" + item.title + "<strong>Description: </strong><br>" + item.description + "</span>");
			}
		});

	});	
}