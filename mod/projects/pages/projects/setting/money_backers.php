<?php
gatekeeper();

$project_guid=(int)get_input('project_guid');
elgg_set_page_owner_guid($project_guid);

$project = get_entity($project_guid);



$title = elgg_echo('projects:money:backers');

if ($project && $project->canEdit()) {
	elgg_push_breadcrumb('settings', 'projects/setting/basic/'.$project_guid);
	elgg_push_breadcrumb($title);
	
	$entities=elgg_get_entities_from_metadata(array(
			'type'=>'object',
			'subtype'=>'intra_bill',
			'metadata_name' => 'project_id',
			'metadata_value' => $project_guid,
			));
	if($entities){
		
		$states_list.="<ul>";
		$total=0;
		foreach ($entities as $entity){
		$states_list.="<li class='dashed'>";
		$amt=$entity->amt;
		$owner=get_entity($entity->owner_guid);
		$owner_link="<a href=\"{$owner->getURL()}\">$owner->name</a>";
		$backer_icon = elgg_view_entity_icon($owner, 'tiny');
		$time=elgg_get_friendly_time($entity->time_created);
		$st_body=$owner_link.' backup  <span style="color:#999;font-size:1.2em">'.$amt.'</span>  point(s) '.' ( <span style="color:#666">'.$time.'</span> ).';
		$states_list.=elgg_view_image_block($backer_icon, $st_body);
		
		$states_list.="</li>";
		$total=$total+$amt;
		}
		$states_list.="</ul>";
		$states_list.='<h2>Total backup: '.$total.' points.</h2>';
	}else{
		$states_list = elgg_echo("no backup");
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
