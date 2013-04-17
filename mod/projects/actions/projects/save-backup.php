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
$reason = get_input('reason');
$t_state = get_input('t_state');
$f_state = get_input('f_state');


$rqmoney = get_input('rqmoney');
$rqteam = get_input('rqteam');
$rqteam_reward = get_input('rqteam_reward');
$rqfacility = get_input('rqfacility');
$rqfacility_reward = get_input('rqfacility_reward');

$tags = get_input('tags');
$guid = get_input('guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('projects');

// don't use elgg_normalize_url() because we don't want
// relative links resolved to this site.
/* if ($address && !preg_match("#^((ht|f)tps?:)?//#i", $address)) {
	$address = "http://$address";
}

if (!$address) {
	register_error(elgg_echo('projects:address:invalid'));
	forward(REFERER);
} */

//validate the data

if ($guid == 0) {
	$project = new ElggObject;
	$project->subtype = "projects";
	$project->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());
	
	$new = true;

// for approval
$project->access_id = 0;
$project->title = $title;
//set up the backup basic
$project->annotate('m_state', 0,2,$_SESSION['user']->getGUID(),'integer');
$project->t_state = 0;
$project->f_state = 0;


} else {
	$project = get_entity($guid);
	if (!$project->canEdit()) {
		system_message(elgg_echo('projects:save:failed'));
		forward(REFERRER);
	}


}
$project->tagline = $tagline;
$project->briefdes = $briefdes;
$project->plan = $plan;
$project->reason = $reason;

$project->rqmoney = $rqmoney;

$project->rqteam = $rqteam;
$project->rqteam_reward = $rqteam_reward;
$project->rqfacility = $rqfacility;
$project->rqfacility_reward = $rqfacility_reward;
$project->t_state =$t_state;
$project->f_state = $f_state;

$tagarray = string_to_tag_array($tags);
$project->tags = $tagarray;
$i=0;
while($i<=4){
	$reward_nums[$i] = get_input('reward_nums'.$i);
	$reward_texts[$i]= get_input('reward_texts'.$i);

	if(!empty($reward_nums[$i])&&!empty($reward_texts[$i])){
		$num_name[$i]='reward_nums'.$i;
		$text_name[$i]='reward_texts'.$i;
		$project->$num_name[$i] =$reward_nums[$i];
		$project->$text_name[$i] =$reward_texts[$i];
	}
	$i++;
}

if ($project->save()) {

	// Now see if we have a file icon
if ((isset($_FILES['pic'])) && (substr_count($_FILES['pic']['type'],'image/'))) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "projects/" . $project->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $project->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('pic'));
	$filehandler->close();

	$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 40, 40, $icon_sizes['tiny']['square']);
	$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 80, 80, $icon_sizes['small']['square']);
	$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200, 200, $icon_sizes['medium']['square']);
	$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 660, 550, $icon_sizes['large']['square']);
	if ($thumbtiny) {

		$thumb = new ElggFile();
		$thumb->owner_guid = $project->owner_guid;
		$thumb->setMimeType('image/jpeg');

		$thumb->setFilename($prefix."tiny.jpg");
		$thumb->open("write");
		$thumb->write($thumbtiny);
		$thumb->close();

		$thumb->setFilename($prefix."small.jpg");
		$thumb->open("write");
		$thumb->write($thumbsmall);
		$thumb->close();

		$thumb->setFilename($prefix."medium.jpg");
		$thumb->open("write");
		$thumb->write($thumbmedium);
		$thumb->close();

		$thumb->setFilename($prefix."large.jpg");
		$thumb->open("write");
		$thumb->write($thumblarge);
		$thumb->close();

		$project->icontime = time();
	}
}



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

	forward('projects/setting/'.$project->getGUID());
} else {
	register_error(elgg_echo('projects:save:failed'));
	forward("projects");
}
