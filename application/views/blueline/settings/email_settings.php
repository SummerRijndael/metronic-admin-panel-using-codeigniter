<div class="portlet light portlet-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">POP / IMAP / SMTP settings</span>
                            </div>
                            
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?=form_open_multipart($form_action,' role="form" ')?>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td colspan="3"> SMTP Settings </td>
                                            </tr>

                                            <tr>
                                                <td style="width:15%">Email protocol : </td>
                                                <td style="width:50%">
                                                   <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" minlength="1" maxlength="30" name="email_protocol" value="<?=$settings->email_protocol;?>" required/>
                                                </td>
                                                <td style="width:35%">
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hostname : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" name="email_host" minlength="3" maxlength="30" value="<?=$settings->email_host;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="" name="email_username" minlength="3" maxlength="30" value="<?=$settings->email_username;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="" minlength="3" maxlength="30" name="email_password" value="<?=$settings->email_password;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Port Number : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="number" min="1" autocomplete="off" placeholder="" maxlength="30" name="email_port" value="<?=$settings->email_port;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Encryption mode : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" maxlength="30" name="email_crypto" value="<?=$settings->email_crypto;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td colspan="2"><a href="<?=base_url()."email_service/testpostmaster/email";?>" data-toggle='mainmodal' class="btn green"> test connection (save first) </a></td>
                                            </tr>
                                        </tbody>
                                   </table>
                                   
                                   <br/>

                                   <table class="table table-bordered table-striped">
                                            <tbody>
                                             <tr>
                                                <td colspan="3"> POP / IMAP Settings </td>
                                            </tr>
                                            <tr>
                                                <td style="width:15%">Email : </td>
                                                <td style="width:50%">
                                                   <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="" minlength="1" maxlength="30" name="mailbox_address" value="<?=$settings->mailbox_address;?>" required/>
                                                </td>
                                                <td style="width:35%">
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hostname : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" name="mailbox_host" minlength="3" maxlength="30" value="<?=$settings->mailbox_host;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="" name="mailbox_username" minlength="3" maxlength="30" value="<?=$settings->mailbox_username;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="" minlength="3" maxlength="30" name="mailbox_password" value="<?=$settings->mailbox_password;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Port : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="number" min="1" autocomplete="off" placeholder="" maxlength="30" name="mailbox_port" value="<?=$settings->mailbox_port;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted">(143 or 110) (Gmail: 993) </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mailbox : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" maxlength="30" name="mailbox_box" value="<?=$settings->mailbox_box;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted">(Gmail: INBOX)</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Additional Flags : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" maxlength="30" name="mailbox_flags" value="<?=$settings->mailbox_flags;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted">(/notls or /novalidate-cert) (Gmail: /novalidate-cert)</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>IMAP search : </td>
                                                <td>
                                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="" maxlength="30" name="mailbox_search" value="<?=$settings->mailbox_search;?>" required/>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr style="border-collapse: initial;">
                                                <td>IMAP : </td>
                                                <td>
                                                    <div class="form-group">
                                                         <input type="checkbox" name='mailbox_imap' class='checkbox-fullsize' data-labelauty="POP3 enabled|IMAP enabled" <?php echo ($settings->mailbox_imap)? "checked": "";?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr style="border-collapse: initial;">
                                                <td>SSL : </td>
                                                <td>
                                                    <div class="form-group">
                                                         <input type="checkbox" name='mailbox_ssl' class='checkbox-fullsize' data-labelauty="SSL disabled|SSL enabled" <?php echo ($settings->mailbox_ssl)? "checked": "";?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td></td>
                                                <td colspan="2"><a href="<?=base_url()."email_service/testpostmaster/mailbox";?>" data-toggle='mainmodal' class="btn green"> test connection (save first) </a></td>
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
