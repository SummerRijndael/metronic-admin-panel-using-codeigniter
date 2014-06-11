<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class adduser extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   //$this->load->model('user','',TRUE);
 }

 function index()
 {
      if($this->session->userdata('logged_in'))
      {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6|max_length[15]|alpha_numeric|is_unique[_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6|max_length[15]|matches[rpassword]|required');
        $this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|min_length[6|max_length[15]|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users_personal_info.email_address]');
        $this->form_validation->set_rules('access-level', 'Access-level', 'trim|required|xss_clean');
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|min_length[3|max_length[15]|xss_clean');
        $this->form_validation->set_rules('middlename', 'Middlename', 'trim|required|min_length[3|max_length[15]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[3|max_length[15]|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[6|max_length[122]|xss_clean');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required|xss_clean');

         if($this->form_validation->run() == FALSE)
         {
             //Field validation failed.
           $session_data = $this->session->userdata('logged_in');
           $data['sess_firstname'] = $session_data['firstname'];
           $data['sess_lastlog'] = $session_data['last-log'];
           $data['sess_access'] = $session_data['access'];
           $data['activeSub'] = 'usersadd';
           $data['activePg'] = 'users';
           //$this->listUsers();
           $this->load->view('user_reg_view',$data,false);
         }
         else
         {
          //Field validation failed.  User redirected to login page
          $this->load->library('pbkdf2');
          $password = $this->input->post('pass2',true);
          $pbkdf2 = $this->pbkdf2->encrypt($password);

          $data = array(
                             'user_id' => null,
                             'username' => $this->input->post('username'),
                             'password' => $pbkdf2['hash'],
                             'access_level' => $this->input->post('access-level'),
                             'account_status' => 0,
                             'date_created' => date('Y-m-d H:i:s', now()),
                             'last_updated' => date('Y-m-d H:i:s', now()),
                             'last_access' => null,//date('Y-m-d H:i:s', now()),
                             'is_deleted' => 0
                          );

                          $this->db->insert('_users', $data); 
          
          $data = array(
                             'info_id' => null,
                             'f_name' => humanize($this->input->post('firstname')),
                             'm_name' => humanize($this->input->post('middlename')),
                             'l_name' => humanize($this->input->post('lastname')),
                             'gender' => $this->input->post('gender'),
                             'address' => humanize($this->input->post('address')),
                             'bday' => date('Y-m-d H:i:s', strtotime($this->input->post('birthday'))),
                             'contact_num' => str_replace(' ', '', $this->input->post('contact')),
                             'email_address' => $this->input->post('email'),
                             'date_created' => null,//date('Y-m-d H:i:s', now()),
                             'last_updated' => null,//date('Y-m-d H:i:s', now()),
                             'p_is_deleted' => 0
                          );

                          $this->db->insert('users_personal_info', $data);                           


           $session_data = $this->session->userdata('logged_in');
           $data['sess_firstname'] = $session_data['firstname'];
           $data['sess_lastlog'] = $session_data['last-log'];
           $data['sess_access'] = $session_data['access'];
           $data['regsucc'] = '1';
           $data['activeSub'] = 'usersadd';
           $data['activePg'] = 'users';
           $this->form_validation->resetpostdata();
           $this->load->view('home_view',$data,false);
            
         }
     }
  else
    {
       //If no session, redirect to login page
       redirect('login', 'refresh');
    }
 }
}
?>
