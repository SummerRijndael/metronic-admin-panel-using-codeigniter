<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_service extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
         if (!$this->user) {
            $this->set_last_url();
            redirect('login');
        } else {
            if ( !in_array("3", explode(",", $this->user->access_child)) ) {
                  show_404();
            }
        }
    }

	public function index()
	{
		$this->view_data['settings'] = Setting::first();
        $this->view_data['form_action'] = "email_service/update_settings";
        $this->content_view = 'settings/email_settings';
	}

    function testpostmaster($mode = NULL){

            switch ($mode) {
                case 'email':
                        $this->load->library('email');
                        $emailconfig = Setting::first();
                        
                        $subject = 'This is a test';
                        $message = '<p>This message has been sent for testing purposes.</p>';

                        // Get full html:
                        $body =
                        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
                            <title>'.html_escape($subject).'</title>
                            <style type="text/css">
                                body {
                                    font-family: Arial, Verdana, Helvetica, sans-serif;
                                    font-size: 16px;
                                }
                            </style>
                        </head>
                        <body>
                        '.$message.'
                        </body>
                        </html>';
                        // Also, for getting full html you may use the following internal method:
                        //$body = $this->email->full_html($subject, $message);

                        $result = $this->email
                            ->from($this->user->email)
                            ->to($emailconfig->email_username)
                            ->subject($subject)
                            ->message($body);

                        //echo $this->email->print_debugger();

                        if($result->send()){
                            $this->view_data['msgresult'] = "success";
                            $this->view_data['result'] = "Sending test email success.";
                            $this->view_data['trace'] = "Message send please check your smtp email address.";
                        }else{
                            $this->view_data['msgresult'] = "danger";
                            $this->view_data['result'] = "Sending test email failed!";
                            $this->view_data['trace'] = "Something went wrong please check your settings. <br/>".strip_tags($this->email->print_debugger());
                        }
                        
                        $this->content_view = 'settings/_testpostmaster';
                        $this->theme_view = 'modal_nojs';
                        $this->view_data['title'] = '<i class="fa fa-envelope font-red-sunglo"></i>
                                             <span class="caption-subject font-red-sunglo bold uppercase">Email sending test.</span>';

                    break;

                case 'mailbox':
                        $emailconfig = Setting::first();
                        $config['login'] = $emailconfig->mailbox_username;
                        $config['pass'] = $emailconfig->mailbox_password;
                        $config['host'] = $emailconfig->mailbox_host;
                        $config['port'] = $emailconfig->mailbox_port;
                        $config['mailbox'] = $emailconfig->mailbox_box;

                        if($emailconfig->mailbox_imap == "1"){$flags = "/imap";}else{$flags = "/pop3";}
                        if($emailconfig->mailbox_ssl == "1"){$flags .= "/ssl";}

                        $config['service_flags'] = $flags.$emailconfig->mailbox_flags; 

                        $this->load->library('peeker_connect');
                        $this->peeker_connect->initialize($config);
                        
                        if($this->peeker_connect->is_connected()){
                            $this->view_data['msgresult'] = "success";
                            $this->view_data['result'] = "Connection to email mailbox successful!";
                        }else{
                            $this->view_data['msgresult'] = "danger";
                            $this->view_data['result'] = "Connection to email mailbox not successful!";
                        }
                        $this->peeker_connect->message_waiting();
                        
                        $this->peeker_connect->close();
                        $this->view_data['trace'] = $this->peeker_connect->trace();
                        $this->content_view = 'settings/_testpostmaster';
                        $this->theme_view = 'modal_nojs';
                        $this->view_data['title'] = '<i class="fa fa-envelope font-red-sunglo"></i>
                                             <span class="caption-subject font-red-sunglo bold uppercase">POP / IMAP testing.</span>';
                    break;
                
                default:
                    show_404();
                    break;
            }
          
    }

    function update_settings(){
        $this->theme_view ="";

        if ($this->user && $this->user->admin) {
                            $info = Setting::first();                    
                            $error_message = array();
                            $final = array();

                            $data = array(
                                "email_protocol"=> $info->email_protocol,
                                "email_host"=> $info->email_host,
                                "email_username"=> $info->email_username,
                                "email_password"=> $info->email_password,
                                "email_port"=> $info->email_port,
                                "email_crypto"=> $info->email_crypto,

                                "mailbox_address"=> $info->mailbox_address,
                                "mailbox_host"=> $info->mailbox_host,
                                "mailbox_username"=> $info->mailbox_username,
                                "mailbox_password"=> $info->mailbox_password,
                                "mailbox_port"=> $info->mailbox_port,
                                "mailbox_box"=> $info->mailbox_box,
                                "mailbox_flags"=> $info->mailbox_flags,
                                "mailbox_search"=> $info->mailbox_search,
                                "mailbox_imap"=> $info->mailbox_imap,
                                "mailbox_ssl"=> $info->mailbox_ssl,

                            );

                            $changes = array(
                                'email_protocol' => htmlspecialchars($this->input->post('email_protocol')),
                                'email_host' => htmlspecialchars($this->input->post('email_host')),
                                'email_username' => htmlspecialchars($this->input->post('email_username')),
                                'email_password' => htmlspecialchars($this->input->post('email_password')),
                                'email_port' => htmlspecialchars($this->input->post('email_port')),
                                'email_crypto' => htmlspecialchars($this->input->post('email_crypto')),

                                "mailbox_address"=>  htmlspecialchars($this->input->post('mailbox_address')),
                                "mailbox_host"=>  htmlspecialchars($this->input->post('mailbox_host')),
                                "mailbox_username"=>  htmlspecialchars($this->input->post('mailbox_username')),
                                "mailbox_password"=>  htmlspecialchars($this->input->post('mailbox_password')),
                                "mailbox_port"=>  htmlspecialchars($this->input->post('mailbox_port')),
                                "mailbox_box"=>  htmlspecialchars($this->input->post('mailbox_box')),
                                "mailbox_flags"=>  htmlspecialchars($this->input->post('mailbox_flags')),
                                "mailbox_search"=>  htmlspecialchars($this->input->post('mailbox_search')),
                            );  
                            
                            if ( $this->input->post('mailbox_imap', TRUE) === "on") {
                                $changes["mailbox_imap"] = 1;
                            } else {
                                $changes["mailbox_imap"] = 0;
                            }  

                            if ( $this->input->post('mailbox_ssl', TRUE) === "on") {
                                $changes["mailbox_ssl"] = 1;
                            } else {
                                $changes["mailbox_ssl"] = 0;
                            }  

                            if ( array_diff_assoc($changes, $data) ) {
                                    $this->load->library('form_validation');

                                    $config = array(
                                        array(
                                                'field' => 'email_protocol',
                                                'label' => 'email protocol',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'email_host',
                                                'label' => 'host',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'email_username',
                                                'label' => 'username',
                                                'rules' => "trim|required|max_length[30]|valid_email"
                                        ),

                                        array(
                                                'field' => 'email_password',
                                                'label' => 'password',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'email_port',
                                                'label' => 'port',
                                                'rules' => "trim|required|max_length[30]|numeric|is_natural_no_zero"
                                        ),

                                        array(
                                                'field' => 'email_crypto',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'mailbox_address',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]|valid_email"
                                        ),

                                        array(
                                                'field' => 'mailbox_host',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'mailbox_username',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]|valid_email"
                                        ),

                                        array(
                                                'field' => 'mailbox_password',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'mailbox_port',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]|numeric|is_natural_no_zero"
                                        ),

                                        array(
                                                'field' => 'mailbox_box',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'mailbox_flags',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                        array(
                                                'field' => 'mailbox_search',
                                                'label' => 'encryption mode',
                                                'rules' => "trim|required|max_length[30]"
                                        ),

                                    );

                                    $this->form_validation->set_error_delimiters('', '');              
                                    $this->form_validation->set_rules($config);

                                    if ($this->form_validation->run() == FALSE){       
                                        foreach ($this->form_validation->error_array() as $key => $value) {
                                            $error_message[] = "error:" .$value;
                                            unset($changes[$key]);
                                        }
     
                                    } 
                            } 

            $final = array_diff_assoc($changes, $data);

            if ($data['mailbox_imap'] != $changes['mailbox_imap']) {
                $final['mailbox_imap'] = $changes['mailbox_imap'];
            }

            if ($data['mailbox_ssl'] != $changes['mailbox_ssl']) {
                $final['mailbox_ssl'] = $changes['mailbox_ssl'];
            }
            /*var_dump(array_filter(array_diff_assoc($changes, $data)));
            var_dump($data);
            var_dump($changes);*/
                  
            if ( count($error_message) == 0 && !count($final) ) {
                 $error = array('info: Nothing changed.');                              
                 $this->session->set_flashdata('message', $error);
                
            } elseif ( count($error_message) == 0 && count($final) ) {
                 $info->update_attributes($final);
                 $info->save();
                 
                 $error = array('success: Settings updated.');                               
                 $this->session->set_flashdata('message', $error);
            
            } elseif ( count($error_message) >= 0 && count($final) ) {
                 $info->update_attributes($final);
                 $info->save();

                 array_push($error_message, 'info: Settings updated, but with some errors.');                               
                 $this->session->set_flashdata('message', $error_message);
             
            } elseif ( count($error_message) >= 0 && count($final) ) {
                 $this->session->set_flashdata('message', $error_message);
             
            } 

            redirect('email_service');
 
        }        
    }


}
