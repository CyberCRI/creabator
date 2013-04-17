<?php
/**
 * Elgg edit state action
 *

 */
$project_guid = (int) get_input('project_guid');

$project = get_entity($project_guid);

if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}

elgg_make_sticky_form('projects');
if (!$project->canEdit()) {
		register_error(elgg_echo('project:access:failed'));
		forward(REFERRER);
}
	$i=0;
	while($i<=4){
	$reward_nums[$i] = get_input('reward_nums'.$i);
	$reward_texts[$i]= get_input('reward_texts'.$i);
	
	if(!empty($reward_nums[$i])&&!empty($reward_texts[$i])){
	$num_name[$i]='reward_nums'.$i;
	$text_name[$i]='reward_texts'.$i;
	$project->$num_name[$i] =$reward_nums[$i];
	$project->$text_name[$i] =$reward_texts[$i];
	}
	$i++;
	}
if ($project->save()) {

	elgg_clear_sticky_form('projects');

	
	system_message(elgg_echo('Reward updated'));

	
	forward('projects/setting/'.$project_guid);
} else {
	register_error(elgg_echo('project:reward:save:failed'));
	forward(REFERRER);
}


