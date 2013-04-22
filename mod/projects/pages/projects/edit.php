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
$form = elgg_view_form('projects/save', array('enctype'=>"multipart/form-data"), $vars);

$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$form));
$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);