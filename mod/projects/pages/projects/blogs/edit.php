<?php
/*
 * Created on 2012-2-1
 *
 * @WiserIncubator
 * Weipeng Kuang
 */
$guid = get_input('guid');
$blogs = get_entity($guid);
$project_guid=$blogs->container_guid;
$project=get_entity($project_guid);
if (!elgg_instanceof($project, 'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERRER);
}
if (!elgg_instanceof($blogs, 'object', 'blogs') || !$blogs->canEdit()) {
	register_error(elgg_echo('not project blog'));
	forward(REFERRER);
}

$title = elgg_echo('blogs:edit');

$content = elgg_view_form('projects/blogs',array(),array(
'project_guid' => $project_guid,
'title'=>$blogs->title,
'description'=>$blogs->description,
'guid'=>$guid,

));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
	'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);