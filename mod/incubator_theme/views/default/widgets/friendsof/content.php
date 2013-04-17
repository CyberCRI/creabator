<?php
/**
 * Friend widget display view
 *
 */

// owner of the widget
$owner = $vars['entity']->getOwnerEntity();

// the number of friends to display
$num = (int) $vars['entity']->num_display;

// get the correct size
$size = $vars['entity']->icon_size;

if (elgg_instanceof($owner, 'user')) {
	
	$html=elgg_list_entities_from_relationship(array(
		'object'=>'user',
		'relationship'=>'friend',
		'relationship_guid'=>$owner->getGUID(),
		'inverse_relationship'=>TRUE,
		'size' => $size,
		'list_type' => 'gallery',
		'pagination' => false
	));
	if ($html) {
		echo $html;
	}
}
