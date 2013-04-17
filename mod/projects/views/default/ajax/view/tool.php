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

// miniu the done annotation
function Undone_task($guid,$limit){
	$tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'tool',
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
			'annotation_name'=>'tool',
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
		$help_link=elgg_view('output/url',array('href'=>"projects/lend/{$guid}?id={$task->id}",'text'=>'LendUs','id'=>"del-{$task->id}",'class'=>'blue-button fr'));
		$help.= "<li class='pam mbm bgwhite'>";
		$help.= $task->value;
		$help.= $help_link;
		$help.= "</li>";
		
	}
		$help.= "</ul>";
//$title=elgg_view('output/url',array('href'=>'projects/required/'.$guid,'text'=>elgg_echo("Needed Tools"),'title'=>elgg_echo('Needed Tools')));
$title=elgg_echo("Needed Tools");
$micro_helps=elgg_view_module('aside', $title, $help,array('class'=>'mtm'));
echo $micro_helps;	
}

?>
