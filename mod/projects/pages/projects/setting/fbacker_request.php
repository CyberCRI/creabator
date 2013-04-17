<?php
gatekeeper();

$project_guid=(int)get_input('project_guid');
elgg_set_page_owner_guid($project_guid);

$project = get_entity($project_guid);


$title = elgg_echo('projects:facilityrequests');

if ($project && $project->canEdit()) {
	elgg_push_breadcrumb('settings', 'projects/setting/basic/'.$project_guid);
	elgg_push_breadcrumb($title);
	
	$requests = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'fbacker_request',
			'relationship_guid' => $project_guid,
			'inverse_relationship' => true,
			'limit' => 0,
	));
	$lists= elgg_view('projects/fbacker_request', array(
			'requests' => $requests,
			'entity' => $project,
	));

} else {
	$lists = elgg_echo("projects:noaccess");
}
$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);
