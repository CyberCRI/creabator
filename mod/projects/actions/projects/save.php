<?php
/**
* Elgg projects save action
*
* @package projects
*/



$title = get_input('title');
$tagline = get_input('tagline');
$briefdes = get_input('briefdes');
$plan = get_input('plan');

$amount=get_input('amount');
$no_money=(int)get_input('no_money');
if($no_money==1){
	$amount=0;
}else{
	if(!$amount){
		register_error('Please fill the amount or click the checkbox');
	}
}
	


$tags = get_input('tags');
$guid = get_input('guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('projects');


$visibility= (int)get_input('vis');

if($visibility!=2&&$visibility!=0){
	$org=get_entity($visibility);
	$visibility = $org->group_acl;
	$container_guid=$org->guid;
}

//validate the data

if ($guid == 0) {
	$project = new ElggProject;
	$project->container_guid =$container_guid;
	
	$new = true;
	
	$project_acl=create_access_collection(elgg_echo('projects:acl',array($title)));
	if($project_acl){
		$project->project_acl=$project_acl;
	}
//set up the backup basic
$project->annotate('m_state', 0,2,$_SESSION['user']->getGUID(),'integer');


} else {
	$project = get_entity($guid);
	if (!$project->canEdit()) {
		system_message(elgg_echo('projects:save:failed'));
		forward(REFERRER);
	}


}


// alow owner to change
$project->fund_amt=$amount;
$project->no_money=$no_money;

$project->access_id=$visibility;

$project->title = $title;
$project->tagline = $tagline;
$project->briefdes = $briefdes;
$project->plan = $plan;
$project->catagory = $catagory;

$tagarray = string_to_tag_array($tags);
$project->tags = $tagarray;


if ($project->save()) {

	

elgg_clear_sticky_form('projects');




	if ($new) {
/* 		 //notify the admin only if new
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
$result = messages_send($subject, $body, $recipient_guid, 0, $reply); */
//add to river only if new
		add_to_river('river/object/projects/create','create', elgg_get_logged_in_user_guid(), $project->getGUID());
		
		// add a new blog post
		$blogs = new ElggObject;
		$blogs->subtype = "blogs";
		$blogs->container_guid = $guid;
		$blogs->title="Our project is open now!";
		$blogs->description="Dear friends,our projects is open now, welcome to follow us.";
		$blogs->access_id = 2;
		$blogs->save();
	}

	forward('projects/setting/help/'.$project->getGUID());
} else {
	register_error(elgg_echo('projects:save:failed'));
	forward("projects");
}
