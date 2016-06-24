
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                        <h3 class="page-title"><i class="fa fa-users"></i> User accounts maintenance page
                    </h3>
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase">User accounts</span>
                                        
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <a class="btn blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                <i class="fa fa-share"></i>
                                                <span class="hidden-xs"> Actions </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="<?=base_url();?>/accounts/create" data-toggle='mainmodal'> Add new</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                <i class="fa fa-share"></i>
                                                <span class="hidden-xs"> Tools </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                                               <li>
                                                    <a href="javascript:;" data-action="0" class="tool-action">
                                                        <i class="icon-printer"></i> Print</a>
                                                </li>
                                                
                                                <li>
                                                    <a href="javascript:;" data-action="1" class="tool-action">
                                                        <i class="icon-doc"></i> PDF</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="2" class="tool-action">
                                                        <i class="icon-paper-clip"></i> Excel</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="3" class="tool-action">
                                                        <i class="icon-cloud-upload"></i> CSV</a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;" data-action="4" class="tool-action">
                                                        <i class="icon-refresh"></i> Reload</a>
                                                </li>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                               <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="table-actions-wrapper">
                                            <span> </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                                <option value="">Select...</option>
                                                <option value="disable">Disable</option>
                                                <option value="enable">Enable</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <button class="btn btn-circle btn-sm green table-group-action-submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                        </div>
                                        <table class="table table-responsive table-striped table-bordered table-hover table-checkable" id="accounts">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable"><span></span></label> </th>
                                                    <th width="13%"> Fullname</th>
                                                    <th style='text-align: center;' width="9%"> Username </th>
                                                    <th style='text-align: center;' width="6%"> Status</th>
                                                    <th style='text-align: center;' width="6%"> Role </th>
                                                    <th style='text-align: center;' width="10%"> Title </th>
                                                    <th width="11%"> Date created </th>
                                                    <th width="11%"> Last updated </th>
                                                    <th style='text-align: center;' width="12%"> Actions </th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td> </td>
                                                    <td>
                                                        <!--<input type="text" class="form-control form-filter input-sm" name="fullname">--> </td>
                                                    
                                                    <td>
                                                        <input type="search" class="form-control form-filter input-sm" name="username"> </td>
                                                    <td>
                                                        <select name="status" class="form-control form-filter input-sm">
                                                            <option value="">Select...</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="deleted">Deleted</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="role" class="form-control form-filter input-sm">
                                                            <option value="">Select...</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="editor">Editor</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="search" class="form-control form-filter input-sm" name="title"> </td>
                                                    <td>
                                                        <div class="input-group date form_datetime from_date margin-bottom-5" data-date-format="dd-mm-yyyy">
                                                            <input type="text" class="form-control form-filter input-sm" name="create_date_from" placeholder="From">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-sm default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <div class="input-group date form_datetime to_date" data-date-format="dd-mm-yyyy">
                                                            <input type="text" class="form-control form-filter input-sm" name="create_date_to" placeholder="To">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-sm default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date form_datetime from_date margin-bottom-5" data-date-format="dd-mm-yyyy">
                                                            <input type="text" class="form-control form-filter input-sm" name="update_date_from" placeholder="From">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-sm default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <div class="input-group date form_datetime to_date" data-date-format="dd-mm-yyyy">
                                                            <input type="text" class="form-control form-filter input-sm" name="update_date_to" placeholder="To">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-sm default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                    
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                            <button id='ab' class="btn btn-circle btn-sm green btn-outline filter-submit margin-bottom">
                                                                <i class="fa fa-search"></i> Search</button>
                                                        </div>
                                                        <button class="btn btn-circle btn-sm red btn-outline filter-cancel">
                                                            <i class="fa fa-times"></i> Reset</button>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->