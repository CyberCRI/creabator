<?php
$guid=get_input('project_guid');
$project=get_entity($guid);
if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}
$i=0;
$name=array('team','tool','fund');
elgg_make_sticky_form('basic');
while($i<=2){
$name_exit[$i]=$name[$i].'_exit';
$name_num[$i]=$name[$i].'_num';
$name_reward[$i]=$name[$i].'_reward';

$exit[$i]=get_input($name_exit[$i]);
$num[$i]=get_input($name_num[$i]);
$reward[$i]=get_input($name_reward[$i]);

$project->$name_exit[$i] = $exit[$i];
$project->$name_num[$i] = $num[$i];
$project->$name_reward[$i] = $reward[$i];


$i++;
}
if($project->save()){
elgg_clear_sticky_form('basic');
system_message("Submit Success");
forward(REFERER);
}else{
register_error("Could not Save! Try again later");
}