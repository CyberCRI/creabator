<?php
 
    function incubator_theme_init() {
        elgg_extend_view('css/elgg', 'incubator_theme/css');
   
   // register the page handler   
       elgg_register_page_handler('about', 'about_page_handler');
       elgg_register_page_handler('contact', 'contact_page_handler');
       elgg_register_page_handler('service', 'service_page_handler');
       elgg_register_page_handler('privacy', 'privacy_page_handler');
       elgg_register_page_handler('feedback', 'feedback_page_handler');
       elgg_register_page_handler('jobs', 'jobs_page_handler');
       elgg_register_page_handler('faq', 'faq_page_handler');
       elgg_register_page_handler('login', 'login_page_handler');
    
     
    // replace the default js
       elgg_register_js('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
       elgg_register_js('jquery.form', '//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js');
       elgg_register_js('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js');

       //cache the css view
       elgg_register_simplecache_view('incubator_theme/css');
       elgg_register_simplecache_view('page/elements/header');

     // register feedback action
       $root = dirname(__FILE__);
       elgg_register_action('feedback', "$root/actions/feedback.php");
       
       //ajax controller page ,@todo: it's better to use this function: elgg_register_ajax_view,
      elgg_register_page_handler('ib_ajax', 'ajax_page_handler');
      //register lib for handling the request from the page handler
      elgg_register_library('elgg:ib_ajax', "$root/lib/ib_ajax.php");
       
       //overwrite the default river page
       elgg_register_page_handler('activity', 'river_page_handler');
       
       //overwrite the default notification setting page
       elgg_register_page_handler('notifications', 'ib_notifications_page_handler');
       // overwrite the default  avater and profile edit page
       elgg_register_page_handler('avatar', 'ib_avatar_page_handler');
       elgg_register_page_handler('profile', 'ib_profile_page_handler');

       // overwrite the default  settings page
       elgg_register_page_handler('settings', 'ib_usersettings_page_handler');
       
       
       //unregister the file page handler and menu and widget so that it will not apprear in the profile page
       elgg_unregister_plugin_hook_handler('register', 'menu:owner_block', 'file_owner_block_menu');
       elgg_unregister_widget_type('filerepo');
       
       
       // overwrite the default friends and friendsof page
       elgg_register_page_handler('friends', 'ib_friends_page');
       elgg_register_page_handler('friendsof', 'ib_friendsof_page');
       
       // // overwrite the default collections and invite page
       elgg_register_page_handler('collections', 'ib_collections_page_handler');
       elgg_register_page_handler('invite', 'ib_invitefriends_page_handler');
       
       
       //register the friends of widget in the profile page
       elgg_register_widget_type('friendsof', elgg_echo("Followers"), elgg_echo("follower:widget:description"));
       
    
    }





function about_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/about.php");
	return true;
}
function contact_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/contact.php");
	return true;
}
function login_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/login.php");
	return true;
}
function service_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/service.php");
	return true;
}
function privacy_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/privacy.php");
	return true;
}
function feedback_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/feedback.php");
	return true;
}
function jobs_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/jobs.php");
	return true;
}
function faq_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/faq.php");
	return true;
}

function river_page_handler() {
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/river.php");
	return true;
}

function ib_friends_page($page) {
	//get the route params form the url
	$username=$page[0];
	$user=get_user_by_username($username);
	set_page_owner($user->getGUID());
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/friends/index.php");
	return true;
}
function ib_friendsof_page($page) {
	$username=$page[0];
	$user=get_user_by_username($username);
	set_page_owner($user->getGUID());
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/friends/of.php");
	return true;
}


function ib_collections_page_handler($page) {
	// set the context to friends 
	elgg_set_context('friends');
	$base = elgg_get_config('path');
	if (isset($page[0])) {
		if ($page[0] == "add") {
			elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
			collections_submenu_items();
			include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/friends/collections/add.php");
			return true;
	} else {
	$user = get_user_by_username($page[0]);
	if ($user) {
	elgg_set_page_owner_guid($user->getGUID());
	if (elgg_get_logged_in_user_guid() == elgg_get_page_owner_guid()) {
	collections_submenu_items();
	}
	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/friends/collections/view.php");
	return true;
}
}
}
return false;
}


function ib_invitefriends_page_handler($page) {
	// block only for the login user
	gatekeeper();

	elgg_set_context('friends');
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

	$title = elgg_echo('friends:invite');

	$body = elgg_view('invitefriends/form');

	$params = array(
			'content' => $body,
			'title' => $title,
	);
	$body = elgg_view_layout('home_two_column', $params);

	echo elgg_view_page($title, $body);
	return true;
}

function ajax_page_handler($page){
	// load the lib (check this in the lib/ib_ajax.php
	elgg_load_library('elgg:ib_ajax');
		
	switch ($page[0]) {
		case 'inbox':
			gatekeeper();
			$params=ajax_get_unread_messages();	
			break;
		case 'search':
			if(elgg_is_active_plugin('search')){
			$params=ajax_get_search_result();
			}
			break;
		case 'rivers':
			$params=ajax_get_all_rivers();
			break;
		case 'project_update':
			$params=ajax_get_projects_update();
				break;
		case 'follow_update':
			$params=ajax_get_follow_update();
				break;
	default:
	return false;
	}
	echo $params;
	return true;
	
} 

function ib_notifications_page_handler(){
	if (!isset($page[0])) {
		$page[0] = 'personal';
	}

	$base = elgg_get_plugins_path() . 'notifications';

	include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/notifications/index.php");

	return true;
}

function ib_avatar_page_handler($page){
	global $CONFIG;
	$user=get_user_by_username($page[1]);
	if($user){
		elgg_set_page_owner_guid($user->getGUID());
	}
	if($page[0]=='edit'){
		include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/avatar/edit.php");
		return true;
	}else{
		return elgg_avatar_page_handler($page);
	}
	return false;
}

function ib_profile_page_handler($page){
	global $CONFIG;

	$user = get_user_by_username($page[0]);
	elgg_set_page_owner_guid($user->guid);

	if ($page[1] == 'edit') {
		include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/profile/edit.php");
		return true;
	}else{
		return profile_page_handler($page);

	}
	return false;

}
function ib_usersettings_page_handler($page) {
	global $CONFIG;

	if (!isset($page[0])) {
		$page[0] = 'user';
	}

	if (isset($page[1])) {
		$user = get_user_by_username($page[1]);
		elgg_set_page_owner_guid($user->guid);
	} else {
		$user = elgg_get_logged_in_user_guid();
		elgg_set_page_owner_guid($user->guid);
	}

	elgg_push_breadcrumb(elgg_echo('settings'), "settings/user/$user->username");


	if($page[0]=='user'){
		include(dirname(dirname(__FILE__)) . "/incubator_theme/pages/settings/account.php");
		return true;
	}else{
		return usersettings_page_handler($page);
	}


}
    elgg_register_event_handler('init', 'system', 'incubator_theme_init');
   
?>