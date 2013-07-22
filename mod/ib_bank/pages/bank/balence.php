<?php 
gatekeeper();
$user_name=get_input('user_name');
$user=get_user_by_username($user_name);
$user_id=$user->guid;
if(elgg_get_logged_in_user_guid()!=$user_id){
	forward('projects/all');
	register_error('no permission');
}

$title=elgg_echo('balence:title');

// set breadcrumb
elgg_push_breadcrumb(elgg_echo('balence:title'), 'bank/balence/'.$user->username);
//elgg_push_breadcrumb($title);


$content=elgg_view('balence/top', array('user_id'=>$user_id));
$content.=elgg_view('balence/list',array('user_id'=>$user_id));

$body=elgg_view_layout('home_two_column',array('content'=>$content));
echo elgg_view_page($title, $body);


?>