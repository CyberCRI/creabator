<?php
/**
 * Page edit form body
 *
 * @package Elggwiki
 */

$variables = elgg_get_config('wiki');
$user = elgg_get_logged_in_user_entity();
$entity = elgg_extract('entity', $vars);
$can_change_access = true;
if ($user && $entity) {
	$can_change_access = ($user->isAdmin() || $user->getGUID() == $entity->owner_guid);
}

foreach ($variables as $name => $type) {
	// don't show read / write access inputs for non-owners or admin when editing
	if (($type == 'access' || $type == 'write_access') && !$can_change_access) {
		continue;
	}
	if(($type == 'access' || $type == 'write_access')){
		$container_guid=$vars['container_guid'];
		$project=get_entity($container_guid);
		
		$acl=$project->project_acl;
		$options[$acl]=elgg_echo('wiki:project');
		$options[ACCESS_PRIVATE]=elgg_echo("PRIVATE");
		$options[ACCESS_FRIENDS]=elgg_echo("access:friends:label");
		$options[ACCESS_LOGGED_IN]=elgg_echo("LOGGED_IN");
		$options[ACCESS_PUBLIC]=elgg_echo("PUBLIC");
		
		echo elgg_echo("wiki:$name") ;
		echo '<br />';
		echo elgg_view("input/$type", array(
			'name' => $name,
			'value' => $acl,
			'options_values'=>$options,
		));
		echo '<br />';
		
	}else{
	
?>
<div>
	<label><?php echo elgg_echo("wiki:$name") ?></label>
	<?php
		if ($type != 'longtext') {
			echo '<br />';
		}

		echo elgg_view("input/$type", array(
			'name' => $name,
			'value' => $vars[$name],
		));
	?>
</div>
<?php
	}
}


echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'page_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));
if ($vars['parent_guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $vars['parent_guid'],
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';
