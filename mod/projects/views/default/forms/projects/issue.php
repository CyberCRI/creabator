<?php
/*
 * Created on 2012-1-29
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$guid = elgg_extract('guid', $vars, null);
$project_guid = elgg_extract('project_guid', $vars, '');
$title = elgg_extract('title', $vars, '');
$description = elgg_extract('description', $vars, '');
$contribute = elgg_extract('contribute', $vars, '');
$tags=elgg_extract('tags', $vars, '');
?>
	<div>
		<label><?php echo elgg_echo('title'); ?></label>
		<?php echo elgg_view('input/text', array('name' => 'title','value'=>$title)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('description'); ?></label>
		<?php echo elgg_view('input/plaintext', array('name' => 'description','value'=>$description)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('How to Contribute?'); ?></label>
		<?php echo elgg_view('input/plaintext', array('name' => 'contribute','value'=>$contribute)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('tags'); ?></label>
		<?php echo elgg_view('input/tags', array('name' => 'tags','value'=>$tags)); ?>
	</div>

<?php

echo elgg_view('input/hidden', array('name' => 'project_guid', 'value' => $project_guid));
	?>

	<div class="elgg-foot">
<?php
if($guid){
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	echo elgg_view('input/submit', array('value' => elgg_echo('Update Issues')));
}else{
		echo elgg_view('input/submit', array('value' => elgg_echo('Create Issues')));
}
?>
	</div>


