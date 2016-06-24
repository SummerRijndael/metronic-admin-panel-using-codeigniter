<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function remote_get_contents($url, $timeout = 25)
{
        if (function_exists('curl_init'))
        {
                return curl_get_contents($url, $timeout);
        }
        else
        {
                return file_get_contents($url,FILE_USE_INCLUDE_PATH);
        }
}

function curl_get_contents($url, $timeout)
{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}