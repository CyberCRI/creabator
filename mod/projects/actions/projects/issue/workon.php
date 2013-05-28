<?php
gatekeeper();
$guid=get_input('guid');
$issue=get_entity($guid);
if(elgg_instanceof($issue,'object','issue')){

	if($issue->annotate('workon', '1','2',elgg_get_logged_in_user_guid())){
		// notify the issue owner
		$to=$issue->getOwnerGUID();
		$subject="Hey, I'm working on your open issue.";
		$sender=elgg_get_logged_in_user_entity()->name;
		$issuelink=$issue->getURL();
		$replylink=elgg_get_site_url().'messages/inbox/'.$issue->getOwnerEntity()->username;
		$message=elgg_echo('issue:workon',array($sender,$issuelink,$replylink));
		messages_send($subject, $message, $to,elgg_get_logged_in_user_guid());
		
		system_message("Work on Success!");
		forward(REFERER);
	}
}else{
	register_error("Failed, Please try agian later.");
	forward(REFERER);
}