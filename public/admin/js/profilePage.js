

$("#editAdminAccountForm").validate({
    rules: {
        adminAccountName: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        adminAccountEmail: {
            required: true,
            email: true
        },
        adminAccountCurrentPassword: {
            minlength: 3,
            maxlength: 20
        },
        adminAccountNewPassword:{

            minlength: 3,
            maxlength: 20

        },
        adminAccountConfirmPassword:{

            
            minlength: 3,
            maxlength: 20,
            equalTo: "#adminAccountNewPassword"

        }
    },
    messages: {
        adminAccountName: {
            required: "Admin Name is required",
            minlength: "Admin Name must be at least 3 characters",
            maxlength: "Admin Name must be no more than 20 characters"
        },
        adminAccountEmail: {
            required: "E-Mail is required",
        },
        adminAccountCurrentPassword: {
            minlength: "Password must be at least 5 characters",
            maxlength: "Password must be no more than 20 characters"
        },
        adminAccountNewPassword:{

            minlength: "Password must be at least 5 characters",
            maxlength: "Password must be no more than 20 characters"

        },
        adminAccountConfirmPassword:{

            minlength: "Password must be at least 5 characters",
            maxlength: "Password must be no more than 20 characters"
        }
    },

    // account Submit Handler
    submitHandler: function (form, e) {

        e.preventDefault();

        let url = "/admin/profile"; // the script where you handle the form input.

        let adminAccountName = $("#adminAccountName").val();
        let adminAccountEmail = $("#adminAccountEmail").val();
        let adminAccountCurrentPassword = $("#adminAccountCurrentPassword").val();
        let adminAccountNewPassword = $("#adminAccountNewPassword").val();
        let adminAccountConfirmPassword = $("#adminAccountConfirmPassword").val();

        var form = $('#editAdminAccountForm');

        $.ajax({
            type: "POST",
            url: url,
            data:form.serialize(),
            beforeSend: function() {

                $('.ajax-loading').css('display', 'block');

            },
            complete: function() {

                $('.ajax-loading').css('display', 'none');

            },
            success: function (data) {
                console.log(data);
                if(data == "success"){
                  
                    Swal({
                            title: "Welcome to Zidni institute ",
                            text: 'An Accredited Branch of the Islamic University of Minnesota',
                            imageUrl: 'http://placehold.it/150x150',
                            imageWidth: 150,
                            imageHeight: 150,
                            imageAlt: 'Zidni Logo',
                            animation: true,
                            showCancelButton: false,
                            confirmButtonColor: '#f1dd7e',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'START LEARNING',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            width: '60rem',
                            customClass: 'welcomeAlertMessage'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "http://localhost:8000/admin/profile";
                            }
                        });

                        $("body").css('padding-right', '0px');

                }else if(data == "failure"){
                    $('#msgs').html('<li id="last" class="alert alert-danger" ><b>The current password you entered is incorrect</b></li>');
                    $(".alert").fadeOut(6000);
                }
               
            },
            error: function (data) {
                console.log('error');
            },


        });

        e.preventDefault();

    }

});






$("#adminChangeEmailForm").validate({
    rules: {
        adminChangeEmailNew: {
            required: true,
            email: true
        },
        adminChangeEmailPassword: {
            required: true,
            minlength: 5,
            maxlength: 20

        },
    },
    messages: {
        adminChangeEmailNew: {
            required: "E-Mail is required",
        },
        adminChangeEmailPassword: {
            required: "Password is required",
            minlength: "Password must be at least 5 characters",
            remote: "Password must be no more than 20 characters"
        }
    },

    // change email Submit Handler
    submitHandler: function (form, e) {

        let url = "/admin/change-email"; // the script where you handle the form input.

        let adminChangeEmailNew = $("#adminChangeEmailNew").val();
        let adminChangeEmailPassword = $("#adminChangeEmailPassword").val();

        var form = $('#adminChangeEmailForm');

        $.ajax({
            type: "POST",
            url: url,
            data:form.serialize(),
            beforeSend: function() {

                $('.ajax-loading').css('display', 'block');

            },
            complete: function() {

                $('.ajax-loading').css('display', 'none');

            },
            success: function (data) {
                console.log(data)
                if(data == 'success'){
                    Swal({
                        title: "Welcome to Zidni institute ",
                        text: 'An Accredited Branch of the Islamic University of Minnesota',
                        imageUrl: 'http://placehold.it/150x150',
                        imageWidth: 150,
                        imageHeight: 150,
                        imageAlt: 'Zidni Logo',
                        animation: true,
                        showCancelButton: false,
                        confirmButtonColor: '#f1dd7e',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'START LEARNING',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        width: '60rem',
                        customClass: 'welcomeAlertMessage'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "http://localhost:8000/admin/profile";
                        }
                    });

                    $("body").css('padding-right', '0px');
                }else if(data == 'failure'){
                    $('#email').html('<li id="last" class="alert alert-danger" ><b>The current password you entered is incorrect</b></li>');
                    $(".alert").fadeOut(6000);
                }
               
            },
            error: function (data) {

                console.log('error')

            },


        });

        e.preventDefault();

    }



});



