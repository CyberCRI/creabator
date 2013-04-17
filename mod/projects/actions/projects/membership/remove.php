<?php
/**
 * Remove a user from a project
 *
 * @package Elggprojects
 */

$user_guid = get_input('user_guid');
$project_guid = get_input('project_guid');

$user = get_entity($user_guid);
$project = get_entity($project_guid);

elgg_set_page_owner_guid($project->guid);

if (($user instanceof ElggUser) && (elgg_instanceof($project,'object', 'projects')) && $project->canEdit()) {
	// Don't allow removing project owner
	if ($project->getOwnerGUID() != $user->getGUID()) {
		if (leave_project($project->guid,$user->guid)) {
			$project->team_exit=$project->team_exit - 1;
			$project->save();
			system_message(elgg_echo("projects:removed", array($user->name)));
		} else {
			register_error(elgg_echo("projects:cantremove1"));
		}
	} else {
		register_error(elgg_echo("projects:cantremove2"));
	}
} else {
	register_error(elgg_echo("projects:cantremove3"));
}

forward(REFERER);
