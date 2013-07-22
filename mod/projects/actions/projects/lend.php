<?php
/**
* Elgg facility save action
*
* @package facility
*/
gatekeeper();

$title = get_input('title');
$description = get_input('description');
/* $freestart = get_input('freestart');
$freeend = get_input('freeend');
$location = get_input('location'); */
$project_guid = get_input('container_guid');
$project=get_entity($project_guid);
elgg_make_sticky_form('facility');
$ptitle=$project->title;
$subject='Lend to-'.$ptitle.':'.$title;
$user=elgg_get_logged_in_user_entity();
$body=<<<HTML
Description:$description</br>

HTML;
if (!$description ) {
	register_error(elgg_echo('project:lend:description:blank'));
	forward(REFERER);
}
/* if (!$freestart ) {
	register_error(elgg_echo('project:lend:freestart:blank'));
	forward(REFERER);
}
if (!$freeend ) {
	register_error(elgg_echo('project:lend:freeend:blank'));
	forward(REFERER);
}
if (!$location ) {
	register_error(elgg_echo('project:lend:location:blank'));
	forward(REFERER);
} */

if (($user instanceof ElggUser) && (elgg_instanceof($project,'object', 'projects'))) {


	add_entity_relationship($user->guid, 'fbacker_request', $project->guid);
	$body .= "{$CONFIG->url}projects/setting/faciligy/$project->guid";
	// send message to project owner;
	$result=notify_user($project->owner_guid, $user->getGUID(), $subject, $body);

	// Save 'send' the message
	if (!$result) {
	register_error(elgg_echo("messages:error"));
	forward(REFERER);
	}

	elgg_clear_sticky_form('facility');


	system_message(elgg_echo('project:lend:success'));


    forward('projects/view/' . $project_guid);
}else{
	register_error(elgg_echo('error here'));
	forward(REFERER);
	
}