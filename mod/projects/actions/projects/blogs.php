<?php
/*
 * update action page
 * Created on 2012-1-29
 *
 * @WiserIncubator
 * Weipeng Kuang
 */


gatekeeper();

$title =get_input('title');
$description = get_input('description');
$access_id = "2";
$guid = get_input('guid');
$container_guid = (int) get_input('project_guid');
$pic_guid=(int)get_input('pic_guid');

elgg_make_sticky_form('blogs');

if ($guid == 0) {
	$blogs = new ElggObject;
	$blogs->subtype = "blogs";
	$blogs->container_guid = $container_guid;
	$new = true;
} else {
	$blogs = get_entity($guid);
	if (!$blogs->canEdit()) {
		register_error(elgg_echo('project:blogs:save:failed'));
		forward(REFERRER);
	}
}


$blogs->title = $title;
$blogs->description = $description;
$blogs->access_id = $access_id;

if ($blogs->save()) {

	elgg_clear_sticky_form('blogs');
if($new){
	add_to_river('river/object/blogs/create','create', elgg_get_logged_in_user_guid(), $blogs->getGUID());
	
}
if($pic_guid){
	add_entity_relationship($pic_guid, "belong_to_blog", $blogs->getGUID());
}
 
	forward($blogs->getURL());
} else {
	register_error(elgg_echo('project:blogs:save:failed'));
	forward(REFERRER);
}
