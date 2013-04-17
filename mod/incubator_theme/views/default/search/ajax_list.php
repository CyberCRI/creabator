<?php
/**
 * List a section of search results corresponding in a particular type/subtype
 * or search type (comments for example)
 *
 * @uses $vars['results'] Array of data related to search results including:
 *                          - 'entities' Array of entities to be displayed
 *                          - 'count'    Total number of results
 * @uses $vars['params']  Array of parameters including:
 *                          - 'type'        Entity type
 *                          - 'subtype'     Entity subtype
 *                          - 'search_type' Type of search: 'entities', 'comments', 'tags'
 *                          - 'offset'      Offset in search results
 *                          - 'limit'       Number of results per page
 *                          - 'pagination'  Display pagination?
 */

$entities = $vars['results']['entities'];
$count = $vars['results']['count'] - count($entities);

if (!is_array($entities) || !count($entities)) {
	return FALSE;
}

$query = http_build_query(
	array(
		'q' => $vars['params']['query'],
		'entity_type' => $vars['params']['type'],
		'entity_subtype' => $vars['params']['subtype'],
		'limit' => $vars['params']['limit'],
		'offset' => $vars['params']['offset'],
		'search_type' => $vars['params']['search_type'],
	//@todo include vars for sorting, order, and friend-only.
	)
);

$url = elgg_get_site_url() . "search?$query";

// get pagination
if (array_key_exists('pagination', $vars['params']) && $vars['params']['pagination']) {
	$nav = elgg_view('navigation/pagination',array(
		'base_url' => $url,
		'offset' => $vars['params']['offset'],
		'count' => $vars['results']['count'],
		'limit' => $vars['params']['limit'],
	));
} else {
	$nav = '';
}




$type_str='projects';
// get any more links.
$more_check = $vars['results']['count'] - ($vars['params']['offset'] + $vars['params']['limit']);
$more = ($more_check > 0) ? $more_check : 0;

if ($more) {
	$title_key = ($more == 1) ? 'comment' : 'comments';
	$more_str = elgg_echo('search:more', array($count, $type_str));
	$more_url = elgg_http_remove_url_query_element($url, 'limit');
	$more_link = "<li class='elgg-item'><a href=\"$more_url\">$more_str</a></li>";
} else {
	$more_link = '';
}


$view = search_get_search_view($vars['params'], 'entity');
if ($view) {
	$body = '<ul class="elgg-list search-list">';
	foreach ($entities as $entity) {
		$id = "elgg-{$entity->getType()}-{$entity->getGUID()}";
		$body .= "<li id=\"$id\" class=\"elgg-item\">";
		$body .= elgg_view($view, array(
			'entity' => $entity,
			'params' => $vars['params'],
			'results' => $vars['results']
		));
		$body .= '</li>';
	}
	$body .= $more_link;
	$body .= '</ul>';
}

echo $body;
echo $nav;
