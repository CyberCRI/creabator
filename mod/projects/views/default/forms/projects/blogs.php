<?php
/*
 * Created on 2012-1-29
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$guid = elgg_extract('guid', $vars, null);
$project_guid = elgg_extract('project_guid', $vars, '');
//$pic_guid = elgg_extract('pic_guid', $vars, '');
$title = elgg_extract('title', $vars, '');
$description = elgg_extract('description', $vars, '');
?>
	<div>
		<label><?php echo elgg_echo('title'); ?></label>
		<?php echo elgg_view('input/text', array('name' => 'title','value' => $title)); ?>
	</div>
	<div>
		<label><?php echo elgg_echo('description'); ?></label>
		<?php echo elgg_view('input/longtext', array('name' => 'description','value' => $description)); ?>
	</div>

<?php
echo elgg_view('input/hidden', array('name' => 'project_guid', 'value' => $project_guid));
if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}
/* if($pic_guid){
	echo elgg_view('input/hidden', array('name' => 'pic_guid','value' => $pic_guid));
} */
	?>

	<div class="elgg-foot">
<?php
		echo elgg_view('input/submit', array('value' => elgg_echo('project:blogs:update')));
?>
	</div>


