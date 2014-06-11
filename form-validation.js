var FormValidation = function () {

    // advance validation
    var handleValidation3 = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

            var form3 = $('#form_sample_3');
            var error3 = $('.alert-danger', form3);
            var success3 = $('.alert-success', form3);


            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    'username': {
                        minlength: 2,
                        required: true
                    },
                    'password': {
                        minlength: 2,
                        required: true
                    },
                    'rpassword': {
                        minlength: 2,
                        required: true,
                        equalTo: "#password_strength"
                    },
                    'firstname': {
                        minlength: 2,
                        required: true
                    },
                    'middlename': {
                        minlength: 2,
                        required: true
                    },
                    'lastname': {
                        minlength: 2,
                        required: true
                    },
                    'contact': {
                        minlength: 12,
                        required: true
                    },
                    'address': {
                        minlength: 6,
                        required: true
                    },
                    'email': {
                        required: true,
                        email: true
                    },  
                    'access-level': {
                        required: true
                    },
                    'gender': {
                        required: true
                    },
                    'birthday': {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    username: {
                        required: "Please type your username."
                    },
                    password: {
                        required: "Please type your password."
                    },
                    rpassword: {
                        required: "Please retype your password.",
                        equalTo: "Your password does not match."
                    },
                    service: {
                        required: "Please select  at least 2 types of Service",
                        minlength: jQuery.validator.format("Please select  at least {0} types of Service")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success3.hide();
                    error3.show();
                    Metronic.scrollTo(error3, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    form3.submit();
                    //success3.show();
                    //error3.hide();
                }

            });

             //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2me', form3).change(function () {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });


            //initialize datepicker
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true
            });
            $('.date-picker .form-control').change(function() {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input 
            })
    }

    return {
        //main function to initiate the module
        init: function () {
            
            handleValidation3();

        }

    };

}();
