<?php
$title="Login";
// login form
$login_url = elgg_get_site_url();
if (elgg_get_config('http_login')) {
	$login_url = str_replace("http:", "http:", elgg_get_site_url());
}
$login=elgg_view_form('index-login', array('action' => "{$login_url}action/login"), array('returntoreferer' => TRUE));

$content=<<<HTML
<div class="elgg-col">
<h2>Login</h2>
$login
</div>
HTML;

$body=elgg_view_layout('one_column',array('content'=>$content));

echo elgg_view_page($title,$body);
?>