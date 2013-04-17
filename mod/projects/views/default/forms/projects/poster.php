<?php
$guid= get_input('project_guid');
echo elgg_view('input/hidden', array(
		'name' => 'project_guid',
		'value' => $guid,

));

 echo elgg_view_title(elgg_echo("Upload poster:(Leave blank if no change)"));
 echo "<div class=\"inline-block w400 mrl\">";
 echo elgg_view('input/file', array('name' => 'pic'));
 echo "</div>";  
 echo elgg_view('input/submit', array('value' => elgg_echo("Upload")));