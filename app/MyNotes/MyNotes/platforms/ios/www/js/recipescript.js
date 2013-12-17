
$(document).ready(function(){           

//	script = document.createElement(”script”);
//	script.type = “text/javascript”;
//	script.src = “http://www.someWebApiServer.com/some-data?callback=my_callback”;



});
function getRecipes(){
	$.getJSON(
		'//epiplace.com/app/db/table/recipes?callback=?', 
		function(data) {
			$('#recipelist1').empty();
	  		$.each(data, function(key, value) {
				$('<li><a href="#recipeprofile"><img src="images/recipes/icon_appetizers.jpg" /><h2>' + value.recipes_categories_name + '</h2><p>' + value.recipes_categories_id_parent + '</p></a></li>').appendTo( "#recipelist1" );
	    	});
	  	}
	);
};