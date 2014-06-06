$(document).ready(function(){           

//	script = document.createElement(”script”);
//	script.type = “text/javascript”;
//	script.src = “http://www.someWebApiServer.com/some-data?callback=my_callback”;



});
function getStores(){
	$.getJSON(
		'//epiplace.com/app/db/table/stores?callback=?', 
		function(data) {
			$('#storelist1').empty();
	  		$.each(data, function(key, value) {
				$('<li><a href="#recipeprofile"><img src="images/storelogo/johnsmarket_logo.jpg" /><h2>' + value.stores_name + '</h2><p>' + value.stores_street_address + +value.stores_street_address_line_2 + + value.stores_street_address_city + "," + value.stores_street_address_state + + value.stores_street_address_zip +'</p></a></li>').appendTo( "#storelist1" );
	    	});
	  	}
	);
};