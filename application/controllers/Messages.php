<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
        if (!$this->user) {
            $this->set_last_url();
            redirect('login');
        }
    }

	public function index()
	{
        $message_count = $this->check_message();
        $this->view_data['inbox'] = intval($message_count[0]->message_number);
        
        $message_count_important = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where important = TRUE');
        $this->view_data['important'] = $message_count_important[0]->message_number;

        $message_count_spam = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where spam = TRUE and deleted != TRUE');
        $this->view_data['spam'] = $message_count_spam[0]->message_number;


        $message_count_trash = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where status = "deleted"');
        $this->view_data['trash'] = intval($message_count_trash[0]->message_number); 
		
        $this->content_view = 'messages/list';
        //$this->session->set_flashdata('message', 'success: message!');
	}

function mark(){
    $this->theme_view = '';

    if ($this->user && $this->input->is_ajax_request()) { 
         $message = Outbox_messages::find_by_view_id($this->input->get('message_id'));

         if ($message->important) {
             $message->important = FALSE;
             $reply['reply'] = "false";
         } else {
             $message->important = TRUE;
             $reply['reply'] = "true";
         }

         $message->save();

         $this->output->set_content_type('application/json')->set_output(json_encode($reply));
    }
}



function download($mode = NULL, $medianame = NULL){
    if ($this->user) {
        $this->theme_view = '';
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->library('zip');

        switch ($mode) {
            case 'single':
                        $media = ArticleHasAttachment::find_by_savename($medianame);
 
                        $file = FCPATH . 'files/media/attachments/'.$media->savename;
                        $mime = get_mime_by_extension($file);
                        if(file_exists($file)) {
                            header('Content-Description: File Transfer');
                            header('Content-Type: '.$mime);
                            header('Content-Disposition: attachment; filename='.basename($media->filename));
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            header('Content-Length: ' . filesize($file));
                            readfile($file);
                            @ob_clean();
                            @flush();
                            exit(); 

                        } else {
                            header('HTTP/1.1 500 Internal Server Error');
                            @ob_clean();
                            @flush();
                            exit();
                        }
                break;
            
            case 'all':
                        $temp = Outbox_messages::find_by_view_id($medianame);
                        if ($temp) {
                            $temp_file = ArticleHasAttachment::find('all', array('conditions'=> array('article_id = ? ', $temp->id)));
                            $this->zip->compression_level = 4;
                            
                            foreach ($temp_file as $key => $value)
                            {
                                $this->zip->read_file(FCPATH . 'files/media/attachments/'.$value->savename, $value->filename);
                                //echo $value->filename . "<br/>";
                            }

                            $this->zip->download(date('Y-m-d').'_email_attachments.zip');
                            @ob_clean();
                            @flush();
                            exit();

                        } else {
                            header('HTTP/1.1 500 Internal Server Error');
                            @ob_clean();
                            @flush();
                            exit();
                        }
                        
                break;

            default:
                show_404();
                break;
        }

    } else {
        show_404();
    }
        
}

