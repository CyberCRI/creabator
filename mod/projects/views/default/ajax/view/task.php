<?php 
$guid=get_input('guid');
$project=get_entity($guid);

$undone=elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'issue',
		'container_guid'=>$guid,
		'limit' => 0,
		'metadata_name'=>'done',
		'metadata_value'=>'0',
));

if($undone){
$tasks=array_reverse($undone);

	$help="<ul >";

	foreach ($tasks as $task){
		$help.= "<li class='pas'>";
		$help.= elgg_view("output/url",array('href'=>'projects/issues/view/'.$task->guid,'text'=>$task->title,'target'=>'_blank'));
		$help.= "</li>";
		
	}
		$help.= "</ul>";
	    
//$title=elgg_view('output/url',array('href'=>'projects/required/'.$guid,'text'=>elgg_echo('project:reward:title'),'title'=>elgg_echo('project:reward:title')));
$title=elgg_echo('project:reward:title');
		$micro_helps=elgg_view_module('aside', $title, $help,array('class'=>'mtm'));
echo $micro_helps;
}

?>
