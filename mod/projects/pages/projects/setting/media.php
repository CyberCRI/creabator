<?php
/**
* setting edit page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);




// upload youtube video
$videoid=$project->videoid;
$titlestatue="Upload a video to present your project (highly recommended):";
$video='';
if ($videoid){
	$titlestatue="Your have Uploaded the Video(Leave Blank if not change)";
	$ytlink='http://www.youtube.com/embed/'.$videoid;
	$video=<<<HTML
	
	<iframe  width="400px" height="320px" style="z-index:-3;" src=$ytlink frameborder="0" ></iframe>
	
	
HTML;
	
}
$youtube=elgg_view('projects/youtube',array('guid'=>$project_guid));
//check if the video uploaded success
if (isset($_GET['status'])){
$status=$_GET['status'];
(isset($_GET['id']) ? $id = $_GET['id'] : $id = null);
if($status < 400) {
// set the videoid of the project
$project->videoid=$id;

}
}
$vars = projects_prepare_form_vars($project);
$pic_upload=elgg_view_form('projects/poster',array('enctype'=>"multipart/form-data"),$vars);
$project_icon=elgg_view_entity_icon($project, 'large',array('img_class'=>'project-img-frame '));



// list the view
$lists =<<<HTML
<div class="mbl">
$pic_upload
$project_icon
</div>

<h3 class="dashed">$titlestatue</h3>
<p>A good video is better than 1000 words. Please upload a video to attract the attention and resource of the world to your splendid idea. Your video will also help accelerate our processing effeciency on your project.</p>
$youtube
<div class="mam">
$video
</div>

$twitter

HTML;



$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
