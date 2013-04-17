<?php
// menu tab
$guid=$vars['project_guid'] ;
$content=$vars['content'] ;
$stabs=array(
		'Mbackers' => array(
				'text' => elgg_echo('Funding Backers'),
				'href' => 'projects/setting/money_backers/'.$guid,
				'priority' => 600,
		),
		
		'Ftbackers' => array(
				'text' => elgg_echo('Remove Backers'),
				'href' => 'projects/setting/remove_backer/'.$guid,
				'priority' => 500,
		),

		'Fbrequest' => array(
				'text' => elgg_echo('Tool Requests'),
				'href' => 'projects/setting/fbacker_request/'.$guid,
				'priority' => 400,
		),

		'membership' => array(
				'text' =>elgg_echo('Participant Requests'),
				'href' => 'projects/setting/requests/'.$guid,
				'priority' => 300,

		),
		'media' => array(
				'text' =>elgg_echo('Promotion media'),
				'href' => 'projects/setting/media/'.$guid,
				'priority' => 200,
		
		),
		'Reward' => array(
				'text' =>elgg_echo('Help Setting'),
				'href' => 'projects/setting/help/'.$guid,
				'priority' => 50,
		
		),
		
		'Basic' => array(
				'text' =>elgg_echo('Basic Setting'),
				'href' => 'projects/setting/basic/'.$guid,
				'priority' => 100,

		),

);


foreach ($stabs as $name => $stab) {
	$stab['name'] = $name;

	elgg_register_menu_item('stabs', $stab);
}

$menu=elgg_view_menu('stabs',array('sort_by' => 'priority','class'=>'project-setting-tab'));
// nav 
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

$body=<<<html
<div class="w200 fr mtl mrl">
$menu
</div>
<div style="width:70%" class="fl mll pas">
$nav
$content
</div>

html;

echo $body;