<?php
/**
 * The default search layout(change the layout to ib_two_column)
 *
 * @uses $vars['body']
 */

$layout=elgg_view_layout('one_sidebar', array('content' => $vars['body']));
if (array_key_exists('type', $vars['params']) && array_key_exists('subtype', $vars['params'])) {
	if($vars['params']['type']=='object'&&$vars['params']['subtype']=='projects'){
		$layout=elgg_view_layout('one_column', array('content' => $vars['body']));
		if($vars['params']['view_type']=='ajax'){
			$layout=$vars['body'];
		}
	}

}
echo $layout;
