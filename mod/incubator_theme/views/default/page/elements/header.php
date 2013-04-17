<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

echo elgg_view('page/elements/header_logo', $vars);
if(!elgg_is_logged_in()){
	echo elgg_view('output/url',array('href'=>'/','text'=>elgg_view_icon('user').elgg_echo('login'),'class'=>'fr mtm mrs','style'=>'color:#999'));
}else{
	$site_url = elgg_get_site_url();
	$user=elgg_get_logged_in_user_entity();
	
	$home_img=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/incubator_theme/graphics/home.png','title'=> elgg_echo('menu:index')));
	$explore_img=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/incubator_theme/graphics/explore.png','title'=> elgg_echo('menu:all')));
	$create_img=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/incubator_theme/graphics/create.png','title'=> elgg_echo('menu:create')));
	$contribute_img=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/incubator_theme/graphics/contribute.png','title'=> elgg_echo('menu:contribute')));
	
		//header left menu
		$htabs=array(
				'home' => array(
						'text' => $home_img,
						'href' => 'activity',
						'priority' => 200,
				),
		
			
			
				
		
		);
		
		if(elgg_is_active_plugin('projects')){
		$htabs['all']= array(
						'text' => $explore_img,
						'href' => 'projects/all',
						'title'=>'You could explore the interesting project here.',
						'class'=>'smallipop smallipop-tour',
						'data-smallipop-tour-index'=>'1',
						'priority' => 300,
				);
		$htabs['create'] = array(
				'text' => $create_img,
				'href' => 'projects/add/'.elgg_get_logged_in_user_guid(),
				'title'=>'Click here to start to collect resources for your innovative idea.',
				'class'=>'smallipop smallipop-tour',
				'data-smallipop-tour-index'=>'2',
				'priority' => 400,
		
		);
		$htabs['contribute'] = array(
						'text' => $contribute_img,
						'href' => 'projects/contribute',
						'title'=>'Check here to see what you could contribute.',
						'class'=>'smallipop smallipop-tour',
						'data-smallipop-tour-index'=>'3',
						'priority' => 600,
		
				);
		
	
		}
	

	
	
	// right menu
	
	// profile tab
	
	$user_icon = elgg_view('output/img', array(
			'src' => $user->getIconURL('tiny'),
			'width' =>25,
			'height' =>25,
	));
	
	$htabs['profile']=array(
					'text' =>$user_icon,
					'href' => '/profile/'.$user->username,
					'item_class'=>'fr mtm w20 prm',
					'priority'=>1900,
			);
				
	
	// mail  tab
	
	$m_img=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/incubator_theme/graphics/mail.png','title'=> elgg_echo('menu:message')));
	$num_messages = (int)messages_count_unread();
	if ($num_messages != 0) {
		$m_img .= "<div id=\"header-messages-new\">$num_messages</div>";
	}
	
	
	
	$htabs['mail']=array(
			'text' =>$m_img,
			'href' =>'messages/inbox/'.$user->username,
			'item_class'=>'fr w50',
			'priority'=>2000,
	);
	
	
	$htabs['logout']=array(
			'text' =>elgg_echo('menu:logout'),
			'href' => '/action/logout',
			'is_action' => TRUE,
			'item_class'=>'fr mtm ',
			'style'=>'color:#333',
			'priority'=>1800,
	
	);
	
	foreach ($htabs as $name => $htab) {
		$htab['name'] = $name;
	
		elgg_register_menu_item('htabs', $htab);
	}
	$menu=elgg_view_menu('htabs',array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
	
	echo $menu;
	
	
}
?>
