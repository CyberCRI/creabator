<?php
/**
 * View a project
 *
 * @package Elggprojects
 */
$guid =get_input('guid');

$project=get_entity($guid);

// check if the project is closed
$closed=get_input('closed');
if($closed){
	$closed="<div class='grey pam'>Your project is closed because you couldn't get enough money in time.If you want to continue, please contact admin(admin@creabator.org).</div>";
}

// @todo add icon for the succeful projects

$comments = elgg_view_comments($project);

$project_entity = elgg_view_entity($project, array('full_view' => true));

//content 
$content=<<<HTML
$closed
<div class="clearfloat"></div>
	<div style="margin-top:50px;" class="fl elgg-col-1of4">
		<div class="pam dashed f1h grey center">
		 We are looking for:
		</div>
		<div id="proccess"></div>
		<div id="rq_team"></div>
		<div id="task"></div>
		<div id="tool"></div>
		
	</div>
	<div class="fl elgg-col-3of4" style="margin-top:50px">
		<div class="pam mls f1h center grey dashed">
			 About this project:
			</div>
		<div  class="fl elgg-col-2of3" >
			<div class="pam">
				
				$project_entity	
	
	             $comments
			</div>
		</div>
		<div class="fl elgg-col-1of3">
			<div id="owner"></div>
			<div id="team"></div>
			<div id="twitter" class="w"></div>
		
		</div>
	</div>



<div class="content-box clearfloat">
	<div id="related"></div>
</div>

HTML;


$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,

));

echo elgg_view_page(null, $body);
?>
<script type="text/javascript">
$(document).ready(function(){
	var project_guid=<?php echo $guid?>;	
	function ajax_load(root,name){
		elgg.get('/ajax/view/ajax/'+root+'/'+name, {
 			data: {guid:project_guid},
	       
	      success: function(resultText, success, xhr) {
       	      $('#'+name).html(resultText);
  				},
  
		});
	}	
// view page        
	//owner moduler 
	    ajax_load('view','owner');
	
	// twitter moduler	
		ajax_load('view','twitter');   

	//proccess 
	   ajax_load('view','proccess'); 
		
 
	// require team 	
	ajax_load('view','rq_team');
 //task	
 	ajax_load('view','task');
 
 	// require tools 	
 	ajax_load('view','tool');

 	
	

	// team moduler 
	   ajax_load('view','team');
	   
	//related projects 
	   ajax_load('view','related');

	 //instant updatas ,refresh in one minutes 
	  /*
	   setInterval(function(){
			ajax_load('view','task');
			},600000);	 
		*/
})
      
</script>