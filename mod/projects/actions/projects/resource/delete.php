<?php

// Ensure we're logged in
if (!elgg_is_logged_in()) {
	forward();
}

// Make sure we can get the comment in question
$annotation_id = (int) get_input('annotation_id');
if ($resource = elgg_get_annotation_from_id($annotation_id)) {

	$entity = get_entity($resource->entity_guid);

	if ($resource->canEdit()) {
		$resource->delete();
		system_message(elgg_echo("resource:deleted"));
		forward($entity->getURL());
	}

} else {
	$url = "";
}

register_error(elgg_echo("resource:notdeleted"));
forward(REFERER);