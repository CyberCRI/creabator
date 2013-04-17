<?php 
$project_guid = get_input('project_guid');
$project = get_entity($project_guid);

$stage=$project->get_money;
if($stage==1){
	return ;
}

if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}
if(elgg_get_logged_in_user_guid()==$project->owner_guid){
	$project->get_money = 1;
	$project->start_time=time();
	$project->save();
	system_message(elgg_echo('Start Success!'));
	
}else{
	register_error(elgg_echo('no permission'));
	forward(REFERER);
	
}


?>