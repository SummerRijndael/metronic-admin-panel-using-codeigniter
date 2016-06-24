<div class='row'>
<div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="<?=base_url()."files/media/".$team_info->avatar;?>" class="img-responsive" alt=""> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"><?=$team_info->fullname;?></div>
                                        <div class="profile-usertitle-job"><?=$team_info->position;?></div>
                                        <p>Status : <?php if($team_info->status){ echo "<span class='label label-success'>Posted</span>"; }else{ echo "<span class='label label-important'>Pending</span>"; }?></p>
                                    </div>
                                    <br/>
                                    <!-- END SIDEBAR USER TITLE -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                <div class="portlet light bordered">
                       
                                    <div>
                                        <h4 class="profile-desc-title">About <?=$team_info->fullname;?></h4>
                                        <span class="profile-desc-text"> <?=$team_info->description;?> </span>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-globe"></i>
                                            <a href="<?php if(!empty($team_info->website_link)){ echo $team_info->website_link; }else { echo "#"; }?>"><?php if(!empty($team_info->website_link)){ echo $team_info->website_link; }else { echo "N/A"; }?></a>
                                        </div>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-twitter"></i>
                                            <a href="<?php if(!empty($team_info->twitter_link)){ echo $team_info->website_link; }else { echo "#"; }?>"><?php if(!empty($team_info->twitter_link)){ echo $team_info->twitter_link; }else { echo "N/A"; }?></a>
                                        </div>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-facebook"></i>
                                            <a href="<?php if(!empty($team_info->facebook_link)){ echo $team_info->website_link; }else { echo "#"; }?>"><?php if(!empty($team_info->facebook_link)){ echo $team_info->facebook_link; }else { echo "N/A"; }?></a>
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
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase"><?=$title;?></span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                <?php if($edit) : ?><li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                    </li><?php endif;?>
                                <?php if($edit) : ?><li>
                                                        <a href="#tab_1_3" data-toggle="tab">Privacy Settings</a>
                                                    </li></li><?php endif;?>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <?php echo form_open_multipart($form_action,'role="form"')?>
                                                            <div class="form-group">
                                                                <label class="control-label">Name</label>
                                                                <input type="text" name='fullname' maxlength='120' placeholder="<?=$team_info->fullname;?>" value="<?=$team_info->fullname;?>" class="form-control" <?php if(!$edit){ echo "readonly";} ?> required> </div>                                                            
                                                            <div class="form-group">
                                                                <label class="control-label">Occupation</label>
                                                                <input type="text" name='position' maxlength='120' placeholder="<?=$team_info->position;?>" value="<?=$team_info->position;?>" class="form-control" <?php if(!$edit){ echo "readonly";} ?> required> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">About</label>
                                                                <textarea name='description' class="form-control" rows="4" maxlength='230' placeholder="<?=$team_info->description;?>" <?php if(!$edit){ echo "readonly";} ?>><?=$team_info->description;?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Facebook</label>
                                                                <input type="url" name='facebook' maxlength="120" placeholder="<?=$team_info->facebook_link;?>" value="<?=$team_info->facebook_link;?>" class="form-control" <?php if(!$edit){ echo "readonly";} ?>> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Twitter</label>
                                                                <input type="url" name='twitter' maxlength="120" placeholder="<?=$team_info->twitter_link;?>" value="<?=$team_info->twitter_link;?>" class="form-control" <?php if(!$edit){ echo "readonly";} ?>> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Website</label>
                                                                <input type="url" name='website' maxlength="120" placeholder="<?=$team_info->website_link;?>" value="<?=$team_info->website_link;?>" class="form-control" <?php if(!$edit){ echo "readonly";} ?>> </div>

                                                          
                                                            <div class=" margin-top-10">
                                            <?php if($edit) : ?><button type='submit' class="btn btn-circle green"> Save Changes </button><?php endif;?>
                                                                <a href="javascript:;" data-dismiss="modal" class="btn btn-circle default"> Close </a>
                                                            </div>
                                                          
                                                        <?php echo form_close();?>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        <?php echo form_open_multipart($form_action,'role="form"')?>
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input id="uploadBtn" type="file" name="userfile" class="upload" required/>
                                                                            <input type="hidden" name="dummy" class="upload" /></span>
                                                                        <a href="javascript:;" class="btn btn-circle default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix margin-top-10">
                                                                    <span class="label label-danger">NOTE! </span>
                                                                    <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                    <br/><span class="label label-danger">NOTE! </span><span> Max image size is 800x800</span>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <button type='submit' class="btn btn-circle green"> Save Changes </button>
                                                                <a href="javascript:;" data-dismiss="modal" class="btn btn-circle default"> Cancel </a>
                                                            </div>
                                                        <?php echo form_close();?>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- PRIVACY SETTINGS TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <?php echo form_open_multipart($form_action,'role="form"')?>
                                                            <table class="table table-light table-hover">
                                                                <tbody>
                <?php if(!empty($team_info->facebook_link)){ ?><tr>
                                                                    <td>Show facebook link</td>
                                                                    <td>
                                                                        <label class="uniform-inline">
                                                                            <div class="checkbox"><span><input type="checkbox" name='fb-pr' <?php if($privacy[0]){ echo "checked"; }?> value="1"></span></div> Yes </label>
                                                                    </td>
                                                                </tr><?php } ?>
                <?php if(!empty($team_info->twitter_link)){ ?><tr>
                                                                    <td>Show twitter link</td>
                                                                    <td>
                                                                        <label class="uniform-inline">
                                                                            <div class="checkbox"><span><input type="checkbox" name='tw-pr' <?php if($privacy[1]){ echo "checked"; }?> value="1"></span></div> Yes </label>
                                                                    </td>
                                                                </tr><?php } ?>
                <?php if(!empty($team_info->website_link)){ ?><tr>
                                                                    <td>Show website link</td>
                                                                    <td>
                                                                        <label class="uniform-inline">
                                                                            <div class="checkbox"><span><input type="checkbox" name='wb-pr' <?php if($privacy[2]){ echo "checked"; }?> value="1"></span></div> Yes </label>
                                                                            <input type='hidden' name='dummy' value='true'>
                                                                    </td>
                                                                </tr><?php } ?>
                                                            </tbody></table>
                                                            <!--end profile-settings-->
                                                            <div class="margin-top-10">
                                                                <button type='submit' class="btn btn-circle green"> Save Changes </button>
                                                                <a href="javascript:;" data-dismiss="modal" class="btn btn-circle default"> Cancel </a>
                                                            </div>
                                                        <?php echo form_close();?>
                                                    </div>
                                                    <!-- END PRIVACY SETTINGS TAB -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>