<?php
/**
 * list of the backers
 *
 * @uses $vars['backers'] Array of ElggUsers
 */

if (!empty($vars['backers']) && is_array($vars['backers'])) {
	echo '<ul class="elgg-list backers_list">';
	foreach ($vars['backers'] as $user) {
		$icon = elgg_view_entity_icon($user, 'medium', array('use_hover' => 'true'));

		$user_title = elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $user->name,
			'is_trusted' => true,
		));

		echo '<li class="elgg-item">';
		echo '<div class="w100 fl">';
		echo $icon;
		echo '</div>';
		echo '<h3 style="margin-top:40px;margin-left:5%" class="fl">';
		echo $user_title;
		echo '</h3></li>';
	}
	echo '</ul>';
}