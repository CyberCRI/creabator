<?php
/*
 * list page for backers
 */
$guid =get_input('project_guid');
$project = get_entity($guid);



$add_resouce_form=elgg_view_form('projects/addresource','',array('project_guid'=>$guid));

$resource_list=elgg_list_annotations(array(
	'guid' => $guid,
	'annotation_name' => 'resource',
	'limit' => 20,
	'full_view'=>true
		));

if(!$resource_list){
	$resource_list='';
}

$content=<<<html
<div  class="pam">
$add_resouce_form
$resource_list
</div>
html;


$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,

));

echo elgg_view_page(null, $body);
