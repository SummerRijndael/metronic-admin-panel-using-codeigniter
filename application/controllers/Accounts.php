<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
        if (!$this->user) {
            $this->set_last_url();
            redirect('login');
        } else {
            if ( !in_array("1", explode(",", $this->user->access_child)) ) {
                  show_404();
            }
        }

    }

	public function index()
	{
        //$a = array('success: niceeeee','error: nooooooooo', 'info: weeeeeeeeeeee');
        //$this->session->set_flashdata('message', $a);
        $this->content_view = 'accounts/list';
	}

	function list_data(){

    if ( $this->input->is_ajax_request() && $this->input->post(NULL, TRUE) && $this->user) {
        $this->theme_view = '';
        /* 
         * Paging
         */

        $total = User::find_by_sql('select count(id) as counter from users');
        $iTotalRecords = $total[0]->counter;
        $iDisplayLength = intval($this->input->post('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval($this->input->post('start'));
        $sEcho = intval($this->input->post('draw'));
        
        $records = array();
        
        $records["data"] = array(); 
        $old_data = $iTotalRecords;

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
          "active"=> array("success" => "Active"),
          "inactive"=> array("warning" => "Inactive"),
          "deleted"=> array("danger" => "Deleted"),
        );

        $role_list = array(
          array("warning" => "Editor"),
          array("info" => "Admin"),
        );

        $sort_list = array(
                0 => 'id',
                1 => 'firstname',
                2 => 'username',
                3 => 'status',
                4 => 'admin',
                5 => 'title',
                6 => 'created',
                7 => 'last_updated'
        );
        
        $column_index = $sort_list[intval($this->input->post('order')[0]['column'])];
        $column_sort_opt = $this->input->post('order')[0]['dir'];
        $final_sort = $column_index . " " . $column_sort_opt;

        if ( $this->input->post("customActionType") && $this->input->post("customActionType") == "group_action" ) {
            $error = FALSE;
            $ids = $this->input->post('id');
            $action = $this->input->post("customActionName");

            foreach ($ids as $key => $value) {
              if ( $this->data_actions($value, $action) ) {
                    $error = TRUE;
                    break;
                }  
            }

            if( !$error ){
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successful! records updated."; // pass custom message(useful for getting status of group actions)
            } else{
                $records["customActionStatus"] = "ERROR"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Something went wrong!."; // pass custom message(useful for getting status of group actions)
            }
          
        }

        if ( $this->input->post(NULL, TRUE) && $this->input->post('action') && $this->input->post('action') === 'filter' ) {
            
            $temp = array();
            $criteria = array();
            $criteria[0] = 'blank';

            if ( !empty( $this->input->post('username') )) { 
                array_push($temp, 'username like ?');
                array_push($criteria,  "%" . $this->input->post('username') .  "%" ) ; 
            }
            

            if ( !empty( $this->input->post('status') )) { 
                array_push($temp, 'status = ?');
                array_push($criteria, $this->input->post('status') ); 
            }
            
            if ( !empty($this->input->post('role') )) {
                array_push($temp, 'admin = ?');
                if ( $this->input->post('role') === 'admin' ) {
                    array_push($criteria, 1);
                }
                else{
                    array_push($criteria, 0);
                }
            }

            if ( !empty( $this->input->post('title') )) { 
                array_push($temp, " title like  ? ");
                array_push($criteria, "%" . $this->input->post('title') . "%" ); 
            }

            if ( !empty( $this->input->post('create_date_from') ) && !empty( $this->input->post('create_date_to') ) ) { 
                array_push($temp, 'created BETWEEN ? AND ?');
                array_push($criteria, date_format(date_create($this->input->post('create_date_from')),'Y-m-d H:i:s') ); 
                array_push($criteria, date_format(date_create($this->input->post('create_date_to')),'Y-m-d 23:59:59') ); 
            }

            if ( !empty( $this->input->post('update_date_from') ) && !empty( $this->input->post('update_date_to') ) ) { 
                array_push($temp, 'last_updated BETWEEN ? AND ?');
                array_push($criteria, date_format(date_create($this->input->post('update_date_from')),'Y-m-d H:i:s') ); 
                array_push($criteria, date_format(date_create($this->input->post('update_date_to')),'Y-m-d 23:59:59') ); 
            }

            $where = implode(' AND ', $temp);
            $criteria[0] = $where;

            //print_r($criteria);
            //exit();

            if (count($criteria) > 1) {
                $options = array('limit'=> $iDisplayLength, 'offset'=> $iDisplayStart, 'conditions' => $criteria, 'order' => $final_sort );  
            }
            else{
                $options = array('limit'=> $iDisplayLength, 'offset'=> $iDisplayStart, 'order' => $final_sort );    
            }
            
        }
        else{
            $options = array('limit'=> $iDisplayLength,'offset'=> $iDisplayStart, 'order' => $final_sort );  
        }

        $results = User::find('all',$options);

        foreach ($results as $key => $value) {
            $status = $status_list[$value->status];
            $role = $role_list[$value->admin];

            /*  rows list
                0 = ids
                1 = fullname
                2 = username
                3 = status
                4 = role
                5 = title
                6 = date created
                7 = last updated
                8 = actions
            */

            $records["data"][] = array(
                                        '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" name="id[]" class="checkboxes" value="'.$value->view_id.'"><span></span></label>',
                                        humanize($value->firstname . ' ' . $value->middlename . ' '. $value->lastname),
                                        $value->username,
                                        '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
                                        '<span class="label label-sm label-'.(key($role)).'">'.(current($role)).'</span>',
                                        humanize($value->title),
                                        date_format($value->created,'[ F. d, Y ] h:i:s a'),
                                        date_format($value->last_updated,'[ F. d, Y ] h:i:s a'),
                                        '<div><a name="view" href="'.base_url().'accounts/view/'.$value->view_id.'" class="label label-success"><i class="fa fa-search"></i> View</a>|<a name="edit" href="'.base_url().'accounts/edit/'.$value->view_id.'" class="label label-info"><i class="fa fa-edit"></i> Edit</a>|<a name="delete" href="'.base_url().'accounts/delete/'.$value->view_id.'" class="label label-danger"><i class="fa fa-trash"></i> Delete</a></div>',
                                    );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        $records["token_name"] = $this->security->get_csrf_token_name();
        $records["token"] = $this->security->get_csrf_hash();

        $this->output->set_content_type('application/json')->set_output(json_encode($records));

        }

        else{
              show_404();
        }

	}

function send_credentials($uid = NULL){
    if ( $this->user->admin && $this->input->post(NULL, TRUE) ) {
        $this->load->helper('file');
            $user_info = User::find_by_view_id($this->input->post('view_id'));
            
            $setting = Setting::first();
            $this->email->from($setting->email, $setting->company);
            $this->email->to($user_info->email); 
            $this->email->subject($setting->credentials_mail_subject);
            $this->load->library('parser');
            $parse_data = array(
                                'client_contact' => $user_info->firstname.' '.$user_info->lastname,
                                'client_link' => $setting->domain,
                                'company' => $setting->company,
                                'username' => $this->input->post('username'),
                                'password' => $this->input->post('password'),
                                'logo' => '<img src="'.base_url().'files/media/'.$setting->logo.'" width="30%" alt="'.$setting->company.'"/>',
                                'invoice_logo' => '<img src="'.base_url().'files/media/'.$setting->logo.'" width="30%" alt="'.$setting->company.'"/>'
                                );
            
            $message = read_file('./application/views/'.$setting->template.'/templates/email_credentials.html');
            $message = $this->parser->parse_string($message, $parse_data);
            $this->email->message($message);

            if($this->email->send()){
                            $user_info->password = $user_info->set_password($this->input->post('password'));
                            $user_info->save();
                            
                            $error = array('success: User credentials sent.');
                            $this->session->set_flashdata('message', $error);
                            
            } else {
                            $error = array('error: Something went wrong.');
                            $this->session->set_flashdata('message', $error);
            }

            redirect($this->agent->referrer());

    } elseif ( $this->user->admin ) {
        $this->theme_view = 'modal';
        
        $this->load->helper('security');
        $this->load->helper('string');
        
        $str = do_hash(random_string('alnum', 40), 'sha512'); // MD5
                
        $this->view_data['new_password'] = substr($str, 0,15);
        $this->view_data['title'] = '<i class="fa fa-user font-red-sunglo"></i>
                                 <span class="caption-subject font-red-sunglo bold uppercase">Email user credentials</span>';
        $this->view_data['form_action']= 'accounts/send_credentials';
        $this->view_data['user_info']= User::find_by_view_id($uid);;
        $this->content_view = 'accounts/_credentials';

    } else {
        show_404();
    }

}

public function view($id = NULL){
   if ($this->user) {
        $result = User::find_by_view_id($id);
            $this->view_data['edit'] = FALSE;
            $this->view_data['form_action'] = base_url()."accounts/edit";
        
        if($result){
            $this->view_data['user_info'] = $result;
            $this->content_view = 'accounts/view';

            
        } else {
            show_404();
        }

   } else {
            show_404();
   }
    
}


public function delete($id = NULL){
    if ($this->user) {
        $this->theme_view = '';
        $result = User::find_by_view_id($id);
        
        if ( $result ) {

            if ($this->user->id === $result->id ) {
                $this->output->set_status_header('400');
            } else {
                $result->status = 'deleted';
                $result->save();
                
                if(!$result){
                    $this->output->set_status_header('400');
                } 
            }

            /* redirect('accounts');*/

        } else {
            show_404();
        }

    } else {
            show_404();
    }
    
}                

private function trigger_reload(){
    $this->session->set_flashdata('reload', true);
}


function verify(){
    if ( $this->input->is_ajax_request() && $this->input->post(NULL, TRUE) && $this->user) {
        $this->theme_view = '';
        $reply = array();
        $reply["token_name"] = $this->security->get_csrf_token_name();
        $reply["token"] = $this->security->get_csrf_hash();

        switch ($this->input->post('mode',true)) {
            case 'username':
                 $result = User::find_by_username($this->input->post('username',true));
                 
                 if ($result){
                    $reply["message"] = TRUE;
                    
                 } else {
                    $reply["message"] = FALSE;
                 }
                
                break;

            case 'email':
                 $result = User::find_by_email($this->input->post('email',true));
                 
                 if ($result){
                    $reply["message"] = TRUE;
                    
                 } else {
                    $reply["message"] = FALSE;
                 }
                
                break;
            
            default:
                # code...
                break;
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($reply));

    } else {
        show_404();
    }
}

public function create(){
        if( $this->input->post(NULL, TRUE) && $this->user){
            $this->load->library('form_validation');
            
              $config = array(
                    array(
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => 'trim|required|min_length[6]|max_length[15]|is_unique[users.username]|regex_match[/(?=^.{3,20}$)^[a-zA-Z][a-zA-Z0-9]*[._-]?[a-zA-Z0-9]+$/]'
                    ),
                    array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required|differs[username]|min_length[8]|max_length[15]|regex_match[/^(?!\.[\d]+)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).+$/]'
                    ),
                    array(
                            'field' => 'rpassword',
                            'label' => 'Password Confirmation',
                            'rules' =>  'required|matches[password]|differs[username]|min_length[8]|max_length[15]|regex_match[/^(?!\.[\d]+)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).+$/]'
                    ),

                    array(
                            'field' => 'email',
                            'label' => 'Email',
                            'rules' => 'trim|required|valid_email|is_unique[users.email]'
                    ),

                    array(
                            'field' => 'title',
                            'label' => 'Title',
                            'rules' => "trim|required|min_length[6]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                    ),

                    array(
                            'field' => 'firstname',
                            'label' => 'Firstname',
                            'rules' => "trim|required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                    ),

                    array(
                            'field' => 'middlename',
                            'label' => 'Middlename',
                            'rules' => "trim|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                    ),

                    array(
                            'field' => 'lastname',
                            'label' => 'Lastname',
                            'rules' => "trim|required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                    ),
                    
            );
            
            $this->form_validation->set_error_delimiters('', '');              
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE){       
                $error_message = array();
                
                foreach ($this->form_validation->error_array() as $key => $value) {
                    $error_message[] = "error:" .$value;
                }
                //$error_message[0] = "error: asdasdas";
                //print_r($error_message);
                $this->session->set_flashdata('message', $error_message);
                redirect($this->agent->referrer());
            }
            
            //exit();
            
            $_POST['title'] = preg_replace('!\s+!', ' ', humanize($this->input->post('title')));
            $_POST['firstname'] = preg_replace('!\s+!', ' ', humanize($this->input->post('firstname')));
            $_POST['middlename'] = preg_replace('!\s+!', ' ', humanize($this->input->post('middlename')));
            $_POST['lastname'] = preg_replace('!\s+!', ' ', humanize($this->input->post('lastname'))); 

            $this->load->helper('security');
            $this->load->helper('string');

            function reference(){
                $str = do_hash(random_string('md5', 40), 'sha1'); // MD5
                
                $ref_id = User::find_by_view_id($str);  

                if(!empty($ref_id)){
                    reference();
                }
                else{
                    return $str;
                }
            }

            $reference = reference();
            $_POST['view_id'] = $reference;

            if ( $_FILES['file-name']['error'] != UPLOAD_ERR_NO_FILE ) {
                $this->load->library('upload');
                $config['upload_path'] = './files/media/avatars/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_width'] = 180;
                $config['max_height'] = 180;
                $this->upload->initialize($config);

                if ( $this->upload->do_upload('file-name') ) {
                     $data = array('upload_data' => $this->upload->data());
                     $_POST['userpic'] = $data['upload_data']['file_name'];
                 } else {
                    $error = array('error' => strip_tags($this->upload->display_errors()));
                    if ($error['error'] != "You did not select a file to upload.") {
                        $error = array('error:' . $error['error'] .': Image upload failed.');
                        $this->session->set_flashdata('message', $error);
                    }
                 }
                unset($_POST['file-name']);
            }
            
            unset($_POST['rpassword']);
            
            if(!empty($_POST["access"])){
                $_POST["access"] = implode(",", $_POST["access"]);
            }
            
            if ( $this->input->post('account_type', TRUE) === "on") {
                $_POST["admin"] = "1";
            } else {
                $_POST["admin"] = "0";
            }
            
            unset($_POST['account_type']);
            //print_r($_POST);
            //redirect('accounts');
            //exit();
            
            $_POST = array_map('htmlspecialchars', $_POST);
            $user->create($_POST);

            if( !$user ){
                $error = array('error: Something went wrong.');
                $this->session->set_flashdata('message', $error);
            } else {
                $error = array('success: User account created.');
                $this->session->set_flashdata('message', $error);
            }
            
            redirect('accounts');
        } else {
            $this->theme_view = 'modal';
            $this->view_data['title'] = '<i class="fa fa-user font-red-sunglo"></i>
                                     <span class="caption-subject font-red-sunglo bold uppercase">User registration form</span>';
            $this->view_data['form_action']= 'accounts/create';
            $this->view_data['modules']= Modules::find('all');
            $this->content_view = 'accounts/registration';
        }
}

function edit($id = FALSE){

       if( $this->input->post(NULL, TRUE) && $this->user ){
            $view_id_link = $this->input->post('view_id',TRUE);
            $result = User::find_by_view_id($view_id_link);

            $this->load->library('form_validation');
            $config = array();
        
            switch ($this->input->post('mode',TRUE)) {
                case 'personal':                                    
                           

                            $data = array(
                                    'email' => $result->email,
                                    'title' => $result->title,
                                    'firstname' => $result->firstname,
                                    'middlename' => $result->middlename,
                                    'lastname' => $result->lastname,
                                    'about' => $result->about,
                                    'interest' => $result->interest,
                                    'occupation' => $result->occupation,
                                    'mobile' => $result->mobile,
                            );

                            $changes = array(
                                    'email' => preg_replace('!\s+!', ' ', $this->input->post('email')),
                                    'title' => preg_replace('!\s+!', ' ', humanize($this->input->post('title'))),
                                    'firstname' => preg_replace('!\s+!', ' ', humanize($this->input->post('firstname'))),
                                    'middlename' => preg_replace('!\s+!', ' ', humanize($this->input->post('middlename'))),
                                    'lastname' => preg_replace('!\s+!', ' ', humanize($this->input->post('lastname'))),
                                    'about' => preg_replace('!\s+!', ' ', htmlentities($this->input->post('about', false))),
                                    'interest' => preg_replace('!\s+!', ' ', htmlentities(humanize($this->input->post('interest',false)))),
                                    'occupation' => preg_replace('!\s+!', ' ', htmlentities(humanize($this->input->post('occupation',false)))),
                                    'mobile' => preg_replace('!\s+!', ' ', $this->input->post('mobile')),
                            );            

                            $config = array(
                                        array(
                                                'field' => 'title',
                                                'label' => 'title',
                                                'rules' => "trim|required|min_length[6]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                                        ),

                                        array(
                                                'field' => 'firstname',
                                                'label' => 'first name',
                                                'rules' => "trim|required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                                        ),

                                        array(
                                                'field' => 'middlename',
                                                'label' => 'middle name',
                                                'rules' => "trim|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                                        ),

                                        array(
                                                'field' => 'lastname',
                                                'label' => 'last name',
                                                'rules' => "trim|required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z][a-zA-Z ]*[\.']?[ a-zA-Z]+$/]"
                                        ),

                                        array(
                                                'field' => 'about',
                                                'label' => 'about',
                                                'rules' => "trim|min_length[3]|max_length[250]"
                                        ),

                                        array(
                                                'field' => 'interest',
                                                'label' => 'interest',
                                                'rules' => "trim|min_length[3]|max_length[60]"
                                        ),

                                        array(
                                                'field' => 'occupation',
                                                'label' => 'occupation',
                                                'rules' => "trim|min_length[3]|max_length[60]"
                                        ),

                                        array(
                                                'field' => 'mobile',
                                                'label' => 'mobile',
                                                'rules' => "trim|min_length[7]|max_length[13]|numeric"
                                        ),
                                    );

                            if (array_key_exists("email", array_diff_assoc($changes, $data))) {
                                //print_r(array_diff_assoc($changes, $data));
                                array_push($config, array('field' => 'email','label' => 'email','rules' => 'trim|required|valid_email|is_unique[users.email]'));
                                //print_r($config);
                            }
                            //exit();

                            if( !empty(array_diff_assoc($changes, $data)) ) {                        
                                    $this->form_validation->set_error_delimiters('', '');              
                                    $this->form_validation->set_rules($config);

                                    if ($this->form_validation->run() == FALSE){       
                                        $error_message = array();
                                        
                                        foreach ($this->form_validation->error_array() as $key => $value) {
                                            $error_message[] = "error:" .$value;
                                        }
                                        //$error_message[0] = "error: asdasdas";
                                        print_r($error_message);
                                        $this->session->set_flashdata('message', $error_message);
                                        redirect($this->agent->referrer());
                                    }
                                    //print_r($config);
                                    //exit();
                                    
                                    $updates = array_diff_assoc($changes, $data);
                                    $updates['last_updated'] = date("Y-m-d G:i:s");

                                    $result->update_attributes($updates);
                                    $result->save();

                                    if ($result) {
                                        $error = array('success: User profile updated.');
                                        $this->session->set_flashdata('message', $error);
                                    }

                            } else {
                                        $error = array('error: Nothing changed.');
                                        $this->session->set_flashdata('message', $error);
                            }
                            
                            //redirect('accounts/edit/'.$view_id_link);  
                            redirect($this->agent->referrer());
                            break;

                        case 'password_update':

                            $user = User::validate_user($this->input->post('username', true), $this->input->post('old_pass',true)); 
                            
                            if($user){

                              $config = array(
                                                array(
                                                            'field' => 'new_pass',
                                                            'label' => 'Password',
                                                            'rules' => 'required|differs[username]|min_length[8]|max_length[15]|regex_match[/^(?!\.[\d]+)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).+$/]'
                                                    ),

                                                array(
                                                            'field' => 'confirm_pass',
                                                            'label' => 'Password Confirmation',
                                                            'rules' =>  'required|matches[new_pass]|differs[username]|min_length[8]|max_length[15]|regex_match[/^(?!\.[\d]+)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).+$/]'
                                                    ),
                                            );
                                    
                                    $this->form_validation->set_error_delimiters('', '');              
                                    $this->form_validation->set_rules($config);

                                    if ($this->form_validation->run() == FALSE){       
                                        $error_message = array();
                                        
                                        foreach ($this->form_validation->error_array() as $key => $value) {
                                            $error_message[] = "error:" .$value;
                                        }
                                        //$error_message[0] = "error: asdasdas";
                                        print_r($error_message);
                                        $this->session->set_flashdata('message', $error_message);
                                        redirect($this->agent->referrer());
                                    }

                                    //print_r($config);
                                    //exit();
                                    
                                    $attr['last_updated'] = date("Y-m-d G:i:s");
                                    $attr['hashed_password'] = $user->set_password($this->input->post('new_pass'));
                                    
                                    $user->update_attributes($attr);
                                    $user->save();

                                    if ($user) {
                                        $error = array('success: Password updated.');
                                        $this->session->set_flashdata('message', $error);
                                    }

                            } else {
                                        $error = array('error: Invalid old password.');
                                        $this->session->set_flashdata('message', $error);
                            }
                            
                            //redirect('accounts/edit/'.$view_id_link);  
                            redirect($this->agent->referrer());
                            break;
                        
                        case 'avatar':
                               if ( $_FILES['file-name']['error'] != UPLOAD_ERR_NO_FILE ) {
                                    $this->load->library('upload');
                                    $config['upload_path'] = './files/media/avatars/';
                                    $config['encrypt_name'] = TRUE;
                                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                                    $config['max_width'] = 180;
                                    $config['max_height'] = 180;
                                    $this->upload->initialize($config);

                                    if ( $this->upload->do_upload('file-name') ) {
                                         $data = array('upload_data' => $this->upload->data());
                                         
                                         if ($result->userpic != "no-pic.png") {
                                             unlink(FCPATH . 'files/media/avatars/' . $result->userpic);
                                         }
                                         
                                         $result->last_updated = date("Y-m-d G:i:s");                        
                                         $result->userpic =  $data['upload_data']['file_name'];
                                         $result->save();

                                         if ($result) {
                                            $error = array('success: Profile picture updated.');
                                            $this->session->set_flashdata('message', $error);
                                         } 

                                     } else {
                                        $error = array('error' => strip_tags($this->upload->display_errors()));
                                        if ($error['error'] != "You did not select a file to upload.") {
                                            $error = array('error:' . $error['error'] .': Image upload failed.');
                                            $this->session->set_flashdata('message', $error);
                                        }
                                     }                                    
                                }

                                //redirect('accounts/edit/'.$view_id_link);  
                                redirect($this->agent->referrer());
                        break;

                        case 'account_settings':
                                if(!empty($_POST["access"])){
                                    $access_parent = array();
                                    $child_array = array();
                                    
                                    foreach ($_POST["access"] as $key => $value) {
                                        $check = Modules::find_by_id($value);
                                        $access_parent[] = $check->nav_child_id;

                                        if ($check->has_child) {

                                            $compare = Module_childs::find('all',array('conditions'=> array("parent_id = ?", $check->nav_child_id)));

                                            foreach ($compare as $index => $vals) {
                                                 $child_array[] = $vals->id;
                                            }

                                            if ( !count(array_intersect($_POST['access_child'], $child_array)) ) {
                                                 $error = array('error: You need atleast 1 sub module selected.');
                                                 $this->session->set_flashdata('message', $error);   
                                                 redirect($this->agent->referrer());
                                                 break;
                                            }

                                        }
                                    }

                                    foreach ($_POST['access_child'] as $key => $value) {
                                          $temp_child = Module_childs::find_by_id($value);

                                          if (!in_array($temp_child->parent_id, $access_parent)) {
                                              unset($_POST['access_child'][array_search($value, $_POST['access_child'])]);
                                          }
                                    }
  
                                    $_POST["access"] = implode(",", $_POST["access"]);
                                    $_POST["access_child"] = implode(",", $_POST["access_child"]);
                                } else {
                                    $_POST["access"] = "3,2";
                                }
                                
                                $_POST['last_updated'] = date("Y-m-d G:i:s");
                                /*print_r($_POST);
                                exit();*/
                                unset($_POST["mode"]);
                                $result->update_attributes($_POST);
                                $result->save();

                                if ($result) {
                                    $error = array('success: Account settings updated.');
                                    $this->session->set_flashdata('message', $error);
                                } else {
                                    $error = array('error: Something went wrong.');
                                    $this->session->set_flashdata('message', $error);
                                }
                                //redirect('accounts/edit/'. $view_id_link);    
                                redirect($this->agent->referrer());
                            break;

                        default:
                            # code...
                            break;
                    }

       
        } else {
                  if ($this->user) {
                      $result = User::find_by_view_id($id);
                    
                        if( $result ){       
                            $modules = Modules::find('all', array('order' => 'sort asc'));
                            $navchild = array();
                
                            foreach ($modules as $key => $value) {
                                if ($value->has_child) {
                                    $temp_container = Module_childs::find('all',array('conditions'=> array("parent_id = ? ", $value->nav_child_id), 'order'=>'sort asc'));
                                    foreach ($temp_container as $index => $vals) {
                                        $navchild[$value->name]['child_name'][] = $vals->name;
                                        $navchild[$value->name]['child_id'][] = $vals->id;
                                    }
                                }                   
                            }
                            unset($temp_container);
                            
                            $this->view_data['navchild'] = $navchild;
                            $this->view_data['modules'] = $modules;

                            $this->view_data['edit'] = true;
                            //$this->view_data['modules'] = Modules::find("all", array('order' => 'sort asc'));
                            $this->view_data['user_info'] = $result;
                            $this->view_data['form_action'] = base_url()."accounts/edit";
                            $this->content_view = 'accounts/view';
                        } else {
                            show_404();
                        }
                        
                  } else {
                    show_404();
                  }
                    
        }
}

private function data_actions($id = NULL, $action = NULL){
    $result = User::find_by_view_id($id);
    
    if ( $result ) {
        switch ($action) {
            case 'disable':
                $result->status = 'inactive';
                break;

            case 'enable':
                $result->status = 'active';
                break;

            case 'delete':
                $result->status = 'deleted';
                break;
        
            default:
                return TRUE;
                break;
        }
        $result->save();

        if ( !$result ) {
            return TRUE;
        }

    } else {
        return TRUE;
    }
}



}
