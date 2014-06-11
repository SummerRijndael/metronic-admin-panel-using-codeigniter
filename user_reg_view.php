<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 3.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metro | User Sign Up</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url();?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed ">
 <?php include 'includes/header.php' ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	 <?php include 'includes/sidebar.php' ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-original-title="Default">
							</li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-original-title="Dark Blue">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
							</li>
							<li class="color-light tooltips" data-style="light" data-original-title="Light">
							</li>
							<li class="color-light2 tooltips" data-style="light2" data-html="true" data-original-title="Light 2">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar </span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					User Account Registration
					<br/> <small>User Account registration page.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="home">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="users">User Accounts
							 <i class="fa fa-angle-right"></i>
						   </a>
						</li>
						<li>
							<a href="signup">Sign Up</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">User Registration</h3>
						</div>
						
						<div class="panel-body">
							<!-- BEGIN FORM-->

							 <?php $attributes = array('class' => 'form-horizontal form-bordered form-row-stripped', 'id' => 'form_sample_3'); 
							      echo form_open_multipart('addusersas', $attributes); ?>
							<!--<form action="#" id="form_sample_3" class="form-horizontal form-bordered form-row-stripped">-->

							<?php 
                            if(!!isset($regsucc)){ echo '<div class="alert alert-success alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' .'User account registration success!'. '</div>';} 
                            else{
                                  echo validation_errors('<div class="alert alert-danger alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>'); }
                        ?>

                        <div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										You have some form errors. Please check below.
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Your form validation is successful!
						</div>
								<div class="form-body">
									<h3 class="form-section">Account Information</h3>									

									<div class="form-group">
										<label class="control-label col-md-3">Avatar</label>
										<div class="col-md-9">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="..." accept="image/*">
													</span>
													<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
													Remove </a>
												</div>
											</div>
											<div class="clearfix margin-top-10">
												<span class="label label-danger">NOTE! </span> &nbsp;Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.
											</div>
										</div>
									</div>
								   
								   <div class="form-group">
										<label class="control-label col-md-3">Username <span class="required">
										* </span></label>
										<div class="col-md-4">
										   <div class="input-icon">
											 <i class="fa fa-user"></i>
										 	 <input class="form-control" data-required="1" type="text" autocomplete="off" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>"/>
										   </div>
									    </div>
									</div>

									<div class="form-group last password-strength">
										<label class="control-label col-md-3">Password<span class="required">
										* </span>
									      </label>
										<div class="col-md-4">
											<div class="input-icon">
										     	<i class="fa fa-lock"></i>
											    <input type="text" class="form-control" data-required="1" name="password" placeholder="Password" id="password_strength" value="<?php echo set_value('password'); ?>">
										  	</div>	    
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Re-type Your Password <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-icon">
												<i class="fa fa-check"></i>
						  						<input class="form-control placeholder-no-fix" data-required="1" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" value="<?php echo set_value('rpassword'); ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Email Address <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
												</span>
												<input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Access Level <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-users"></i>
												</span>
											  <select class="form-control select2me" name="access-level">
												 <option value="" <?php echo set_select('access-level', '', TRUE); ?>>Select...</option>
                                  				 <option value="0" <?php echo set_select('access-level', '0'); ?>>Administrator</option>
                                  				 <option value="1" <?php echo set_select('access-level', '1'); ?>>Editor</option>                            
                                			 </select>
										  </div>
										</div>
									</div>
									
									<h3 class="form-section">Personal Information</h3>
									<div class="form-group">
										<label class="control-label col-md-3">Firstname <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-icon">
												<i class="fa fa-font"></i>
											    <input type="text" name="firstname" data-required="1" class="form-control" value="<?php echo set_value('firstname'); ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Middlename <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-icon">
											   <i class="fa fa-font"></i>
											   <input type="text" name="middlename" data-required="1" class="form-control" value="<?php echo set_value('middlename'); ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Lastname <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-icon">
											  <i class="fa fa-font"></i>
											   <input type="text" name="lastname" data-required="1" class="form-control" value="<?php echo set_value('lastname'); ?>"/>
											</div>
										</div>	
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Gender <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-user"></i>
												</span>
											<select class="form-control select2me" name="gender">
												<option value="" <?php echo set_select('gender', '', TRUE); ?>>Select...</option>
												<option value="Male" <?php echo set_select('gender', 'Male'); ?>>Male</option>
												<option value="Female" <?php echo set_select('gender', 'Female'); ?>>Female</option>
											</select>
										   </div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Birthday<span class="required">
										* </span></label>
										<div class="col-md-4">
											<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
												<input type="text" class="form-control" readonly name="birthday" value="<?php echo set_value('birthday'); ?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
											<!-- /input-group -->
											<span class="help-block">
											Select your birthdate </span>
										</div>
									</div>

								    <div class="form-group">
										<label class="control-label col-md-3">Address
										<span class="required">
										* </span></label>
										<div class="col-md-4">
											<div class="input-icon">
									  	      <i class="fa fa-location-arrow "></i>
											  <textarea id="maxlength_textarea" class="form-control" name="address" maxlength="225" rows="2" placeholder="This textarea has a limit of 225 chars."><?php echo set_value('address'); ?></textarea>
										    </div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Phone
										<span class="required">
										* </span></label>
										<div class="col-md-4">
										  <div class="input-icon">
									  	    <i class="fa fa-phone-square"></i>
										 	  <input class="form-control" data-required="1" name="contact" id="mask_phone" type="text" value="<?php echo set_value('contact'); ?>"/>
											  <span class="help-block">
											  +(99) 999-999-9999 </span>
										  </div>
										</div>
									</div>
							
							    <br/>	
								<div class="form-actions fluid">
									<div class="pull-right">
										<button type="submit" class="btn green">Submit</button>
										<button class="btn btn-danger" type="reset">Reset</button>
									</div>
								</div>
						   </div>
						    <!-- END FORMBODY-->
						</form>
						<!-- END FORM-->
					</div>
					<!-- END PANELBODY-->
				</div>
					<!-- END PANEL-->
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes.
	</div>
	<div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL STYLES -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/form-validation.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-form-tools.js"></script>
<!-- END PAGE LEVEL STYLES -->
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   ComponentsFormTools.init();
   FormValidation.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
