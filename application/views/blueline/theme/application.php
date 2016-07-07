<?php 
$act_uri = $this->uri->segment(1, 0);
$lastsec = $this->uri->total_segments() - 1;
$act_uri_submenu = $this->uri->segment($lastsec);

if(!$act_uri){ $act_uri = 'dashboard'; }
?>
<!DOCTYPE html>
<!-- 
Version: 1.0.0
Author: Link technologies
Website: http://www.linktech.com.ph/
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?=$core_settings->company;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        
        <link href="<?=base_url();?>assets/global/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css" />
        <script src="<?=base_url();?>assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bower_components/jquery-labelauty/source/jquery-labelauty.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        
         <link href="<?=base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/global/plugins/elFinder-2.1.12/css/elfinder.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/global/plugins/elFinder-2.1.12/themes/windows-10/css/theme.css">
        <link href="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=base_url();?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <link href="<?=base_url();?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url();?>assets/apps/css/inbox.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=base_url();?>assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url();?>assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?=base_url();?>assets/favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md page-sidebar-closed">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?=base_url();?>">
                        <img src="<?=base_url();?>files/media/<?=$core_settings->small_logo;?>" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-docs"></i> New Post </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-tag"></i> New Comment </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-share"></i> Share </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-flag"></i> Comments
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-users"></i> Feedbacks
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="page_user_profile_1.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i> 
                                    <span class="badge badge-default <?=($messages_new > 0)? NULL : 'display-none';?> message-counter"><?=($messages_new > 0)? $messages_new : NULL;?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                    <?php if(($messages_new > 0)):?>
                                        <h3 class="message-badge">You have <span class="bold"><?=$messages_new;?> new</span> messages.</h3>
                                    <?php else:?>
                                        <h3 class="message-badge">You have no new messages.</h3>
                                    <?php endif;?>    
                                        <a href="<?=base_url().'messages';?>">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller message-peeker" style="height: 250px;" data-handle-color="#637283">
                                        <?php foreach($messages_list as $key => $value):?>
                                            <li>
                                                <a href="<?=base_url().'messages?a=view&msg='.$value->view_id;?>">
                                                    <span class="photo">
                                                        <img src="<?=base_url();?>files/media/avatars/no-pic.png" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> <?=character_limiter($value->subject, 20);?> </span>
                                                        <span class="time"><?php $unix = human_to_unix(date_format(date_create($value->time),'Y-m-d G:i')); echo time_ago($unix, false);?> </span>
                                                    </span>
                                                    <span class="message"><?php echo character_limiter(strip_tags($value->message), 20);?></span>
                                                </a>
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END INBOX DROPDOWN -->
          
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?=base_url()."files/media/avatars/".$this->user->userpic;?>" />
                                    <span class="username username-hide-on-mobile"> <?=humanize($this->user->firstname);?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?=base_url()."accounts/view/".$this->user->view_id?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> My Calendar </a>
                                    </li>
                                    <li>
                                        <a href="app_inbox.html">
                                            <i class="icon-envelope-open"></i> My Inbox
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app_todo_2.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?=site_url('lock');?>">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li>
                                    <li>
                                        <a href="<?=site_url('logout');?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                             <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu page-sidebar-menu-closed page-header-fixed page-sidebar-menu-accordion-submenu page-sidebar-menu-compact page-sidebar-closed" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">

                  <?php 
                      $index_counter = 0;
                      foreach ($menu as $key => $value): 
                      $index_counter++;
                  ?>
                  <?php if(!$value->has_child):?>
                        <li id="<?=strtolower($value->name);?>" class="nav-item <?php echo $index_counter == 1 ? "start" : NULL; 
                        if($act_uri === $value->link){ echo " active open"; } ?>">
                            <a href="<?=site_url($value->link);?>" class="nav-link nav-toggle">
                                <i class="<?=$value->icon;?>"></i>
                                <?php if($act_uri === $value->link ) : ?>
                                <span class="selected"></span>
                                <?php endif;?>
                                <span class="title"></i> <?=$value->name;?></span>
                            </a>
                        </li>
                  <?php else:?>
                      <li id="<?=strtolower($value->name);?>" class="nav-item <?php echo $index_counter == 1 ? "start" : NULL;
                       $options = array_key_exists($act_uri, $navi_child[$value->name]['parent'])? $act_uri : "";
                       $criteria = !empty($options)? $navi_child[$value->name]['parent'][$options]: "";
             
                       if($value->name === $criteria ){ echo " active open"; }?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="<?=$value->icon;?>"></i>
                                <?php if( $value->name === $criteria ) : ?>
                                <span class="selected"></span>
                                <?php endif;?>
                                <span class="arrow <?php echo $value->name === $criteria ? "open": NULL;?>"></span>
                                <span class="title"><?php echo $value->name;?></span>
                            </a>
                            <ul class="sub-menu">
                                <?php $counter = 0; foreach ($navi_child[$value->name]['child_name'] as $index => $vals) : $counter++; ?>
                                <li class="nav-item <?=(($counter-1) == 0)? "start": ""; ?> <?=($navi_child[$value->name]['child_link'][$counter - 1] == $act_uri )? "active open": ""; ?>">
                                    <a href="<?=base_url().$navi_child[$value->name]['child_link'][$counter - 1];?>" class="nav-link ">
                                        <span class="title"><i class="<?=$navi_child[$value->name]['child_icon'][$counter - 1];?>"></i> <?=$vals;?></span>
                                        <span class="<?=($navi_child[$value->name]['child_link'][$counter - 1] == $act_uri )? "selected": ""; ?>"></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                  <?php endif;?>
              <?php endforeach; ?>                        

                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    <div class="theme-panel">
                        <div class="toggler tooltips" data-container="body" data-placement="left" data-html="true" data-original-title="Click to open advance theme customizer panel">
                            <i class="icon-settings"></i>
                        </div>
                        <div class="toggler-close">
                            <i class="icon-close"></i>
                        </div>
                        <div class="theme-options">
                            <div class="theme-option theme-colors clearfix">
                                <span> THEME COLOR </span>
                                <ul>
                                    <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                                    <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                                    <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                    <li class="color-dark tooltips" data-style="dark" data-container="body" data-original-title="Dark"> </li>
                                    <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                                </ul>
                            </div>
                            <div class="theme-option">
                                <span> Layout </span>
                                <select class="layout-option form-control input-small">
                                    <option value="fluid" selected="selected">Fluid</option>
                                    <option value="boxed">Boxed</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Header </span>
                                <select class="page-header-option form-control input-small">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Top Dropdown</span>
                                <select class="page-header-top-dropdown-style-option form-control input-small">
                                    <option value="light" selected="selected">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Mode</span>
                                <select class="sidebar-option form-control input-small">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Style</span>
                                <select class="sidebar-style-option form-control input-small">
                                    <option value="default" selected="selected">Default</option>
                                    <option value="compact">Compact</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Menu </span>
                                <select class="sidebar-menu-option form-control input-small">
                                    <option value="accordion" selected="selected">Accordion</option>
                                    <option value="hover">Hover</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Sidebar Position </span>
                                <select class="sidebar-pos-option form-control input-small">
                                    <option value="left" selected="selected">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span> Footer </span>
                                <select class="page-footer-option form-control input-small">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END THEME PANEL -->
                    <?=$yield;?>

                    <div class="mt-cookie-consent-bar display-hide">
                        <div class="container">
                            <div class="mt-cookie-consent-bar-holder">
                                <div class="mt-cookie-consent-bar-content"> This website uses cookies to ensure you get the best experience on our website.
                                    <a href="http://www.allaboutcookies.org/cookies/" tatget="_blank">What is cookie ?</a>
                                    <a href="#">Our Cookie Policy</a>
                                </div>
                                <div class="mt-cookie-consent-bar-action">
                                    <a href="javascript:;" class="mt-cookie-consent-btn btn btn-circle green">Understand</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="idle-timeout-dialog" data-backdrop="static">
                        <div class="modal-dialog modal-small">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Your have been idle for some time.</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <i class="fa fa-warning font-red"></i> Your session will be locked in
                                        <span id="idle-timeout-counter"></span> seconds.</p>
                                    <p> Do you want to continue your session? </p>
                                </div>
                                <div class="modal-footer">
                                    <button id="idle-timeout-dialog-logout" type="button" class="btn dark btn-outline sbold uppercase">No, Logout</button>
                                    <button id="idle-timeout-dialog-keepalive" type="button" class="btn green btn-outline sbold uppercase" data-dismiss="modal">Yes, Keep Working</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        <?php include_once "sidebar.php"; ?>
        </div>
        <!-- END CONTAINER -->
        <div class="modal fade" id="mainModal" data-easein="flipXIn" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="mainModalLabel" aria-hidden="true"></div>
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="col-md-12 page-footer-inner text-center"> 2015 &copy; <?=humanize($core_settings->company);?>.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="<?=base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?=base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.3.0.min.js"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <script type="text/javascript">
            var token_name = "<?php echo $this->security->get_csrf_token_name(); ?>";
            var token = "<?php echo $this->security->get_csrf_hash(); ?>";
            var base_url = "<?php echo base_url(); ?>";
            var idleTime = "<?php echo $core_settings->idle; ?>";

            jQuery(document).ready(function($) {
               $('form').validate();  
            });
        </script>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bower_components/jquery-labelauty/source/jquery-labelauty.js" type="text/javascript" ></script> 
        <script src="<?=base_url();?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-cookiebar/jquery.cookieBar.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>assets/global/scripts/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

         <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script type="text/javascript" src="<?=base_url();?>assets/global/plugins/elFinder-2.1.12/js/elfinder.min.js"></script>
        <script src="<?=base_url();?>assets/pages/scripts/table-accounts.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/apps/scripts/inbox.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/layouts/global/scripts/cookie-consent.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/pages/scripts/user-idletimeout.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <?php if($act_uri === "gallery_maintenance"):?><script src="<?=base_url();?>assets/pages/scripts/gallery.js" type="text/javascript"></script><?php endif;?>
        <script src="<?=base_url();?>assets/pages/scripts/portfolio-3.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url();?>assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        
        <script type="text/javascript">
            $('#settings_about').summernote({height: 300});
            $('#project').summernote({height: 500});
         <?php if($act_uri === "file_manager"):?>
            $(document).ready(function() {
                var elf = $('#elfinder').elfinder({
                    // lang: 'ru',             // language (OPTIONAL)
                    //requestType: 'post',
                    url : base_url+'file_manager/elfinder_init',  // connector URL (REQUIRED)
                    customData: {token: token},
                    height: 540,
                    
                    handlers: {upload: function (e, fm) {
                      
                    if (e.data && e.data.token) {
                            fm.customData['token'] = e.data.token;
                            token = e.data.token;
                        }
                    }},

                }).elfinder('instance');       
   
            });
        <?php endif;?>
        </script>
        
        <?php if($act_uri === "accounts" && $act_uri_submenu === "edit"):?>
        <script type="text/javascript">
            $('form').validate();
 
            $('input[type=checkbox]').click(function() {
                var that = "#"+this.id+"_sub_child";
                $(that).toggle(this.checked);
                
            });

        </script>
        <?php endif;?>

        <?php if($this->session->flashdata('message')) { ?>
          <script type="text/javascript">
            jQuery(document).ready(function() {    
              <?php foreach ($this->session->flashdata('message') as $key => $value) { $exp = explode(":", $value) ?>
                notifyU("<?=$exp[0]?>","<?=$exp[1]?>","<?php echo isset($exp[2]) ? $exp[2] : NULL;?>");
              <?php }?>
            });
          </script>
        <?php }?>
    </body>

</html>