function load_reply(){
            
         if ( $this->user && $this->input->is_ajax_request() ) {
             $this->theme_view = '';
             $message_array = Outbox_messages::find_by_view_id($this->input->get('message_id'));
             
             if(!$message_array){
                show_404();
             }

             $sender = explode("<", trim($message_array->sender));
             
             if (count($sender)  > 1 ) {
                 $sender_display = str_replace(">", '', $sender[1]);
             } else {
                 $sender_display = str_replace(">", '', $sender[0]);
             }
          $reply = form_open_multipart('messages/send_mail',' class="inbox-compose form-horizontal" id="fileupload"').'
            <div class="inbox-compose-btn">
                <button class="btn green">
                    <i class="fa fa-check"></i>Send</button>
                <button class="btn default">Discard</button>
                <button class="btn default">Draft</button>
            </div>
            <div class="inbox-form-group mail-to">
                <label class="control-label">To:</label>
                <div class="controls controls-to">
                    <input type="text" class="form-control" name="to" value="'.$sender_display.'">
                    <span class="inbox-cc-bcc">
                        <span class="inbox-cc " style="display:none"> Cc </span>
                        <span class="inbox-bcc"> Bcc </span>
                    </span>
                </div>
            </div>
            <div class="inbox-form-group input-cc display-hide">
                <a href="javascript:;" class="close"> </a>
                <label class="control-label">Cc:</label>
                <div class="controls controls-bcc">
                    <input type="text" name="cc" class="form-control"> </div>
            </div>
            <div class="inbox-form-group input-bcc display-hide">
                <a href="javascript:;" class="close"> </a>
                <label class="control-label">Bcc:</label>
                <div class="controls controls-bcc">
                    <input type="text" name="bcc" class="form-control"> </div>
            </div>
            <div class="inbox-form-group">
                <label class="control-label">Subject:</label>
                <div class="controls">
                    <input type="text" class="form-control" name="subject" value="'.$message_array->subject.'"> </div>
            </div>
            <div class="inbox-form-group">
                <div class="controls-row">
                    <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>
                    <!--blockquote content for reply message, the inner html of reply_email_content_body element will be appended into wysiwyg body. Please refer Inbox.js loadReply() function. -->
                    <div id="reply_email_content_body" class="hide">
                        <blockquote>'.$message_array->message.'</blockquote>
                    </div>
                </div>
            </div>
            <div class="inbox-compose-attachment">
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <span class="btn green btn-outline  fileinput-button">
                    <i class="fa fa-plus"></i>
                    <span> Add files... </span>
                    <input type="file" name="files[]" multiple> </span>
                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table table-striped margin-top-10">
                    <tbody class="files"> </tbody>
                </table>
            </div>
            <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-upload fade">
                    <td class="name" width="30%">
                        <span>{%=file.name%}</span>
                    </td>
                    <td class="size" width="40%">
                        <span>{%=o.formatFileSize(file.size)%}</span>
                    </td> {% if (file.error) { %}
                    <td class="error" width="20%" colspan="2">
                        <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else if (o.files.valid && !i) { %}
                    <td>
                        <p class="size">{%=o.formatFileSize(file.size)%}</p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                    </td> {% } else { %}
                    <td colspan="2"></td> {% } %}
                    <td class="cancel" width="10%" align="right">{% if (!i) { %}
                        <button class="btn btn-sm red cancel">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button> {% } %}</td>
                </tr> {% } %} </script>
            <!-- The template to display files available for download -->
            <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-download fade"> {% if (file.error) { %}
                    <td class="name" width="30%">
                        <span>{%=file.name%}</span>
                    </td>
                    <td class="size" width="40%">
                        <span>{%=o.formatFileSize(file.size)%}</span>
                    </td>
                    <td class="error" width="30%" colspan="2">
                        <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else { %}
                    <td class="name" width="30%">
                        <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'. chr(39) . 'gallery' .chr(39) . '%}" download="{%=file.name%}">{%=file.name%}</a>
                    </td>
                    <td class="size" width="40%">
                        <span>{%=o.formatFileSize(file.size)%}</span>
                    </td>
                    <td colspan="2"></td> {% } %}
                    <td class="delete" width="10%" align="right">
                        <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" {% if (file.delete_with_credentials) { %} data-xhr-fields='.chr(39).'{"withCredentials":true}'.chr(39).'{% } %}>
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr> {% } %} </script>
            <div class="inbox-compose-btn">
                <button class="btn green">
                    <i class="fa fa-check"></i>Send</button>
                <button class="btn default">Discard</button>
                <button class="btn default">Draft</button>
            </div>
        </form>';

        $this->output->set_content_type('text/html')->set_output($reply);
    }
}

