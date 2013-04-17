<?php
/**
 * Compose message form
 *
 * @package ElggMessages
 * @uses $vars['friends']
 */


$subject = elgg_extract('subject', $vars, '');
$body = elgg_extract('body', $vars, '');
$guid= elgg_extract('project_guid', $vars, '');
$project=get_entity($guid);

echo elgg_view('input/hidden', array(
	'name' => 'project_guid',
	'value' => $guid,

));

$annotation_id= elgg_extract('annotation_id', $vars, '');
if($annotation_id){
	$annotation=elgg_get_annotation_from_id($annotation_id);
	$name=$annotation->name;
	if($name=='task'){
	$subject="Micro help:{$annotation->value}";
	}else if($name=='team'){
	$subject="JoinUs:{$annotation->value}";
	echo elgg_view("input/hidden",array('name'=>'id','value'=>$annotation_id));
	}
}
?>

<div>
	<label><?php echo elgg_echo("messages:title"); ?>: <br /></label>
	<?php echo elgg_view('input/text', array(
		'name' => 'subject',
		'value' => $subject,
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo("messages:message"); ?>:</label>
	<?php echo elgg_view("input/longtext", array(
		'name' => 'body',
		'value' => $body,
	));
	?>
</div>
<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('messages:send'))); ?>
</div>
