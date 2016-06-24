 <!-- END THEME PANEL -->
                    <h3 class="page-title">User account information</h3>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet ">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="<?=base_url();?>files/media/avatars/<?=$user_info->userpic;?>" class="img-responsive" alt="Profile picture"> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?=humanize($user_info->firstname ." ". $user_info->middlename ." ". $user_info->lastname );?> </div>
                                        <div class="profile-usertitle-job">Role: <?=($user_info->admin)? "Administrator" :"Editor";?> </div>
                                        <div class="profile-usertitle-job">Username: <?=$user_info->username;?> </div>
                                        <div class="profile-usertitle-job">Title: <?=$user_info->title;?> </div>
                                        <div class="profile-usertitle-job">Status: <span class="font-<?php if($user_info->status == "active"){ echo "green"; }elseif($user_info->status == "inactive"){ echo "yellow"; }else{ echo "red"; } ?>" > <?=$user_info->status;?> </span> </div>
                                    </div>

                                    <!-- END SIDEBAR USER TITLE -->
                                    <?php if($this->user->id != $user_info->id): ?>
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
                                        <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <?php endif; ?>
                                    <!-- SIDEBAR MENU -->
                                    <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li <?php if(!$edit):?> class="active" <?php endif; ?> >
                                                <a href="<?=base_url();?>accounts/view/<?=$user_info->view_id;?>">
                                                    <i class="icon-home"></i> Overview </a>
                                            </li>
                                            <li <?php if($edit):?> class="active" <?php endif; ?> >
                                                <a href="<?=base_url();?>accounts/edit/<?=$user_info->view_id;?>">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- END MENU -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                <div class="portlet light ">
                                    <!-- STAT -->
                                    <div class="row list-separated profile-stat">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 37 </div>
                                            <div class="uppercase profile-stat-text"> Projects </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 51 </div>
                                            <div class="uppercase profile-stat-text"> Tasks </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 61 </div>
                                            <div class="uppercase profile-stat-text"> Uploads </div>
                                        </div>
                                    </div>
                                    <!-- END STAT -->
                                    <div>
                                        <h4 class="profile-desc-title">About <?=humanize($user_info->firstname ." ". $user_info->middlename ." ". $user_info->lastname );?> </h4>
                                        <span class="profile-desc-text"> <?=$user_info->about;?> </span>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-globe"></i>
                                            <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                                        </div>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-twitter"></i>
                                            <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                        </div>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-facebook"></i>
                                            <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Account profile</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                <?php if($edit): ?>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                    </li>
                                                   <?php if($this->user->admin): ?>
                                                    <li>
                                                        <a href="#tab_1_4" data-toggle="tab">Account Settings</a>
                                                    </li>
                                                   <?php endif; ?>
                                                <?php endif; ?>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <?=form_open_multipart($form_action,' role="form" ');?>
                                                        <input type="hidden" name="view_id" value="<?=$user_info->view_id;?>">
                                                        <input type="hidden" name="mode" value="personal">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="30" name="firstname" value="<?=humanize($user_info->firstname);?>" placeholder="<?=humanize($user_info->firstname);?>" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Middle Name</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="30" name="middlename" value="<?=humanize($user_info->middlename);?>" placeholder="<?=humanize($user_info->middlename);?>" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="30" name="lastname" value="<?=humanize($user_info->lastname);?>" placeholder="<?=humanize($user_info->lastname);?>" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="6" maxlength="30" name="title" value="<?=humanize($user_info->title);?>" placeholder="<?=humanize($user_info->title);?>" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Email address</label>
                                                                <input type="email" <?php echo (!$edit) ? "readonly": "";?> name="email" value="<?=$user_info->email;?>" placeholder="<?=$user_info->email;?>" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Mobile Number</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="7" maxlength="13" name="mobile" value="<?=$user_info->mobile;?>" placeholder="<?=humanize($user_info->mobile);?>" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Interests</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="60" name="interest" value="<?=humanize($user_info->interest);?>" placeholder="<?=humanize($user_info->interest);?>" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Occupation</label>
                                                                <input type="text" <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="60" name="occupation" value="<?=humanize($user_info->occupation);?>" placeholder="<?=humanize($user_info->occupation);?>" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">About</label>
                                                                <textarea <?php echo (!$edit) ? "readonly": "";?> minlength="3" maxlength="250" class="form-control" rows="3" name="about" placeholder="<?=humanize($user_info->about);?>"><?=$user_info->about;?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Website Url</label>
                                                                <input type="url" <?php echo (!$edit) ? "readonly": "";?> placeholder="http://www.mywebsite.com" class="form-control" /> 
                                                            </div>
                                                            <?php if($edit):?>
                                                            <div class="margiv-top-10">
                                                                <button type="submit" class="btn green"> Save Changes </button>
                                                                <a href="<?=base_url();?>accounts" class="btn default"> Cancel </a>
                                                            </div>
                                                            <?php endif;?>
                                                        <?=form_close();?>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <?php if($edit): ?>
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        <p>Update avatar</p>
                                                        <?=form_open_multipart($form_action,' role="form" ');?>
                                                        <input type="hidden" name="view_id" value="<?=$user_info->view_id;?>">
                                                        <input type="hidden" name="mode" value="avatar">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="file-name"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix margin-top-10">
                                                                    <span class="label label-danger">NOTE! </span>
                                                                    <span>&nbsp; Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only and maximum image size is 180x180.</span>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <button type="submit" class="btn green"> Submit </button>
                                                                <a href="<?=base_url();?>accounts" class="btn default"> Cancel </a>
                                                            </div>
                                                        <?=form_close();?>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <?=form_open_multipart($form_action,' role="form" ');?>
                                                        <input type="hidden" name="username" value="<?=$user_info->username;?>">
                                                        <input type="hidden" name="mode" value="password_update">
                                                            <div class="form-group">
                                                                <label class="control-label">Current Password</label>
                                                                <input type="password" name="old_pass" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">New Password</label>
                                                                <input type="password" name="new_pass" class="form-control" required/> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Re-type New Password</label>
                                                                <input type="password" name="confirm_pass" class="form-control" required/> </div>
                                                            <div class="margin-top-10">
                                                                <button type="submit" class="btn green"> Change Password </button>
                                                                <a href="<?=base_url();?>accounts" class="btn default"> Cancel </a>
                                                            </div>
                                                        <?=form_close();?>
                                                    </div>
                                                    <!-- END CHANGE PASSWORD TAB -->
                                                    <?php if($this->user->admin): ?>
                                                    <!-- ACCOUNT SETTINGS TAB -->
                                                    <div class="tab-pane " id="tab_1_4">
                                                            <?=form_open_multipart($form_action,' role="form" ');?>
                                                            <input type="hidden" name="view_id" value="<?=$user_info->view_id;?>">
                                                            <input type="hidden" name="mode" value="account_settings">
                                                            <div class="form-body">  
                                                            
                                                            <table class="table table-bordered table-striped">    
                                                            <tr style="border-collapse: initial;">
                                                                <td>                                                          
                                                                        <label class="control-label col-md-3">Modules</label>
                                                                </td>
                                                                <td style="vertical-align: top !important;">                                                                    
                                                                        <ul class="nav_section list-unstyled">
                                                                        <?php 
                                                                            $access = array();
                                                                            if(isset($user_info)){ $access = explode(",", $user_info->access); $access_child = explode(",", $user_info->access_child);}
                                                                            foreach($modules as $key => $value) : ?>
                                                                            <li><input type="checkbox" name='access[]' id="<?=$value->name;?>"  value="<?=$value->id;?>" class='checkbox-beauty' <?php if(in_array($value->id, $access)){ echo 'checked="checked"';}?> data-labelauty="<?=$value->name;?>"/>
                                                                                <?php if($value->has_child): ?>
                                                                                    <ul id="<?=$value->name;?>_sub_child" class="list-unstyled <?php if(!in_array($value->id, $access)){ echo 'display-none';}?>">
                                                                                        <?php foreach($navchild[$value->name]['child_name'] as $index => $vals):?>
                                                                                            <li><input type="checkbox" name='access_child[]'  value="<?=$navchild[$value->name]['child_id'][$index];?>" class='checkbox-halfsize' <?php if(in_array($navchild[$value->name]['child_id'][$index], $access_child)){ echo 'checked="checked"';}?> data-labelauty="<?=$vals;?>"/></li>
                                                                                        <?php endforeach;?>
                                                                                    </ul>
                                                                                <?php endif;?>
                                                                            </li>
                                                                        <?php endforeach;?>
                                                                        
                                                                        </ul>
                                                                        
                                                                    </td>                                                       
                                                                </tr>

                                                                <tr style="border-collapse: initial;">
                                                                     <td>
                                                                        <label class="control-label col-md-3">Status</label>
                                                                     </td>
                                                                     
                                                                     <td>
                                                                          <ul class="list-unstyled list-inline">
                                                                              <li><input class="radio-beauty" type="radio" name="status" value="active" data-labelauty="Active" <?=($user_info->status == "active")? "checked": "";?> ></li>
                                                                              <li><input class="radio-beauty" type="radio" name="status" value="inactive" data-labelauty="Inactive" <?=($user_info->status == "inactive")? "checked": "";?> ></li>
                                                                              <li><input class="radio-beauty" type="radio" name="status" value="deleted" data-labelauty="Deleted" <?=($user_info->status == "deleted")? "checked": "";?> ></li>
                                                                       </ul>
                                                                     </td>
                                                                </tr>
                                                                
                                                                <tr style="border-collapse: initial;">
                                                                    <td>
                                                                        <label class="control-label col-md-3">Role</label>
                                                                    </td> 
                                                                    <td> 
                                                                          <ul class="list-unstyled list-inline">
                                                                              <li><input class="radio-beauty" type="radio" name="admin" value="1" data-labelauty="Admin" <?=($user_info->admin)? "checked": "";?> ></li>
                                                                              <li><input class="radio-beauty" type="radio" name="admin" value="0" data-labelauty="Editor" <?=(!$user_info->admin)? "checked": "";?> ></li>
                                                                          </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                <td> <label class="control-label col-md-3">Password reset</label></td>
                                                                <td><a href="<?=base_url()."accounts/send_credentials/".$user_info->view_id;?>" class="label label-sm label-danger" data-toggle='mainmodal'><i class="fa fa-envelope"></i> Email user details</a></td>
                                                                </tr>   
                                                            </div>
                                                            </table>
                                                            <div class="form-actions">
                                                                <div class="margin-top-10">
                                                                    <button type="submit" class="btn green"> Save Changes </button>
                                                                    <a href="<?=base_url();?>accounts" class="btn default"> Cancel </a>
                                                                </div>
                                                            </div>
                                                        <?=form_close();?>
                                                    </div>
                                                    <!-- END ACCOUNT SETTINGS TAB -->
                                                    <?php endif;?>
                                                <!-- end tab content -->
                                                <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                </div>
