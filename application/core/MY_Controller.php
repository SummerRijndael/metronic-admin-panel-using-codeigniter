<?php

class MY_Controller extends CI_Controller
{	
	var $user = FALSE;
	var $client = FALSE;
	var $core_settings = FALSE;

	protected $theme_view = 'application';
	protected $content_view = '';
	protected $view_data = array();
	protected $flag = false;
	
	function __construct()
	{	
	    parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		header("Pragma: no-cache"); // HTTP 1.0.
		header("Expires: 0"); // Proxies.		

		$this->view_data['core_settings'] = Setting::first();
		$this->view_data['datetime'] = date('Y-m-d H:i', time());
		//$this->lang->load('application', 'english');
		/*$this->lang->load('messages', $language);
		$this->lang->load('event', $language);*/
		$this->user = $this->session->userdata('user_id') ? User::find_by_id($this->session->userdata('user_id')) : FALSE;

		if($this->user){

			//check if user or client
			if($this->user){
				$access = $this->user->access;
				$access = explode(",", $access);
				$access_child = $this->user->access_child;
				$access_child = explode(",", $access_child);
				$update = User::find($this->user->id); 

				$modules = Modules::find('all', array('conditions'=> array(' id in (?)', $access), 'order' => 'sort asc'));
				$navi_child = array();
				
				foreach ($modules as $key => $value) {
					if ($value->has_child) {
						$temp_container = Module_childs::find('all',array('conditions'=> array("parent_id = ? and id in (?)", $value->nav_child_id, $access_child), 'order'=>'sort asc'));
						foreach ($temp_container as $index => $vals) {
							$navi_child[$value->name]['parent'][$vals->link] = $value->name;
							$navi_child[$value->name]['child_name'][] = $vals->name;
							$navi_child[$value->name]['child_link'][] = $vals->link;
							$navi_child[$value->name]['child_icon'][] = $vals->icon;
						}
					}					
				}
				unset($temp_container);
				
				$this->view_data['navi_child'] = $navi_child;
				$this->view_data['menu'] = $modules;
				$this->view_data['user_online'] = $this->check_online();

				/*$arr = get_defined_vars();
				print_r($arr);
				exit();
				/*$email = 'u'.$this->user->id;
				$this->view_data['menu'] = Module::find('all', array('order' => 'sort asc', 'conditions' => array('id in (?) AND type = ?', $access, 'main')));
				$this->view_data['widgets'] = Module::find('all', array('conditions' => array('id in (?) AND type = ?', $access, 'widget')));
				
				$this->view_data['tickets_new'] = $this->check_tickets();*/
			}
			//Update user last active
			$update->last_active = time();
			$update->save();

			/*$this->view_data['online_counter'] = User::all(array('select'=>'count(id) as counter', 'conditions' => array('last_active+(30 * 60) > ? AND status = ?', time(), "active")));
			$this->view_data['messages_new'] = $this->check_message($email);*/
			$this->view_data['messages_new'] = $this->check_message()[0]->message_number;
				
		}
		
		$options = array('select'=> 'count(id) as counter','conditions' => array('status = ? and is_deleted != ?', '1','1'));
 		/*$news_info = News_post::all($options);
		/*$this->load->database();
		$sql = "select * FROM templates WHERE type='notes'";
		$query = $this->db->query($sql); */
		$this->view_data["note_templates"] = "";//$query->result();	
		/*$this->view_data["news_counter"] = $news_info;*/
	}

	protected function check_message(){
		return Outbox_messages::find_by_sql('select count(id) as message_number from outbox_messages where status = "new" and deleted != TRUE and spam != TRUE');
	}

	protected function check_online(){
		return User::all(array('select'=>'id, firstname, lastname, userpic, title, last_active', 'conditions' => array('last_active+(30 * 60) > ? AND status = ?', time(), "active")));
	}

	protected function check_tickets(){
		return Ticket::find_by_sql("select count(id) as amount from tickets where `status`='New'");
	}
	
	function set_last_url(){
		//$this->input->delete_cookie('last_url');
		//$last_url = $this->agent->referrer();
		$last_url = current_url();
		
        $cookie = array(
              'name'   => 'last_url',
              'value'  => $last_url,
              'expire' => '60',
        );

        $this->input->set_cookie($cookie);
	}

	private function maintenance(){
			$data = array();
			$data['core_settings'] = Setting::first();
		    echo $this->load->view('frontend/landing/maintenance',$data,true);
	}

	public function _output($output){
		$act_url = $this->uri->segment(1,0);		
		
		if ($this->view_data['core_settings']->maintenance && !$this->user && !$act_url == 'login') {
			$this->maintenance();
		}

		if ($this->user && $this->user->system_lock) {
			$this->view_data['form_action'] = "unlock";
			$yield = $this->load->view('blueline/auth/lock', $this->view_data, TRUE); 
			echo $this->load->view('blueline/theme/lock', array('yield' => $yield), TRUE);
		}
		
		else{	
			   if($this->flag){
			   			$this->theme_view = 'matrix';
						// set the default content view
						if($this->content_view !== FALSE && empty($this->content_view)){ $this->content_view = $this->router->class . '/' . $this->router->method; }
						//render the content view
						$yield = file_exists(APPPATH . 'views/' . $this->view_data['core_settings']->template_front . '/' . $this->content_view . '.php') ? $this->load->view($this->view_data['core_settings']->template_front . '/' . $this->content_view, $this->view_data, TRUE) : FALSE;
						
						//render the theme
						if($this->theme_view){
							echo $this->load->view($this->view_data['core_settings']->template_front . '/' . $this->theme_view, array('yield' => $yield), TRUE);
						}
						else{
							echo $yield;
						}
						echo $output; 
				}
				else{
						// set the default content view
						if($this->content_view !== FALSE && empty($this->content_view)){ $this->content_view = $this->router->class . '/' . $this->router->method; }
						//render the content view
						$yield = file_exists(APPPATH . 'views/' . $this->view_data['core_settings']->template . '/' . $this->content_view . '.php') ? $this->load->view($this->view_data['core_settings']->template . '/' . $this->content_view, $this->view_data, TRUE) : FALSE;

						//render the theme
						if($this->theme_view){
							echo $this->load->view($this->view_data['core_settings']->template . '/' .'theme/' . $this->theme_view, array('yield' => $yield), TRUE);
						}
						else{
							echo $yield;
						}
						echo $output;
				}
		}
		
	}
	
	
}
