<?php

$title=get_input('title');
$description=get_input('description');
$contribute=get_input('contribute');
$tags=get_input('tags');
$container_guid=get_input('project_guid');
$guid=get_input('guid');

if($title&&$description&&$tags&&$container_guid){
    $project=get_entity($container_guid);
    if(elgg_instanceof($project,'object','projects')){
		if($guid){
		 $issue=get_entity($guid);
		 if(!elgg_instanceof($issue,'object','issue')){
		 	register_error(elgg_echo('not valid issue'));
		 	forward(REFERER);
		 }	
		}else{
    	$issue=new ElggObject;
    	$issue->subtype="issue";
    	$issue->container_guid=$container_guid;
    	// default open to every
    	$issue->access_id=2;
    	$new=true;
		}
    	$issue->title=$title;
    	$issue->description=$description;
    	$issue->contribute=$contribute;
    	$tagarray = string_to_tag_array($tags);
    	$issue->tags = $tagarray;
    	// set default undone
    	$issue->done=0;
    	
		if ($issue->save()) {
			if($new){
				add_to_river('river/object/issue/create','create', elgg_get_logged_in_user_guid(), $issue->getGUID());
				
			}
			
			system_message('Save Success!');
			forward('projects/issues/view/'.$issue->guid);
		}else{
			register_error(elgg_echo('Failed, Please try again later.'));
			forward(REFERER);
		}

    }else{
    	register_error(elgg_echo('not valid project'));
    	forward(REFERER);
    }
}else{
	register_error(elgg_echo('Failed, Please try agian later.'));
	forward(REFERER);
}



