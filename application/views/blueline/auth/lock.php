<div class="page-lock">
            <div class="page-body">
                <div class="lock-head"> Locked </div>
                <div class="lock-body">
                    <?php if($this->session->flashdata('message')) { $exp = explode(':', $this->session->flashdata('message'))?>
                         <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span class='error-message'><?=$exp[1];?></span>
                        </div>
                    <?php } ?>
                    <div class="pull-left lock-avatar-block">
                        <img src="<?=base_url()."files/media/avatars/".$this->user->userpic;?>" class="lock-avatar"> </div>
                    <?=form_open_multipart($form_action,'class="lock-form pull-left"')?>
                        <h4><?=humanize($this->user->firstname . " " . $this->user->middlename . " " . $this->user->lastname);?></h4>
                        <div class="form-group">
                            <input type="hidden" name="username" value="<?=$this->user->username;?>">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/> 
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn red uppercase">Login</button>
                        </div>
                    <?=form_close();?>
                </div>
                <div class="lock-bottom">
                    <a href="<?=site_url('logout')?>">Not <?=humanize($this->user->firstname . " " . $this->user->middlename . " " . $this->user->lastname);?>?</a>
                </div>
            </div>
            <div class="page-footer-custom"> 2015 &copy; <?=$core_settings->company;?></div>
        </div>