function bulk_action($mode = NULL){
    $this->theme_view = '';

    if ($this->user && $this->input->is_ajax_request()) {
        switch ($mode) {
            case 'read':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_view_id($value);
                      $message_array->status = "read";
                      $message_array->save();
                }
                
                $reply = array();
                $reply["token_name"] = $this->security->get_csrf_token_name();
                $reply["token"] = $this->security->get_csrf_hash();
                $this->output->set_content_type('application/json')->set_output(json_encode($reply));
                break;

            case 'unread':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_view_id($value);
                      $message_array->status = "new";
                      $message_array->save();
                }
                
                $reply = array();
                $reply["token_name"] = $this->security->get_csrf_token_name();
                $reply["token"] = $this->security->get_csrf_hash();
                $this->output->set_content_type('application/json')->set_output(json_encode($reply));
                break;

            case 'spam':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_view_id($value);
                      $message_array->spam = TRUE;
                      $message_array->save();
                }
                
                $reply = array();
                $reply["token_name"] = $this->security->get_csrf_token_name();
                $reply["token"] = $this->security->get_csrf_hash();
                $this->output->set_content_type('application/json')->set_output(json_encode($reply));
                break;

            case 'important':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_view_id($value);
                      $message_array->important = TRUE;
                      $message_array->save();
                }
                
                $reply = array();
                $reply["token_name"] = $this->security->get_csrf_token_name();
                $reply["token"] = $this->security->get_csrf_hash();
                $this->output->set_content_type('application/json')->set_output(json_encode($reply));
                break;

            case 'delete':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_view_id($value);
                      $message_array->deleted = TRUE;
                      $message_array->save();
                }
                
                $reply = array();
                $reply["token_name"] = $this->security->get_csrf_token_name();
                $reply["token"] = $this->security->get_csrf_hash();
                $this->output->set_content_type('application/json')->set_output(json_encode($reply));
                break;
            
            default:
                # code...
                break;
        }
    } else {
        show_404();
    }
}

function load_message_list($mode = NULL){
    if ( $this->input->is_ajax_request() && $this->user) {
            
            if($this->input->get('filter')){
                $filter = intval($this->input->get('filter'));
            } else {
                $filter = 10;
            }   

            $this->theme_view = '';

            switch ($mode) {
                case 'inbox':
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where deleted != TRUE and spam != TRUE');

                    $iTotalRecords = intval($message_count[0]->message_number);
                    $iDisplayLength = $filter;
                    $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
                    $iDisplayStart = ($this->input->get('start') >= 0)? $this->input->get('start') : 0;

                    $end = $iDisplayStart + $iDisplayLength;
                    $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                    $message_array = Outbox_messages::find('all', array('limit'=>$iDisplayLength,'offset'=>$iDisplayStart,'conditions'=> array(' deleted != ? and spam != ?', TRUE, TRUE)));
                    break;

                case 'important':
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where important = TRUE and deleted != TRUE and spam != TRUE');

                    $iTotalRecords = intval($message_count[0]->message_number);
                    $iDisplayLength = $filter;
                    $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
                    $iDisplayStart = ($this->input->get('start') >= 0)? $this->input->get('start') : 0;

                    $end = $iDisplayStart + $iDisplayLength;
                    $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                    $message_array = Outbox_messages::find('all', array('limit'=>$iDisplayLength,'offset'=>$iDisplayStart,'conditions'=> array(' important = ? and deleted != ? and spam != ?', TRUE,TRUE,TRUE)));
                    break;

                case 'spam':
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where spam = TRUE and deleted != TRUE');

                    $iTotalRecords = intval($message_count[0]->message_number);
                    $iDisplayLength = $filter;
                    $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
                    $iDisplayStart = ($this->input->get('start') >= 0)? $this->input->get('start') : 0;

                    $end = $iDisplayStart + $iDisplayLength;
                    $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                    $message_array = Outbox_messages::find('all', array('limit'=>$iDisplayLength,'offset'=>$iDisplayStart,'conditions'=> array(' spam = ? and deleted != ?', TRUE, TRUE)));
                    break;

                case 'trash':
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where deleted = TRUE and spam != TRUE');

                    $iTotalRecords = intval($message_count[0]->message_number);
                    $iDisplayLength = $filter;
                    $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
                    $iDisplayStart = ($this->input->get('start') >= 0)? $this->input->get('start') : 0;

                    $end = $iDisplayStart + $iDisplayLength;
                    $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                    $message_array = Outbox_messages::find('all', array('limit'=>$iDisplayLength,'offset'=>$iDisplayStart,'conditions'=> array(' deleted = ? and spam != ? ', TRUE, TRUE)));
                    break;
                
                default:
                    # code...
                    break;
            }
            

            //$display_counter = ($message_count[0]->message_number > 0) ? 1 . " - " . $filter . " of ". $message_count[0]->message_number : NULL;
            
            

            $wrapper = array();

            if ($message_array) {
                 foreach($message_array as $key => $value){
                            $star = ($value->important)? " inbox-started": NULL;
                            $status = ($value->status == "new")? 'unread': NULL;
                            $marker = ($value->status == "new")? '<i class="fa fa-envelope"></i> &nbsp;': '<i class="icon-envelope-open"></i> &nbsp;';
                            $attachment = ($value->attachment)? '<i class="fa fa-paperclip"></i>': NULL;
                            
                            $sender = explode("<", trim($value->sender));
         
                             if (count($sender)  > 1 ) {
                                 $sender_display = $sender[0];
                             } else {
                                 $sender_display = $sender[0];
                             }

                    $wrapper['data'][] = array( 
                    
                             '<tr class="' . $status . ' col-message" data-messageid="'.$value->view_id.'"><td class="inbox-small-cells" style="width: 4px;"><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="mail-checkbox" name="mails[]" value="'.$value->view_id.'" /><span></span></label></td>', '<td class="inbox-small-cells"><i class="fa fa-star '. $star .' star-marker" data-id="'.$value->view_id.'"></i></td>', '<td class="inbox-small-cells"><i class="fa fa-trash" data-id="'.$value->view_id.'"></i></td>', 
                             '<td class="view-message hidden-xs">'. $marker . $sender_display . '</td>','<td class="view-message ">'. $value->subject .'</td>', '<td class="view-message inbox-small-cells">'. $attachment .'</td> <td class="view-message"  style="width: 130px;">'. date_format(date_create($value->time), "M. d, Y H:i:s a") .'</td></tr>'
                    );

                }

                $wrapper['total_records'] = $iTotalRecords;
                $wrapper['records_end'] = $end;
                 
            } else {
                 $wrapper['data'][0] = array('<tr><td class="text-center" colspan="7"><code>No messages found.</code></td></tr>');
                 $wrapper['total_records'] = false;
            }

         $this->output->set_content_type('application/json')->set_output(json_encode($wrapper));

    } else {
        show_404();
    }
}

