<?php
/**
 * Add project page
 *
 * @package projects
 */


$title = elgg_echo('projects:add');

$vars = projects_prepare_form_vars();


$form = elgg_view_form('projects/save', array(), $vars);

$content="<div class='pam'>{$form}</div>";
$body=elgg_view_layout('home_two_column',array('content'=>$content,'title'=>$title));

echo elgg_view_page($title, $body);
