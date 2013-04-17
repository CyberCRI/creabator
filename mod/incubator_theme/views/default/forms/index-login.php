<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
?>


<div class="fl w200 mtl prs">
	
	<?php echo elgg_view('input/text', array(
		'name' => 'username',
		'class' => 'elgg-autofocus',
		'placeholder'=>elgg_echo('loginusername'),
		));
	?>
</div>
<div class="fl w200 mtl prs">
	<?php echo elgg_view('input/password', array('name' => 'password','placeholder'=>elgg_echo('password'),)); ?>
</div>
<div class="fl w50 mtl pls ">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('login'),'class'=>'elgg-button-index pas')); ?>
</div>

<div class="fl elgg-foot">

	<?php 
	if (isset($vars['returntoreferer'])) {
		echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
	}
	?>

	<ul class="elgg-menu elgg-menu-index fr">
	
	<li style="color:white">
	<input type="checkbox" name="persistent" value="true" />
		<?php echo elgg_echo('user:persistent'); ?>
	</li>
	<li>
	.
	</li>
		<li ><a class="forgot_link" href="<?php echo elgg_get_site_url(); ?>forgotpassword">
			<?php echo elgg_echo('user:password:lost'); ?>
		</a></li>
	</ul>
</div>
