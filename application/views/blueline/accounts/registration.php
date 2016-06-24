 <link href="<?=base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
 
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <?=form_open_multipart($form_action,' role="form" ');?>
                                    <div class="form-body">
                                        <h4><i class="fa fa-info"></i> Account information</h4>
                                         <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input id='username' minlength="6" maxlength="15" type="text" class="form-control" name="username" placeholder="Enter your username" required>
                                                    <label for="password">Username  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your username...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        
                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                                    <label for="email">Email  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your email...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="password" minlength="8" maxlength="15" class="form-control" name="password" placeholder="Enter your password" data-container="body" data-trigger="hover" data-content="Popover body goes here! Popover body goes here!" data-original-title="Another Popover" required>
                                                    <label for="password">Password  <span class="required">*</span></label>
                                                    <span class="blast"></span>
                                                    <span class="help-block">Must contain atleast 1 capital letter, 1 small letter, 1 number, and 1 speacial character.</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-cog" ></i>
                                                    </span>
                                                </div>
                                            </div>

                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="password" minlength="8" maxlength="15" class="form-control" name="rpassword" placeholder="Retype your password" required>
                                                    <label for="rpassword">Re-type Password  <span class="required">*</span></label>
                                                    <span class="help-block">Re-type your password...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>                                                
                                            </div>

                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="text" minlength="6" maxlength="30" class="form-control" name="title" placeholder="Enter your title" required>
                                                    <label for="password">Title  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your title...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-share"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        
                                        <div class="form-group">
                                                <label><i class='fa fa-camera'></i> Profile picture</label>
                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                       <div class="form-control" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                            <span class="fileinput-filename"></span>
                                                       </div>
                                                            <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="file-name"> </span>
                                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                        <span class="label label-danger">NOTE!</span> Max picture dimention is 180x180
                                        </div>
                                        
                                        <br/>
                                        
                                        <div class="form-group">
                                                <label for="account_type"><i class='fa fa-cog'></i> Account type</label>
                                                <input type="checkbox" name='account_type' class='checkbox-beauty' data-labelauty="Admin"/>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                                <label for="modules"><i class='fa fa-cog'></i> Modules</label>
                                                <?php foreach ($modules as $key => $value) : ?>
                                                    <input type="checkbox" name='access[]'  value="<?=$value->id;?>" class='checkbox-beauty' data-labelauty="<?=$value->name;?>"/>
                                                <?php endforeach; ?>
                                        </div>
                                        
                                        <hr/>
                                        <br/>   

                                         <h4><i class="fa fa-info"></i> Personal information</h4>
                                           
                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="text" minlength="3" maxlength="30" class="form-control" name="firstname" placeholder="Enter your firstname" required>
                                                    <label for="password">Firstname  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your firstname...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                                <div class="input-group">
                                                    <input type="text" minlength="3" maxlength="30" class="form-control" name="middlename" placeholder="Enter your middlename">
                                                    <label for="password">Middlename  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your middlename...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        <div class="form-group form-md-line-input last">
                                                <div class="input-group">
                                                    <input type="text" minlength="3" maxlength="30" class="form-control" name="lastname" placeholder="Enter your lastname" required>
                                                    <label for="password">Lastname  <span class="required">*</span></label>
                                                    <span class="help-block">Enter your lastname...</span>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        <div class="modal-footer form-actions">
                                            <div class="row">
                                                <div class="">
                                                    <button type="submit" class="btn btn-circle blue">Submit</button>
                                                    <button data-dismiss='modal' class="btn btn-circle btn-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>

<script src="<?=base_url();?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script type="text/javascript">
    $('document').ready(function(){
        jQuery.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value != $(param).val();
        }, "This has to be different...");

        $.validator.addMethod("checkUsername", function(value, element) {
                var result = false;
                
                $.ajax({
                    type:"POST",
                    dataType: 'json',
                    data: { "username": value, "token": token,  "mode": "username"},
                    async: false,
                    processData: true,
                    url: base_url + "accounts/verify",
                    
                    success: function(response) {
                        result = (response.message)? false: true;

                        token_name = response.token_name;
                        token = response.token;

                        //console.log(result);
                    }

                });
                return result;

                //console.log("value : " + value + " - xxx - element : " + element.name);
            }, 
           "Username already in use."
        );

        $.validator.addMethod("checkEmail", function(value, element) {
                var result = false;
                
                $.ajax({
                    type:"POST",
                    dataType: 'json',
                    data: { "email": value, "token": token,  "mode": "email"},
                    async: false,
                    processData: true,
                    url: base_url + "accounts/verify",
                    
                    success: function(response) {
                        result = (response.message)? false: true;

                        token_name = response.token_name;
                        token = response.token;

                        //console.log(result);
                    }

                });
                return result;

                //console.log("value : " + value + " - xxx - element : " + element.name);
            }, 
           "Email address already in use."
        );

        $(".checkbox-beauty").labelauty({ 
            //checked_label: "You selected this",
            //unchecked_label: "You don't want it",
            minimum_width: "100%" 
        });

        $('form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input

            rules: {
                username: {
                    pattern: "(?=^.{3,20}$)^[a-zA-Z][a-zA-Z0-9]*[._-]?[a-zA-Z0-9]+$",
                    checkUsername: true,
                },

                email: {
                    checkEmail: true,
                    email: true,
                },

                password: {
                    required: true,
                    pattern: "^(?!\.[\d]+)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).+$",
                    notEqual: "#username",
                },

                rpassword: {
                    required: true,
                    equalTo: "input[name=password]",
                    notEqual: "#username",
                },
                title:{
                    pattern: "^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$",
                },
                firstname:{
                    pattern: "^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$",
                },
                middlename:{
                    pattern: "^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$",
                },
                lastname:{
                    pattern: "^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$",
                }
            },

            messages:{
                password: {
                    notEqual: "Password must not be the same as your username.",
                },
                rpassword: {
                    notEqual: "Password must not be the same as your username.",
                    equalTo: "Password does not match."
                }

            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function(element) { // hightlight error inputs
                //if(element.type != 'checkbox'){ 
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group 
                //}
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

        });
    });
 </script>
