<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_maintenance extends MY_Controller {
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
		$this->content_view = 'gallery/beta';
	}


 function load_files(){
    $this->theme_view = '';
            $upload_path_url = base_url() . 'files/media/uploads/';
            $full_path = FCPATH. 'files/media/uploads';

            $existingFiles = get_dir_file_info($full_path);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as $fileName => $info) {
              if($fileName!='thumbs'){//Skip over thumbs directory
                //set the data for the json array   
                $foundFiles[$f]['name'] = $fileName;
                $foundFiles[$f]['size'] = $info['size'];
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                $foundFiles[$f]['deleteUrl'] = base_url() . 'gallery_maintenance/deleteImage/' . $fileName;
                $foundFiles[$f]['deleteType'] = 'DELETE';
                $foundFiles[$f]['error'] = null;

                $f++;
              }
            }

            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
 }

 function upload() {
     $this->theme_view = '';

        $upload_path_url = base_url() . 'files/media/uploads/';

        $config = array();
        $config['upload_path'] = FCPATH . 'files/media/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '30000';

        $this->load->library('upload');

        $files           = $_FILES;
        $number_of_files = count($_FILES['files']['name']);
        $errors = 0;

        // codeigniter upload just support one file
        // to upload. so we need a litte trick
        for ($i = 0; $i < $number_of_files; $i++)
        {
            $_FILES['files']['name'] = $files['files']['name'][$i];
            $_FILES['files']['type'] = $files['files']['type'][$i];
            $_FILES['files']['tmp_name'] = $files['files']['tmp_name'][$i];
            $_FILES['files']['error'] = $files['files']['error'][$i];
            $_FILES['files']['size'] = $files['files']['size'][$i];

            // we have to initialize before upload
            $this->upload->initialize($config);

            if (! $this->upload->do_upload("files")) {
                $errors++;
            }

            $data = $this->upload->data();

            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $info = new StdClass;
            $info->blah = 'Image name :';
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = base_url() . 'gallery_maintenance/deleteImage/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $files_info[] = $info;
            
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(array("files" => $files_info)));
       
 }


public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'files/media/uploads/' . $file);
        $success = unlink(FCPATH . 'files/media/uploads/thumbs/' . $file);
        
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'files/media/uploads/' . $file;
        $info->file = is_file(FCPATH . 'files/media/uploads/' . $file);

        if ($this->input->is_ajax_request()) {
            $this->theme_view = '';
            //I don't think it matters if this is set but good for error checking in the console/firebug
            $this->output->set_content_type('application/json')->set_output(json_encode(array($info)));
        }
    }





}
