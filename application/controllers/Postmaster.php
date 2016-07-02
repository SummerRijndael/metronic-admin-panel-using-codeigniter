<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postmaster extends MY_Controller {
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
            $this->load->helper('security');
            $this->load->helper('string');
            $this->theme_view = '';
            //print_r(explode("<", "Google <no-reply@accounts.google.com>"));
            //exit();
            $emailconfig = Setting::first();
            set_time_limit(0);
            // this shows basic IMAP, no TLS required
            $config['login'] = $emailconfig->mailbox_username;
            $config['pass'] = $emailconfig->mailbox_password;
            $config['host'] = $emailconfig->mailbox_host;
            $config['port'] = $emailconfig->mailbox_port;
            $config['mailbox'] = $emailconfig->mailbox_box;

            if($emailconfig->mailbox_imap == "1"){$flags = "/imap";}else{$flags = "/pop3";}
            if($emailconfig->mailbox_ssl == "1"){$flags .= "/ssl";}

            $config['service_flags'] = $flags.$emailconfig->mailbox_flags;

            $this->load->library('peeker', $config);
            //attachment folder
            $bool = $this->peeker->set_attachment_dir('files/media/email_files');
            //Search Filter
            $this->peeker->set_search($emailconfig->mailbox_search);
            echo $this->peeker->search_and_count_messages();
            
            if ($this->peeker->search_and_count_messages() != "0"){
                $id_array = $this->peeker->get_ids_from_search();
                
                //walk trough emails
                $details = array(); 

                  function reference(){
                        $str = do_hash(random_string('md5', 40), 'sha1'); // MD5
                        
                        $ref_id = Outbox_messages::find_by_view_id($str);  

                        if(!empty($ref_id)){
                            reference();
                        }
                        else{
                            return $str;
                        }
                    }               

                foreach($id_array as $email_id){
                    $email_object = $this->peeker->get_message($email_id);
                    $email_object->rewrite_html_transform_img_tags('files/media/email_files/');
                    $attachment = ($email_object->has_attachment())? TRUE: FALSE;
                    
                    if($attachment){
                        //Attachments
                        $parts = $email_object->get_parts_array();
                        $email_attachment = array();
                       
                        foreach ($parts as $part){
                            $savename = $email_object->get_fingerprint().random_string('alnum', 8).$part->get_filename();
                            $savename = str_replace(' ','_',$savename); $savename = str_replace('%20','_',$savename);
                            $savename = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', $savename);
                            // Remove any runs of periods
                            $savename = preg_replace("([\.]{2,})", '', $savename);
                            $orgname = $part->get_filename();
                            $orgname = str_replace(' ','_',$orgname); $orgname = str_replace('%20','_',$orgname);
                            $part->filename = $savename;
                            $filetype = $part->get_subtype();
                            $size = $part->get_bytes();
                            $attributes = array('article_id' => $email_id, 'filename' => $orgname, 'filetype'=>$filetype, 'size'=>$size, 'savename' => $savename);
                            $attachment_temp = ArticleHasAttachment::create($attributes);
                            $email_attachment[] = "files/media/attachments/".$savename;
                        }
                        $email_object->save_all_attachments('files/media/attachments/');
                    }

                    $details['status'] = 'new';
                    $details['time'] = $email_object->get_date();
                    $details['recipient'] = $email_object->get_to();
                    $details['reply_to'] = $email_object->get_reply_to();
                    $details['sender'] = $email_object->get_from();
                    $details['cc'] = $email_object->get_cc();
                    $details['bcc'] = $email_object->get_bcc();
                    $details['subject'] = ($email_object->get_subject())? $email_object->get_subject(): '(no subject)';
                    
                    if ($email_object->has_PLAIN_not_HTML()) {
                        $details['message'] = nl2br($email_object->get_plain());    
                    } else {
                        $details['message'] = $email_object->get_html();    
                    }
                    
                    iconv(mb_detect_encoding($details['message'], mb_detect_order(), true), "UTF-8", $details['message']);
                    
                    $details['attachment'] = $attachment;
                    //$details['headers'] = $email_object->get_header_array();

                    $reference = reference();
                    $details['view_id'] = $reference;

                    $outbox = Outbox_messages::create($details);
                }
            }

            //print_r($details);
            $this->peeker->close();
            exit();
    }

}