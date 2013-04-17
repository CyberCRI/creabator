<?php
/**
* lend faclity
*
* @package IncubatorProject
*/
gatekeeper();
$guid =get_input('guid');
$project = get_entity($guid);


if (!elgg_instanceof($project, 'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERRER);
}


$annotation_id=get_input('id');
if($annotation_id){
	$annotation=elgg_get_annotation_from_id($annotation_id);
	$require=$annotation->value;
	$content =<<<HTML
	<h3 class="dashed">Required Tool:</h3>
	$require
	<h3 class="dashed">Your Tool Info:</h3>
HTML;
}


$options['container_guid']=$guid;
$content.= elgg_view_form('projects/lend',array(),$options);



$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,
));

echo elgg_view_page($title, $body);
