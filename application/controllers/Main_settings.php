<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_settings extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
         if (!$this->user) {
            $this->set_last_url();
            redirect('login');
        } else {
            if ( !in_array("2", explode(",", $this->user->access_child)) ) {
                  show_404();
            }
        }
    }

	public function index()
	{
		$this->view_data['settings'] = Setting::first();
        $this->view_data['form_action'] = "main_settings/update_settings";
        $this->content_view = 'settings/general_settings';
	}

    function update_settings(){
        $this->theme_view ="";

        if ($this->user && $this->user->admin) {
                            $info = Setting::first();                    
                            $error_message = array();
                            $final = array();

                            $data = array(
                                "company"=> $info->company,
                                "address"=> $info->address,
                                "city"=> $info->city,
                                "contact_person"=> $info->contact_person,
                                "contact_number"=> $info->contact_number,
                                "email"=> $info->email,
                                "domain"=> $info->domain,
                                "idle"=> $info->idle,
                                "logo"=> $info->logo,
                                "small_logo"=> $info->small_logo,
                                "maintenance"=> $info->maintenance,
                                "credentials_mail_subject"=> $info->credentials_mail_subject,
                                "pw_reset_mail_subject" => $info->pw_reset_mail_subject,
                                "short_description"=> $info->short_description,
                                "full_description"=> $info->full_description,
                            );

                            $changes = array(
                                'company' => preg_replace('!\s+!', ' ', htmlspecialchars($this->input->post('company'))),
                                'address' => preg_replace('!\s+!', ' ', htmlspecialchars($this->input->post('address'))),
                                'city' => preg_replace('!\s+!', ' ', htmlspecialchars(humanize($this->input->post('city')))),
                                'contact_person' => preg_replace('!\s+!', ' ', htmlspecialchars(humanize($this->input->post('contact_person')))),
                                'credentials_mail_subject' => preg_replace('!\s+!', ' ', htmlspecialchars($this->input->post('credentials_mail_subject'))),
                                'pw_reset_mail_subject' => preg_replace('!\s+!', ' ', htmlspecialchars($this->input->post('pw_reset_mail_subject'))),
                                'contact_number' => $this->input->post('contact_number'),
                                'email' => $this->input->post('email'),
                                'domain' => $this->input->post('domain'),
                                'idle' => $this->input->post('idle'),
                                'short_description' => preg_replace('!\s+!', ' ', htmlspecialchars($this->input->post('short_description'))),
                                'full_description' => htmlspecialchars($this->input->post('full_description',FALSE)),
                            );  

                            if ( $this->input->post('maintenance', TRUE) === "on") {
                                $changes["maintenance"] = "1";
                            } else {
                                $changes["maintenance"] = "0";
                            }  

                            if ( $_FILES['logo']['error'] != UPLOAD_ERR_NO_FILE ) {

                                    $this->load->library('upload');
                                    $config['upload_path'] = './files/media/';
                                    $config['encrypt_name'] = TRUE;
                                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                                    $config['max_width'] = 800;
                                    $config['max_height'] = 800;
                                    $this->upload->initialize($config);

                                    if ( $this->upload->do_upload('logo') ) {
                                         $data_upload = array('upload_data' => $this->upload->data());
                                         
                                         unlink(FCPATH . 'files/media/' . $info->logo);
                                         $changes['logo'] = $data_upload['upload_data']['file_name'];   

                                     } else {
                                                $error = array('error' => strip_tags($this->upload->display_errors()));
                                                $image_error = array("error:" . $error["error"] .": Company logo upload failed.");
                                                array_push($error_message, $image_error[0]);
                                     }                   
                            } else {
                                $changes['logo'] = $info->logo;
                            }  

                            if ( $_FILES['small-logo']['error'] != UPLOAD_ERR_NO_FILE ) {

                                    $this->load->library('upload');
                                    $config['upload_path'] = './files/media/';
                                    $config['encrypt_name'] = TRUE;
                                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                                    $config['max_width'] = 94;
                                    $config['max_height'] = 14;
                                    $this->upload->initialize($config);
                                    
                                    if ( $this->upload->do_upload('small-logo') ) {
                                         $data_upload = array('upload_data' => $this->upload->data());
                                         
                                         unlink(FCPATH . 'files/media/' . $info->small_logo);
                                         $changes["small_logo"] =  $data_upload['upload_data']['file_name'];
                                          
                                     } else {
                                                $error = array('error' => strip_tags($this->upload->display_errors()));
                                                $image_error = array("error:" . $error["error"] .": Rectangle logo upload failed.");
                                                array_push($error_message, $image_error[0]);
                                     }                              
                            } else {
                                $changes['small_logo'] = $info->small_logo;
                            } 

                            if ( array_diff_assoc($changes, $data) ) {
                                    $this->load->library('form_validation');

                                    $config = array(
                                        array(
                                                'field' => 'company',
                                                'label' => 'company',
                                                'rules' => "trim|required|min_length[1]|max_length[255]"
                                        ),

                                        array(
                                                'field' => 'address',
                                                'label' => 'address',
                                                'rules' => "trim|required|min_length[3]|max_length[255]"
                                        ),

                                        array(
                                                'field' => 'credentials_mail_subject',
                                                'label' => 'credential email subject',
                                                'rules' => "trim|required|min_length[3]|max_length[150]"
                                        ),

                                        array(
                                                'field' => 'pw_reset_mail_subject',
                                                'label' => 'password reset subject',
                                                'rules' => "trim|required|min_length[3]|max_length[150]"
                                        ),

                                        array(
                                                'field' => 'city',
                                                'label' => 'city',
                                                'rules' => "required|trim|min_length[3]|max_length[60]"
                                        ),

                                        array(
                                                'field' => 'contact_person',
                                                'label' => 'contact person',
                                                'rules' => "trim|required|min_length[3]|max_length[150]"
                                        ),

                                        array(
                                                'field' => 'short_description',
                                                'label' => 'short website description',
                                                'rules' => "trim|max_length[1000]"
                                        ),

                                        array(
                                                'field' => 'full_description',
                                                'label' => 'full website description',
                                                'rules' => "max_length[10000]"
                                        ),

                                        array(
                                                'field' => 'domain',
                                                'label' => 'domain',
                                                'rules' => "max_length[60]|valid_url|required"
                                        ),

                                        array(
                                                'field' => 'email',
                                                'label' => 'email',
                                                'rules' => "required|valid_email"
                                        ),

                                        array(
                                                'field' => 'idle',
                                                'label' => 'idle',
                                                'rules' => "required|numeric|is_natural_no_zero"
                                        ),

                                        array(
                                                'field' => 'contact_number',
                                                'label' => 'contact number',
                                                'rules' => "trim|min_length[7]|max_length[13]|numeric|required"
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

            if ($data['maintenance'] != $changes['maintenance']) {
                $final['maintenance'] = $changes['maintenance'];
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

            redirect('main_settings');
 
        }        
    }


}
