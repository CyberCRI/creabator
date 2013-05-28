<?php
/**
 * History of revisions of a page
 *
 * @package Elggwiki
 */

$page_guid = get_input('guid');

$page = get_entity($page_guid);
if (!$page) {

}

$container = $page->getContainerEntity();
$container_guid=$container->getGUID();

if (!is_project_member($container_guid, elgg_get_logged_in_user_guid())) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

elgg_set_page_owner_guid($container->getGUID());


if (elgg_instanceof($container, 'object','projects')) {
	elgg_push_breadcrumb(elgg_echo('all'), "wiki/project/$container->guid");
} else {
	register_error("Invilid container");
	forward('/');
}
wiki_prepare_parent_breadcrumbs($page);
elgg_push_breadcrumb($page->title, $page->getURL());
elgg_push_breadcrumb(elgg_echo('wiki:history'));

$title = $page->title . ": " . elgg_echo('wiki:history');

$content = elgg_list_annotations(array(
		'guid' => $page_guid,
		'annotation_name' => 'page',
		'limit' => 20,
		'order_by' => "n_table.time_created desc"
));


$sidebar=elgg_view('wiki/sidebar/navigation', array('page' => $page));

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
		'ib_guid'=>$container->getGUID(),
));

echo elgg_view_page($title, $body);
