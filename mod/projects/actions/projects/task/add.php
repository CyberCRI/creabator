<?php

$guid=get_input('guid');
$project=get_entity($guid);
$value=get_input('value');
$name=get_input('annotation');
$owner_id=$project->owner_guid;

if($project->annotate($name, $value,2,$owner_id)){
	echo json_encode(array($name=>$value));
}else{
	register_error('save error');
}