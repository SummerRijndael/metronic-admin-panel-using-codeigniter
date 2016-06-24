    <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset">
                    <div class="login-bg" style="background-image:url(<?=base_url();?>/assets/pages/img/login/bg1.jpg)">
                        <img class="login-logo" src="<?=base_url();?>files/media/<?=$core_settings->logo;?>" width='34%'/> </div>
                </div>
                <div class="col-md-6 login-container bs-reset">
                    <div class="login-content">
                        <h1><?=$core_settings->company;?></h1>
                        <p><?=$core_settings->company;?> admin panel login page</p>
                        <?php echo form_open_multipart($form_action, 'class="login-form" id="login-form"');?>
                            
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span class='error-message'></span>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <input autofocus class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Username" name="username" <?php if(isset($username)){ echo "value = '". $username ."'"; } ?> required/> <span></span></div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/> <span></span></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <div class="forgot-password">
                                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                    </div>
                                    <button class="btn blue btn-circle login" type="submit">Sign In</button>
                                </div>
                            </div>
                        <?=form_close();?>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        <?php echo form_open_multipart($form_action_forget, 'class="forget-form" id="forgotpass"');?>
                            <h3 class="font-green">Forgot Password ?</h3>
                            <p> Enter your e-mail address below to reset your password. </p>
                            <p class="message"></p>
                            <div class="form-group">
                                <input class="form-control placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" name="email" required/> 
                            </div>

                            <div class="form-actions">
                                <button type="button" id="back-btn" class="btn grey btn-circle btn-default">Back</button>
                                <button type="submit" class="btn blue btn-circle btn-success uppercase pull-right reset-pass">Submit</button>
                            </div>
                        <?=form_close();?>
                        <!-- END FORGOT PASSWORD FORM -->
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; <?=$core_settings->company;?> 2015</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->