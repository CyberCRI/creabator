<?php 
$guid=get_input('guid');
$project=get_entity($guid);
/* $limit=get_input('limit');
if(!$limit){
	$limit=3;
}else{
	$limit=0;
} */
$limit=0;

$tasks=elgg_get_annotations(array(
		'type'=>'object',
		'subtype'=>'projects',
		'guid'=>$guid,
		'annotation_name'=>'team',
		'limit'=>0
		));
// miniu the done annotation
function Undone_task($guid,$limit){
	$tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'team',
			'limit'=>0
	));
	if(!$tasks){
		return false;
	}
	
	$project=get_entity($guid);
	$at_ids=array();
	foreach ($tasks as $task){
		$id=$task->id;
		$done=$project->$id;
		
		if($done!=1){
			$at_ids[].=$id;
			
		}
	}
	if(!$at_ids){
		return false ;
	}
	$undone_tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'annotation_name'=>'team',
			'annotation_ids'=>$at_ids,
			'limit'=>$limit
	));
	return $undone_tasks;
}
$undone=Undone_task($guid,$limit);
if($undone){
$tasks=array_reverse($undone);

	$help="<ul >";

	foreach ($tasks as $task){
		$help_link=elgg_view('output/url',array('href'=>"projects/apply/{$guid}?id={$task->id}",'text'=>'JoinUs','id'=>"del-{$task->id}",'class'=>'orange-button fr'));
		$help.= "<li class='pam mbm bgwhite'>";
		$help.= $task->value;
		$help.= $help_link;
		$help.= "</li>";
		
	}
		$help.= "</ul>";
	

//$title=elgg_view('output/url',array('href'=>'projects/required/'.$guid,'text'=>elgg_echo('Team we looking for'),'title'=>elgg_echo('Team we looking for')));
$title=elgg_echo('Team we needed:');
$micro_helps=elgg_view_module('aside', $title, $help,array('class'=>'mtm'));
echo $micro_helps;
}
?>
