<?php
/**
 * Add project page
 *
 * @package Elggprojects
 */

$project_guid = get_input('guid');
$project = get_entity($project_guid);

if (!elgg_instanceof($project, 'object', 'projects') || !$project->canEdit()) {
	register_error(elgg_echo('projects:unknown_project'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('projects:edit');

$vars = projects_prepare_form_vars($project);
$body = elgg_view_form('projects/save', array('enctype'=>"multipart/form-data"), $vars);


echo elgg_view_page($title, $body);