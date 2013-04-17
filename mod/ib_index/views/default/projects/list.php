<?php 

$offset=get_input('offset');

 $projects=elgg_get_entities(array(
		'type'=>'object',
		'subtype'=>'projects',
		'offset'=>$offset,
		'limit' => 3,
		));
if($projects){
	$list_project=" <ul class='pam projest_index_list'>";
	foreach ($projects as $project){
		$img_url=$project->getIconURL('large');
		$title=$project->title;
		//$title_link=elgg_view('output/url',array('href'=>$project->getURL(),'text'=>$title));
		$brief=$project->briefdes;
		//$progress=project_proccess_bar($project,"22px","70%");
		$list_project.="<li class='brm'> ";
		$list_project.="<a href='{$project->getURL()}' class='index_list_img' ><img alt='{$title}' src='{$img_url}' class='brm' ></a>";
		//$list_project.= "<div class='pam'>{$progress}</div>";
		$list_project.="<div class='index_list_title'>{$title}</div>";
		$list_project.="<div class='index_list_div'>{$brief}</div></li>";
	}
	$list_project.="</ul>";	;
  echo $list_project;	
  echo <<<js
<script type="text/javascript">
$(function(){
	var moveTime = 200,
		curMove = null;
	$('.projest_index_list li').hover(function (e){
		var curLi = $(this);
		curMove = setTimeout(function (){
			curLi.children('div.index_list_div').animate({ left: '0px' }, moveTime);
		}, 200);
	},function(e){
		clearTimeout(curMove);
		$(this).children('div.index_list_div').animate({ left:'500px' }, moveTime);
	});
});
</script>
js;

  
}
?>