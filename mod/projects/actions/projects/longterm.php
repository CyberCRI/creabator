<?php 
admin_gatekeeper();

$guid=get_input('project_guid');
$project=get_entity($guid);

//@todo validate if $project is a project
// status: refresh:2,frozen:1
$project->longterm=1;

system_message('Success!');

forward(REFERRER);

?>