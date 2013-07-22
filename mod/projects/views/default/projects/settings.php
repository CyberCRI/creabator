<?php
// menu tab
$guid=$vars['project_guid'] ;
$content=$vars['content'] ;
$stabs=array(
		/*
		'membership' => array(
				'text' =>elgg_echo('Team Managemant'),
				'href' => 'projects/setting/requests/'.$guid,
				'priority' => 300,

		),
		*/
		'media' => array(
				'text' =>elgg_echo('Promotion media'),
				'href' => 'projects/setting/media/'.$guid,
				'priority' => 300,
		
		),
		'Reward' => array(
				'text' =>elgg_echo('Team Setting'),
				'href' => 'projects/setting/help/'.$guid,
				'priority' => 50,
		
		),
		'issue' => array(
				'text' =>elgg_echo('Open Issues'),
				'href' => 'projects/setting/issues/'.$guid,
				'priority' => 100,
		
		),
		
		'edit' => array(
				'text' =>elgg_echo('Edit Project'),
				'href' => 'projects/edit/'.$guid,
				'priority' => 200,
		
		),
		'Basic' => array(
				'text' =>elgg_echo('Widget Setting'),
				'href' => 'projects/setting/basic/'.$guid,
				'priority' => 500,

		),

);
if(elgg_is_active_plugin('ib_bank')){
	 $stabs['Mbackers']=array(
			'text' =>elgg_echo('Funding Backers'),
			'href' => 'projects/setting/money_backers/'.$guid,
			'priority'=>600,
	
	 );
}
if(elgg_is_active_plugin('ib_facility')){
	 $stabs['Fbrequest']=array(
				'text' => elgg_echo('Facility Setting'),
				'href' => 'projects/setting/facility/'.$guid,
				'priority' => 80,
		);
}


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