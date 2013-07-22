<?php
/**
 * Project Checkout Page
 *
 * @package Elggprojects
 */
$guid =get_input('backup_guid');
$checkout = get_entity($guid);
if (!$checkout){
	system_message("error");
	return false;
}

$checkout_entity = elgg_view_entity($checkout, array('full_view' => true));
$pid= $checkout -> bp_guid;
$content=<<<HTML
$checkout_entity
HTML;
$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$pid,

));

echo elgg_view_page(null, $body);