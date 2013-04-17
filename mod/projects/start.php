<?php
/**
 * Elgg projects plugin
 *
 * @package Elggprojects
 */

elgg_register_event_handler('init', 'system', 'projects_init');




/**
 * project init
 */
function projects_init() {

	$root = dirname(__FILE__);
	elgg_register_library('elgg:projects', "$root/lib/projects.php");
	

	// actions
	$action_path = "$root/actions";
	elgg_register_action('projects/save', "$action_path/projects/save.php");
	elgg_register_action('projects/delete', "$action_path/projects/delete.php");
	elgg_register_action('projects/updates/delete', "$action_path/projects/updates/delete.php");
	elgg_register_action('projects/blogs/delete', "$action_path/projects/blogs/delete.php");
  	
  
	
	// twitter action	
	elgg_register_action('projects/twitter', "$action_path/projects/twitter.php");
	
	//reward action
	elgg_register_action('projects/reward', "$action_path/projects/reward.php");
	
	
	//updates action
	elgg_register_action('projects/updates', "$action_path/projects/updates.php");

	//blog action
	elgg_register_action('projects/blogs', "$action_path/projects/blogs.php");

	//apply action
	elgg_register_action('projects/apply', "$action_path/projects/apply.php");

	
	// lend action
	elgg_register_action('projects/lend', "$action_path/projects/lend.php");

	//featured action
	elgg_register_action('projects/featured', "$action_path/projects/featured.php", 'admin');
	//approve action
	elgg_register_action('projects/approve', "$action_path/projects/approve.php");

	//project resource action
	elgg_register_action('projects/addresource', "$action_path/projects/resource/add.php");
	elgg_register_action('projects/deleteresource', "$action_path/projects/resource/delete.php");
	
    //fix the bug of the updates comment forward,register the comment action
    elgg_register_action('comments/delete', "$action_path/comments/delete.php");
	
 	 // register action for membership
    elgg_register_action("projects/leave", "$action_path/projects/membership/leave.php");
    elgg_register_action("projects/remove", "$action_path/projects/membership/remove.php");
    elgg_register_action("projects/killrequest", "$action_path/projects/membership/delete_request.php");
    elgg_register_action("projects/addtoproject", "$action_path/projects/membership/add.php");

    // register action for fbackers
    elgg_register_action("projects/fbleave", "$action_path/projects/fbacker/leave.php");
    elgg_register_action("projects/fbremove", "$action_path/projects/fbacker/remove.php");
    elgg_register_action("projects/killfbacker", "$action_path/projects/fbacker/delete_request.php");
    elgg_register_action("projects/addfbacker", "$action_path/projects/fbacker/add.php");
    
	
	elgg_register_action("projects/basic","$action_path/projects/basic.php");
	
	//reward plan action (projects/reward)
	elgg_register_action("projects/help","$action_path/projects/help.php");
	
	//reward plan action (projects/basic)
	elgg_register_action("projects/poster","$action_path/projects/poster.php");
	
	//register refresh action (projects/refresh)
	elgg_register_action("projects/refresh","$action_path/projects/refresh.php");
	
	//register required task action
	elgg_register_action("task/add","$action_path/projects/task/add.php");
	elgg_register_action("task/delete","$action_path/projects/task/delete.php");
	elgg_register_action("task/finish","$action_path/projects/task/finish.php");
	
	
	// set as long term project action
	elgg_register_action("projects/longterm","$action_path/projects/longterm.php",'admin');
	
    // menus
	elgg_register_menu_item('site', array(
		'name' => 'projects',
		'text' => elgg_echo('Projects'),
		'href' => 'projects/all'
	));

	elgg_register_plugin_hook_handler('register', 'menu:page', 'projects_page_menu');

	elgg_register_page_handler('projects', 'projects_page_handler');

	elgg_extend_view('css/elgg', 'projects/css');
	elgg_extend_view('js/elgg', 'projects/js');

	elgg_register_widget_type('projects', elgg_echo('Projects(Owner)'), elgg_echo('projects:widget:description'));
	elgg_register_widget_type('memberofprojects', elgg_echo('Projects(Participate)'), elgg_echo('projects:widget:description'));
	

	// Register granular notification for this type
	register_notification_object('object', 'projects', elgg_echo('projects:new'));

	// Listen to notification events and supply a more useful message
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'projects_notify_message');
	// project icon

	elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'projects_icon_url_override');
	// Register an icon handler for projects
	elgg_register_page_handler('projecticon', 'projects_icon_handler');
	//elgg_register_page_handler('projectimg', 'projects_img_handler');

	// Register a URL handler for projects
	elgg_register_entity_url_handler('object', 'projects', 'project_url');

	// Register a URL handler for projects blogs
	elgg_register_entity_url_handler('object', 'blogs', 'blogs_url');
	
	// Register a URL handler for projects checkout
	elgg_register_entity_url_handler('object', 'backup', 'backup_url');

	// Register entity type for search
	elgg_register_entity_type('object', 'projects');

	//add the featured link

	elgg_register_plugin_hook_handler('register', 'menu:entity', 'projects_entity_menu_setup');


   //register catalog page handler
   elgg_register_page_handler('categories', 'project_categories_page_handler');
   
 
   //add delete link to the resource
   elgg_register_plugin_hook_handler('register', 'menu:annotation', 'resource_annotation_menu_setup');
   
    //register ajax view for admin project page
    elgg_register_ajax_view('ajax/frozen');
    elgg_register_ajax_view('ajax/recommened');

    
    // project view main page ajax view page 
    elgg_register_ajax_view('ajax/view/twitter');
    elgg_register_ajax_view('ajax/view/comment');
    elgg_register_ajax_view('ajax/view/proccess');
    elgg_register_ajax_view('ajax/view/countdown');
    elgg_register_ajax_view('ajax/view/rewards');
    elgg_register_ajax_view('ajax/view/team');
    elgg_register_ajax_view('ajax/view/related');
    elgg_register_ajax_view('ajax/view/owner');
    elgg_register_ajax_view('ajax/view/task');
    elgg_register_ajax_view('ajax/view/tool');
    elgg_register_ajax_view('ajax/view/rq_team');
    
    // project required ajax page
    elgg_register_ajax_view('ajax/required/proccess_big');
    elgg_register_ajax_view('ajax/required/require');
    
    
    elgg_register_ajax_view('ajax/require/task');
    
    
    // register project permission plugin handler
    elgg_register_plugin_hook_handler("project:permission", "all", 'check_project_view_permission','1');

    //register anular js
    elgg_register_js('angular','https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js','head');

   
  
    

}

