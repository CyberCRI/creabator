<?php
/**
 * Add project page
 *
 * @package projects
 */


$title = elgg_echo('projects:add');

$vars = projects_prepare_form_vars();
$body = elgg_view_form('projects/save', array(), $vars);


echo elgg_view_page($title, $body);