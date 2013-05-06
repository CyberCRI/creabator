<?php 
$guid=get_input('guid');
$project=get_entity($guid);
$process=project_proccess_bar($project,"25px","100%");
echo $process;
?>