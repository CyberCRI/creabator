<?php
/**
 * A project's member requests
 *
 * @uses $vars['entity']   Elggproject
 * @uses $vars['remove'] Array of ElggUsers
 * @uses $vars['action'] remove action name
 */

if (!empty($vars['remove']) && is_array($vars['remove'])) {
	echo '<ul class="elgg-list">';
	foreach ($vars['remove'] as $user) {
		$icon = elgg_view_entity_icon($user, 'tiny', array('use_hover' => 'true'));

		$user_title = elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $user->name,
			'is_trusted' => true,
		));

		$url = 'action/projects/'.$vars['action'].'?user_guid=' . $user->guid . '&project_guid=' . $vars['entity']->guid;
		$delete_button = elgg_view('output/confirmlink', array(
				'href' => $url,
				'confirm' => elgg_echo('projects:remove:check'),
				'text' => elgg_echo('delete'),
				'class' => 'elgg-button elgg-button-delete mlm',
		));

		$body = "<h4>$user_title</h4>";
		$alt = $delete_button;

		echo '<li class="pvs">';
		echo elgg_view_image_block($icon, $body, array('image_alt' => $alt));
		echo '</li>';
	}
	echo '</ul>';
} else {
	echo '<p class="mtm">' . elgg_echo('projects:remove:none') . '</p>';
}
