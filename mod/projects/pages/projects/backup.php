<?php
/**
* backup form page
*
* @package IncubatorProject
*/
gatekeeper();
$guid =get_input('guid');
$project = get_entity($guid);

if(!elgg_instanceof($project,'object','projects')){
	register_error('not projects');
	return ;
}



$content= elgg_view_form('backup/add',array(),array('backup_amt'=>1,'guid'=>$guid));



$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$guid,
));

echo elgg_view_page($title, $body);
?>
<script type="text/javascript">
$(function(){
	
    $('form :input').blur(function(){
		 var $parent = $(this).parent();
		 $parent.find(".formtips").remove();
		
      
    	   if( $(this).is('#all_amt') ){
   			if( this.value=="" || ( this.value!="" && !/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/.test(this.value)) ){
                     var errorMsg = 'Positive Number;';
   				  $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
   			}
   		 }
          
		
		
	}).keyup(function(){
	   $(this).triggerHandler("blur");
	}).focus(function(){
  	   $(this).triggerHandler("blur");
	});
	

})

</script>