// image upload




$('.dropify').dropify({

    messages: {
        'default': 'Drag and drop a profile image here or click',
        'replace': 'Drag and drop or click to replace your profile image',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.',
        'test':    'Your image should be at minimum 200x200 pixels and maximum 6000x6000 pixels'
        
    },
    tpl: {
        wrap:            '<div class="dropify-wrapper"></div>',
        loader:          '<div class="dropify-loader"></div>',
        message:         '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
        preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p><p class="dropify-infos-message">{{ test }}</p></div></div></div>',
        filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
        clearButton:     '<button type="button" class="dropify-clear">{{ remove }}</button>',
        errorLine:       '<p class="dropify-error">{{ error }}</p>',
        errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
    },
    error: {
        'fileSize': 'The file size is too big ( {{ value }} max ).',
        'minWidth': 'The image width is too small ( {{ value }} px min ).',
        'maxWidth': 'The image width is too big ( {{ value }} px max ).',
        'minHeight': 'The image height is too small ( {{ value }} px min ).',
        'maxHeight': 'The image height is too big ( {{ value }}px max ).',
        'imageFormat': 'The image format is not allowed ( {{ value }} only ).'
    }

});





// Notifaction



$("#adminNotificationsForm").validate({


    // change email Submit Handler
    submitHandler: function (form, e) {

        let url = "/api/test"; // the script where you handle the form input.

        let adminSendMeNotifications = $("#adminSendMeNotifications").val();
        let adminDontSendMeNotifications = $("#adminDontSendMeNotifications").val();

        $('#adminNotificationsForm input').on('change', function() {

            let seletedOption = $('input[name=notificationsControl]:checked', '#adminNotificationsForm').val()

        });


        $.ajax({
            type: "POST",
            url: url,
            data:{},
            beforeSend: function() {

                $('.ajax-loading').css('display', 'block');

            },
            complete: function() {

                $('.ajax-loading').css('display', 'none');

            },
            success: function (data) {
                console.log(data)               
            },
            error: function (data) {

                console.log('error')


                let seletedOption = $('input[name=notificationsControl]:checked', '#adminNotificationsForm').val()

                if (seletedOption == 1){



                    Swal({
                        title: "Done",
                        text: 'Zidni will send you notifications about new lectures ،live classes ، instructor answers ، grades published',
                        imageUrl: 'http://placehold.it/150x150',
                        imageWidth: 150,
                        imageHeight: 150,
                        imageAlt: 'Zidni Logo',
                        animation: true,
                        showCancelButton: false,
                        confirmButtonColor: '#f1dd7e',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Great',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        width: '60rem',
                        customClass: 'welcomeAlertMessage'
                    }).then((result) => {
                        if (result.value) {
                        }
                    });
    
                    $("body").css('padding-right', '0px');




                } else {


                    Swal({
                        title: "Done",
                        text: 'Zidni will no longer send you notifications',
                        imageUrl: 'http://placehold.it/150x150',
                        imageWidth: 150,
                        imageHeight: 150,
                        imageAlt: 'Zidni Logo',
                        animation: true,
                        showCancelButton: false,
                        confirmButtonColor: '#f1dd7e',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Great',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        width: '60rem',
                        customClass: 'welcomeAlertMessage'
                    }).then((result) => {
                        if (result.value) {
                        }
                    });
    
                    $("body").css('padding-right', '0px');



                }

            },


        });

        e.preventDefault();

    }



});



