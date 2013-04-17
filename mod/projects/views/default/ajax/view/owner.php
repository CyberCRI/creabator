<?php 
$guid=get_input('guid');
$project=get_entity($guid);

$user=elgg_get_logged_in_user_entity();
if (is_project_member($guid, $user->guid)) {
	// leave a project
	$url = elgg_get_site_url() . "action/projects/leave?project_guid={$guid}";
	$url = elgg_add_action_tokens_to_url($url);
	$leave_url =elgg_view('output/confirmlink',array('href'=>$url,'text'=>elgg_echo('projects:leave'),'class'=>'elgg-button elgg-button-submit'));
}
$comments = elgg_view_comments($project);

$owner = $project->getOwnerEntity();
$owner_name=$owner->name;
$owner_icon = elgg_view_entity_icon($owner, 'small');

$tags = elgg_view('output/tags', array('tags' => $project->tags));


// set the imageblock which show the basic info for the object
$date = elgg_view_friendly_time($project->time_created);
$ownerdecs=elgg_view('output/longtext', array('value' => $owner->description));

$categories = elgg_view('output/categories', array('entity'=>$project));
$metadata = elgg_view_menu('entity', array(
		'entity' => $project,
		'handler' => 'projects',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
));

$params = array(
		'entity' => $project,
		'title' => false,
		'subtitle' => $date.$categories,
		'tags' => $tags,
);

$summary = elgg_view('object/elements/summary', $params);



$image_block = elgg_view_image_block($owner_icon, $summary);




$owner_moduler=<<<html
<div style="background-color:#f6f6f6;padding:10px;">
$metadata
<div style="font-size:1.5em;text-align:center;margin:5px 0;">
$owner_name
</div>
$image_block
<div class="bgwhite pam">
$ownerdecs
</div>
<div class="pas">
$leave_url
</div>

</div>
html;

echo $owner_moduler;
?>