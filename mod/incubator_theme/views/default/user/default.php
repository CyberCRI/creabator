<?php
/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */

$entity = $vars['entity'];
$size = elgg_extract('size', $vars, 'tiny');

$icon = elgg_view_entity_icon($entity, $size, $vars);

// Simple XFN
$rel = '';
if (elgg_get_logged_in_user_guid() == $entity->guid) {
	$rel = 'rel="me"';
} elseif (check_entity_relationship(elgg_get_logged_in_user_guid(), 'friend', $entity->guid)) {
	$rel = 'rel="friend"';
}

$title = "<a href=\"" . $entity->getUrl() . "\" $rel>" . $entity->name . "</a>";

$metadata = elgg_view_menu('entity', array(
	'entity' => $entity,
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}

if (elgg_get_context() == 'gallery') {
	echo $icon;
} else {
	if ($entity->isBanned()) {
		$banned = elgg_echo('banned');
		$params = array(
			'entity' => $entity,
			'title' => $title,
			'metadata' => $metadata,
		);
	} else {
		$m_skills=elgg_view('output/tags',array('value'=>$entity->skills));
		if(!$m_skills){
			$m_skills="<span class='muted'>This user is too lazy,he/she did not add any skills tags yet.</span>";
		}
		$m_interests=elgg_view('output/tags',array('value'=>$entity->interests));
		if(!$m_interests){
			$m_interests="<span class='muted'>This user is too lazy,he/she did not add any interests tags yet.</span>";
		}

		$params = array(
			'entity' => $entity,
			'title' => $title,
			'metadata' => $metadata,
			'subtitle' =>"{$entity->briefdescription}<br><b>Skills:</b>{$m_skills}<br><b>Interests:</b>$m_interests",
			'content' => elgg_view('user/status', array('entity' => $entity)),
		);
	}

	$list_body = elgg_view('user/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}
