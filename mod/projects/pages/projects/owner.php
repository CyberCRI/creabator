<?php
/**
 * Elgg owner projects 
 *
 * @package projects
 */

$owner_name=get_input('user_name');
$owner=get_user_by_username($owner_name);
$owner_guid=$owner->guid;
$user_guid = elgg_get_logged_in_user_guid();
$user=get_entity($guid);

if ($owner_guid!=$user_guid) {
	forward('projects/all');
}


$offset = (int)get_input('offset', 0);
elgg_set_context('owner');
$content .= elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'projects',
	'container_guid' => $owner->guid,
	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false
));

if (!$content) {
	$content = elgg_echo('projects:none');
}

$title = elgg_echo('projects:own');


$vars = array(
	
	'content' => $content,
	'title' => $title,
);



$body = elgg_view_layout('home_two_column', $vars);

echo elgg_view_page($title, $body);