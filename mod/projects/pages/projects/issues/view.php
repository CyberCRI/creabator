<?php

/*
 * project issue view page
*
*
* Weipeng Kuang
*/


$guid = get_input('guid');
$issue = get_entity($guid);
$project_guid=$issue->container_guid;
$back=elgg_view('output/url',array('href'=>elgg_get_site_url().'projects/issues/all/'.$project_guid,'text'=>'Back to Issues list','class'=>'mbm'));
$ititle=$issue->title;
$idesc=$issue->description;
$icontribute=$issue->contribute;
$comment=elgg_view_comments($issue,true);
if(elgg_get_logged_in_user_guid()==$issue->owner_guid){
	$edit=elgg_view('output/url',array('href'=>elgg_get_site_url().'projects/issues/edit/'.$issue->guid,'text'=>'Edit','class'=>'fr'));
	$del=elgg_view('output/confirmlink',array('href'=>elgg_get_site_url().'action/issue/delete?guid='.$issue->guid,'text'=>elgg_view_icon('delete'),'class'=>'fr','is_action'=>true));
}else{
	// add contribute button
	$workon=elgg_view('output/url',array('href'=>elgg_get_site_url().'action/issue/workon?&guid='.$issue->guid,'text'=>"Work on This",'class'=>'fr elgg-button elgg-button-submit','is_action'=>true));
}
// get people who on this this
$contributers=elgg_get_annotations(array('type'=>'object','subtype'=>'issue','guid'=>$guid,'annotation_name'=>'workon'));
if($contributers){
	$cnum=count($contributers);
	$contributer_lists="{$cnum} people working on this";
	$contributer_lists.="<ul>";
	foreach($contributers as $backer){
		$ownerid=$backer->owner_guid;
		$owner=get_entity($ownerid);
		$ownericon=elgg_view_entity_icon($owner,'small');
		$contributer_lists.="<li class='pas fl'>{$ownericon}</li>";
	}
	$contributer_lists.="</ul>";
	$contributer_lists.="<div class='clearfloat'></div>";
}

$content=<<<html
$back
<div class="well well-small">
$del$edit $workon
<h2 class="solid">$ititle</h2>
<div class="pas">
<h5 class="dashed">Detail:</h5>
$idesc
<h5 class="dashed">How to Contribute?</h5>
$icontribute
</div>
<div class="pam solid">
  $contributer_lists
</div>
$comment
</div>

html;


if (!$content) {
	$content = elgg_echo('projects:blogs:none');
}
$body = elgg_view_layout('main_project', array(
		'ib_content' => $content,
		'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
?>

