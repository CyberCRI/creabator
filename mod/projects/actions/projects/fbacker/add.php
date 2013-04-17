<?php
/**
 * Add users to a project
 *
 * @package Elggprojects
 */
$logged_in_user = elgg_get_logged_in_user_entity();

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}
$project_guid = get_input('project_guid');
$project = get_entity($project_guid);

if (sizeof($user_guid)) {
	foreach ($user_guid as $u_id) {
		$user = get_user($u_id);
		
		if ($user && $project->canEdit()) {
			if (!check_entity_relationship($user->guid, 'fbacker', $project->guid)) {
				
			$be_backer=add_entity_relationship($user->guid, 'fbacker', $project->guid);
			if ($be_backer) {
			
		 		remove_entity_relationship($user->guid, 'fbacker_request', $project->guid);
			
				//add_to_river('river/relationship/fbacker/create', 'backup', $user->guid, $project->guid);
		 		$project->tool_exit=$project->tool_exit + 1;
		 		$project->save();
		 		
				notify_user($user->getGUID(), $project->owner_guid,
							elgg_echo('projects:welcome:subject', array($project->title)),
							elgg_echo('projects:welcome:body', array(
								$user->name,
								$project->title,
								$project->getURL())
							));

				system_message(elgg_echo('projects:addedtoproject'));
				}
			}
		}
	}
}

forward(REFERER);