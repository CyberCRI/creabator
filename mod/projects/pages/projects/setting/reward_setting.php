<?php
/**
* setting edit page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);





$title=elgg_view_title('Required & Reward Setting:');
$vars = projects_prepare_form_vars($project);
$lists .=elgg_view_form('projects/reward_setting',array(),$vars);

$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $title.$content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
