<?php 
/*
 * Project's admin page menu layout
 */

$tabs=array(
		'new' => array(
				'text' => elgg_echo("admin:menu:new"),
				'href' => 'projects/administration',
				'priority' => 200,
		),
		'frozen' => array(
				'text' => elgg_echo("admin:menu:frozen"),
				'href' => 'projects/administration?option=frozen',
				'priority' => 300,
		),
		'recommened' => array(
				'text' => elgg_echo("admin:menu:recommened"),
				'href' => 'projects/administration?option=recommened',
				'priority' => 400,
		),
		'finish' => array(
				'text' => elgg_echo("admin:menu:finish"),
				'href' => 'projects/administration?option=finish',
				'priority' => 500,
		),
		'stop' => array(
				'text' => elgg_echo("admin:menu:stop"),
				'href' => 'projects/administration?option=stop',
				'priority' => 600,
		),
		'graphic' => array(
				'text' => elgg_echo("admin:menu:graphic"),
				'href' => 'projects/administration?option=graphic',
				'priority' => 700,
		),
);
foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('admin_menu_tabs', $tab);
}

echo elgg_view_menu('admin_menu_tabs',array('sort_by' => 'priority', 'class' => 'elgg-menu-hz adminmenu-tab '));
