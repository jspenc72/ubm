window.globalCounter = 0;
        	function getTodaysDate () {
        		window.today = new Date();
        		window.dd = today.getDate(); 
        		window.mm = today.getMonth()+1;
        		window.yyyy = today.getFullYear(); 
        		window.h = today.getHours();
        		window.m = today.getMinutes();
        		window.s = today.getSeconds();
        	}
        	function fillTodaysDate() {
        		getTodaysDate();
        		document.getElementById('mcs_setup_checklist_p4_b1_NewBusinessAccount_popup_form_TodaysDate').value= '' + window.mm + '/' + window.dd + '/' + window.yyyy + '';
        	}
        	function greetUser() {
        		$().toastmessage({position : 'bottom-right'});
        		getTodaysDate();
        		if (window.h >=5 && window.h<12) {
        			$().toastmessage('showSuccessToast', "Good Morning " + window.username + "");
        		}
        		if (window.h >=12 && window.h<17) {
        			$().toastmessage('showSuccessToast', "Good Afternoon " + window.username + "");
        		}
        		if (window.h >=17 && window.h<20) {
        			$().toastmessage('showSuccessToast', "Good Evening " + window.username + "");

        		}
        		if (window.h >=20 && window.h<=24 || window.h>=1 && window.h <5) {
        			$().toastmessage('showWarningToast', "You Should Go To Bed " + window.username + "");
        		}
        		
        		
        	}