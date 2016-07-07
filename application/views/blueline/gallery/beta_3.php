<div class="row">
                       <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-paperclip font-blue-sharp"></i>
                                        <span class="caption-subject font-blue-sharp bold uppercase"> Project page</span>
                                    </div>
                                </div>
                                <div class="portlet-body">

                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption"> Project name</div>
                                        <div class="actions btn-set">
                                            <button type="button" name="back" class="btn btn-secondary-outline">
                                                <i class="fa fa-angle-left"></i> Back</button>
                                            <button class="btn btn-secondary-outline">
                                                <i class="fa fa-reply"></i> Reset</button>
                                            <button class="btn btn-success">
                                                <i class="fa fa-check"></i> Save</button>
                                            <button class="btn btn-success">
                                                <i class="fa fa-check-circle"></i> Save & Continue Edit</button>
                                            <div class="btn-group">
                                                <a class="btn btn-success dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                    <i class="fa fa-share"></i> More
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;"> Duplicate </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"> Delete </a>
                                                    </li>
                                                    <li class="dropdown-divider"> </li>
                                                    <li>
                                                        <a href="javascript:;"> Print </a>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_general" data-toggle="tab"> General </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_meta" data-toggle="tab"> Meta </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_images" data-toggle="tab"> Images </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_general">
                                                 <form class="form-horizontal form-row-seperated">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Name:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="product[name]" placeholder=""> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Short Description:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="product[short_description]"></textarea>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Description:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <textarea id="project" class="form-control" name="product[description]"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                                <div class="tab-pane" id="tab_meta">
                                                 <form class="form-horizontal form-row-seperated">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Title:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control maxlength-handler" name="product[meta_title]" maxlength="100" placeholder="">
                                                                <span class="help-block"> max 100 chars </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Keywords:</label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control maxlength-handler" rows="8" name="product[meta_keywords]" maxlength="1000"></textarea>
                                                                <span class="help-block"> max 1000 chars </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Description:</label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control maxlength-handler" rows="8" name="product[meta_description]" maxlength="255"></textarea>
                                                                <span class="help-block"> max 255 chars </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="tab_images">
                                                    <div class="table-container">
  <form id="fileupload" action="<?=base_url();?>sample/upload" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                       
                                        <span class="btn green fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span> Add files... </span>
                                            <input type="file" name="files[]" multiple=""> </span>
                                        <button type="submit" class="btn blue start">
                                            <i class="fa fa-upload"></i>
                                            <span> Start upload </span>
                                        </button>
                                        <button type="reset" class="btn warning cancel">
                                            <i class="fa fa-ban-circle"></i>
                                            <span> Cancel upload </span>
                                        </button>
                                        <button type="button" class="btn red delete">
                                            <i class="fa fa-trash"></i>
                                            <span> Delete </span>
                                        </button>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"> </span>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended"> &nbsp; </div>
                                    </div>
                                
                                <!-- The table listing the files available for upload/download -->
                                <table id="uploads" role="presentation" class="table table-striped table-hover  table-bordered">
                                    <tr>
                                        <thead>
                                            <th width='1%'> <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="toggle" name="images[]" /><span></span></label></th>
                                            <th width='10%'>Thumbnails</th>
                                            <th>Details</th>
                                            <th>Size</th>
                                            <th style='text-align: center;'>Actions</th>

                                        </thead>
                                    </tr>
                                    <tbody class="files">
                                    <tr id='no_data' class='display-none'>
                                        <td colspan='5' style='text-align: center;'><code>No data found.</code></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </form>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Notes</h3>
                                </div>
                                <div class="panel-body">
                                    <ul>
                                        <li> Only image files (<strong>JPG, GIF, PNG</strong>) are allowed.</li>
                                    </ul>
                                </div>
                            </div>

                    <!-- The blueimp Gallery widget -->
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                        <div class="slides"> </div>
                        <h3 class="title"></h3>
                        <a class="prev"> ‹ </a>
                        <a class="next"> › </a>
                        <a class="close white"> </a>
                        <a class="play-pause"> </a>
                        <ol class="indicator"> </ol>
                    </div>
                    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="toggle" name="images[]" disabled/><span></span></label>
                            </td>
                            <td>
                                <span class="preview"></span>
                            </td>
                            <td>
                                <p class="name">{%=file.name%}</p>
                                <strong class="error text-danger label label-danger"></strong>
                            </td>
                            <td>
                                <p class="size">Processing...</p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            </td>
                            <td> {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn blue btn-circle start" disabled>
                                    <i class="fa fa-upload"></i>
                                    <span>Start</span>
                                </button> {% } %} {% if (!i) { %}
                                <button class="btn red btn-circle cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel</span>
                                </button> {% } %} </td>
                        </tr> {% } %} </script>
                    <!-- The template to display files available for download -->
                    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="toggle" name="mails[]" value="'.$value->view_id.'" /><span></span></label>
                            </td>
                            <td>
                                <span class="preview"> {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                        <img src="{%=file.thumbnailUrl%}">
                                    </a> {% } %} </span>
                            </td>
                            <td>
                                <p class="name"> {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                    <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                <div>
                                    <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                            <td>
                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
                            </td>
                            <td> {% if (file.deleteUrl) { %}
                                <button class="btn red btn-circle delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                    <i class="fa fa-trash-o"></i>
                                    <span>Delete</span>
                                </button>
                                {% } else { %}
                                <button class="btn yellow btn-circle cancel btn-sm">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel</span>
                                </button> {% } %} </td>
                        </tr> {% } %} </script>

                                                    </div>
                                                </div>
          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>