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


// admin featue button
if(elgg_is_admin_logged_in()){
	if ($entity->featured_project == "yes") {
		$url = "action/projects/featured?project_guid={$project->guid}&action_type=unfeature";
		$wording = elgg_echo("Make Uneatured");
	} else {
		$url = "action/projects/featured?project_guid={$project->guid}&action_type=feature";
		$wording = elgg_echo("Make Featured");
	}
	$feature=elgg_view('output/url',array('href'=>$url,'text'=>$wording,'class'=>'elgg-button elgg-button-submit','is_action'=>true));
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
		'title' => $owner_name,
		'subtitle' => $date,
		'tags' => false,
);

$summary = elgg_view('object/elements/summary', $params);



$image_block = elgg_view_image_block($owner_icon, $summary);

$brieftitle=elgg_echo('project:brief');
$briefdes = $project->briefdes;


$owner_moduler=<<<html
<div style="background-color:#f6f6f6;padding:10px;">
	<h4>$brieftitle</h4>
	<div class="f16 pas bgwhite">$briefdes </div>
<h6>$categories</h6>
<h6>$tags</h6>
<div class="dashed"></div>
$image_block
<div class="pas">
$leave_url
$feature
</div>

</div>
html;

echo $owner_moduler;
?>