<?php
/**
 * Elgg collections of friends
 *
 * @package Elgg.Core
 * @subpackage Social.Collections
 */

$title = elgg_echo('friends:collections');

$add=elgg_view('output/url',array(
		'href'=>"collections/add",
		'text'=>elgg_echo('Add A Group'),
		'class'=>'elgg-button elgg-button-submit pam',
		));
$content = "<div class='fr'>$add</div>";
$content.= elgg_view_access_collections(elgg_get_logged_in_user_guid());
// add setting menu tab
$menu=elgg_view('incubator_theme/setting_menu');
$user=elgg_get_page_owner_entity();
// set breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), 'settings/user/'.$user->username);
elgg_push_breadcrumb($title);

$body = elgg_view_layout('home_two_column', array(
	
	'content' => $menu.$content,
	'title' => $title,
	
));

echo elgg_view_page($title, $body);
