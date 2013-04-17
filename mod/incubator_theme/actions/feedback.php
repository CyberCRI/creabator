<?php


$uid=elgg_get_logged_in_user_guid();
$title = get_input('title');
$desc = get_input('description');

elgg_make_sticky_form('feedback');
if (!$title || !$desc) {
	register_error(elgg_echo("feedback:required"));
	forward(REFERER);
}

$subject=elgg_echo('feedback').'-'.$title;

$admins=elgg_get_admins();
foreach ($admins as $admin){
	$admin_guids[].=$admin->guid;
}
$recipient_guid = $admin_guids[ mt_rand(0, count($admin_guids) - 1) ];
$result=notify_user($recipient_guid, $uid, $subject, $desc);
if($result){
	elgg_clear_sticky_form('feedback');
system_message(elgg_echo("feedback:success"));
}else{
register_error(elgg_echo("feedback:failed"));
forward(REFERER);
}