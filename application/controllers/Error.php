<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Controller {
    function __construct()
    {   
        parent::__construct();
    }

	function not_found()
	{
		$this->theme_view = '';
		$this->content_view = 'error/404';
	}

}
