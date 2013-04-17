<?php 
$guid=get_input('guid');
$project=get_entity($guid);
$annotation=get_input('annotation');

$tasks=elgg_get_annotations(array(
		'type'=>'object',
		'subtype'=>'projects',
		'guid'=>$guid,
		'annotation_name'=>$annotation,
		'limit'=>0
		));
if($tasks){
$tasks=array_reverse($tasks);
	echo "<ul class='pam bgwhite'>";
echo <<<js
<script type="text/javascript">
  var load_tasks=function(name){
		elgg.get('/ajax/view/ajax/require/task', {
					data: {
						guid:$guid,
						annotation:name,
					},
			      success: function(resultText, success, xhr) {
			   	      $('#output_'+name).html(resultText);
							},	
	
					});
		}
		
 var deletetask=function(id,name){
			elgg.action('task/delete', {
			data: {annotation_id:id,},
			success: function(resultText, success, xhr) {
				load_tasks(name);
			}
			});
	}
 var finish=function(id,value,name){
		elgg.action('task/finish',{
		data:{guid:$guid,annotation_id:id,done:value},
		success:function(data){
		 if(data.output.done==1){
		   $("#task-"+id).addClass("task_done");
		  load_tasks(name);
		  }else{
			 $("#task-"+id).removeClass("task_done");
			 load_tasks(name);
			}
		}
		})
	}
</script>
js;

	foreach ($tasks as $task){
	    //get status of each task
	    $id=$task->id;
		$done=$project->$id;
		if(!$done){
			$done=0;
		}
	    
		$del_link=elgg_view('output/url',array('href'=>"#del",'text'=>elgg_view_icon('delete'),'id'=>"del-{$task->id}",'class'=>'fr'));
		echo "<li class='pas grey dashed'>";
		echo elgg_view('input/checkbox',array('name'=>$task->id,'id'=>$task->id,'default'=>$done));
		echo "<span id='task-{$task->id}'>";
		echo $task->value;
		echo "</span>";
		echo $del_link;
		echo "</li>";
		echo <<<js
		<script type="text/javascript">
$(document).ready(function(){
       var taskid=$task->id;
		$("#del-"+taskid).click(function(){
		deletetask(taskid,"$annotation")
		})
		$("#"+taskid).attr("checked",false);
		var done=1
		if($done==1){
		   $("#task-"+taskid).addClass("task_done");
		   $("#"+taskid).attr("checked",true);
		   done=0
		}
		
		 $("#"+taskid).change(function() {
		 if($("#"+taskid).attr("checked")){
             finish(taskid,done,$annotation)
    		
           }
    });

})
</script>		
js;
	}
	echo "</ul>";
	
}

?>
<style type="text/css">
.task_done{
text-decoration: line-through;
color: grey;
}
</style>