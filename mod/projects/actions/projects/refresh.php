<?php 
admin_gatekeeper();

$guid=get_input('project_guid');
$project=get_entity($guid);

//@todo validate if $project is a project
// status: refresh:2,frozen:1
$project->status=2;
// add refresh time
$project->refresh_time=time();

system_message('Refresh Success!');

forward(REFERRER);

?>