<?php
/*
 * Created on 2012-2-7
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$guid =get_input('project_guid');

$content=<<<HTML
<div style="width:60%;margin-left:20%" >
	<div id="proccess_big"></div>
</div>
<div class="pal">
	<div id="rq_team"></div>
	<div id="task"></div>
	<div id="tool"></div>
	
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
	function ajax_load(root,name,limit){
		elgg.get('/ajax/view/ajax/'+root+'/'+name, {
 			data: {guid:project_guid,limit:limit},
	      beforeSend:function(XMLHttpRequest)  
            {  
	    	  $('#'+name).html("<div class=\"elgg-ajax-loader\"></div>"); 
                },  
	      success: function(resultText, success, xhr) {
       	      $('#'+name).html(resultText);
  				},
  
		});
	}	

//required page 
 	 //proccess 
 	   ajax_load('required','proccess_big');

 	// require team
 	 ajax_load('view','rq_team',1);
  	//micro help
    ajax_load('view','task',1);

  	//require tools
  	ajax_load('view','tool',1);
})
      
</script>