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
	'relationship' => 'member',
	'relationship_guid' => $vars['entity']->owner_guid,
	'inverse_relationship' => False,
	'limit' => $max,
	'full_view' => FALSE,
	'list_type'=>'gallery',
	
);
$content = elgg_list_entities_from_relationship($options);



if ($content) {
	echo $content;
} else {
	echo elgg_echo('projects:none');
}
