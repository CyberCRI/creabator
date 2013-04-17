<?php 
$project_guid = get_input('project_guid');
$project = get_entity($project_guid);

$amount=get_input('amount');
if(!$amount){
	register_error(elgg_echo('amount could not be empty'));
	forward(REFERER);
}

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
	$project->fund_amt=$amount;
	$project->start_time=time();
	$project->save();
	echo json_encode(array('amount'=>$amount,'get_money'=>1));
	
}else{
	register_error(elgg_echo('no permission'));
	forward(REFERER);
	
}


?>