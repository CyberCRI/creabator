<?php 
/*
 * Check if the task is finish or not 
 */
$guid=get_input('guid');
$issue=get_entity($guid);
$msg=get_input('msg');
if(elgg_instanceof($issue,'object','issue')&&$issue->canEdit()){
	$issue->done=1;
	// @todo: thanks user who workon the project
	// get all users who working on this issue
	$contributers=elgg_get_annotations(array('type'=>'object','subtype'=>'issue','guid'=>$guid,'annotation_name'=>'workon'));
	if($contributers){
		foreach($contributers as $backer){
		
		   // thanks the contributer 
			$subject="Thanks for helping our issue.";
			$to=$backer->owner_guid;
			$message="I'm happy to inform you that we finally fix the issue with your kindly help. Thanks for your contribution to this issue:".$issue->title.'.Have a nice day.';
			messages_send($subject, $message, $to,elgg_get_logged_in_user_guid());

		}
		
	}

	system_message('Update Success!');
	forward(REFERER);
}else{
	register_error('Failed,Please try again later.');
	forward(REFERER);
}
?>