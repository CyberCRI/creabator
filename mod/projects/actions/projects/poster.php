<?php
$guid=get_input('project_guid');
$project=get_entity($guid);
if (!elgg_instanceof($project,'object', 'projects')) {
	register_error(elgg_echo('not project'));
	forward(REFERER);
}
// Now see if we have a file icon
if ((isset($_FILES['pic'])) && (substr_count($_FILES['pic']['type'],'image/'))) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "projects/" . $project->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $project->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('pic'));
	$filehandler->close();

	$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 40, 40, $icon_sizes['tiny']['square']);
	$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 80, 80, $icon_sizes['small']['square']);
	$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200, 200, $icon_sizes['medium']['square']);
	$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 660, 550, $icon_sizes['large']['square']);
	if ($thumbtiny) {

		$thumb = new ElggFile();
		$thumb->owner_guid = $project->owner_guid;
		$thumb->setMimeType('image/jpeg');

		$thumb->setFilename($prefix."tiny.jpg");
		$thumb->open("write");
		$thumb->write($thumbtiny);
		$thumb->close();

		$thumb->setFilename($prefix."small.jpg");
		$thumb->open("write");
		$thumb->write($thumbsmall);
		$thumb->close();

		$thumb->setFilename($prefix."medium.jpg");
		$thumb->open("write");
		$thumb->write($thumbmedium);
		$thumb->close();

		$thumb->setFilename($prefix."large.jpg");
		$thumb->open("write");
		$thumb->write($thumblarge);
		$thumb->close();

		$project->icontime = time();
	}
}
system_message("Upload Success!");
forward(REFERER);
