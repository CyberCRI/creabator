<?php 
//check if it's system recommend projects
function is_system_recommend_project($project){
	$team_exit=$project->team_exit;
	$team_num=$project->team_num;
	$t_proccess=number_format(($team_exit/$team_num)*100);

	$tool_exit=$project->tool_exit;
	$tool_num=$project->tool_num;
	$f_proccess=number_format(($tool_exit/$tool_num)*100);

	$fund_exit=$project->fund_exit;
	$fund_num=$project->fund_num;
	$m_bp_total = $project->getAnnotationsSum('m_state');
	$m_proccess=number_format((($fund_exit+$m_bp_total)/$fund_num)*100);

	$total=$m_proccess*3+$t_proccess+$f_proccess;
	if ($total>=250){
		return true;
	}else{
		return false;
	}
}

$not_recommend_projects=elgg_get_entities_from_metadata(array(
		'type'=>'object',
		'subtype'=>'projects',
		'metadata_names' =>'featured_project',
		'metadata_values'=>'no',
		));

foreach ($not_recommend_projects as $project){
	if(is_system_recommend_project($project)){
		$recommends_guids[].=$project->guid;
	}
}

if ($recommends_guids){
$recommends_projests=elgg_get_entities(array(
		'guids'=>$recommends_guids,
		'type'=>'object',
		'subtype'=>'projects',
		'metadata_names' =>'featured_project',
		'metadata_values'=>'no',
		));
}
if(!$recommends_guids){
	$list=elgg_echo('No Recommened Projects');
}else{
	$project_list="<ul class=\"project_list pam grey brs\">";
	foreach ($recommends_projests as $project){
		$icon=elgg_view_entity_icon($project,'small');
		$title=$project->title;
		$brief=$project->briefdes;
		$feature=elgg_view('output/url',array(
				'href'=>'action/projects/featured?project_guid='.$project->guid.'&action_type=feature',
				'text'=>elgg_echo("Recommened"),
				'is_action' => true,
				'class'=>'elgg-button elgg-button-submit fr',
		));
		$params = array(
				'entity' => $project,
				'title' => $title.$feature,
				'subtitle' => $brief,
				'tags'=>false,
		);
		
		$summary = elgg_view('object/elements/summary', $params);
		
		$project_list.="<li class=\"mts dashed\">";
		$project_list.=elgg_view_image_block($icon, $summary);
		$project_list.="</li>";
		
	}
	$project_list.="</ul>";
	$list=$project_list;
}
echo $list;