<?php
/**
* Send the application message
*
* @package ElggMessages
*/


$body = get_input('body');
$project_guid = get_input('project_guid');
$project=get_entity($project_guid);
$title=$project->title;
$subject ='Application-'.$title.'-';
$subject.= strip_tags(get_input('subject'));



elgg_make_sticky_form('messages');

$user_guid=elgg_get_logged_in_user_guid();
$user=get_entity($user_guid);

// Make sure the message field, send to field and title are not blank
if (!$body ) {
	register_error(elgg_echo("messages:blank"));
	forward(REFERER);
}

if (($user instanceof ElggUser) && (elgg_instanceof($project,'object', 'projects'))) {
	$annotation_id=get_input('id');
	$annotation=elgg_get_annotation_from_id($annotation_id);
	$name=$annotation->name;
	if($name!='task'){
	add_entity_relationship($user->guid, 'membership_request', $project->guid);
	$body .= "{$CONFIG->url}projects/setting/requests/$project->guid";
	}
	// send message to project owner;
	$result=notify_user($project->owner_guid, $user->getGUID(), $subject, $body);

if (!$result) {
	register_error(elgg_echo("messages:error"));
	forward(REFERER);
}

elgg_clear_sticky_form('messages');

system_message(elgg_echo('project:Apply:success'));

forward('projects/view/' . $project_guid);
}
