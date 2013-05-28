<?php 
/*
 * Check if the task is finish or not 
 */
$guid=get_input('guid');
$issue=get_entity($guid);
if(elgg_instanceof($issue,'object','issue')&&$issue->canEdit()){
	$issue->done=1;
	// @todo: thanks user who workon the project
	system_message('Update Success!');
	forward(REFERER);
}else{
	register_error('Failed,Please try again later.');
	forward(REFERER);
}
?>