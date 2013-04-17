<?php
/**
 * Elgg delete task action
 *
 * @package Elgg
 */

// Ensure we're logged in
if (!elgg_is_logged_in()) {
	forward();
}

// Make sure we can get the task in question
$annotation_id = (int) get_input('annotation_id');
if ($task = elgg_get_annotation_from_id($annotation_id)) {

	$entity = get_entity($task->entity_guid);


	if ($task->canEdit()) {
		$task->delete();

		
		return true;
	}

} else {
	return false;
}

