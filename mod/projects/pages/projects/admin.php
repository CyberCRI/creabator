<?php 

$option=get_input('option');

$new_projests=elgg_get_entities_from_access_id(array(
		'type'=>'object',
		'subtype'=>'projects',
		'access_id'=>0, 
		));
if(!$new_projests){
	$list=elgg_echo('No New Projects');
}else{
$project_list="<ul class=\"project_list pam grey brs\">";
foreach ($new_projests as $project){
	$icon=elgg_view_entity_icon($project,'small');
	$title=$project->title;
	$brief=$project->briefdes;
	$activated=elgg_view('output/url',array(
			'href'=>'action/projects/approve?project_guid='.$project->guid.'&action_type=activated',
			'text'=>elgg_echo("Activated"),
			'is_action' => true,
			'class'=>'elgg-button elgg-button-submit fr',
	));
	$params = array(
			'entity' => $project,
			'title' => $title.$activated,
			'subtitle' => $brief,
			'tags'=>false,
	);
	
	$summary = elgg_view('object/elements/summary', $params);

	
	$project_list.="<li class=\"mts dashed\">";
	$project_list.=elgg_view_image_block($icon, $summary);
	$project_list.="</li>";
	
}
$project_list.="</ul>";
$list=$project_list;
}
switch ($option){
	case "frozen":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"frozen\"></div></div>";
		break;
	case "recommened":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"recommened\"></div></div>";
		break;
	case "finish":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"finish\"></div></div>";
		break;
	case "stop":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"stop\"></div></div>";
		break;
	case "graphic":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"graphic\"></div></div>";
		break;
	default:
		$tab_content=$list;

}

$menu=elgg_view('projects/admin_menu');
$content=<<<html
$menu
$tab_content
html;
$body=elgg_view_layout('one_column',array('content'=>$content));

echo elgg_view_page($title, $body);
?>
<script type="text/javascript">
$(document).ready(function(){
	  //get the value from url 
	String.prototype.GetValue= function(para) {  
		  var reg = new RegExp("(^|&)"+ para +"=([^&]*)(&|$)");  
		  var r = this.substr(this.indexOf("\?")+1).match(reg);  
		  if (r!=null) return unescape(r[2]); return null;  
		}  
		var str = location.href;  
		option=str.GetValue("option");		

		
		if(option=='frozen'){
	     	elgg.get('/ajax/view/ajax/frozen', {
			     
			      beforeSend:function(XMLHttpRequest)  
		            {  
			    	  $('#frozen').html("<div class=\"elgg-ajax-loader\"></div>"); 
		                },  
			      success: function(resultText, success, xhr) {
		       	      $('#frozen').html(resultText);
	      				},
	      
				});
	 
	}else if (option=='recommened'){
	     	elgg.get('/ajax/view/ajax/recommened', {
			      data:{guid:elgg.get_logged_in_user_guid()},
			      beforeSend:function(XMLHttpRequest)  
		            {  
			    	  $('#recommened').html("<div class=\"elgg-ajax-loader\"></div>"); 
		                },  
			      success: function(resultText, success, xhr) {
		       	      $('#recommened').html(resultText);
	      				}
				});
	 
	}
})

</script>