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
<div class="grey brm pam">Open Issue is the place that help you getting help from the crowd. In order to reward students or citizen who will help you, You should announce that you will <b>reward</b> them with a <b>certificate</b> with your signature to prove they actually helping you to finish which task so that they could include it in their CV.</div>
	<div>
		<label><?php echo elgg_echo('title'); ?></label>
		<?php echo elgg_view('input/text', array('name' => 'title','value'=>$title)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('description'); ?></label>
		<?php echo elgg_view('input/longtext', array('name' => 'description','value'=>$description)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('How to Contribute?'); ?></label>
		<?php echo elgg_view('input/plaintext', array('name' => 'contribute','value'=>$contribute,'class'=>'h100')); ?>
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


