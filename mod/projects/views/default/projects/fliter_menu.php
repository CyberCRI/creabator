<?php
/**
 * All projects listing page navigation
 *
 */
$tabs = array(
	'design' => array(
				'text' => elgg_echo('project:all:design'),
				'href' => 'categories/list?category=design',
				'priority' => 700,
		),
	'engineering' => array(
				'text' => elgg_echo('project:all:engineering'),
				'href' => 'categories/list?category=engineering',
				'priority' => 600,
		),
	'research' => array(
				'text' => elgg_echo('project:all:research'),
				'href' => 'categories/list?category=research',
				'priority' => 500,
		),
	'learning' => array(
				'text' => elgg_echo('project:all:learning'),
				'href' => 'categories/list?category=education',
				'priority' => 400,
	),
	
	'all' => array(
		'text' => elgg_echo('project:all:newest'),
		'href' => 'projects/all?filter=all',
		'priority' => 800,
	),
	'hottest' => array(
		'text' => elgg_echo('project:all:hottest'),
		'href' => 'projects/all?filter=hottest',
		'priority' => 300,
	),
	'feature' => array(
		'text' => elgg_echo('project:all:recommended'),
		'href' => 'projects/all?filter=feature',
		'priority' => 200,
	),


);

// sets default selected item
if (strpos(full_url(), 'filter') === false) {
	if(strpos(full_url(), 'category') === false){
	$tabs['feature']['selected'] = true;
	}
}

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz elgg-menu-ptabs'));
