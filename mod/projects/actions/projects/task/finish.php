<?php 
/*
 * Check if the task is finish or not 
 */
$guid=get_input('guid');
$project=get_entity($guid);
$annotation_id=get_input('annotation_id');
$done=get_input('done');

$project->$annotation_id=$done;
if($project->save()){
	echo json_encode(array('done'=>$done));
}else{
	register_error('save error');
}
?>