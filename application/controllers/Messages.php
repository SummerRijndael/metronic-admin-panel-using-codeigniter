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

function waga(){
            $this->load->helper('string');
            $this->theme_view = '';
            //print_r(explode("<", "Google <no-reply@accounts.google.com>"));
            //exit();
            $emailconfig = Setting::first();

            // this shows basic IMAP, no TLS required
            $config['login'] = $emailconfig->mailbox_username;
            $config['pass'] = $emailconfig->mailbox_password;
            $config['host'] = $emailconfig->mailbox_host;
            $config['port'] = $emailconfig->mailbox_port;
            $config['mailbox'] = $emailconfig->mailbox_box;

            if($emailconfig->mailbox_imap == "1"){$flags = "/imap";}else{$flags = "/pop3";}
            if($emailconfig->mailbox_ssl == "1"){$flags .= "/ssl";}

            $config['service_flags'] = $flags.$emailconfig->mailbox_flags;

            $this->load->library('peeker', $config);
            //attachment folder
            $bool = $this->peeker->set_attachment_dir('files/media/email_files');
            //Search Filter
            $this->peeker->set_search($emailconfig->mailbox_search);
            echo $this->peeker->search_and_count_messages();
            
            if ($this->peeker->search_and_count_messages() != "0"){
                $id_array = $this->peeker->get_ids_from_search();
                
                //walk trough emails
                $details = array();                

                foreach($id_array as $email_id){
                    $email_object = $this->peeker->get_message($email_id);
                    $email_object->rewrite_html_transform_img_tags('files/media/attachments/');
                    $attachment = ($email_object->has_attachment())? TRUE: FALSE;

                    //Attachments
                    $parts = $email_object->get_parts_array();
                    $email_attachment = array();
                    if($email_object->has_attachment()){
                        foreach ($parts as $part){

                            $savename = $email_object->get_fingerprint().random_string('alnum', 8).$part->get_filename();
                            $savename = str_replace(' ','_',$savename); $savename = str_replace('%20','_',$savename);
                            $savename = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', $savename);
                            // Remove any runs of periods
                            $savename = preg_replace("([\.]{2,})", '', $savename);
                            $orgname = $part->get_filename();
                            $orgname = str_replace(' ','_',$orgname); $orgname = str_replace('%20','_',$orgname);
                            $part->filename = $savename;
                            $attributes = array('article_id' => 1, 'filename' => $orgname, 'savename' => $savename);
                            //$attachment = ArticleHasAttachment::create($attributes);
                            $email_attachment[] = "files/media/attachments/".$savename;
                        }
                        $email_object->save_all_attachments('files/media/attachments/');
                    }

                    $details['status'] = 'new';
                    $details['time'] = $email_object->get_date();
                    $details['sender'] = $email_object->get_from();
                    $details['subject'] = $email_object->get_subject();
                    
                    if ($email_object->has_PLAIN_not_HTML()) {
                        $details['message'] = $email_object->get_plain();    
                    } else {
                        $details['message'] = $email_object->get_html();    
                    }
                    
                    $details['attachment'] = $attachment;
                    //$details['headers'] = $email_object->get_header_array();

                    $outbox = Outbox_messages::create($details);
                }
            }

            //print_r($details);
            $this->peeker->close();
            exit();
}

