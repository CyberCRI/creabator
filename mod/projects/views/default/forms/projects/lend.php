<?php
/**
 * Edit / add a project facility
 *
 * @package project facility
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
//$freestart = elgg_extract('freestart', $vars, '');
//$freeend = elgg_extract('freeend', $vars, '');
//$location = elgg_extract('location', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
// if it need edit function , than use this line $guid = elgg_extract('guid', $vars, null);
/*
 *  delete the function of filling add facility with data and location
 *  
 <?php echo elgg_echo('Free From'); ?><div style="display: inline-block;width:200px">
<?php echo elgg_view('input/date', array('name' => 'freestart', 'value' => $freestart)); ?></div>
<?php echo elgg_echo('To'); ?><div style="display: inline-block;width:200px">
<?php echo elgg_view('input/date', array('name' => 'freeend', 'value' => $freeend)); ?></div><br>
<?php echo elgg_echo('Location:'); ?><div style="display: inline-block;width:500px">
<?php echo elgg_view('input/text', array('name' => 'location', 'value' => $location)); ?></div>
*/
?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>

<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));


echo elgg_view('input/submit', array('value' => elgg_echo("Lend")));

?>
</div>