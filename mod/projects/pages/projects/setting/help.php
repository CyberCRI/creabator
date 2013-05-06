<?php
/**
* setting edit page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);



$title=elgg_view_title('Needed Team & Tools:');
$vars = projects_prepare_form_vars($project);
//$team=elgg_view_form('projects/help',array(),$vars);


$lists=<<<html
<h2>Needed Team</h2>
<div class="pam grey mbm">
<textarea name="team" id="team" placeholder="Example:We need a php web developer who are passion in Education."></textarea>
<input type='submit' id="submit_team" class="orange-button" value="Add">
	<div id="output_team"></div>
</div>

<h2>Open Task</h2>
<blockquote>Open task is the task that you want to get help from the crowed and it's better that could be done within 15 mins.</blockquote>

<div class="pam grey mbm">
<textarea name="task" id="task" placeholder="Example:I need your help to design a logo."></textarea>
<input type='submit' id="submit_task" class="orange-button" value="Add">
	<div id="output_task"></div>
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

 load_tasks('team');
 $("#submit_team").click(function(){
        add_task('team');
	})

	 // load & submit tasks	
 load_tasks('task');
  $("#submit_task").click(function(){
        add_task('task');
	})
	

	

	
})
</script>
html;


$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $title.$content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
