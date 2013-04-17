<?php
/**
 * Elgg add references action
 *
 */
gatekeeper();

$link = get_input('link');
$project_guid = get_input('project_guid');

if ($link && !preg_match("#^((ht|f)tps?:)?//#i", $link)) {
	$link = "http://$link";
}

// Let's see if we can get an entity with the specified GUID
$project = get_entity($project_guid);
if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();


	$annotation = create_annotation($project->guid,
			'resource',
			$link,
			"",
			$user->guid,
			$project->access_id);
	
	// tell user annotation posted
	if (!$annotation) {
		register_error(elgg_echo("resource:failure"));
		forward(REFERER);
	}
	if ($user->guid!=$project->owner_guid){
	notify_user(
			$project->owner_guid,
			$user->guid,
			elgg_echo('resource:subject'),
			elgg_echo('resource:body',array(
					$user->name,
					$link,
					$project->getURL(),
					
	
			)));
	
	}
	system_message(elgg_echo("resource:save"));
	

// Forward to the page the action occurred on
forward(REFERER);
