<?php
/*
 * project blogs list page
 *
 * Created on 2012-1-31
 *
 * @WiserIncubator
 * Weipeng Kuang
 */


$project_guid = get_input('guid');
$project = get_entity($project_guid);

if (!elgg_instanceof($project, 'object', 'projects')) {
	register_error(elgg_echo('projects:unknown_project'));
	forward(REFERRER);
}
if (elgg_get_logged_in_user_guid() == $project ->owner_guid){
	$blogs=elgg_view_title("Add a Post:");
	$blogs .= elgg_view_form('projects/blogs',array(),array('project_guid' => $project_guid));
	/* // ajax pic upload 
	$siteurl=elgg_get_site_url();
	$security=elgg_view('input/securitytoken');
	$blogs .=<<<html
	<form id='blog_img' action="{$siteurl}action/projectimgs/upload" method="POST"  enctype='multipart/form-data'>
		<fieldset>
		$security
		<input type="hidden" name="container_guid" value="{$project_guid}"/>
		<input type="file" name="upload"/>
		<button type="submit" class="btn">Upload</button>
		</fieldset>
	</form>
html;
	 */

}else{
	$blogs='';
}

$lists = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'blogs',
	'container_guid'=>$project_guid,
	'limit' => 5,
	'full_view' => false,
	'list_class'=>'project-blog-list',
	'item_class'=>'project-blog-item',
	'view_toggle_type' => false,
		
	));

$content=$blogs;
$content .=elgg_view('projects/project_blog',array('pb_content'=>$lists,'project_guid'=>$project_guid));


if (!$content) {
				$content = elgg_echo('projects:blogs:none');
			}
$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
?>

