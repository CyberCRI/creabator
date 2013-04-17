<?php
/**
 * List entities by category
 *
 * @package ElggCategories
 */

$limit = get_input("limit", 10);
$offset = get_input("offset", 0);
$category = get_input("category");
$owner_guid = get_input("owner_guid", ELGG_ENTITIES_ANY_VALUE);
$subtype ="projects";
$type = get_input("type", 'object');

$params = array(
	'metadata_name' => 'universal_categories',
	'metadata_value' => $category,
	'types' => $type,
	'subtypes' => $subtype,
	'owner_guid' => $owner_guid,
	'limit' => $limit,
	'full_view' => FALSE,
	'metadata_case_sensitive' => FALSE,
	'list_class'=>'project-elgg-list',
	'item_class'=>'project-elgg-item',
);
$objects = elgg_list_entities_from_metadata($params);

$title = elgg_echo('categories:results', array($category));

$content = elgg_view_title($title);
$content .= $objects;

$fliter = elgg_view('projects/fliter_menu', array('selected' => $category));
$body = elgg_view_layout('ib_two_column', array(
	'ib_content' => $content,
	'ib_filter'=>$fliter,
));

echo elgg_view_page($title, $body,'list');
