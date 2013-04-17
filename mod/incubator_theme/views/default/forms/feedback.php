<?php
/**
 * feedback form
*
*/

?>

<div>

<?php echo elgg_view('input/text', array(
'name' => 'title',
'class' => 'elgg-autofocus',
'placeholder'=>elgg_echo('feedback:title'),
));
?>
</div>

<div>

<?php echo elgg_view('input/plaintext', array(
'name' => 'description',
'class' => 'elgg-autofocus ',
'placeholder'=>elgg_echo('feedback:desc'),
));
?>
</div>
<div class="elgg-foot">

<?php echo elgg_view('input/submit', array('value' => elgg_echo('feedback'),'class'=>'green-button pal')); ?>

</div>
