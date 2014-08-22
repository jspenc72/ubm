function getUsersProfile() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getUsersProfile.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username
    }, function(res, status) {
        $('#welcome_user').empty();
        $('.user_bio').empty();
        $('.user_phone').empty();
        $('#models_created').empty();
        $('#shared_models').empty();
        $('#total_objects_created').empty();
        $.each(res, function(i, item) {
            $('#welcome_user').append('Welcome ' + item.username);
            $('#models_created').append('Models Created: ' + item.num_models_created);
            $('#shared_models').append('Shared Models: ' + item.num_shared_models);
            $('#total_objects_created').append('Positions: ' + item.num_created_positions);
            $('#total_objects_created').append('</br>Job Descriptions: ' + item.num_created_jobdescriptions);
            $('#total_objects_created').append('</br>Policies: ' + item.num_created_policies);
            $('#total_objects_created').append('</br>Procedures: ' + item.num_created_procedures);
            $('#total_objects_created').append('</br>Steps: ' + item.num_created_steps);
            $('#total_objects_created').append('</br>Tasks: ' + item.num_created_tasks);
            $('#total_objects_created').append('</br>Total: ' + item.num_created_model_hierarchical_objects);
            $('#settings_user_first_name').val(item.first_name);
            $('#settings_user_last_name').val(item.last_name);
            $('#settings_user_employer').val(item.employer);
            if (item.user_sms_preference==1) {
                $('#settings_user_sms_preference').prop( "checked", true );
            }else{
                $('#settings_user_sms_preference').prop( "checked", false );
            }
            if (item.user_email_preference==1) {
                $('#settings_user_email_preference').prop( "checked", true );
            }else{
                $('#settings_user_email_preference').prop( "checked", false );
            }
            if (item.bio == null) {
                $('.user_bio').append("Visit Settings to update bio.");
            } else { 
                $('.user_bio').append(item.bio);
                $('.user_bio').val(item.bio);
            }
            if (item.phone_number == null || item.phone_number==0) {
                $('.user_phone').append("Your phone number isn't set. Update your mobile number to receive text notifications from UBM applications");
            }else{
                $('.user_phone').val(item.phone_number);
            }
            if (item.wireless_carrier=="Verizon") {
                $("#settings_user_wirelesscarrier").val("Verizon");
            }else if(item.wireless_carrier=="AT&T"){
                $("#settings_user_wirelesscarrier").val("AT&T");
            }else if(item.wireless_carrier=="T-Mobile"){
                $("#settings_user_wirelesscarrier").val("T-Mobile");
            }else{                
                $("#settings_user_wirelesscarrier").val("Other");
            }
        });
    });
}

function updateUserBiography(){
    event.preventDefault();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_updateUserBio.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        user_bio: document.getElementById("settings_user_bio").value,
        user_first_name: document.getElementById("settings_user_first_name").value,
        user_last_name: document.getElementById("settings_user_last_name").value,
        user_employer: document.getElementById("settings_user_employer").value
    }, function(res, status) {
        alert(res.message);
    });    
}

function updateUserPhone(){
    event.preventDefault();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_updateUserPhone.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        user_phone: document.getElementById("settings_user_phone").value,
        user_wireless_carrier: $('select[id="settings_user_wirelesscarrier"]').val()
    }, function(res, status) {
        alert(res.message);
    });    
}

function updateUserNotificationPreferences(){
    event.preventDefault();
    var user_sms_preference = 0; var user_email_preference = 0;
    if($('#settings_user_sms_preference').is(':checked')){
        user_sms_preference = 1;
        // alert(user_sms_preference);
    }else{} 
    if($('#settings_user_email_preference').is(':checked')){
        user_email_preference = 1
        // alert(user_email_preference);
    }else{}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_updateUserNotificationPreferences.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        user_sms_preference: user_sms_preference,
        user_email_preference: user_email_preference
    }, function(res, status) {
        alert(res.message);
    });    
}