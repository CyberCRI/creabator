<?php
/**
add or edit page for the backup
 *
 */


$backup_amt = elgg_extract('backup_amt', $vars, '');


$guid =get_input('guid');


echo elgg_view('input/hidden', array(
	'name' => 'project_guid',
	'value' => $guid,

));



?>
<div class="pal">
	<div class="fl elgg-col-2of3">
	<h1 class="mbl" >Enter pledge Amount:</h1>
		<div class="grey brl  pal h100 ">
			<span class="f3 fl mrs" style="line-height:1.3">$</span>
		<?php echo elgg_view('input/text', array(
			'name' => 'backup_amt',
			'value' => $backup_amt,
			'id'=>'backup-amt',
			'class'=>'fl f2',
		));
		?>
		
		<div class="fl mll f20 mtl">
		It's up to you. 
	Any amount of 1 $ or more.
		</div>
		<div class="clearfloat ptm">
		<?php echo elgg_echo('backup:attention')?>
		</div>
	</div>

	<div class="mtl">
		<?php echo elgg_view('input/submit', array('value' => elgg_echo('Pay now'),'class'=>'elgg-button-submit f2 pam')); ?>
	</div>
	</div>
	<div class='fl elgg-col-1of3'>
		<div class="pas">
		<?php echo  elgg_view_title(elgg_echo('deposit:important'),array('class'=>'dashed mbm'));?>
		<p><?php echo   elgg_echo('backup:important:content');?></p>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	
    $('form :input').blur(function(){
		 var $parent = $(this).parent();
		 $parent.find(".formtips").remove();
		
      
    	   if( $(this).is('#backup-amt') ){
   			if( this.value=="" || ( this.value!="" && !/^[1-9]\d*$/.test(this.value)) ){
                     var errorMsg = 'Number;';
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