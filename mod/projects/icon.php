<?php
/**
 * Icon display(for the project poster)
 *
 * @package Elggprojects
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);

$size = strtolower(get_input('size'));
if (!in_array($size,array('large','medium','small','tiny','master','topbar')))
	$size = "medium";

$success = false;

$filehandler = new ElggFile();
$filehandler->owner_guid = $project->owner_guid;
$filehandler->setFilename("projects/" . $project->guid . $size . ".jpg");

$success = false;
if ($filehandler->open("read")) {
	if ($contents = $filehandler->read($filehandler->size())) {
		$success = true;
	}
}

if (!$success) {
	$location = elgg_get_plugins_path() . "projects/graphics/default{$size}.jpg";
	$contents = @file_get_contents($location);
}
// caching images for 10 days
header("Content-type: image/jpeg");
header('Expires: ' . date('r',time() + 864000));
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));

echo $contents;
