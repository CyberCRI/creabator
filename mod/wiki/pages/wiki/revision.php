<?php
/**
 * View a revision of page
 *
 * @package ElggPages
 */

$id = get_input('id');
$annotation = elgg_get_annotation_from_id($id);
if (!$annotation) {
	forward();
}

$page = get_entity($annotation->entity_guid);
if (!$page) {
	
}

elgg_set_page_owner_guid($page->getContainerGUID());


$container = elgg_get_page_owner_entity();
$container_guid=$container->getGUID();

if (!is_project_member($container_guid, elgg_get_logged_in_user_guid())) {
	register_error(elgg_echo('wiki:nopermission'));
	forward('');
}


$title = $page->title . ": " . elgg_echo('wiki:revision');

if (elgg_instanceof($container, 'object','projects')) {
	elgg_push_breadcrumb(elgg_echo('all'), "wiki/project/$container->guid");
} else {
	register_error("Invilid container");
	forward('/');
}
wiki_prepare_parent_breadcrumbs($page);
elgg_push_breadcrumb($page->title, $page->getURL());
elgg_push_breadcrumb(elgg_echo('pages:revision'));

$content = elgg_view('object/page_top', array(
	'entity' => $page,
	'revision' => $annotation,
	'full_view' => true,
));

$sidebar = elgg_view('pages/sidebar/history', array('page' => $page));


$ibcontent=<<<html
<div class=" elgg-col-3of4 fl">
<div class="pam">

$content
</div>
</div>
<div class=" elgg-col-1of4 fl">
$sidebar
</div>
html;


$body = elgg_view_layout('main_project', array(
	'ib_content' =>$ibcontent,
    'ib_guid'=>$container->guid,
));

echo elgg_view_page($title, $body);