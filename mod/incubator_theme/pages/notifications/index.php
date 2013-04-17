<?php
/**
 * Elgg notifications plugin index
 *
 * @package ElggNotifications
 */


// Ensure only logged-in users can see this page
gatekeeper();

elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
$user = elgg_get_page_owner_entity();

// Set the context to settings
elgg_set_context('settings');

$title = elgg_echo('notifications:subscriptions:changesettings');

elgg_push_breadcrumb(elgg_echo('settings'), "settings/user/$user->username");
elgg_push_breadcrumb($title);

// Get the form
$people = array();
if ($people_ents = elgg_get_entities_from_relationship(array(
		'relationship' => 'notify',
		'relationship_guid' => elgg_get_logged_in_user_guid(),
		'types' => 'user',
		'limit' => 99999,
	))) {
	
	foreach($people_ents as $ent) {
		$people[] = $ent->guid;
	}
}

$body = elgg_view('notifications/subscriptions/form', array('people' => $people));
// add setting menu tab
$menu=elgg_view('incubator_theme/setting_menu');

$params = array(
	'content' => $menu.$body,
	'title' => $title,
);
$body = elgg_view_layout('home_two_column', $params);

echo elgg_view_page($title, $body);
