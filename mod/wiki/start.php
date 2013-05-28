<?php
/**
 * Elgg wiki
 *
 * @package Elggwiki
 */

elgg_register_event_handler('init', 'system', 'wiki_init');

/**
 * Initialize the wiki plugin.
 *
 */
function wiki_init() {

	// register a library of helper functions
	elgg_register_library('elgg:wiki', elgg_get_plugins_path() . 'wiki/lib/wiki.php');


	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('wiki', 'wiki_page_handler');

	// Register a url handler
	elgg_register_entity_url_handler('object', 'page_top', 'wiki_url');
	elgg_register_entity_url_handler('object', 'page', 'wiki_url');
	elgg_register_annotation_url_handler('page', 'wiki_revision_url');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'wiki/actions/wiki';
	elgg_register_action("wiki/edit", "$action_base/edit.php");
	elgg_register_action("wiki/delete", "$action_base/delete.php");

	// Extend the main css view
	elgg_extend_view('css/elgg', 'wiki/css');

	// Register javascript needed for sidebar menu
	$js_url = 'mod/wiki/vendors/jquery-treeview/jquery.treeview.min.js';
	elgg_register_js('jquery-treeview', $js_url);
	$css_url = 'mod/wiki/vendors/jquery-treeview/jquery.treeview.css';
	elgg_register_css('jquery-treeview', $css_url);

	// Register entity type for search
	elgg_register_entity_type('object', 'page');
	elgg_register_entity_type('object', 'page_top');

	// Register granular notification for this type
	register_notification_object('object', 'page', elgg_echo('wiki:new'));
	register_notification_object('object', 'page_top', elgg_echo('wiki:new'));
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'page_notify_message');

	
	//add a widget
	elgg_register_widget_type('wiki', elgg_echo('wiki'), elgg_echo('wiki:widget:description'));

	// Language short codes must be of the form "wiki:key"
	// where key is the array key below
	elgg_set_config('wiki', array(
		'title' => 'text',
		'description' => 'longtext',
		'access_id' => 'access',
		'write_access_id' => 'write_access',
	));

	//elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'wiki_owner_block_menu');

	// write permission plugin hooks
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'wiki_write_permission_check');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'wiki_container_permission_check');

	// icon url override
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'wiki_icon_url_override');

	// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'wiki_entity_menu_setup');

	// register ecml views to parse
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'wiki_ecml_views_hook');
	

}

/**
 * Dispatcher for wiki.
 * URLs take the form of
 *  All wiki:        wiki/all
 *  User's wiki:     wiki/owner/<username>
 *  Friends' wiki:   wiki/friends/<username>
 *  View page:        wiki/view/<guid>/<title>
 *  New page:         wiki/add/<guid> (container: user, group, parent)
 *  Edit page:        wiki/edit/<guid>
 *  History of page:  wiki/history/<guid>
 *  Revision of page: wiki/revision/<id>
 *  Group wiki:      wiki/group/<guid>/all
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function wiki_page_handler($page) {

	elgg_load_library('elgg:wiki');
	
	
	$base_dir = elgg_get_plugins_path() . 'wiki/pages/wiki';

	$page_type = $page[0];
	switch ($page_type) {
		case 'view':
			
			set_input('guid', $page[1]);
			include "$base_dir/view.php";
			break;
		case 'add':
			
			set_input('guid', $page[1]);
			include "$base_dir/new.php";
			
			break;
		case 'edit':
			set_input('guid', $page[1]);
			include "$base_dir/edit.php";
			break;
		case 'project':
		
			set_input('guid', $page[1]);
			include "$base_dir/project.php";
			
			break;
		case 'history':
			set_input('guid', $page[1]);
			include "$base_dir/history.php";
			break;
		case 'revision':
			set_input('id', $page[1]);
			include "$base_dir/revision.php";
			break;
	
		default:
			return false;
	}
	return true;
}

/**
 * Override the page url
 * 
 * @param ElggObject $entity Page object
 * @return string
 */
function wiki_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return "wiki/view/$entity->guid/$title";
}

/**
 * Override the page annotation url
 *
 * @param ElggAnnotation $annotation
 * @return string
 */
function wiki_revision_url($annotation) {
	return "wiki/revision/$annotation->id";
}

/**
 * Override the default entity icon for wiki
 *
 * @return string Relative URL
 */
function wiki_icon_url_override($hook, $type, $returnvalue, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'page_top') ||
		elgg_instanceof($entity, 'object', 'page')) {
		switch ($params['size']) {
			case 'topbar':
			case 'tiny':
			case 'small':
				return 'mod/wiki/images/wiki.gif';
				break;
			default:
				return 'mod/wiki/images/wiki_lrg.gif';
				break;
		}
	}
}

/**
 * Add links/info to entity menu particular to wiki plugin
 */
function wiki_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'wiki') {
		return $return;
	}

	// remove delete if not owner or admin
	if (!elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != $entity->getOwnerGuid()) {
		foreach ($return as $index => $item) {
			if ($item->getName() == 'delete') {
				unset($return[$index]);
			}
		}
	}

	$options = array(
		'name' => 'history',
		'text' => elgg_echo('wiki:history'),
		'href' => "wiki/history/$entity->guid",
		'priority' => 150,
	);
	$return[] = ElggMenuItem::factory($options);

	return $return;
}

/**
* Returns a more meaningful message
*
* @param unknown_type $hook
* @param unknown_type $entity_type
* @param unknown_type $returnvalue
* @param unknown_type $params
*/
function page_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];

	if (elgg_instanceof($entity, 'object', 'page') || elgg_instanceof($entity, 'object', 'page_top')) {
		$descr = $entity->description;
		$title = $entity->title;
		$owner = $entity->getOwnerEntity();
		
		return elgg_echo('wiki:notification', array(
			$owner->name,
			$title,
			$descr,
			$entity->getURL()
		));
	}
	return null;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function wiki_write_permission_check($hook, $entity_type, $returnvalue, $params)
{
	if ($params['entity']->getSubtype() == 'page'
		|| $params['entity']->getSubtype() == 'page_top') {

		$write_permission = $params['entity']->write_access_id;
		$user = $params['user'];

		if (($write_permission) && ($user)) {
			// $list = get_write_access_array($user->guid);
			$list = get_access_array($user->guid); // get_access_list($user->guid);

			if (($write_permission!=0) && (in_array($write_permission,$list))) {
				return true;
			}
		}
	}
}

/**
 * Extend container permissions checking to extend can_write_to_container for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function wiki_container_permission_check($hook, $entity_type, $returnvalue, $params) {

	if (elgg_get_context() == "wiki") {
		if (elgg_get_page_owner_guid()) {
			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
		}
		if ($page_guid = get_input('page_guid',0)) {
			$entity = get_entity($page_guid);
		} else if ($parent_guid = get_input('parent_guid',0)) {
			$entity = get_entity($parent_guid);
		}
		if ($entity instanceof ElggObject) {
			if (
					can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid)
					|| in_array($entity->write_access_id,get_access_list())
				) {
					return true;
			}
		}
	}

}

/**
 * Return views to parse for wiki.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $return_value
 * @param unknown_type $params
 */
function wiki_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['object/page'] = elgg_echo('item:object:page');
	$return_value['object/page_top'] = elgg_echo('item:object:page_top');

	return $return_value;
}
