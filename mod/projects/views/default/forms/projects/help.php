<?php
/**
 * setting basic info 
 */


$fund_exit = elgg_extract('fund_exit', $vars, '');
$fund_num = elgg_extract('fund_num', $vars, '');
$fund_reward = elgg_extract('fund_reward', $vars, '');
$tool_exit = elgg_extract('tool_exit', $vars, '');
$tool_num = elgg_extract('tool_num', $vars, '');
$tool_reward = elgg_extract('tool_reward', $vars, '');
$team_exit = elgg_extract('team_exit', $vars, '');
$team_num = elgg_extract('team_num', $vars, '');
$team_reward = elgg_extract('team_reward', $vars, '');

$guid= get_input('project_guid');
echo elgg_view('input/hidden', array(
	'name' => 'project_guid',
	'value' => $guid,

));



?>


<?php 
$i=0;
$name=array('team','tool','fund');
$exit_value=array($team_exit,$tool_exit,$fund_exit);
$num_value=array($team_num,$tool_num,$fund_num);
$reward_value=array($team_reward,$tool_reward,$fund_reward);

while($i<=2){
	?>
<?php echo elgg_view_title(elgg_echo('setting:'.$name[$i].':title'))?>
<div class="inline-block">
	<div class="pbm inline-block w200 "><?php echo elgg_echo('setting:'.$name[$i].':exit'); ?></div>
	<div class="inline-block w100 mll mrl" ><?php echo elgg_view('input/text', array(
		'name' => $name[$i].'_exit',
		'value' => $exit_value[$i],
		'class'=>'num',
	));
	?></div>
</div>
<div class="inline-block" >
	<div class="pbm  inline-block w200"><?php echo elgg_echo('setting:'.$name[$i].':num'); ?></div>
	<div class="inline-block w100 mll" ><?php echo elgg_view('input/text', array(
		'name' => $name[$i].'_num',
		'value' => $num_value[$i],
		'class'=>'num',
	));
	?></div>
</div><br>
<div>
	<div class="pbm"><?php echo elgg_echo('setting:'.$name[$i].':reward'); ?></div>
	<?php echo elgg_view('input/longtext', array(
		'name' => $name[$i].'_reward',
		'value' => $reward_value[$i],
		'class'=>'pal',
		'placeholder'=>elgg_echo('setting:'.$name[$i].':placeholder'),
	));
	?>
</div>
<div class="dashed"></div>
	<?php 
$i++;
}
?>



<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('Submit'),'class'=>'pam')); ?>
</div>
<script type="text/javascript">
$(function(){
	
    $('form :input').blur(function(){
		 var $parent = $(this).parent();
		 $parent.find(".formtips").remove();
		
      
    	   if( $(this).is('.num') ){
   			if( this.value=="" || ( this.value!="" && !/^[1-9]\d*$/.test(this.value)) ){
                     var errorMsg = 'Numbers';
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
