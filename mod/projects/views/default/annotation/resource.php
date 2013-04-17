<?php
/**
 * Elgg generic comment view
 *
 * @uses $vars['annotation']  ElggAnnotation object
 * @uses $vars['full_view']   Display fill view or brief view
 */

if (!isset($vars['annotation'])) {
	return true;
}

$resource = $vars['annotation'];

$entity = get_entity($resource->entity_guid);
$resource_owner = get_user($resource->owner_guid);
if (!$entity || !$resource_owner) {
	return true;
}



$resource_owner_icon = elgg_view_entity_icon($resource_owner, 'tiny');
//Add a menu to the annotation

$menu = elgg_view_menu('annotation', array(
		'annotation' => $resource,
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz float-alt',
));
$resource_text = $resource->value;	
	$body = <<<HTML
<div class="mbn">
	$menu
	
	<a href='$resource_text' target='blank'>$resource_text</a>
</div>
HTML;
echo elgg_view_image_block($resource_owner_icon,  $body);

