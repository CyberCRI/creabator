<?php
$guids=$vars['guids'];


$i=0;
$total=count($guids);
while($i<$total){
	$ud=Undone_contribute($guids[$i], 'task');
	if($ud){
	$undones_tasks=$ud;
		foreach($undones_tasks as $undone_task){
			$undones[]=$undone_task;
		}
	}
    $i++;
}

//print_r($undones);



if($undones){
	$list="<ul >";
	foreach ($undones as $undone){
		$guid=$undone->entity_guid;
		//$owner=get_entity($undone->owner_guid);
		//$owner_icon=elgg_view_entity_icon($owner,'small');
		$project=get_entity($guid);
		$p_title="From: {$project->title}";
		$p_link=elgg_view('output/url',array('href'=>$project->getURL(),'text'=>'View Project','style'=>'color:#ccc','class'=>'fr'));
		$p_brief=$project->briefdes;
		$list_link=elgg_view('output/url',array('href'=>"projects/apply/{$guid}?id={$undone->id}",'text'=>'HelpUs','id'=>"del-{$undone->id}",'class'=>'orange-button fr'));
		
		$list.= "<li class='mts mbs pam grey brm' style='width:98%'>";
		$list.= "<div class='dashed' style='font-size:1.2em' >{$undone->value}$list_link</div>";
		$list.= "<div style='color:#ccc'>$p_title  $p_link</div>";
		$list.= "</li>";

	}
	$list.= "</ul>";

}
echo $list;