<?php
/**
 * Elgg add a collection of friends
 *
 * @package Elgg.Core
 * @subpackage Social.Collections
 */

// You need to be logged in for this one
gatekeeper();

$title = elgg_echo('friends:collections:add');

$content = elgg_view_form('friends/collections/add', array(), array(
	'friends' => get_user_friends(elgg_get_logged_in_user_guid(), "", 9999),
));

$user=elgg_get_page_owner_entity();
// set breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), 'settings/user/'.$user->username);
elgg_push_breadcrumb(elgg_echo('friends:collections'), 'collections/'.$user->username);
elgg_push_breadcrumb($title);

// add setting menu tab
$menu=elgg_view('incubator_theme/setting_menu');

$body = elgg_view_layout('home_two_column', array('content' => $menu.$content,'title'=>$title));

echo elgg_view_page(elgg_echo('friends:collections:add'), $body);
