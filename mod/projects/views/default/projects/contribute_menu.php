<?php
/**
 * All projects listing page navigation
 *
 */
$tabs = array(
	
	'facility' => array(
				'text' => elgg_echo('project:contribute:facility'),
				'href' => 'projects/contribute?filter=facility',
				'priority' => 400,
	),
	'team' => array(
		'text' => elgg_echo('project:contribute:team'),
		'href' => 'projects/contribute?filter=team',
		'priority' => 300,
	),
	'task' => array(
		'text' => elgg_echo('project:contribute:task'),
		'href' => 'projects/contribute?filter=task',
		'priority' => 200,
	),


);

// sets default selected item
if (strpos(full_url(), 'filter') === false) {
	$tabs['task']['selected'] = true;
	
}

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('contribute_filter', $tab);
}

echo elgg_view_menu('contribute_filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz elgg-menu-ptabs'));
