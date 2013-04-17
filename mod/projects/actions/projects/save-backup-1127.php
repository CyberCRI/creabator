<?php
/**
* Elgg projects save action
*
* @package projects
*/


gatekeeper();

$title = get_input('title');
$tagline = get_input('tagline');
$briefdes = get_input('briefdes');
$plan = get_input('plan');
$days = get_input('days');

$tags = get_input('tags');
$guid = get_input('guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('projects');



//validate the data

if ($guid == 0) {
	$project = new ElggProject;
	$project->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());
	
	$new = true;

// for approval
$project->access_id = 0;
$project->title = $title;



//set up the backup basic
$project->annotate('m_state', 0,2,$_SESSION['user']->getGUID(),'integer');



} else {
	$project = get_entity($guid);
	if (!$project->canEdit()) {
		system_message(elgg_echo('projects:save:failed'));
		forward(REFERRER);
	}


}
//set up the basic days,could not change with edit
$project->days = $days;

$project->tagline = $tagline;
$project->briefdes = $briefdes;
$project->plan = $plan;
$project->catagory = $catagory;

$tagarray = string_to_tag_array($tags);
$project->tags = $tagarray;


if ($project->save()) {

	

elgg_clear_sticky_form('projects');




	if ($new) {
		 //notify the admin only if new
	// radom select the admin to send message
$users=elgg_get_entities(array('type'=>'user'));
		foreach ($users as $user){
			if ($user->isAdmin()){
				$admin_guids[].=$user->guid;
			}
		}
$recipient_guid = $admin_guids[ mt_rand(0, count($admin_guids) - 1) ];
//set up the subject and title
$subject='New Project-'.$title;
$body=$project->getURL();
$result = messages_send($subject, $body, $recipient_guid, 0, $reply);
//add to river only if new
		add_to_river('river/object/projects/create','create', elgg_get_logged_in_user_guid(), $project->getGUID());
	}

	forward('projects/setting/basic/'.$project->getGUID());
} else {
	register_error(elgg_echo('projects:save:failed'));
	forward("projects");
}