function project_categories_page_handler() {
	include(dirname(__FILE__) . "/pages/categories/listing.php");
	return true;
}

/* check the persmison for the project's view
 * 
 * */
function check_project_view_permission($hook, $type, $returnvalue, $params){
	$guid=$params['guid'];
	$user_guid=elgg_get_logged_in_user_guid();
	$projects=get_entity($guid);
	if($projects instanceof ElggObject){
		$group_guid=$projects->container_guid;
		$group=get_entity($group_guid);
		if($group instanceof ElggGroup){
			return is_group_member($group_guid, $user_guid);
		}
		return true;
	}
	return false;
	
}


/**
 * Dispatcher for projects.
 *
 * URLs take the form of
 *  All projects:        projects/all
 *  User's projects:     projects/owner/<username>
 *  Friends' projects:   projects/friends/<username>
 *  View project:        projects/view/<guid>/<title>
 *  New project:         projects/add/<guid> (container: user, project, parent)
 *  Edit project:        projects/edit/<guid>

 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function projects_page_handler($page) {
	elgg_load_library('elgg:projects');
	
	
	// user usernames
	$user = get_user_by_username($page[0]);
	if ($user) {
		projects_url_forwarder($page);
	}

	$pages = dirname(__FILE__) . '/pages/projects';
    $updates= dirname(__FILE__) . '/pages/projects/updates';
    $blogs= dirname(__FILE__) . '/pages/projects/blogs';


	switch ($page[0]) {
		case "all":
			elgg_load_js('angular');
			include "$pages/all.php";
			break;
		case "contribute":
			include "$pages/contribute.php";
			break;
		case "owner":
			set_input('user_name', $page[1]);
			include "$pages/owner.php";
			break;
		case "administration":
			admin_gatekeeper();
			include "$pages/admin.php";
			break;
			
		case "read":
		case "view":			
			if(elgg_trigger_plugin_hook('project:permission', 'all',array('guid'=>$page[1]),false)){
					set_input('guid', $page[1]);
					include "$pages/view.php";
				
			}else{
				register_error("You don't have permission to visit this page!");
				forward('projects/all');	
			}
			break;

		case "add":
			gatekeeper();
			include "$pages/add.php";
			break;

		case "edit":
			gatekeeper();
			set_input('guid', $page[1]);
			include "$pages/edit.php";
			break;

		case "apply":
			
			set_input('guid', $page[1]);
			include "$pages/apply.php";
			break;
		case "lend":
		
			set_input('guid', $page[1]);
			include "$pages/lend.php";
			break;

		case "setting":
			gatekeeper();
			$project=get_entity($page[2]);
			if (!elgg_instanceof($project, 'object', 'projects')) {
				register_error(elgg_echo('not project'));
				forward(REFERRER);
			}
			if (!$project->canEdit()){
				register_error(elgg_echo('projects:no permission'));
				forward(REFERRER);
			}
			switch ($page[1]) {
				case "basic":
					set_input('project_guid', $page[2]);
					include "$pages/setting/basic.php";
					break;
				case "help":
					set_input('project_guid', $page[2]);
					include "$pages/setting/help.php";
					break;
				case "media":
					set_input('project_guid', $page[2]);
					include "$pages/setting/media.php";
					break;
				case "fbacker_request":
					set_input('project_guid', $page[2]);
					include "$pages/setting/fbacker_request.php";
					break;
				case "requests":
					set_input('project_guid', $page[2]);
					include "$pages/setting/requests.php";
					break;
				case "remove_backer":
					set_input('project_guid', $page[2]);
					include "$pages/setting/remove_backer.php";
					break;
				
			default:
			return false;
			}
			break;
			
		
		case "required":
			
			set_input('project_guid', $page[1]);
			include "$pages/required.php";
			break;
	   case "resource":
			set_input('project_guid', $page[1]);
			include "$pages/resource.php";
			break;
		case "backers":
			set_input('project_guid', $page[1]);
			include "$pages/backers.php";
			break;
		case "blogs":
			switch ($page[1]) {
		  		case "all":
		    	set_input('guid', $page[2]);
				include "$blogs/list.php";
				break;
				case "edit":
		    	gatekeeper();
				set_input('guid', $page[2]);
				include "$blogs/edit.php";
				break;
		 		case "view":
				set_input('blog_guid', $page[2]);
				include "$blogs/view.php";
				break;
				case "archives":
					set_input('project_guid', $page[2]);
					set_input('lower_time', $page[3]);
					set_input('upper_time', $page[4]);
					include "$blogs/archives.php";
					break;
			default:
			return false;
			}
          break;

		default:
			return false;
	}

	elgg_pop_context();
	return true;
}

/**
 * Forward to the new style of URLs
 *
 * @param string $page
 */