function view_message($id = NULL){
        
        if ( $this->user && $this->input->is_ajax_request() ) {
             $this->theme_view = '';
             $message_array = Outbox_messages::find_by_view_id($this->input->get('message_id'));
             
             if($message_array){
                  $message_array->status = "read";
                  $message_array->save();

             } else {
                show_404();
             }

             $sender = explode("<", trim($message_array->sender));
             
             if (count($sender)  > 1 ) {
                 $sender_display = '<span class="sbold">' . $sender[0] . '</span> <span> &#60;'. $sender[1] .'</span>';
             } else {
                 $sender_display = '<span class="sbold">' . $sender[0] . '</span>';
             }

             $cc = ($message_array->cc)? '<br /><span> Cc: <i class="fa fa-angle-double-right"></i> ' . $message_array->cc .'</span>': NULL;

             $return_this = '<div class="inbox-header inbox-view-header">
                            <h1 class="pull-left">'. $message_array->subject . '</h1>
                        </div>
                        <div class="inbox-view-info">
                            <div class="row">
                                <div class="col-md-7">
                                    To: <i class="fa fa-angle-double-right"></i>
                                    <span class="sbold">' . $message_array->recipient . '</span> <br />
                                    From: <i class="fa fa-angle-double-right"></i> ' . $sender_display . ' <br /> On: <i class="fa fa-angle-double-right"></i> '. date_format(date_create($message_array->time), "M. d, Y h:i:s a") .'
                                    '. $cc .'

                                </div>
                                <div class="col-md-5 inbox-info-btn">
                                    <div class="btn-group">
                                        <a class="btn btn-sm blue btn-outline dropdown-toggle sbold" href="javascript:;" data-toggle="dropdown"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </a>

                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;" data-messageid="'.$message_array->view_id.'" class="reply-btn">
                                                    <i class="fa fa-reply"></i> Reply </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-arrow-right reply-btn"></i> Forward </a>
                                            </li>
                            
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-ban"></i> Spam </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-trash-o"></i> Delete </a>
                                            </li>
                                         </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inbox-view">'
                         . $message_array->message .   
                        '</div>';
                        
                        if ($message_array->attachment) {
                            $attachment_array = ArticleHasAttachment::find('all', array('conditions'=> array(' article_id = ?', $message_array->id)));

                              function formatSizeUnits($bytes)
                                    {
                                        if ($bytes >= 1073741824)
                                        {
                                            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                                        }
                                        elseif ($bytes >= 1048576)
                                        {
                                            $bytes = number_format($bytes / 1048576, 2) . ' MB';
                                        }
                                        elseif ($bytes >= 1024)
                                        {
                                            $bytes = number_format($bytes / 1024, 2) . ' KB';
                                        }
                                        elseif ($bytes > 1)
                                        {
                                            $bytes = $bytes . ' bytes';
                                        }
                                        elseif ($bytes == 1)
                                        {
                                            $bytes = $bytes . ' byte';
                                        }
                                        else
                                        {
                                            $bytes = '0 bytes';
                                        }

                                        return $bytes;
                                }

                            $files = '';
                            foreach ($attachment_array as $key => $value) {
                                $size = formatSizeUnits(intval($value->size));
                                $types = array('png', 'jpg', 'gif', 'bmp');

                                if (in_array($value->filetype, $types)) {
                                    $files = '<div class="margin-bottom-25">
                                            <img src="'.base_url().'files/media/attachments/'.$value->savename.'">
                                          </div>
                                          <div>
                                                <strong>File name: '.$value->filename.'</strong>
                                                <span>'.$size.'</span>
                                                <a href="'.base_url().'messages/download/single/'.$value->savename.'">Download </a>
                                         '.$files.'</div>';
                                } else {
                                    $files = '<div class="margin-bottom-25"></div>
                                                <div>
                                                    <strong>File name: '.$value->filename.'</strong>
                                                    <span>'.$size.'</span>
                                                    <a href="'.base_url().'messages/download/single/'.$value->savename.'">Download </a>
                                             '.$files.'</div>';
                                }
                            }

                            $return_this = $return_this . '<hr>
                                            <div class="inbox-attached">
                                                <div class="margin-bottom-15">
                                                    <span>attachments — </span>
                                                    <a href="'.base_url().'messages/download/all/'.$message_array->view_id.'">Download all attachments </a>
                                                </div>'.$files.'</div>';
                        }

            $this->output->set_content_type('text/html')->set_output($return_this);
    } else {
        show_404();
    }
}

