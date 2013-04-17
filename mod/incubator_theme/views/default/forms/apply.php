<?php
/**
 * apply form
*
*/

?>

<div>

<?php echo elgg_view('input/email', array(
'name' => 'email',
'class' => 'elgg-autofocus required',
'placeholder'=>elgg_echo('email'),
));
?>
</div>
<div>

<?php echo elgg_view('input/text', array(
'name' => 'name',
'class' => 'elgg-autofocus',
'placeholder'=>elgg_echo('realname'),
));
?>
</div>
<div>

<?php echo elgg_view('input/plaintext', array(
'name' => 'description',
'class' => 'elgg-autofocus h100',
'placeholder'=>elgg_echo('apply-desc'),
));
?>
</div>
<div class="elgg-foot">

<?php echo elgg_view('input/submit', array('value' => elgg_echo('apply'),'class'=>'elgg-button-index pas')); ?>

</div>
