<?php
$guids=$vars['guids'];

foreach($guids as $guid){
$issues=elgg_get_entities_from_metadata(array('type'=>'object','subtype'=>'issue','container_guid'=>$guid,'metadata_name'=>'done','metadata_value'=>'0','limit'=>'0'));
	if($issues){
		foreach($issues as $issue){
		$undones[]=$issue;
		}
	}
}


if($undones){
	$list="<ul >";
	foreach ($undones as $undone){
		$guid=$undone->container_guid;
		$utitle=elgg_view('output/url',array('href'=>elgg_get_site_url().'projects/issues/view/'.$undone->guid,'text'=>$undone->title,'target'=>'_blank'));
		$project=get_entity($guid);
		$p_title="Project: {$project->title}";
		$p_link=elgg_view('output/url',array('href'=>$project->getURL(),'text'=>'View Project','style'=>'color:#ccc','class'=>'fr','target'=>'blank'));
		$p_brief=$project->briefdes;
		
		$list.= "<li class='mts mbs pam grey brm' style='width:98%'>";
		$list.= "<div class='dashed'>$utitle</div>";
		$list.= "<div style='color:#ccc'>$p_title  $p_link</div>";
		$list.= "</li>";

	}
	$list.= "</ul>";

}
echo $list;