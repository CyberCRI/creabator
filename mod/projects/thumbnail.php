<?php
/**
 * Image display(for the testpic poster)
 *
 * @package Elggprojects
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$file_guid = get_input('file_guid');
$file = get_entity($file_guid);

$size = strtolower(get_input('size'));
if (!in_array($size,array('small','large'))){
	$size = "large";
}
if($size=="large"){
	$size="";
}
$success = false;

$filehandler = new ProjectImageFile();
$filehandler->owner_guid = $file->owner_guid;
$filehandler->setFilename("projectimgs/" . $file->guid . $size . ".jpg");

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