function projects_url_forwarder($page) {
	global $CONFIG;

	if (!isset($page[1])) {
		$page[1] = 'items';
	}

	switch ($page[1]) {


		case "friends":
			$url = "{$CONFIG->wwwroot}projects/friends/{$page[0]}";
			break;
		case "add":
			$url = "{$CONFIG->wwwroot}projects/add/{$page[0]}";
			break;
		case "items":
			$url = "{$CONFIG->wwwroot}projects/owner/{$page[0]}";
			break;

	}

	register_error(elgg_echo("changeproject"));
	forward($url);
}

/**
 * Populates the ->getUrl() method for projected objects
 *
 * @param ElggEntity $entity The projected object
 * @return string projected item URL
 */
function project_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "projects/view/" . $entity->getGUID() . "/" . $title;
}

function blogs_url($entity) {
	global $CONFIG;
	return $CONFIG->url . "projects/blogs/view/" . $entity->getGUID();
}

function backup_url($entity) {
	global $CONFIG;
	return $CONFIG->url . "projects/checkout/" . $entity->getGUID();
}

/**
 * Handle project icons.
 *
 * @param array $page
 * @return void
 */
function projects_icon_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('project_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/projects/icon.php");
	return true;
}

function projects_img_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('file_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/projects/thumbnail.php");
	return true;
}
/**
 * Override the default entity icon for projects
 *
 * @return string Relative URL
 */
