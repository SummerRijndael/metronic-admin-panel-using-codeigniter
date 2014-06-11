<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class signup extends CI_Controller {

 function __construct()
 {
   parent::__construct();   
   $this->load->model('user_model','',false);
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
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
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
}
?>
