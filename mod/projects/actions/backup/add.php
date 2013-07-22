<?php
/**
* Elgg backup save action
*
* @package backup
*/

gatekeeper();

//get the value
$amt = get_input('backup_amt');
if(!is_numeric($amt)){
	register_error(elgg_echo('not number'));
	forward(REFERER);
}
$user_id=elgg_get_logged_in_user_guid();
$project_guid = get_input('project_guid');

elgg_make_sticky_form('backup');
// load the lib of the bank
elgg_load_library('elgg:bank');

$result=add_money_to_project($user_id, $project_guid, $amt);
if($result==2){
//session the infor and forward to the deposit page
$_SESSION['last_to_pay_amt'] = $amt;
$_SESSION['last_to_pay_project'] = $project_guid;
$_SESSION['last_to_pay_user'] = $user_id;
 
	register_error('not engough money');
	$user=get_user($user_id);
	forward('bank/deposit/'.$user->username);
	
}elseif($result==0){
		register_error(elgg_echo('backup:save:failed'));
		forward(REFERER);
}elseif($result==1){

elgg_clear_sticky_form('backup');
//forward
$project=get_entity($project_guid);
forward($project->getURL());
}


	


