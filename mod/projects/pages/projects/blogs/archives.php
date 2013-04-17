<?php
$now = time();
$project_guid=get_input('project_guid');
$lower=get_input('lower_time');
$upper=get_input('upper_time');
$container=get_entity($project_guid);
$url = "projects/blogs/all/$project_guid";
elgg_push_breadcrumb(elgg_echo('blogs'), $url);
elgg_push_breadcrumb(elgg_echo('Archives'));
if ($lower) {
	$lower = (int)$lower;
}

if ($upper) {
	$upper = (int)$upper;
}

$options = array(
		'type' => 'object',
		'subtype' => 'blogs',
		'full_view' => FALSE,
		'container_guid'=>$project_guid
);

if ($upper > $now) {
		$upper = $now;
	}



if ($lower) {
	$options['created_time_lower'] = $lower;
}

if ($upper) {
	$options['created_time_upper'] = $upper;
}

$list = elgg_list_entities_from_metadata($options);
if (!$list) {
	$content .= elgg_echo('blog:none');
} else {
	$content .= elgg_view('projects/project_blog',array('pb_content'=>$list,'project_guid'=>$project_guid));
}

$title = elgg_echo('date:month:' . date('m', $lower), array(date('Y', $lower)));
$body = elgg_view_layout('main_project', array(
		'ib_content' => $content,
		'ib_guid'=>$project_guid,
));

echo elgg_view_page($title, $body);