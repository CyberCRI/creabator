<?php
gatekeeper();

$project_guid=(int)get_input('project_guid');
elgg_set_page_owner_guid($project_guid);

$project = get_entity($project_guid);



$title = elgg_echo('projects:money:backers');

if ($project && $project->canEdit()) {
	elgg_push_breadcrumb('settings', 'projects/setting/basic/'.$project_guid);
	elgg_push_breadcrumb($title);
	
	//get the backer list
	$m_states = elgg_get_annotations(array(
			'guid' => $project_guid,
			'annotation_name' => 'm_state',
			'limit' => 20,
			'order_by' => 'n_table.time_created desc'
	));
	foreach ($m_states as $mst){
	
		$mstvs[] .=$mst->value;
	
	}
	$mstnum=array_search("0",$mstvs);
	//delete the owner's backup(0) which set by the system
	array_splice($m_states,$mstnum,1);
	$states_list="No Backer";
	if($m_states){
		$states_list=elgg_view_annotation_list($m_states,array('full_view'=>false));
	}
} else {
	$states_list = elgg_echo("projects:noaccess");
}
$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$states_list));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);