function check_counters(){
    $this->theme_view = '';
    $return_data = array();

    if ( $this->user && $this->input->is_ajax_request() ) {
        
        $message_array = Outbox_messages::find('all', array('conditions'=> array(' status = ? and deleted != ? and spam != ?', "new",TRUE, TRUE)));
        
        $messages = '';

        if ($message_array) {
                 foreach($message_array as $key => $value){
                      $unix = human_to_unix(date_format(date_create($value->time),'Y-m-d G:i')); 
                      $moment = time_ago($unix, false);

                      $messages =  '<li>
                            <a href="'.base_url().'messages?a=view&msg='.$value->view_id.'">
                                <span class="photo">
                                    <img src="' . base_url() . 'files/media/avatars/no-pic.png" class="img-circle" alt=""> </span>
                                <span class="subject">
                                    <span class="from">' . character_limiter($value->subject, 20) . '</span>
                                    <span class="time">' . $moment . '</span>
                                </span>
                                <span class="message">'. character_limiter(strip_tags($value->message), 20) . '</span>
                            </a>
                        </li>'. $messages;
                }
                 
        }

        $return_data['peek'] = $messages;

        $message_count_inbox = $this->check_message();
        $return_data['inbox'] = $message_count_inbox[0]->message_number;

        $message_count_trash = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where deleted = TRUE');
        $return_data['trash'] = $message_count_trash[0]->message_number;

        $message_count_important = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where important = TRUE');
        $return_data['important'] = $message_count_important[0]->message_number;

        $message_count_spam = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where spam = TRUE and deleted != TRUE');
        $return_data['spam'] = $message_count_spam[0]->message_number;

        $this->output->set_content_type('application/json')->set_output(json_encode($return_data));

    } else {
        show_404();
    }
    
}

function send_mail(){

    if ($this->user) {
        $this->load->library('email');

       $result = $this->email
                ->from($this->user->email)
                ->to($this->input->post('to'))
                ->subject($this->input->post('subject'))
                ->message($this->input->post('message'));

        if ($this->input->post('cc')) {
            $this->email->cc($this->input->post('cc'));
        }

        if ($this->input->post('bcc')) {
            $this->email->bcc($this->input->post('bcc'));
        }
                
        if ($result->send()) {
            $error = array('success: Email sent');
            $this->session->set_flashdata('message', $error);

        } else {
            $error = array('error: something went wrong.');
            $this->session->set_flashdata('message', $error);
        }
                            
        redirect($this->agent->referrer());
    }       
}

