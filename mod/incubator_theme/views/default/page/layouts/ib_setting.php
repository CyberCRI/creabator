<?php
/**
 * Main project list view area layout
 *
 * @uses $vars['content']        HTML of main content area
 * @uses $vars['sidebar']        HTML of the sidebar
 * @uses $vars['filter']         HTML of the content area filter (override)

 */
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));
// give plugins an opportunity to add to content sidebars
$content=null;
$sidebar=null;


if (isset($vars['content'])) {
	$content=$vars['content'];
			}

if (isset($vars['sidebar'])) {
		$sidebar=$vars['sidebar'];
	
	}
$user=elgg_get_logged_in_user_entity();
$sidebar_tabs=array(
		'deposit' => array(
				'text' => elgg_echo('Deposit'),
				'href' => 'bank/deposit/'.$user->username,
				'priority' => 700,
		),
		'balence' => array(
				'text' => elgg_echo('balence:title'),
				'href' => 'bank/balence/'.$user->username,
				'priority' => 600,
		),
			'notification' => array(
					'text' => elgg_echo('notifications:subscriptions:changesettings'),
					'href' => 'notifications/personal',
					'priority' => 500,
			),
			'avatar' => array(
					'text' => elgg_echo('avatar:edit'),
					'href' => 'avatar/edit/'.$user->username,
	
					'priority' => 400,
			),
			'profile' => array(
					'text' => elgg_echo('profile:edit'),
					'href' =>'profile/'.$user->username.'/edit',
					'priority' => 300,
			),
			'setting' => array(
				'text' => elgg_echo('menu:account'),
				'href' =>'settings/user/'.$user->username,
				'priority' => 200,
		),
	);
	foreach ($sidebar_tabs as $name => $sidebar_tab) {
		$sidebar_tab['name'] = $name;
	
		elgg_register_menu_item('sidebar_tabs', $sidebar_tab);
	}
	$menu=elgg_view_menu('sidebar_tabs',array('sort_by' => 'priority', 'class' => 'elgg-menu-hz sidebar-menu center'));
	
echo <<<HTML
<div class="container">
<div class="content pal brs mbl">
$nav
<div class=" elgg-col-4of5 fl">
		$content
</div>
<div class=" elgg-col-1of5 fl">
	<div class="pam">
		$menu
		</div>
</div>
</div>
</div>
HTML;





?>
