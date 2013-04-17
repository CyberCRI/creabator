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

		if ($user && $project && $project->canEdit()) {
			if (!is_project_member($project->guid,$user->guid)) {
				if (user_join_project($project, $user)) {
                    $project->team_exit=$project->team_exit + 1;
                    $project->save();
					// send welcome email to user
					notify_user($user->getGUID(), $project->owner_guid,
							elgg_echo('projects:welcome:join:subject', array($project->title)),
							elgg_echo('projects:welcome:join:body', array(
								$user->name,
								$project->getURL(),
								$project->title)
							));

					system_message(elgg_echo('projects:addedtoproject'));
				} else {
					// huh
				}
			}
		}
	}
}

forward(REFERER);
