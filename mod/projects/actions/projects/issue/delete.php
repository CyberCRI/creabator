<?php
/**
 * Delete an issue
 *
 * @package projects
 */

$guid = get_input('guid');
$issue = get_entity($guid);

if (elgg_instanceof($issue, 'object', 'issue') && $issue->canEdit()) {
	$project = $issue->getContainerEntity();
	if ($issue->delete()) {
		system_message(elgg_echo('Delete Success!'));

			forward("projects/issues/all/$project->guid");

	}
}

register_error(elgg_echo('Failed,Please try agian later.'));
forward(REFERER);
