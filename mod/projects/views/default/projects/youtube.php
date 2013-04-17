<?php
/* transfer youtube variable
 * Created on 2012-2-4
 *
 * @WiserIncubator
 * Weipeng Kuang
*/
// define the youtube functions
$guid = elgg_extract('guid', $vars, '');
$project=get_entity($guid);

$expert=$project->briefdes;
$more_link=$project->getURL();
$desc=<<<HTML
$expert
$more_link

HTML;

$title=$project->title;

$tags=$project->tags;
$site_url=elgg_get_site_url();
$return_url=$site_url.'projects/setting/media/'.$guid;

createUploadForm($title,$desc,"tech",$tags,$return_url);







