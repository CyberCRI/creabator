<?php
$user=elgg_get_page_owner_entity();
$tabs=array(
		
		'setting' => array(
				'text' => elgg_echo('menu:account'),
				'href' =>'settings/user/'.$user->username,
				'priority' => 200,
		),
		'avatar' => array(
					'text' => elgg_echo('avatar:edit'),
					'href' => 'avatar/edit/'.$user->username,
	
					'priority' => 300,
			),
		'profile' => array(
					'text' => elgg_echo('profile:edit'),
					'href' =>'profile/'.$user->username.'/edit',
					'priority' => 400,
			),
	
		'notification' => array(
				'text' => elgg_echo('notifications:subscriptions:changesettings'),
				'href' => 'notifications/personal',
				'priority' => 500,
		),
		/*
		'friends' => array(
				'text' => elgg_echo('friends'),
				'href' => 'friends/'.$user->username,
				'priority' => 1000,
		),
		'friendsof' => array(
				'text' => elgg_echo('menu:friendsof'),
				'href' => 'friendsof/'.$user->username,
				'priority' => 1000,
		),
		*/
		'collection' => array(
				'text' => elgg_echo('Collection'),
				'href' => "collections/$user->username",
				'priority' => 800,
		),
);
foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('setting_tabs', $tab);
}

echo elgg_view_menu('setting_tabs',array('sort_by' => 'priority', 'class' => 'elgg-menu-hz river-tab'));
echo "<div class='mbm'></div>";