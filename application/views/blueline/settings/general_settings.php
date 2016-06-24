<div class="portlet light portlet-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">General web application settings</span>
                            </div>
                            
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?=form_open_multipart($form_action,' role="form" ')?>
                                    <table id="user" class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td style="width:15%">Company name : </td>
                                                <td style="width:50%">
                                                   <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Company name" minlength="1" maxlength="255" name="company" value="<?=$settings->company;?>" required/>
                                                </td>
                                                <td style="width:35%">
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Address" name="address" minlength="3" maxlength="255" value="<?=$settings->address;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>City : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="City" name="city" minlength="3" maxlength="60" value="<?=humanize($settings->city);?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Contact person" minlength="3" maxlength="150" name="contact_person" value="<?=humanize($settings->contact_person);?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Number : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Contact number" maxlength="15" name="contact_number" value="<?=humanize($settings->contact_number);?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User credential email subject : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Credential email subject" maxlength="150" name="credentials_mail_subject" value="<?=$settings->credentials_mail_subject;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User password reset subject : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Password reset subject" maxlength="150" name="pw_reset_mail_subject" value="<?=$settings->pw_reset_mail_subject;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>Logo : </td>
                                                <td>
                                                   <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                       <div class="form-control" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                            <span class="fileinput-filename"></span>
                                                       </div>
                                                      
                                                       <span class="input-group-addon btn blue btn-default btn-file">
                                                          <span class="fileinput-new">Select file</span>
                                                          <span class="fileinput-exists red">Change</span>
                                                          <input type="file" name="logo">
                                                       </span>
                                                      
                                                      <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                   </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted"><span class="label label-danger">NOTE!</span> Max picture dimention is 800x800</span>
                                                    <br/><br/>
                                                    <center><img src="files/media/<?=$settings->logo;?>" alt="Logo" width="30%"></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" name="email" maxlength="150" value="<?=$settings->email;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Domain : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="url" autocomplete="off" placeholder="Domain" name="domain" maxlength="60" value="<?=$settings->domain;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Full URL to your web application installation. Including subfolder i.e. http://www.yoursite.com/webapp/</span>
                                                </td>
                                            </tr>
                                               <tr>
                                                <td>User Idle time : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="number" name="idle" min="1" value="<?=$settings->idle;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Number of seconds before the system locks down when user is idle.</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rectangle logo : </td>
                                                <td>
                                                   <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                       <div class="form-control" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                            <span class="fileinput-filename"></span>
                                                       </div>
                                                      
                                                       <span class="input-group-addon btn blue btn-default btn-file">
                                                          <span class="fileinput-new">Select file</span>
                                                          <span class="fileinput-exists red">Change</span>
                                                          <input type="file" name="small-logo">
                                                       </span>
                                                      
                                                      <a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                   </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted"><span class="label label-danger">NOTE!</span> Max picture dimention is 94x14</span>
                                                    <br/><br/>
                                                    <center><img style="background-color: #000; width: 60%;" alt="Logo" src="files/media/<?=$settings->small_logo;?>"></center>
                                                </td>
                                            </tr>
                                             <tr style="border-collapse: initial;">
                                                <td>Maintenance mode : </td>
                                                <td>
                                                    <div class="form-group">
                                                         <input type="checkbox" name='maintenance' class='checkbox-fullsize' data-labelauty="Maintenance mode disabled|Maintenance mode enabled" <?php echo ($settings->maintenance)? "checked": "";?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Short website description : </td>
                                                <td>
                                                   <textarea name="short_description" maxlength="1000" class="form-control" rows="13"><?=$settings->short_description;?></textarea>
                                                </td>
                                                <td>
                                                     <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Full website description : </td>
                                                <td colspan="2">
                                                    <textarea name="full_description" maxlength="10000" id="settings_about"><?=$settings->full_description;?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                     <div class="form-action pull-right">
                                                        <button type="submit" class="btn blue">Save</button>
                                                     </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  <?=form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>                    
