<?php 
$guid=get_input('guid');
$project=get_entity($guid);
/* $limit=get_input('limit');
$hide_link=elgg_view('output/url',array('href'=>'#','id'=>'hide_task','text'=>'Hide'));
if(!$limit){
	$limit=3;
	$hide_link=elgg_view('output/url',array('href'=>'#','id'=>'show_task','text'=>'Show'));;
} */

// miniu the done annotation
function Undone_task($guid,$limit){
	$tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'task',
			'limit'=>0,
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
			'annotation_name'=>'task',
			'annotation_ids'=>$at_ids,
			'limit'=>0
	));
	
	return $undone_tasks;
}
$undone=Undone_task($guid);
if($undone){
$tasks=array_reverse($undone);

	$help="<ul >";

	foreach ($tasks as $task){
		$help_link=elgg_view('output/url',array('href'=>"projects/apply/{$guid}?id={$task->id}",'text'=>'HelpUs','id'=>"del-{$task->id}",'class'=>'orange-button fr'));
		$help.= "<li class='pam mbm bgwhite'>";
		$help.= $task->value;
		$help.= $help_link;
		$help.= "</li>";
		
	}
		$help.= "</ul>";
	    
//$title=elgg_view('output/url',array('href'=>'projects/required/'.$guid,'text'=>elgg_echo('project:reward:title'),'title'=>elgg_echo('project:reward:title')));
$title=elgg_echo('project:reward:title');
		$micro_helps=elgg_view_module('aside', $title, $help,array('class'=>'mtm'));
echo $micro_helps;
}

?>
