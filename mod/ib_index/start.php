<?php
/*
 *  Index page plugin in Creabator
 * 
 * @package Ib_index
 * @author Weipeng Kuang
 * @website http://www.creabator.org
 * 
 */

    function ib_index_init() {
    	
        elgg_extend_view('css/elgg', 'ib_index/css');
     
        elgg_register_plugin_hook_handler('index', 'system', 'ib_index');
 
       	elgg_extend_view( 'forms/index-login'   , 'elgg_social_login/login' );
       
       //register ajax view for projects listing in the font page
       
     
       	elgg_register_ajax_view('projects/list');
       
    
    }
 function ib_index() {
 	
    if (!include_once(dirname(dirname(__FILE__)) . "/ib_index/pages/index.php"))
        return false;
 
    return true;
}


    elgg_register_event_handler('init', 'system', 'ib_index_init');
   
?>