function projects_icon_url_override($hook, $type, $returnvalue, $params) {
	$object = $params['entity'];
	$size = $params['size'];
	if (elgg_instanceof($object, 'object', 'projects')){
	
	if (isset($object->icontime)) {
		// return thumbnail
		$icontime = $object->icontime;
		
		return "projecticon/$object->guid/$size/$icontime.jpg";
		
	}

	return "mod/projects/graphics/default{$size}.gif";
	}
}


// add the feature link
function projects_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);

	if ($handler != 'projects') {
		if($handler != 'projects/updates'){



  return $return;
		}
		foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access','edit'))) {
			unset($return[$index]);
		}
	}
	return $return;

	}

	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access'))) {
			unset($return[$index]);
		}
	}



	// feature link
	if (elgg_is_admin_logged_in()) {
		if ($entity->featured_project == "yes") {
			$url = "action/projects/featured?project_guid={$entity->guid}&action_type=unfeature";
			$wording = elgg_echo("Featured");
		} else {
			$url = "action/projects/featured?project_guid={$entity->guid}&action_type=feature";
			$wording = elgg_echo("Unfeatured");
		}
		$options = array(
			'name' => 'feature',
			'text' => $wording,
			'href' => $url,
			'priority' => 300,
			'is_action' => true
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}


/* process bar function*/
// function backup icon link
function project_backup_icon_with_link($imglink,$imgtitle,$backup_link,$style,$url_class){
	$backup_icon=elgg_view('output/img', array(
			'src' => $imglink,
			'alt' => "$imgtitle",
			'title' => "$imgtitle",
			'style'=>"$style",
	));

	return elgg_view('output/url', array(
			'href' => $backup_link,
			'text' => $backup_icon,
			'class'=>$url_class,
			'is_trusted' => true,
			'title'=>"$imgtitle",
	));

}

/*
 *function for proccess bar and undone_item count
 * 
 */ 
 function done_item($guid,$name){
 	$tasks=elgg_get_annotations(array(
 			'type'=>'object',
 			'subtype'=>'projects',
 			'guid'=>$guid,
 			'annotation_name'=>$name,
 			'limit'=>0
 	));
 	$project=get_entity($guid);
 	$at_ids=array();
 	foreach ($tasks as $task){
 		$id=$task->id;
 		$done=$project->$id;
 
 		if($done==1){
 			$at_ids[].=$id;
 
 		}
 	}
 	if($at_ids){
 	$done_items=elgg_get_annotations(array(
 			'type'=>'object',
 			'subtype'=>'projects',
 			'annotation_name'=>$name,
 			'annotation_ids'=>$at_ids,
 			'count'=>True
 	));
 	}else{
 		$done_items=0;
 	}
 	return $done_items;
 }
function project_proccess_bar($project,$height,$width,$class1,$class){
	
	
	$guid=$project->guid;

	//team proccess ,team member+ micor help
		//team member
	$team_done=done_item($guid,'team');
	$team_total=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'team',
			'count'=>True
	));
	
		//micro help
	$task_done=done_item($guid,'task');
	$task_total=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'task',
			'count'=>True
	));
	if($team_total==0 && $task_total==0){
		$t_proccess=0;
	}else{
	// add some 5 times for the team member
		$t_proccess=number_format(((($team_done+1)*5+$task_done)/(($team_total+1)*5+$task_total))*100);
	}
	
	
	// tool proccess
	$tool_done=done_item($guid,'tool');
	$tool_total=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>'tool',
			'count'=>True
	));
	$f_proccess=number_format(($tool_done/$tool_total)*100);

	
	$site_url=elgg_get_site_url();

	$team_backup=project_backup_icon_with_link("/mod/incubator_theme/graphics/team.png", "Join this team", $site_url.'projects/apply/'.$guid, "height:$height;float:left;margin:5px 1px;");
	$facility_backup=project_backup_icon_with_link("/mod/incubator_theme/graphics/facility.png", "Lend facility to this project", $site_url.'projects/lend/'.$guid, "height:$height;float:left;margin:5px 1px;");
	
	$style="display:inline-block;width:$width;height:$height";
	$class0="grey pas brs";
	if($class1){
		$class0=$class1;
	}
	$class2="mls mts";
	if($class){
		$class2=$class;
	}

	
	return <<<HTML

	<div class="$class0" style="line-height:1">
	

	<div style="$style" class="progress-bar team orange fl">
	<span style="width: $t_proccess%"><div class="$class2">$t_proccess%</div></span>
	</div>
	$team_backup


	<div style="$style" class="progress-bar blue facility fl">
	<span style="width:$f_proccess%;" ><div class="$class2">$f_proccess%</div></span>
	</div>

	$facility_backup
	
	
	<div class="clearfloat"></div>
	</div>
