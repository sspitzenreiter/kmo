<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
    function is_logged_in()
    {
        $CI =& get_instance();
        $user_session = $CI->session->userdata("identity");
        return !empty($user_session) && is_array($user_session) && array_key_exists("id", $user_session) && !empty($user_session['id']);
    }   
}

?>