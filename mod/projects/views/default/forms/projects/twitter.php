<?php 

$name = elgg_extract('twitter', $vars, '');
$data_id=elgg_extract('data_id', $vars, '');
$guid= elgg_extract('guid', $vars, '');
$project=get_entity($guid);

echo elgg_view('input/hidden', array(
		'name' => 'project_guid',
		'value' => $guid,

));



?>

<h2><?php echo elgg_echo("Twitter widget"); ?>:</h2>
<div class="grey brs pam">
	
	<abbr>To create your widget,you should click <a href="https://twitter.com/settings/widgets" target="blank">Twitter Widget</a>,The domains name should be set as <span style="color:blue;"> www.creabator.org</span>.You could copy your data-widget-id after you create the widget inside the code.</abbr>
	<div class="elgg-col-1of4 fl inline-block mrl">
	<?php echo elgg_echo('Twitter-username:')?>
	<?php echo elgg_view("input/text", array(
	'name' => 'twitter',
	'value' => $name,
	'class'=>'',
	));
	?>
	</div>
	<div class="elgg-col-1of4 fl inline-block ">
	<?php echo elgg_echo('Twitter-data-widget-id:')?>
	<?php echo elgg_view("input/text", array(
	'name' => 'twitter_data_id',
	'value' => $data_id,
	));
	?>
	</div>
	<div class="clearfloat"></div>
</div>
<div class="elgg-foot">
<?php echo elgg_view('input/submit', array('value' => elgg_echo('Save'),'class'=>'elgg-button elgg-button-submit pas')); ?>
</div>

