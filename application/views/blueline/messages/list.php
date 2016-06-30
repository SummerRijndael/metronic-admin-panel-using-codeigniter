<div class="inbox">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="inbox-sidebar">
                                    <a href="javascript:;" data-title="Compose" class="btn red compose-btn btn-block">
                                        <i class="fa fa-edit"></i> Compose </a>
                                    <ul class="inbox-nav">
                                        <li class="active">
                                            <a href="javascript:;" data-type="inbox" data-title="Inbox"> Inbox
                                                <span class="badge badge-success message-counter"><?=($inbox > 0)? $inbox: NULL;?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="important" data-title="Important"> Important  <span class="badge badge-danger message-counter-important"><?=($important > 0)? $important: NULL;?></span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="spam" data-title="Spam"> Spam  <span class="badge badge-info message-counter-spam"><?=($spam > 0)? $spam: NULL;?></span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="sent" data-title="Sent"> Sent </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="draft" data-title="Draft"> Draft
                                                <span class="badge badge-danger">100</span>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:;" class="sbold uppercase" data-title="Trash"> Trash
                                                <span class="badge badge-info message-counter-trash"><?=($trash > 0)? $trash: NULL;?></span>
                                            </a>
                                        </li>
                        
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="inbox-body">
                                    <div class="inbox-header">
                                        <h1 class="pull-left inbox-title">Inbox</h1>
                                    
                                    </div>
                                    <div class="inbox-content">
                                        <table class="table table-bordered table-striped table-advance table-hover <?=(isset($message))? 'display-none': NULL; ?>">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="mail-group-checkbox" />
                                                            <span></span>
                                                        </label>
                                                        <div class="btn-group input-actions">
                                                            <a class="btn btn-sm blue btn-outline dropdown-toggle sbold" href="javascript:;" data-toggle="dropdown"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </a>
                                                            <ul class="dropdown-menu list-actions">
                                                                <li>
                                                                    <a href="<?=base_url();?>messages/bulk_action/important">
                                                                        <i class="fa fa-star"></i> Mark as Important </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?=base_url();?>messages/bulk_action/read">
                                                                        <i class="icon-envelope-open"></i> Mark as Read </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?=base_url();?>messages/bulk_action/unread">
                                                                        <i class="fa fa-envelope"></i> Mark as Unread </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?=base_url();?>messages/bulk_action/spam">
                                                                        <i class="fa fa-ban"></i> Mark as Spam </a>
                                                                </li>
                                                                <li class="divider"> </li>
                                                                <li>
                                                                    <a href="<?=base_url();?>messages/bulk_action/delete">
                                                                        <i class="fa fa-trash-o"></i> Delete </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                       
                                                       <select id="filter" class="form-control input-xs input-sm input-inline">
                                                           <option value="10">10</option>
                                                           <option value="20">20</option>
                                                           <option value="50">50</option>
                                                           <option value="100">100</option>
                                                           <option value="150">150</option>
                                                       </select> messages per page.
                                                    </th>
                                                    <th class="pagination-control" colspan="3">
                                                        <span class="pagination-info"></span>
                                                        <a class="btn btn-sm blue btn-outline prev">
                                                            <i class="fa fa-angle-left"></i>
                                                        </a>
                                                        <a class="btn btn-sm blue btn-outline next">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                                <tbody id="mail_contents">

                                                </tbody>
                                            </table>  
                                            
                                            <div class="viewer">
                                               
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>