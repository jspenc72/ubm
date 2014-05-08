function checkEmail() {

                var email = document.getElementById('reg_email');
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
                if (!filter.test(email.value)) {
                	$().toastmessage('showErrorToast', 'Please provide a valid email address');
                reg_email.focus;
                return false;
             }
            }