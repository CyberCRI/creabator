<?php
/**
* setting edit page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);



$title=elgg_view_title('Facility Management');

$lists=<<<html
<h2>Needed Facility</h2>
<div class="pam grey mbm">
<textarea name="tool" id="tool" placeholder="Example:We need to use microscope for 2 hours."></textarea>
<input type='submit' id="submit_tool" class="orange-button" value="Add">
	<div id="output_tool"></div>
</div>




<script type="text/javascript">
$(document).ready(function(){
   var project_guid=$project_guid
   var load_tasks=function(name){
		elgg.get('/ajax/view/ajax/require/task', {
					data: {
						guid:project_guid,
						annotation:name,
					},
			      success: function(resultText, success, xhr) {
			   	      $('#output_'+name).html(resultText);
							},	
	
					});
		}
	var add_task=function(name){
	
		elgg.action('task/add', {
			data: {
				guid:project_guid,
				value:$("#"+name).val(),
				annotation:name,
			},
			success: function(resultText, success, xhr) {
			   load_tasks(name);
				$("#"+name).val("");
			 
			}
		});
	}

 load_tasks('tool');
 $("#submit_tool").click(function(){
        add_task('tool');
	})
	
})
</script>
html;
$lists.="<h2>".elgg_echo('projects:facilityrequests')."</h2>";
if ($project && $project->canEdit()) {
	$requests = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'fbacker_request',
			'relationship_guid' => $project_guid,
			'inverse_relationship' => true,
			'limit' => 0,
	));
	$lists.= elgg_view('projects/fbacker_request', array(
			'requests' => $requests,
			'entity' => $project,
	));

} else {
	$lists.= elgg_echo("projects:noaccess");
}

$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $title.$content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
