<?php 
$guid=get_input('guid');
$project=get_entity($guid);

$team_exit=$project->team_exit;
$team_num=$project->team_num;
$team_reward=$project->team_reward;

$tool_exit=$project->tool_exit;
$tool_num=$project->tool_num;
$tool_reward=$project->tool_reward;

$fund_exit=$project->fund_exit;
$fund_num=$project->fund_num;
$fund_reward=$project->fund_reward;

$i=0;
$name=array('team','tool','fund');
$exit_value=array($team_exit,$tool_exit,$fund_exit);
$num_value=array($team_num,$tool_num,$fund_num);
$reward_value=array($team_reward,$tool_reward,$fund_reward);
// the reward will only view when they started to get money
$num=1;
$stage=$project->get_money;
if($stage==1||$stage==3){
	$num=2;	
}

while($i<=$num){

	$reward_head=elgg_echo('setting:'.$name[$i].':title');
	$exit_title[$i]=elgg_echo('setting:'.$name[$i].':exit');
	$num_title[$i]=elgg_echo('setting:'.$name[$i].':num');
	$reward_title[$i]=elgg_echo('setting:'.$name[$i].':reward');

	$required .=<<<html
	<div class="mbl">
	<h3 class="dashed grey brs pas">$reward_head </h3>
	<div class="pam">
	<div class="inline-block" >
	<div class="pbm inline-block w200 ">$exit_title[$i]</div>
	<div class="inline-block w100 mll mrl" >$exit_value[$i]</div>
	</div>
	<div class="inline-block" >
	<div class="pbm inline-block w200 ">$num_title[$i]</div>
	<div class="inline-block w100 mll mrl" >$num_value[$i]</div>
	</div>
	<div>
	<div class="pbm">$reward_title[$i]</div>
	$reward_value[$i]
	</div>

	</div>
	</div>
html;
$i++;
}

echo $required;



?>
