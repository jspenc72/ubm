//4. Call this callback function when the GAPI auth request has finished.
	  var loginFinished = function(authResult) {
		  if (authResult) {
		  	//4.1 Load the users profile picture and email address		  	
		        gapi.client.load('plus','v1', loadProfile);  // Trigger request to get the email address.
		   //console.log(authResult);
		    var el = document.getElementById('oauth2-results');
		    var label = '';
		    toggleDiv('oauth2-results');
		    if (authResult['status']['signed_in']) {
		    	//User has authenticated using the google plus api
		      label = 'Welcome to the UBM! You have successfully signed in with your Google + Account.';
		      gapi.auth.setToken(authResult);
		    } else {
		      label = 'User denied access: ' + authResult['error'];
		    }
		    el.innerHTML = label /* + '<pre class="prettyprint"><code>' +
		        // JSON.stringify doesn't work in IE8.
		        '{<br />' +
		        '  "id_token" : "' + authResult['id_token'] +'",<br />' +
		        '  "access_token" : "' + authResult['access_token'] + '",<br />' +
		        '  "state" : "' + authResult['state'] + '",<br />' +
		        '  "expires_in" : "' + authResult['expires_in'] + '",<br />' +
		        '  "error" : "' + authResult['error'] + '",<br />' +
		        '  "error_description" : "' + authResult['error_description'] + '",<br />' +
		        '  "authUser" : "' + authResult['authuser'] + '",<br />' +
		        '  "status" : {"' + '<br />' +
		        '    "google_logged_in" : "' + authResult['status']['google_logged_in'] + '",<br />' +
		        '    "method" : "' + authResult['status']['method'] + '",<br />' +
		        '    "signed_in" : "' + authResult['status']['signed_in'] + '"<br />' +
		        '  }<br />' +
		        '}</code></pre>';*/
		  } else {
		    document.getElementById('oauth2-results').innerHTML =
		        'Empty authResult';
		  }
	  };
	  function loadProfile(){
	    var request = gapi.client.plus.people.get( {'userId' : 'me'} );
	    request.execute(loadProfileCallback);
	  }
	  /**
	   * Callback for the asynchronous request to the people.get method. The profile
	   * and email are set to global variables. Triggers the user's basic profile
	   * to display when called.
	   */
		function loadProfileCallback(obj) {
		    profile = obj;
		    window.profile = obj;
		    // Filter the emails object to find the user's primary account, which might
		    // not always be the first in the array. The filter() method supports IE9+.
		    email = obj['emails'].filter(function(v) {
		        return v.type === 'account'; // Filter out the primary email
		    })[0].value; // get the email from the filtered results, should always be defined.
		    var displayName = profile['displayName'];
		    displayProfile(profile);
		  	//Create account in ubm db
		    createUBMUser(email, displayName, profile);
		}
		function createUBMUser(email, displayName, profile){
			$.getJSON('http://api.universalbusinessmodel.com/ubms_createAccount_GAPI.php?callback=?', {//JSONP Request
				key : "YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD",
				displayNameGAPI : displayName,
				emailGAPI: email
			}, function(res, status) {
				alert(res.message);
				if(status=="success"){
	    			//Set Username window Variable
					window.username = email.split("@", 1).toString();		
					redirectUserToUserDashboard(profile);
				}
			});					
		}
		function redirectUserToUserDashboard(profile){
			window.location = "#ubmsuite_SelectBusinessModel";
		    displayProfile(profile);
		}	  
	  /**
	   * Display the user's basic profile information from the profile object.
	   */
	  function displayProfile(profile){
	    document.getElementById('name').innerHTML = window.profile['displayName'];
	    document.getElementById('pic').innerHTML = '<img src="' + window.profile['image']['url'] + '" />';
	    document.getElementById('email').innerHTML = email;
	    toggleElement('profile');
	  }
	  function getPersonsVisibleCircle(){
		//Get a persons visible circle
		gapi.client.load('plus','v1', function(){
		 var request = gapi.client.plus.people.list({
		   'userId': 'me',
		   'collection': 'visible'
		 });
		 request.execute(function(resp) {
		   document.getElementById('numFriends').innerHTML = "Friends: " + resp.totalItems;
			$.each(resp.items, function(i, item) {
				$("#friendListview").append("<li><a href='" + item.url + "'><img src='" + item.image.url + "' alt='France' class='ui-li-icon ui-corner-none'>" + item.displayName + "</a></li>");
				$('#friendListview').listview("refresh");
				// alert(item.displayName);
			});
		 });
		});	  	
	  }
	  /**
	   * Utility function to show or hide elements by their IDs.
	   */
	  function toggleElement(id) {
	    var el = document.getElementById(id);
	    if (el.getAttribute('class') == 'hide') {
	      el.setAttribute('class', 'show');
	    } else {
	      el.setAttribute('class', 'hide');
	    }
	  }
	//1. Set options for the Google API request.
	  var options = {
	    'callback' : loginFinished,
	    'approvalprompt' : 'force',
	    'clientid' : '987154660482-1mc6t6c29ltsapkuuivkh9mncnku1qq3.apps.googleusercontent.com',
	    'requestvisibleactions' : 'http://schemas.google.com/CommentActivity http://schemas.google.com/ReviewActivity',
	    'cookiepolicy' : 'single_host_origin',
	    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read https://www.googleapis.com/auth/plus.me',
	  };
	//2. The onclick method that is called when user clicks Sign Up!
	  function startFlow(){
	    //toggleDiv('startFlow');
	    gapi.auth.signIn(options);
	  }
	//3. Funciton to hide the sign in button when user signs in.	
	  function toggleDiv(id) {
	    var div = document.getElementById(id);
	    if (div.getAttribute('class') == 'hide') {
	      div.setAttribute('class', 'show');
	    } else {
	      div.setAttribute('class', 'hide');
	    }
	  }	