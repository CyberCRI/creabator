<?php
/**
 * Compose message form
 *
 * @package ElggMessages
 * @uses $vars['friends']
 */


$link = elgg_extract('link', $vars, '');
$guid= elgg_extract('project_guid', $vars, '');
$project=get_entity($guid);

echo elgg_view('input/hidden', array(
	'name' => 'project_guid',
	'value' => $guid,

));



?>


<div>
	<span><?php echo elgg_echo("addresource:link"); ?>:</span>
	<?php echo elgg_view("input/text", array(
		'name' => 'link',
		'value' => $link,
		'class'=>'elgg-col-2of3',
	));
	?>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('addresource:submit'),'class'=>'elgg-col-1of6')); ?>
</div>

	

