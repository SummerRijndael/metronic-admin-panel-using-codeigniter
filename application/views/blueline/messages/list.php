<div class="inbox">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="inbox-sidebar">
                                    <a href="javascript:;" data-title="Compose" class="btn red compose-btn btn-block">
                                        <i class="fa fa-edit"></i> Compose </a>
                                    <ul class="inbox-nav">
                                        <li class="active">
                                            <a href="javascript:;" data-type="inbox" data-title="Inbox"> Inbox
                                            <?php if($message_count >= 1):?>
                                                <span class="badge badge-success message-counter"><?=$message_count;?></span>
                                            <?php endif;?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="important" data-title="Inbox"> Important </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="sent" data-title="Sent"> Sent </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="draft" data-title="Draft"> Draft
                                                <span class="badge badge-danger">8</span>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:;" class="sbold uppercase" data-title="Trash"> Trash
                                                <span class="badge badge-info">23</span>
                                            </a>
                                        </li>
                        
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="inbox-body">
                                    <div class="inbox-header">
                                        <h1 class="pull-left">Inbox</h1>
                                    
                                    </div>
                                    <div class="inbox-content">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>