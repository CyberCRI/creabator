<?php
/**
 * Delete an update post
 *
 * @package projects
 */

$guid = get_input('guid');
$blogs = get_entity($guid);

if (elgg_instanceof($blogs, 'object', 'blogs') && $blogs->canEdit()) {
	$project = $blogs->getContainerEntity();
	if ($blogs->delete()) {
		system_message(elgg_echo('project:blogs:delete:success'));

			forward("projects/blogs/all/$project->guid");

	}
}

register_error(elgg_echo('project:blogs:delete:failed'));
forward(REFERER);
