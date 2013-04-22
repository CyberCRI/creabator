<?php
// menu tab
$guid=$vars['project_guid'] ;
$content=$vars['content'] ;
$stabs=array(
		
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
		'edit' => array(
				'text' =>elgg_echo('Edit Project'),
				'href' => 'projects/edit/'.$guid,
				'priority' => 100,
		
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
//$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

// delete project button
$delp=elgg_view('output/confirmlink',array('href'=>'action/projects/delete?guid='.$guid,'is_action'=>true,'text'=>'Delete Project','class'=>'elgg-button-submit elgg-button mtl'));

$body=<<<html
<div class="w200 fr mtl mrl">
$menu
$delp
</div>
<div style="width:70%" class="fl mll pas">

$content
</div>

html;

echo $body;