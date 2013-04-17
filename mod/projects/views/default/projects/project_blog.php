<?php
if($vars['pb_content']){
	$content=$vars['pb_content'];
}
if($vars['project_guid']){
	$project_guid=$vars['project_guid'];
}

// nav for blogs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

//sidebar
$dates = get_entity_dates('object', 'blogs', $project_guid);
$url_segment = 'projects/blogs/archives/' . $project_guid;
if ($dates) {
	$title = elgg_echo('Archives');
	$blog_content = '<ul class="project-blogs-archives">';
	foreach ($dates as $date) {
		$timestamplow = mktime(0, 0, 0, substr($date,4,2) , 1, substr($date, 0, 4));
		$timestamphigh = mktime(0, 0, 0, ((int) substr($date, 4, 2)) + 1, 1, substr($date, 0, 4));

		$link = elgg_get_site_url() . $url_segment . '/' . $timestamplow . '/' . $timestamphigh;
		$month = elgg_echo('date:month:' . substr($date, 4, 2), array(substr($date, 0, 4)));
		$blog_content .= "<li><a href=\"$link\" title=\"$month\">$month</a></li>";
	}
	$blog_content .= '</ul>';

	$blog_archive=elgg_view_module('info', $title, $blog_content);
}
// Latest Blog comments

$blogs=elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'blogs',
		'container_guid'=>$project_guid
));
foreach ($blogs as $blog){
	$guids[].=$blog->getGUID();
}
if($guids){
$options = array(
		'guids' => $guids,
		'annotation_name' => 'generic_comment',
		'limit'=>10,
);
$Latest_comments=elgg_list_annotations($options);

$comment_title=elgg_echo('Latest comments');
$comments_module=elgg_view_module('info',$comment_title, $Latest_comments);
}
$body=<<<html
$nav
<div class="elgg-col-3of4 fl">
$content
</div>
<div class="elgg-col-1of4 fr">
	<div class="pam">
	$blog_archive
	$comments_module
	</div>
</div>

html;
echo $body;