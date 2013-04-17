<?php
/*
 * Created on 2012-2-4
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$project_guid = get_input('project_guid');
$action = get_input('action_type');

$project = get_entity($project_guid);

if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}

//get the action, is it to feature or unfeature
if ($action == "activated") {
	$project->access_id = 2;
	// add the draft function

	$project->save();
	system_message(elgg_echo('Projects:Activated'));
} else {
	$project->access_id = 0;
	$project->save();
	system_message(elgg_echo('Projects:Desactivated'));
}

forward(REFERER);