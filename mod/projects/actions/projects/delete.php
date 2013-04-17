<?php
/**
 * Delete a project
 *
 * @package projects
 */

$guid = get_input('guid');
$project = get_entity($guid);

if (elgg_instanceof($project, 'object', 'projects') && $project->canEdit()) {
	// delete group icons
	$owner_guid = $project->owner_guid;
	$prefix = "projects/" . $project->guid;
	$imagenames = array('.jpg', 'tiny.jpg', 'small.jpg', 'medium.jpg', 'large.jpg');
	$img = new ElggFile();
	$img->owner_guid = $owner_guid;
	foreach ($imagenames as $name) {
		$img->setFilename($prefix . $name);
		$img->delete();
	}
	
	$container = $project->getContainerEntity();
	
	if ($project->delete()) {
		system_message(elgg_echo("projects:delete:success"));

			forward("projects/all");

	}
}

register_error(elgg_echo("projects:delete:failed"));
forward(REFERER);
