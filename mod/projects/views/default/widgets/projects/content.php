<?php
/**
 * Elgg projects widget
 *
 * @package projects
 */

$max = (int) $vars['entity']->num_display;

$options = array(
	'type' => 'object',
	'subtype' => 'projects',
	'container_guid' => $vars['entity']->owner_guid,
	'limit' => $max,
	'full_view' => FALSE,
	'list_type'=>'gallery',
	
);
$content = elgg_list_entities($options);



if ($content) {
	echo $content;
} else {
	echo elgg_echo('projects:none');
}
