<?php
/**
 * Elgg comments add form
 *
 * @package Elgg
 *
 * @uses ElggEntity $vars['entity'] The entity to comment on
 * @uses bool       $vars['inline'] Show a single line version of the form?
 */


if (isset($vars['entity']) && elgg_is_logged_in()) {

	$inline = elgg_extract('inline', $vars, false);
$user=elgg_get_logged_in_user_entity();
$user_icon=elgg_view_entity_icon($user,'tiny');
$inline_form=elgg_view('input/text', array(
'name' => 'generic_comment',
'placeholder' => elgg_echo('Leave a comment'),
'style'=>'margin-top:0'		
		));
	if ($inline) {
		echo elgg_view_image_block($user_icon, $inline_form);
		echo elgg_view('input/submit', array(
'value' => elgg_echo('Comment'),
'class'=>'hidden'
));
	} else {
$user_icon=elgg_view_entity_icon($user,'small');
$long_from=elgg_view('input/plaintext', array('name' => 'generic_comment','placeholder' => elgg_echo('Leave a comment'),'style'=>'height:45px'));
$submit=elgg_view('input/submit', array('value' => elgg_echo("Comments"),'class'=>'elgg-button-submit fr'));
echo elgg_view_image_block($user_icon, $long_from.$submit);

	}

	echo elgg_view('input/hidden', array(
		'name' => 'entity_guid',
		'value' => $vars['entity']->getGUID()
	));
}
