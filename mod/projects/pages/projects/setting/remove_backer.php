<?php
gatekeeper();

$project_guid=(int)get_input('project_guid');
elgg_set_page_owner_guid($project_guid);

$project = get_entity($project_guid);



$title = elgg_echo('projects:remove:backers');

if ($project && $project->canEdit()) {
	elgg_push_breadcrumb('settings', 'projects/setting/basic/'.$project_guid);
	elgg_push_breadcrumb($title);
	
	$members = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'member',
			'relationship_guid' => $project_guid,
			'inverse_relationship' => true,
			'limit' => 0,
	));
	$fbackers=elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'fbacker',
			'relationship_guid' => $project_guid,
			'inverse_relationship' => true,
			'limit' => 0,
	));
	$member_body = elgg_view('projects/remove_backer', array(
			'remove' => $members,
			'entity' => $project,
			'action'=>'remove',
	));
	$fbacker_body= elgg_view('projects/remove_backer', array(
			'remove' => $fbackers,
			'entity' => $project,
			'action'=>'fbremove',
	));
	$lists=<<<html
	<div style="width:48%;" class="elgg-divide-right fl pas">
	<h1>Team Members</h1>
	$member_body
	</div>
	<div style="width:48%;" class="fl pas">
	<h1>Facility Backers</h1>
	$fbacker_body
	</div>
html;
	

} else {
	$lists = elgg_echo("projects:noaccess");
}
$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);
