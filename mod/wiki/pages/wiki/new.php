<?php
/**
 * Create a new page
 *
 * @package Elggwiki
 */

gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);



$parent_guid = 0;
$page_owner = $container;
if (elgg_instanceof($container, 'object','page')||elgg_instanceof($container, 'object','page_top')) {
	$parent_guid = $container->getGUID();
	$page_owner = $container->getContainerEntity();
}

elgg_set_page_owner_guid($page_owner->getGUID());


if (!is_project_member($page_owner->getGUID(), elgg_get_logged_in_user_guid())) {
	register_error(elgg_echo('wiki:nopermission'));
	forward('');
}
if (elgg_instanceof($page_owner, 'object','projects')) {
	elgg_push_breadcrumb(elgg_echo('all'), "wiki/project/$page_owner->guid");
} else {
	register_error("Invilid container");
	forward('/');
}

$title = elgg_echo('wiki:add');
elgg_push_breadcrumb($title);

$vars = wiki_prepare_form_vars(null, $parent_guid);
$content = elgg_view_form('wiki/edit', array(), $vars);


$body = elgg_view_layout('main_project', array(
	'ib_content' =>$content,
    'ib_guid'=>$page_owner->getGUID(),
));

echo elgg_view_page($title, $body);