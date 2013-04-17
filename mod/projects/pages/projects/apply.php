<?php
/**
* send message for application
*
* @package ElggMessages &IncubatorProject
*/
gatekeeper();
$guid =get_input('guid');
$project = get_entity($guid);
$user=elgg_get_logged_in_user_entity();

if (!elgg_instanceof($project, 'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERRER);
}
if($user->guid==$project->owner_guid){
	register_error(elgg_echo('cannt join your own project'));
	forward(REFERRER);
}
if(is_project_member($guid, $user->guid)){
	register_error(elgg_echo('already joined this project'));
	forward(REFERRER);
}



$content = <<<HTML
<h3 >Contact Form:</h3>
<blockquote class="dashed">Tips:You could mention your expertise in the message so that owner could know more about you.</blockquote>
HTML;
$options['project_guid']=$guid;
//specify subject for
$annotation_id=get_input('id');
if($annotation_id){
$options['annotation_id']=$annotation_id;
}

$content.= elgg_view_form('projects/apply',array(),$options);

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,
));

echo elgg_view_page($title, $body);


