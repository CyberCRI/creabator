<?php 
$guid=get_input('guid');
$project=get_entity($guid);
$process=project_proccess_bar($project,"43px","77%","grey mtl mbl brm pam","mll mtm f16");

echo $process;
?>