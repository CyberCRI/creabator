<?php
$guid = get_input('guid');
$issue = get_entity($guid);
$project_guid=$issue->container_guid;
$content="<h2 class='dashed mbm'>Edit Issue</h2>";
$content.=elgg_view_form('projects/issue',array('action'=>'action/issue/add'),array(
		'project_guid'=>$project_guid,
		'guid'=>$guid,
		'title'=>$issue->title,
		'description'=>$issue->description,
		'contribute'=>$issue->contribute,
		'tags'=>$issue->tags,
		));



$body = elgg_view_layout('main_project', array(
		'ib_content' => $content,
		'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);