<?php
/*
 * list page for backers
 */

$guid =get_input('project_guid');
$project = get_entity($guid);
$site_url=elgg_get_site_url();

$money_backup=project_backup_icon_with_link("/mod/incubator_theme/graphics/money2.png", "Donate this project", $site_url.'projects/backup/'.$guid, "width:30%;margin-left:35%");
$team_backup=project_backup_icon_with_link("/mod/incubator_theme/graphics/team2.png", "Join this team", $site_url.'projects/apply/'.$guid, "width:30%;margin-left:35%",'elgg-lightbox');
$facility_backup=project_backup_icon_with_link("/mod/incubator_theme/graphics/facility2.png", "Lend facility to this project", $site_url.'projects/lend/'.$guid, "width:30%;margin-left:35%");


$money_backers_list=elgg_get_entities_from_relationship(array('type' => 'user',
			'relationship' => 'mbacker',
			'relationship_guid' => $guid,
			'inverse_relationship' => true,
			'limit' => 20));
$money_backers=elgg_view('projects/list_backers', array(
			'backers' => $money_backers_list,
			
	));
$team_backers_list=elgg_get_entities_from_relationship(array('type' => 'user',
			'relationship' => 'member',
			'relationship_guid' => $guid,
			'inverse_relationship' => true,
			'limit' => 20));
$team_backers=elgg_view('projects/list_backers', array(
			'backers' => $team_backers_list,
			
	));
$facility_backers_list=elgg_get_entities_from_relationship(array('type' => 'user',
		'relationship' => 'fbacker',
		'relationship_guid' => $guid,
		'inverse_relationship' => true,
		'limit' => 20));
$facility_backers=elgg_view('projects/list_backers', array(
		'backers' => $facility_backers_list,
		
));

$content=<<<html
<div  class="elgg-col-1of3 fl ">
<div class="mas pal center f2h grey">
  Team members
</div>
$team_backup
$team_backers

</div>

<div  class="elgg-col-1of3 fl" >
<div class="mas pal center f2h grey">
  Facility Backers
</div>
$facility_backup
$facility_backers
</div>
<div class="elgg-col-1of3  fl" >
<div class="mas pal center f2h grey">
  Money Backers
</div>
$money_backup
$money_backers
</div>
html;


$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,

));

echo elgg_view_page(null, $body);
