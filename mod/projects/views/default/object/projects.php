<?php
/**
 * Elgg project view
 *
 * @package Elggprojects
 */


$full = elgg_extract('full_view', $vars, FALSE);
$project = elgg_extract('entity', $vars, FALSE);

if (!$project) {
	return;
}
$site_url = elgg_get_site_url();
$owner = $project->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$container = $project->getContainerEntity();
$categories = elgg_view('output/categories', $vars);
$title=$project->title;

$project_icon=elgg_view_entity_icon($project, 'large',array('img_class'=>'project-img-frame '));
$videoid=$project->videoid;
$briefdes = $project->briefdes;
$plan = elgg_view('output/longtext', array('value' => $project->plan));
$plan_excerpt=elgg_get_excerpt($plan,800);
$ytlink='http://www.youtube.com/embed/'.$videoid;
$youtube=$project_icon;
if ($videoid){
$youtube=<<<HTML

<iframe class="project-img-frame"  style="z-index:-3;height:350px" src=$ytlink frameborder="0" ></iframe>


HTML;


}

$process_list=project_proccess_bar($project,"25px","70%");
$process_index=project_proccess_bar($project,"30px","62%");
$process_gallery=project_proccess_bar($project,"19px","66%",'',"mls");
$process_main=project_proccess_bar($project,"43px","68.5%","grey mtl mbl brm pam","mll mtm f16");

$gallery_icon=elgg_view_entity_icon($project, 'small',array('img_class'=>'full-width'));
$exptitle=elgg_get_excerpt($project->title,30);
$title_link=elgg_view('output/url',array('href'=>$project->getURL(),'text'=>$project->title));

$date = elgg_view_friendly_time($project->time_created);


$list_img=project_backup_icon_with_link($project->getIconURL('large'), $title, $project->getURL(), "",'list_img');

$gallery_img="<div style='line-height:0'><a href='{$project->getURL()}' ><img alt='{$title}'style='width:90%;height: auto;margin-left: 5%;' src='{$project->getIconURL('medium')}'><span id='gallery-list-title'>{$title}</span></a></div>";

$index_img=project_backup_icon_with_link($project->getIconURL('large'), $title, $project->getURL(), "width:100%;height:100%");

$presentation=elgg_echo('project:presentation');
$brieftitle=elgg_echo('project:brief');
$followtitle=elgg_echo('project:follow');
$cooltitle=elgg_echo('project:cool');

$comments=elgg_view_comments($project,true,array('class'=>'mts'));


$morebox= elgg_view_module('info', '',$morect, array('id' => 'read-more'));

$list_image_block= elgg_view_image_block($owner_icon, "<a href='{$owner->geturl()}'>{$owner->name}</a><br>{$owner->description}");

// add org icon
$group=get_entity($project->container_guid);
if($group instanceof ElggGroup){
	$group_sign="<div class='group_sign'>{$group->name}</div>";
}

if ($full&& !elgg_in_context('gallery')&&!elgg_in_context('index-list')) {
	// full project view
	$body = <<<HTML

	
			$youtube
			
			<div class="clear"></div>
			
			
			<h3 class="dashed mtl mbm f20 grey brs pas">$presentation</h3>
			<div class="mlm">
				<h4 class="dashed">$brieftitle</h3>
				<div class="f16 pam">$briefdes </div>
				 <h4 class="dashed">$followtitle</h3>
	
				<div class="pas">$plan</div>
			</div>
	
			

HTML;

	echo $body;
	
}elseif (elgg_in_context('gallery')) {
	if (elgg_in_context('widgets')) {
	echo elgg_view_image_block($gallery_icon, $title_link."<br>".$briefdes);
		
	}else{
	// gallery view
	 echo <<<HTML
	 <div class='ptm grey mrl brm' style='box-shadow: 5px 5px 5px #999;height: 360px;'>
		$gallery_img
	 	<div class='center pas bgwhite brs mlm mrm mtl'>$briefdes</div>	 
	</div>


HTML;
	}
}else if(elgg_in_context('owner')){

	$metadata = elgg_view_menu('entity', array(
	'entity' => $project,
	'handler' => 'projects',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
	$params = array(
			'entity' => $project,
			'title' => $title_link,
			'metadata' => $metadata,
			'subtitle' => $briefdes,
			'tags'=>false,
	);
	$summary = elgg_view('object/elements/summary', $params);

	
echo elgg_view_image_block($gallery_icon, $summary);

	}else{
	
echo <<<HTML
$list_img
<div class="list_title">
$title
</div>
<div class="list_div">	
	$briefdes
</div>
$group_sign
HTML;

		
	}	

?>
