<?php
/**
 * New projects river entry
 *
 * @package projects
 */

$object = $vars['item']->getObjectEntity();
$excerpt = $object->briefdes;

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,

));
