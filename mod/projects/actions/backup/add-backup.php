<?php
/**
* Elgg backup save action
*
* @package backup
*/

gatekeeper();

//get the value
$backup_amt = get_input('backup_amt');

$bp_guid = get_input('bp_guid');
$access_id = 2;
$guid = get_input('guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());


elgg_make_sticky_form('backup');

if ($guid == 0) {
$checkout = new ElggObject;
$checkout->subtype = "backup";
$checkout->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());

$new = true;
} else {
	$checkout = get_entity($guid);
}
$checkout->backup_amt = $backup_amt;

$checkout->bp_guid = $bp_guid;
$checkout->access_id = $access_id;
if ($checkout->save()) {

	elgg_clear_sticky_form('backup');

	


	
	forward($checkout->getURL());
} else {
	register_error(elgg_echo('backup:save:failed'));
	forward(REFERER);
}