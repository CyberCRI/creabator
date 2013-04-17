<?php
/*
 * update action page
 * Created on 2012-1-29
 *
 * @WiserIncubator
 * Weipeng Kuang
 */


gatekeeper();
$description = get_input('content');
$access_id = "2";
$guid = get_input('guid');
$container_guid = get_input('project_guid');

elgg_make_sticky_form('updates');

if ($guid == 0) {
	$updates = new ElggObject;
	$updates->subtype = "updates";
	$updates->container_guid = $container_guid;
	$new = true;
} else {
	$updates = get_entity($guid);
	if (!$updates->canEdit()) {
		system_message(elgg_echo('project:updates:save:failed'));
		forward(REFERRER);
	}
}

$updates->content = $description;
$updates->access_id = $access_id;

if ($updates->save()) {

	elgg_clear_sticky_form('updates');
	$updateurl='projects/updates/'.$container_guid;
	forward($updateurl);
} else {
	register_error(elgg_echo('project:updates:save:failed'));
	forward(REFERRER);
}
