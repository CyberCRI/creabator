<?php 
$guid=get_input('guid');
$project=get_entity($guid);

// load project lib
elgg_load_library('elgg:projects');

//set the related projects
$related_title=elgg_echo('project:related:title');
$related_projects=related_objects_base_on_tags($guid, 4,array(
		'list_class'=>'project-elgg-list',
				'item_class'=>'project-elgg-item',));
if($related_projects){
	$rlpbody=<<<html
	<h2 class="dashed mbm "> $related_title</h2>
	$related_projects
	</div>
	<script type="text/javascript">
$(function(){
	var moveTime = 200,
		curMove = null;
	$('.project-elgg-list li').hover(function (e){
		var curLi = $(this);
		curMove = setTimeout(function (){
			curLi.children('div.list_div').animate({ left: '0px' }, moveTime);
		}, 200);
	},function(e){
		clearTimeout(curMove);
		$(this).children('div.list_div').animate({ left:'500px' }, moveTime);
	});
});
</script>	
html;
}

echo $rlpbody;
?>