<?php
/**
 * Elgg projects plugin everyone page
 *
 * @package Elggprojects
 */


		$title = elgg_echo('projects:everyone');
		$siteurl=elgg_get_site_url();
  $content=<<<html
  <h2 class="dashed">$title</h2>
  <div ng-controller="ListCtrl" class="mtm">
  <div class="elgg-col-1of3 inline-block">
      <input class="w200" ng-model="query" id="appendedInputButton" type="text" placeholder="search projects">
      <button class="elgg-button elgg-button-submit plm prm pts pbs" type="button">Search</button>
  </div>


  <div class="elgg-col-1of3 inline-block mlm">
   <span style="color:#999"> Sort By:</span>
          <select ng-model="orderProp" class="f2">
            <option value="time_created">Newest</option>
            <option value="title">Alphabetically</option>
            <option value="teamProgress">Team Proccess</option>
            <option value="taskProgress">Task Proccess</option>
          </select>
    </div>   
  <ul class="mtl">
  	<li ng-repeat="project in projects | filter:query | orderBy:orderProp:true " class="well well-small elgg-gird">
  	
	  		<div class="elgg-col-1of6 elgg-col">
	  			<a href="{$siteurl}projects/view/{{project.guid}}"><img ng-src="{{project.iconurl}}" width=160 height=160 /></a>
	  		</div>
	  		
	  		<div class="elgg-col-1of2 elgg-col">
	  			<div class="pam">
	  			<h3><a href="{$siteurl}projects/view/{{project.guid}}">{{project.title}}</a></h3>
	  			<div class="grey">{{project.brief}}</div>
	  			Created by <a href="$siteurl/profile/{{project.owneruser}}">{{project.ownername}}</a> in {{project.friendly_time}}.
	  			</div>
	  		</div>
	  	
	  		<div class="elgg-col-1of3 elgg-col">
	                   <div class="w200">Team：{{project.teamProgress}}%({{project.teamdone}}/{{project.teamtotal}})</div>
	                        <div class="progress progress-info span3">
	                         <div class="bar" style="width: {{project.teamProgress}}%"></div>
	                      	</div>
	                     <div class="w200">Task：{{project.taskProgress}}%({{project.taskdone}}/{{project.tasktotal}})</div>
	                        <div class="progress progress-success span3">
	                      <div class="bar" style="width: {{project.taskProgress}}%"></div>
	                      </div>
	  		</div>
	  		
  		<div class="clearfloat"></div>
  		
  	</li>
  </ul>
  </div>
  
  
html;
		
	$body = elgg_view_layout('ib_two_column', array(
				'ib_content' => $content,
				'ib_filter'=>$fliter,
	));
	

	
echo  elgg_view_page($title, $body,'list');

// list with angular js

$projects=elgg_get_entities(array('limit'=>0,'type'=>'object','subtype'=>'projects'));
if($projects){

	foreach($projects as $project){
		$export=new stdClass();
		$export->guid=$project->guid;
		$export->title=$project->title;
		$export->brief=$project->briefdes;
		$export->iconurl=$project->getIconURL('medium');
		$owner=$project->getOwnerEntity();
		$export->ownername=$owner->name;
		$export->owneruser=$owner->username;
		$export->time_created=$project->time_created;
		$export->friendly_time=elgg_get_friendly_time($project->time_created);
		$guid=$project->guid;
		$team_done=done_item($guid,'team');
		$team_total=elgg_get_annotations(array(
				'type'=>'object',
				'subtype'=>'projects',
				'guid'=>$guid,
				'annotation_name'=>'team',
				'count'=>True
		));
		if($team_total==0){
			$t_proccess=0;
		}else{
		$t_proccess=number_format(($team_done/$team_total)*100);
		}
		$export->teamtotal=$team_total;
		$export->teamdone=$team_done;
		$export->teamProgress=$t_proccess;
		
		//open task
		$task_done=done_item($guid,'task');
		$task_total=elgg_get_annotations(array(
				'type'=>'object',
				'subtype'=>'projects',
				'guid'=>$guid,
				'annotation_name'=>'task',
				'count'=>True
		));
		if($task_total==0){
			$task_proccess=0;
		}else{
		$task_proccess=number_format(($task_done/$task_total)*100);
		}
		$export->tasktotal=$task_total;
		$export->taskdone=$task_done;
		$export->taskProgress=$task_proccess;

		$data[]=$export;
	}

	$JsonProjects=json_encode($data);

}


?>
<script type="text/javascript">


function ListCtrl($scope,$http){
	   
    $scope.projects=<?php echo $JsonProjects ?>;
   
    
    
    $scope.orderProp='title';
	
}
</script>

