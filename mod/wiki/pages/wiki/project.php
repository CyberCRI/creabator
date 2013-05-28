<?php
/**
 * List a project wiki
 *
 * @package ElggPages
 */

// 
$guid=get_input('guid');

$title = elgg_echo('wiki:all');


$content = elgg_list_entities(array(
	'types' => 'object',
	'subtypes' => 'page_top',
	'container_guid' => $guid,
	'full_view' => false,
));
if (!$content) {
	$content = '<p>' . elgg_echo('wiki:none') . '</p>';
}



//$sidebar = elgg_view('wiki/sidebar/navigation');
//$sidebar .= elgg_view('wiki/sidebar');

if(is_project_member($guid, elgg_get_logged_in_user_guid())){
$add_button=elgg_view('output/url',array('href'=>'wiki/add/'.$guid,'text'=>elgg_echo('wiki:add'),'class'=>'elgg-button elgg-button-submit fr mbm'));
$p_title=elgg_view_title($title.$add_button);
$attention=elgg_echo('wiki:attention');
$attention=<<<html
<blockquote class='pam mam'> $attention</blockquote>
html;
}
$sidebar= elgg_view('wiki/sidebar/navigation');

$ibcontent=<<<html
$p_title
$attention
$content
html;

$body = elgg_view_layout('main_project', array(
	'ib_content' =>$ibcontent,
    'ib_guid'=>$guid,
));

echo elgg_view_page($title, $body);

