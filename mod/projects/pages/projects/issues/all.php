<?php

/*
 * project issues list page
*
*
* Weipeng Kuang
*/


$project_guid = get_input('project_guid');
$project = get_entity($project_guid);
$status=get_input('statue');


if (!elgg_instanceof($project, 'object', 'projects')) {
	register_error(elgg_echo('projects:unknown_project'));
	forward(REFERRER);
}

if($status=="closed"){
	$tabclosed="elgg-state-selected";
	$issues=elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'issue',
			'container_guid'=>$project_guid,
			'limit' => 0,
			'metadata_name'=>'done',
			'metadata_value'=>'1',
	));
}else{
	$tabopen="elgg-state-selected";
	$issues=elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'issue',
			'container_guid'=>$project_guid,
			'limit' => 0,
			'metadata_name'=>'done',
			'metadata_value'=>'0',
	));
}
$done=elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'issue',
			'container_guid'=>$project_guid,
			'count' => true,
			'metadata_name'=>'done',
			'metadata_value'=>'1',
	));
$total=elgg_get_entities(array('type'=>'object','subtype'=>'issue','count'=>true,'container_guid'=>$project_guid));
$undone=$total-$done;
if($total==0){
	$pgs=0;
}else{
	$pgs=floor($done/$total*100);
}

$progress=<<<html
<div class="well well-small">
<h3 class="solid">Issue Progress:$pgs% (Closed:$done Open:$undone)</h3>

<div style="display:inline-block;width:100%;height:30px" class="progress progress-success ">
	 <div class="bar" style="width:$pgs%"></div>
	</div>
</div>
html;

$openlink=elgg_view('output/url',array('href'=>elgg_get_site_url().'projects/issues/all/'.$project_guid,'text'=>'Open('.$undone.')'));
$closedlink=elgg_view('output/url',array('href'=>elgg_get_site_url().'projects/issues/all/'.$project_guid.'?statue=closed','text'=>'Closed('.$done.')'));

$content.=<<<html
$progress
<ul class="elgg-menu elgg-menu-ptabs elgg-menu-hz mbm mtm">
<li class="$tabopen">$openlink</li>
<li class="$tabclosed">$closedlink</li>
</ul>
html;


if($issues){
	$content.="<ul>";
	foreach($issues as $issue){
		if(elgg_get_logged_in_user_guid()==$issue->owner_guid){
			if($status=="closed"){
			
			//$button=elgg_view('output/url',array('href'=>elgg_get_site_url().'action/issue/open?guid='.$issue->guid,'text'=>'Open Issue','class'=>'elgg-button elgg-button-submit fr','is_action'=>true));
				
			}else{
			$button=elgg_view('output/confirmlink',array('href'=>elgg_get_site_url().'action/issue/finish?guid='.$issue->guid,'text'=>'Closed Issue','class'=>'elgg-button elgg-button-submit fr','is_action'=>true));
			}
		}
		$ititle=elgg_view('output/url',array('text'=>$issue->title,'href'=>elgg_get_site_url().'projects/issues/view/'.$issue->guid,'target'=>'_blank'));
		$idesc=$issue->description;
		$itags=elgg_view('output/tags',array('entity'=>$issue));
		$num="<div style='color:#999;float:right'>#{$issue->guid}</div>";
		$content.="<li  class='well well-small'><h3 class='solid'>$num$ititle</h3>$button<div class='pas'>$idesc</div>$itags</li>";
	}
	$content.="</ul>";
}



if (!$content) {
	$content.= elgg_echo('projects:issues:none');
}
$body = elgg_view_layout('main_project', array(
		'ib_content' => $content,
		'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
?>

