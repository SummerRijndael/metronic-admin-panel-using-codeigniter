<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller{
	
	function login(){
		if(!$this->user){
				$this->theme_view = 'login';
				$this->view_data['form_action'] = 'login';
				$this->view_data['form_action_forget'] = 'forgotpass';

			if($this->input->post(NULL, TRUE)){
				$reply = array();
				$this->theme_view = '';
				$this->content_view = 'landing/blank';
				$user = User::validate_login($this->input->post('username', true), $this->input->post('password',true));
				
				if($user){
					if($this->input->cookie('last_url') != ""){
						//redirect($this->input->cookie('last_url'));
						$reply["message"] = $this->input->cookie('last_url');
						$this->output->set_content_type('application/json')->set_output(json_encode($reply));
					} else {
				    		 $reply["message"] = "dashboard";
				             $this->output->set_content_type('application/json')->set_output(json_encode($reply));
					}
				} else {
					$reply["message"] = "Username or password is invalid.";
					$reply["token_name"] = $this->security->get_csrf_token_name();
        			$reply["token"] = $this->security->get_csrf_hash();
				    $this->output->set_content_type('application/json')->set_output(json_encode($reply));
				}
			}
		 }
		 else{
		 	redirect('accounts');
		 }
		
	}

	function user_alive(){
		$this->theme_view = '';
		if ($this->input->is_ajax_request() && $this->user) {
			$update = User::find($this->user->id); 
			$update->last_active = time();
			$update->save();

			$this->output->set_content_type('text/plain')->set_output("OK");
		} else {
			show_404();
		}
	}
	
	function logout(){
	    	if($this->user){ 
				$update = User::find($this->user->id); 
				$update->system_lock = FALSE;
				$update->last_active = 0;
				$update->save();
			}
				
		User::logout();
		redirect('login');
	}

	function system_lock(){
		   if($this->user){ 
				$update = User::find($this->user->id); 
				$update->system_lock = TRUE;
				$update->save();
			} else {
				show_404();
			}
		//redirect('accounts');
		redirect($this->agent->referrer());
	}

	function unlock_user(){
		if ($this->input->post(NULL, TRUE)) {
			
			$user = User::validate_login($this->input->post('username', true), $this->input->post('password',true));

			if ($user) {
				$update = User::find($this->user->id); 
				$update->system_lock = FALSE;
				$update->save();

			} else {
			    $this->session->set_flashdata('message', 'error: Invalid password.');
			}
			redirect($this->agent->referrer());
		} else {
			show_404();
		}
	}

}
