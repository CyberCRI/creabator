<?php
/**
 * project blogs view
 *
 * @package Elggprojects
 */

$guid =get_input('blog_guid');
$blogs=get_entity($guid);
$project_guid=$blogs->container_guid;
$project = get_entity($project_guid);


$blog = elgg_view_entity($blogs, array('full_view' => true));
$comments = elgg_view_comments($blogs);
// breadcrumb 
elgg_push_breadcrumb(elgg_echo('blogs'), 'projects/blogs/all/'.$project_guid);
$title = $blogs->title;
elgg_push_breadcrumb($title);
//$content="<div class=\"pam\">";
//$content .=elgg_view('projects/project_blog',array('pb_content'=>$blog.$comments,'project_guid'=>$project_guid));
//$content .="</div>";
$content=<<<html
<div class="elgg-col-3of4 fl">
   $blog
</div>
<div class="elgg-col-1of4 fl">
	<div class="plm">
	$comments
	</div>
</div>
html;

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,

));

echo elgg_view_page(null, $body);