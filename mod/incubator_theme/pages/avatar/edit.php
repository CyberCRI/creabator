<?php
/**
 * Upload and crop an avatar page
 */

// Only logged in users
gatekeeper();

elgg_set_context('profile_edit');

$title = elgg_echo('avatar:edit');

$user=elgg_get_logged_in_user_entity();

// set breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), 'settings/user/'.$user->username);
elgg_push_breadcrumb($title);

$entity = elgg_get_page_owner_entity();
$content = elgg_view('core/avatar/upload', array('entity' => $entity));

// only offer the crop view if an avatar has been uploaded
if (isset($entity->icontime)) {
	$content .= elgg_view('core/avatar/crop', array('entity' => $entity));
}
// add setting menu tab
$menu=elgg_view('incubator_theme/setting_menu');

$params = array(
	'content' => $menu.$content,
	'title' => $title,
);
$body = elgg_view_layout('home_two_column', $params);

echo elgg_view_page($title, $body);