function load_composer(){
    if ( $this->input->is_ajax_request() && $this->user) {
        $this->theme_view = '';

        $data = form_open_multipart('messages/send_mail','class="inbox-compose form-horizontal" id="fileupload"').'
                <div class="inbox-compose-btn">
                    <button class="btn green">
                        <i class="fa fa-check"></i>Send</button>
                    <button class="btn default inbox-discard-btn">Discard</button>
                    <button class="btn default">Draft</button>
                </div>
                <div class="inbox-form-group mail-to">
                    <label class="control-label">To:</label>
                    <div class="controls controls-to">
                        <input type="text" class="form-control" name="to">
                        <span class="inbox-cc-bcc">
                            <span class="inbox-cc"> Cc </span>
                            <span class="inbox-bcc"> Bcc </span>
                        </span>
                    </div>
                </div>
                <div class="inbox-form-group input-cc display-hide">
                    <a href="javascript:;" class="close"> </a>
                    <label class="control-label">Cc:</label>
                    <div class="controls controls-cc">
                        <input type="text" name="cc" class="form-control"> </div>
                </div>
                <div class="inbox-form-group input-bcc display-hide">
                    <a href="javascript:;" class="close"> </a>
                    <label class="control-label">Bcc:</label>
                    <div class="controls controls-bcc">
                        <input type="text" name="bcc" class="form-control"> </div>
                </div>
                <div class="inbox-form-group">
                    <label class="control-label">Subject:</label>
                    <div class="controls">
                        <input type="text" class="form-control" name="subject"> </div>
                </div>
                <div class="inbox-form-group">
                    <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>
                </div>
                <div class="inbox-compose-attachment">
                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <span class="btn green btn-outline fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span> Add files... </span>
                        <input type="file" name="files[]" multiple> </span>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped margin-top-10">
                        <tbody class="files"> </tbody>
                    </table>
                </div>
                <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                        <td class="name" width="30%">
                            <span>{%=file.name%}</span>
                        </td>
                        <td class="size" width="40%">
                            <span>{%=o.formatFileSize(file.size)%}</span>
                        </td> {% if (file.error) { %}
                        <td class="error" width="20%" colspan="2">
                            <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else if (o.files.valid && !i) { %}
                        <td>
                            <p class="size">{%=o.formatFileSize(file.size)%}</p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                        </td> {% } else { %}
                        <td colspan="2"></td> {% } %}
                        <td class="cancel" width="10%" align="right">{% if (!i) { %}
                            <button class="btn btn-sm red cancel">
                                <i class="fa fa-ban"></i>
                                <span>Cancel</span>
                            </button> {% } %}</td>
                    </tr> {% } %} </script>
                <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade"> {% if (file.error) { %}
                        <td class="name" width="30%">
                            <span>{%=file.name%}</span>
                        </td>
                        <td class="size" width="40%">
                            <span>{%=o.formatFileSize(file.size)%}</span>
                        </td>
                        <td class="error" width="30%" colspan="2">
                            <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else { %}
                        <td class="name" width="30%">
                            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'.chr(39).'gallery'.chr(39).'%}" download="{%=file.name%}">{%=file.name%}</a>
                        </td>
                        <td class="size" width="40%">
                            <span>{%=o.formatFileSize(file.size)%}</span>
                        </td>
                        <td colspan="2"></td> {% } %}
                        <td class="delete" width="10%" align="right">
                            <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" {% if (file.delete_with_credentials) { %} data-xhr-fields='.chr(39).'{"withCredentials":true}'.chr(39).' {% } %}>
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr> {% } %} </script>
                <div class="inbox-compose-btn">
                    <button class="btn green">
                        <i class="fa fa-check"></i>Send</button>
                    <button class="btn default">Discard</button>
                    <button class="btn default">Draft</button>
                </div>
            </form>';
         $this->output->set_content_type('text/html')->set_output($data);
    } else {
        show_404();
    }


}



}
