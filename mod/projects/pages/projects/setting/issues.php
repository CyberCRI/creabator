<?php
/**
* setting Issue page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);
$title="Issues";

$lists="<h2 class='dashed mbm'>Create An Issue</h2>";
$lists.=elgg_view_form('projects/issue',array('action'=>'action/issue/add'),array('project_guid'=>$project_guid));


$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' =>$content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);
