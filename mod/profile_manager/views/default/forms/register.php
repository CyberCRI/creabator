<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');

if (elgg_is_sticky_form('register')) {
	extract(elgg_get_sticky_values('register'));
	elgg_clear_sticky_form('register');
}
/*
echo "<div style='width:800px;margin:0 auto;padding:10px;text-align:center;'>";
echo elgg_view("register/extend_side");
echo "</div>";
echo "<hr>";
*/
// must accept terms
if($accept_terms = elgg_get_plugin_setting("registration_terms", "profile_manager")){
	$link_begin = "<a target='_blank' href='" . $accept_terms . "'>";
	$link_end = "</a>";
	
	$terms .= "<div class='mandatory'>";
	$terms .= "<input type='checkbox' name='accept_terms' value='yes' /> ";
	$terms .= "<label>" . elgg_echo("profile_manager:registration:accept_terms", array($link_begin, $link_end)) . "</label>";
	$terms .= "</div>";
}

echo "<div id='profile_manager_register_left'>";
?>

<fieldset>
	<div class="mtm mandatory">
		<label><?php echo elgg_echo('name'); ?></label><br />
		<?php
		echo elgg_view('input/text', array(
			'name' => 'name',
			'value' => $name,
		));
		?>
	</div>
	<div class="mandatory">
		<label><?php echo elgg_echo('email'); ?></label><br />
		<?php
		echo elgg_view('input/text', array(
			'name' => 'email',
			'value' => $email,
		));
		?>
	</div>
	<div class="mandatory">
		<label><?php echo elgg_echo('username'); ?></label><br />
		<?php
		echo elgg_view('input/text', array(
			'name' => 'username',
			'value' => $username,
		));
		?>
	</div>
	<div class="mandatory">
		<label><?php echo elgg_echo('password'); ?></label><br />
		<?php
		echo elgg_view('input/password', array(
			'name' => 'password',
			'value' => $password,
		));
		?>
	</div>
	
	
</fieldset>

<?php


echo "</div>";

echo "<div id='profile_manager_register_right'>";

?>
<fieldset>
<div class="mandatory">
		<label><?php echo elgg_echo('passwordagain'); ?></label><br />
		<?php
		echo elgg_view('input/password', array(
			'name' => 'password2',
			'value' => $password2,
		));
		?>
	</div>
</fieldset>
<?php	
// view to extend to add more fields to the registration form
echo elgg_view('register/extend');
// Add captcha hook
echo elgg_view('input/captcha');
echo $terms;
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register'),'class'=>'mtm mbm btn'));
echo "<div>" . elgg_echo("profile_manager:register:mandatory") . "</div>";
echo "</div>";
	
echo "</div>";

echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));


echo elgg_view("profile_manager/register/js");
echo "<hr>";
?>
<style type="text/css">
	.elgg-form-account {
		max-width: 100%;
	}
</style>