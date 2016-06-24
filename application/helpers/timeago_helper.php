<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    function time_ago($timeago, $short = false)
    {
        $instance =& get_instance();
        $now = time(); 
        $timepices = array();
        if(!is_numeric($timeago)){ 
            $timeago = human_to_unix($timeago); 
            }
        
        $timespan = timespan($timeago, $now); 
        $timespan = explode(",",  trim($timespan)); 
        foreach($timespan as $key => $value){ 
            $timespanvalue = explode(" ", trim($value)); 
            $arrayvalue = $timespanvalue[0]." ".$instance->lang->line('application_'.$timespanvalue[1]); 
            $timepices[$key] = $arrayvalue;
        }
        $return = $timepices[0];
        if(isset($timepices[1]) && $short == false){
            $return .= ' '.$instance->lang->line('application_and').' '.$timepices[1];
        }
        $return .= ' '.$instance->lang->line('application_ago');
        return $return;
    }
