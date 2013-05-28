<?php
/**
 * Edit a page
 *
 * @package ElggPages
 */

gatekeeper();

$page_guid = (int)get_input('guid');
$page = get_entity($page_guid);
if (!$page) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

$container = $page->getContainerEntity();
$container_guid=$container->getGUID();

if (!is_project_member($container_guid, elgg_get_logged_in_user_guid())) {
	register_error(elgg_echo('wiki:nopermission'));
	forward('');
}

elgg_set_page_owner_guid($container_guid);

elgg_push_breadcrumb($page->title, $page->getURL());
elgg_push_breadcrumb(elgg_echo('edit'));

$title = elgg_echo("pages:edit");

if ($page->canEdit()) {
	$vars = wiki_prepare_form_vars($page);
	$content = elgg_view_form('wiki/edit', array(), $vars);
} else {
	$content = elgg_echo("pages:noaccess");
}

$body = elgg_view_layout('main_project', array(
	'ib_content' =>$content,
    'ib_guid'=>$container_guid,
));

echo elgg_view_page($title, $body);