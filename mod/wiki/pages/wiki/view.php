<?php
/**
 * View a single page
 *
 * @package Elggwiki
 */

$page_guid = get_input('guid');
$page = get_entity($page_guid);
if (!$page) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

elgg_set_page_owner_guid($page->getContainerGUID());

$container = elgg_get_page_owner_entity();
$container_guid=$container->getGUID();




$title = $page->title;

if (elgg_instanceof($container, 'object','projects')) {
	elgg_push_breadcrumb(elgg_echo('all'), "wiki/project/$container->guid");
} else {
	register_error("Invilid container");
	forward('/');
}
wiki_prepare_parent_breadcrumbs($page);
elgg_push_breadcrumb($title);

$content = elgg_view_entity($page, array('full_view' => true));
$content .= elgg_view_comments($page);

// can add subpage if can edit this page and write to container (such as a group)
if ($page->canEdit() && $container->canWriteToContainer(0, 'object', 'page')) {
	$url = "wiki/add/$page->guid";
	elgg_register_menu_item('title', array(
			'name' => 'subpage',
			'href' => $url,
			'text' => elgg_echo('wiki:newchild'),
			'link_class' => 'elgg-button elgg-button-action',
	));
}
$sidebar= elgg_view('wiki/sidebar/navigation');
$add_sub=elgg_view('output/url',array('href'=>'wiki/add/'.$page_guid,'text'=>elgg_echo('wiki:newchild'),'class'=>'elgg-button elgg-button-submit mbm'));

$ibcontent=<<<html
<div class=" elgg-col-3of4 fl">
<div class="pam">

$content
</div>
</div>
<div class=" elgg-col-1of4 fl">
$add_sub
$sidebar
</div>
html;


$body = elgg_view_layout('main_project', array(
	'ib_content' =>$ibcontent,
    'ib_guid'=>$container->guid,
));

echo elgg_view_page($title, $body);