HTML;
}

/**
 * Join a user to a project, add river event, clean-up invitations
 *
 * @return bool
 */

function user_join_project($project, $user) {

	// access ignore so user can be added to access collection of invisible group
	$ia = elgg_set_ignore_access(TRUE);
	$result = join_project($project->guid,$user->guid);
	elgg_set_ignore_access($ia);

	if ($result) {
		// flush user's access info so the collection is added
		get_access_list($user->guid, 0, true);

		// Remove any invite or join request flags
		//remove_entity_relationship($project->guid, 'invited', $user->guid);
		remove_entity_relationship($user->guid, 'membership_request', $project->guid);

		add_to_river('river/relationship/member/create', 'join', $user->guid, $project->guid);

		return true;
	}

	return false;
}

// membership functions
/**
 * Return whether a given user is a member of the project or not.
 *
 * @param int $project_guid The project ID
 * @param int $user_guid  The user guid
 *
 * @return bool
 */
function is_project_member($project_guid, $user_guid) {
	$user=get_entity($user_guid);
	if (!($user instanceof ElggUser)) {
		return false;
	}
	// is project owner?
	$project=get_entity($project_guid);
	$owner_guid=$project->owner_guid;
	if($user_guid==$owner_guid){
		return true;
	}
	
	$object = check_entity_relationship($user_guid, 'member', $project_guid);
	if ($object) {
		return true;
	} else {
		return false;
	}
}

function join_project($project_guid, $user_guid) {
	$result = add_entity_relationship($user_guid, 'member', $project_guid);

	if ($result) {
		$params = array('object' => get_entity($project_guid), 'user' => get_entity($user_guid));
		elgg_trigger_event('join', 'object', $params);
	}

	return $result;
}

function leave_project($project_guid, $user_guid) {
	// event needs to be triggered while user is still member of group to have access to group acl
	$params = array('object' => get_entity($project_guid), 'user' => get_entity($user_guid));

	elgg_trigger_event('leave', 'object', $params);
	$result = remove_entity_relationship($user_guid, 'member', $project_guid);
	return $result;
}


//add a delete link to the resource annotation
function resource_annotation_menu_setup($hook, $type, $return, $params) {
	$annotation = $params['annotation'];

	if ($annotation->name == 'resource' && $annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/projects/deleteresource', array(
				'annotation_id' => $annotation->id,
		));

		$options = array(
				'name' => 'delete',
				'href' => $url,
				'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
				'confirm' => elgg_echo('deleteconfirm'),
				'encode_text' => false
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}