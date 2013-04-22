<?php
/**
 * Index login form
 *
 */
?>

<div>
	
	<?php echo elgg_view('input/text', array(
		'name' => 'username',
		'class' => 'elgg-autofocus',
		'placeholder'=>elgg_echo('loginusername'),
		));
	?>
</div>
<div>
	<?php echo elgg_view('input/password', array('name' => 'password','placeholder'=>elgg_echo('password'),)); ?>
</div>
<div class="elgg-foot">
	<div class="fl">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('login'),'class'=>'orange-button','style'=>'padding:10px 20px')); ?>
	<input type="checkbox" name="persistent" value="true" style="margin-left:1em;" />
		<span style="color:#666"><?php echo elgg_echo('user:persistent'); ?></span>
	</div>
	
	<?php 
	if (isset($vars['returntoreferer'])) {
		echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
	}
	?>

    <a class="forgot_link fl mts" href="<?php echo elgg_get_site_url(); ?>forgotpassword">
			<span style="color:#ccc"><?php echo elgg_echo('user:password:lost'); ?> ?</span>
	</a>
</div>