function mark(){
    $this->theme_view = '';

    if ($this->user && $this->input->is_ajax_request()) { 
         $message = Outbox_messages::find_by_id($this->input->get('message_id'));

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

function bulk_action($mode = NULL){
    $this->theme_view = '';

    if ($this->user && $this->input->is_ajax_request()) {
        switch ($mode) {
            case 'read':
                foreach ($this->input->post('mail_ids') as $key => $value) {
                      $message_array = Outbox_messages::find_by_id($value);
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
                      $message_array = Outbox_messages::find_by_id($value);
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
                      $message_array = Outbox_messages::find_by_id($value);
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
                      $message_array = Outbox_messages::find_by_id($value);
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
                      $message_array = Outbox_messages::find_by_id($value);
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
            $this->theme_view = '';
            $messages = "";

            switch ($mode) {
                case 'inbox':
                    $message_array = Outbox_messages::find('all', array('conditions'=> array(' deleted != ? and spam != ?', TRUE, TRUE)));
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where deleted != TRUE and spam != TRUE');
                    break;
                case 'important':
                    $message_array = Outbox_messages::find('all', array('conditions'=> array(' important = ?', TRUE)));
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where important = TRUE');
                    break;
                case 'spam':
                    $message_array = Outbox_messages::find('all', array('conditions'=> array(' spam = ? and deleted != ?', TRUE, TRUE)));
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where spam = TRUE and deleted != TRUE');
                    break;
                case 'trash':
                    $message_array = Outbox_messages::find('all', array('conditions'=> array(' deleted = ? and spam != ? ', TRUE, TRUE)));
                    $message_count = Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where deleted = TRUE and spam != TRUE');
                    break;
                
                default:
                    # code...
                    break;
            }
            

            $display_counter = ($message_count[0]->message_number > 0) ? 1 . " - " . $message_count[0]->message_number . " of ". $message_count[0]->message_number : NULL;

            if ($message_array) {
                 foreach($message_array as $key => $value){
                            $star = ($value->important)? " inbox-started": NULL;
                            $status = ($value->status == "new")? 'unread': NULL;
                            $marker = ($value->status == "new")? '<i class="fa fa-envelope"></i> &nbsp;': '<i class="icon-envelope-open"></i> &nbsp;';
                            $attachment = ($value->attachment)? '<i class="fa fa-paperclip"></i>': NULL;
                            
                            $messages ='<tr class="' . $status . ' col-message" data-messageid="'.$value->id.'">
                               <td class="inbox-small-cells">
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="mail-checkbox" name="mails[]" value="'.$value->id.'" />
                                    <span></span>
                                </label>
                            </td>
                            <td class="inbox-small-cells">
                                <i class="fa fa-star '. $star .' star-marker" data-id="'.$value->id.'"></i>
                            </td>
                            <td class="view-message hidden-xs">'. $marker . $value->sender .'</td>
                            <td class="view-message ">'. $value->subject .'</td>
                            <td class="view-message inbox-small-cells">'. $attachment .'</td>
                            <td class="view-message"  style="width: 130px;">'. date_format(date_create($value->time), "M. d, Y H:i:s a") .'</td>
                        </tr>'.$messages;
                }
                 
            } else {
                 $messages ='<tr><td class="text-center" colspan="4"><code>No messages found.</code></td></tr>';

            }
            
            $records = '<table class="table table-bordered table-striped table-advance table-hover">
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
                                            <a href="'.base_url().'messages/bulk_action/important">
                                                <i class="fa fa-star"></i> Mark as Important </a>
                                        </li>
                                        <li>
                                            <a href="'.base_url().'messages/bulk_action/read">
                                                <i class="icon-envelope-open"></i> Mark as Read </a>
                                        </li>
                                        <li>
                                            <a href="'.base_url().'messages/bulk_action/unread">
                                                <i class="fa fa-envelope"></i> Mark as Unread </a>
                                        </li>
                                        <li>
                                            <a href="'.base_url().'messages/bulk_action/spam">
                                                <i class="fa fa-ban"></i> Mark as Spam </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="'.base_url().'messages/bulk_action/delete">
                                                <i class="fa fa-trash-o"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>
                               
                               <select name="accounts_length" class="form-control input-xs input-sm input-inline">
                                   <option value="10">10</option>
                                   <option value="20">20</option>
                                   <option value="50">50</option>
                                   <option value="100">100</option>
                                   <option value="150">150</option>
                               </select> messages per page.
                            </th>
                            <th class="pagination-control" colspan="3">
                                <span class="pagination-info">' . $display_counter . '</span>
                                <a class="btn btn-sm blue btn-outline">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="btn btn-sm blue btn-outline">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>'. $messages .'</tbody>
                    </table>';  

         $this->output->set_content_type('text/html')->set_output($records);

    } else {
        show_404();
    }
}

function view_message(){
    if ( $this->user && $this->input->is_ajax_request() ) {
         $this->theme_view = '';
         $message_array = Outbox_messages::find_by_id($this->input->get('message_id'));
         $message_array->status = "read";
         $message_array->save();

         $sender = explode("<", trim($message_array->sender));
         
         if (count($sender)  > 1 ) {
             $sender_display = '<span class="sbold">' . $sender[0] . '</span> <span> &#60;'. $sender[1] .'</span>';
         } else {
             $sender_display = '<span class="sbold">' . $sender[0] . '</span>';
         }

         $return_this = '<div class="inbox-header inbox-view-header">
                        <h1 class="pull-left">'. $message_array->subject . '</h1>
                    </div>
                    <div class="inbox-view-info">
                        <div class="row">
                            <div class="col-md-7">
                                <img src="'.base_url().'files/media/avatars/no-pic.png" width="7%" class="inbox-author">
                                ' . $sender_display . ' to
                                <span class="sbold"> me </span> on '. date_format(date_create($message_array->time), "M. d, Y h:i:s a") .'</div>
                            <div class="col-md-5 inbox-info-btn">
                                <div class="btn-group">
                                    <button data-messageid="'.$message_array->id.'" class="btn green reply-btn">
                                        <i class="fa fa-reply"></i> Reply
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;" data-messageid="'.$message_array->id.'" class="reply-btn">
                                                <i class="fa fa-reply"></i> Reply </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-arrow-right reply-btn"></i> Forward </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
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
                                        <li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inbox-view">'
                     . $message_array->message .   
                    '</div>';
                    
                    if ($message_array->attachment) {
                        $return_this = $return_this . '<hr>
                    <div class="inbox-attached">
                        <div class="margin-bottom-15">
                            <span>attachments — </span>
                            <a href="javascript:;">Download all attachments </a>
                            <a href="javascript:;">View all images </a>
                        </div>
                        <div class="margin-bottom-25">
                            <img src="'.base_url().'assets/pages/media/gallery/image4.jpg">
                            <div>
                                <strong>image4.jpg</strong>
                                <span>173K </span>
                                <a href="javascript:;">View </a>
                                <a href="javascript:;">Download </a>
                            </div>
                            <div class="margin-bottom-25">
                                <img src="'.base_url().'assets/pages/media/gallery/image3.jpg">
                                <div>
                                    <strong>IMAG0705.jpg</strong>
                                    <span>14K </span>
                                    <a href="javascript:;">View </a>
                                    <a href="javascript:;">Download </a>
                                </div>
                            </div>
                            <div class="margin-bottom-25">
                                <img src="'.base_url().'assets/pages/media/gallery/image5.jpg">
                                <div>
                                    <strong>test.jpg</strong>
                                    <span>132K </span>
                                    <a href="javascript:;">View </a>
                                    <a href="javascript:;">Download </a>
                                </div>
                            </div>';
                    }

        $this->output->set_content_type('text/html')->set_output($return_this);
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
                            <a href="#">
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
