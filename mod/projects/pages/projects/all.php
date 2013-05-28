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
  <div ng-controller="ListCtrl" class="mtm" style="overflow:hidden">
  <div class="elgg-col-1of3 inline-block">
      <input class="w200" ng-model="query" id="appendedInputButton" type="text" placeholder="search projects">
      <button class="elgg-button elgg-button-submit plm prm pts pbs" type="button">Search</button>
  </div>


  <div class="elgg-col-1of3 inline-block mlm">
   <span style="color:#999"> Sort By:</span>
          <select ng-model="orderProp" class="f2">
            <option value="time_created">Newest</option>
            <option value="title">Alphabetically</option>
            <option value="taskProgress">Issue Proccess</option>
          </select>
    </div>   
  <ul class="mtl elgg-gird">
  	<li ng-repeat="project in projects | filter:query | orderBy:orderProp:true" class="elgg-col-1of2  elgg-col">
  	 <div  class="well well-small mas">
  	 <div class="center" style="font-size:1.2"><a href="{$siteurl}projects/view/{{project.guid}}">{{project.title}}</a></div>
  	 <div class="muted mts center">Created by <a href="{$siteurl}profile/{{project.owneruser}}">{{project.ownername}}</a> in {{project.friendly_time}}.</div>
	  			
	  		<div class="elgg-col-1of4 elgg-col">
	  			<a href="{$siteurl}projects/view/{{project.guid}}"><img ng-src="{{project.iconurl}}" width=120 height=120 class="brm" /></a>
	  		</div>
	  		
	  		<div class="elgg-col-3of4 elgg-col">
	  			
	  			<div class="bgwhite mlm mts pas brm h100">{{project.brief}}</div>
	  		
	  		
	  		</div>
  		<div class="clearfloat"></div>
  			<div class="pam">
		              <h4><span class="muted">Open:</span>{{project.tasktotal-project.taskdone}}  <span class="muted">Closed:</span>{{project.taskdone}} <div class="fr">{{project.taskProgress}}%</div></h4>
		                     <div class="progress progress-success span3">
		                     <div class="bar" style="width: {{project.taskProgress}}%"></div>
		              </div>
	              </div>
  	 </div>
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

		//open task
		$task_done=elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'issue',
			'container_guid'=>$guid,
			'count' => true,
			'metadata_name'=>'done',
			'metadata_value'=>'1',
	));
	   $task_total=elgg_get_entities(array('type'=>'object','subtype'=>'issue','count'=>true,'container_guid'=>$guid));
	  if($task_total==0){
	  	$task_proccess=0;
	  }else{
	 	// add some 5 times for the team member
	 	$task_proccess=floor($task_done/$task_total*100);
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
   
    
    
    $scope.orderProp='time_created';
	
}
</script>
