<?php 
$guid=get_input('guid');
$project=get_entity($guid);


//team members
$team_backers_list=elgg_get_entities_from_relationship(array('type' => 'user',
		'relationship' => 'member',
		'relationship_guid' => $guid,
		'inverse_relationship' => true,
		'limit' => 0));
$team_backers=elgg_view('projects/backers',array('backers'=>$team_backers_list));

$team_backers_amount=elgg_get_entities_from_relationship(array('type' => 'user',
		'relationship' => 'member',
		'relationship_guid' => $guid,
		'inverse_relationship' => true,
		'count'=>true,
));
if($team_backers_amount==0){
 return;
}
// plus owner
//$nums=$team_backers_amount+1;

$p_title=elgg_echo('Team Members('.$team_backers_amount.')');
//$p_title.=elgg_view('output/url',array('href'=>'projects/apply/'.$guid,'text'=>'JoinUs','class'=>'orange-button fr'));

$backers_module=elgg_view_module('aside', $p_title, $team_backers,array('class'=>'mtm brs'));

echo $backers_module;
?>