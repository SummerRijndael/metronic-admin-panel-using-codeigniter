<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
        if (!$this->user) {
            $this->set_last_url();
            redirect('login');
        }  else {
            if ( !in_array("4", explode(",", $this->user->access_child)) ) {
                  show_404();
            }
        }
    }

	public function index()
	{
		$this->content_view = 'settings/file_manager';
	}

function elfinder_init()
{
  if ($this->user) {
      $this->load->helper('path');
      $opts = array(
        'bind' => array('upload' => array(array($this, 'setToken'))),
        // 'debug' => true, 
        'roots' => array(
          array( 
            'uploadMaxConn' => 1,
            'driver' => 'LocalFileSystem', 
            'path'   => set_realpath('files/media'), 
            'URL'    => site_url('files/media') . '/',
            // more elFinder options here
          ) 
        )
      );
      $this->load->library('elfinder_lib', $opts);
      
  } else {
    show_404();
  }
  
}

function setToken($cmd, &$result, $args, $elfinder) {
        if (isset($result['added']) && $result['added']) {
            $token_name = $this->security->get_csrf_token_name(); //return string 'token'
            $hash = $this->security->get_csrf_hash();
            $result[$token_name] = $hash;
        }
    }



}
