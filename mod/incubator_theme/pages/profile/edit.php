<?php
/**
 * Edit profile page
 */

gatekeeper();

$user = elgg_get_page_owner_entity();
if (!$user) {
	register_error(elgg_echo("profile:notfound"));
	forward();
}

// check if logged in user can edit this profile
if (!$user->canEdit()) {
	register_error(elgg_echo("profile:noaccess"));
	forward();
}

elgg_set_context('profile_edit');

$title = elgg_echo('profile:edit');
// set breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), 'settings/user/'.$user->username);
elgg_push_breadcrumb($title);

// add setting menu tab
$menu=elgg_view('incubator_theme/setting_menu');

$content = elgg_view_form('profile/edit', array(), array('entity' => $user));


$params = array(
	'content' => $menu.$content,
	'title' => $title,
);
$body = elgg_view_layout('home_two_column', $params);

echo elgg_view_page($title, $body);
