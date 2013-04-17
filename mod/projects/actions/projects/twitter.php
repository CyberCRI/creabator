<?php
/**
* Send the application message
*
* @package ElggMessages
*/


$code= get_input('twitter');
$data_id= get_input('twitter_data_id');
$project_guid = get_input('project_guid');
$project=get_entity($project_guid);


elgg_make_sticky_form('twitters');

$user_guid=elgg_get_logged_in_user_guid();
$user=get_entity($user_guid);

// Make sure the message field, send to field and title are not blank
if (!$code) {
	register_error(elgg_echo("Blank"));
	forward(REFERER);
}

if (($user instanceof ElggUser) && (elgg_instanceof($project,'object', 'projects'))) {

	$project->twitter = $code;
	$project->twitter_data_id = $data_id;
	
if (!$project->save()) {
	register_error(elgg_echo("Error"));
	forward(REFERER);
}

elgg_clear_sticky_form('twitters');

system_message(elgg_echo('Save Success'));

}
