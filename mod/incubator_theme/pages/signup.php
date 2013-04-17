<?php
// create the registration url - including switching to https if configured
$register_url = elgg_get_site_url() . 'action/register';
if (elgg_get_config('https_login')) {
	$register_url = str_replace("http:", "https:", $register_url);
}
$form_params = array(
		'action' => $register_url,
		
		

);

$body_params = array(
		'friend_guid' => $friend_guid,
		'invitecode' => $invitecode
);
$register_form .= elgg_view_form('index-register', $form_params, $body_params);

$register_form .= elgg_view('help/register');
/* echo "<div class='mll w700 pal'>";
echo $register_form;
echo "</div>"; */

$body=elgg_view_layout('one_sidebar',array('content'=>$register_form));

echo elgg_view_page($title,$body);