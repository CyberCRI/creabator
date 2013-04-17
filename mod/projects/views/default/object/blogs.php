<?php
/**
 * updates object view
 *
 * @package Elggprojects
 */

$full = elgg_extract('full_view', $vars, FALSE);
$blogs = elgg_extract('entity', $vars, FALSE);
$blog_guid=$blogs->getGUID();
$project_guid=$blogs->container_guid;
$project = get_entity($project_guid);

if (!$blogs) {
	return;
}

$title=elgg_view('output/text', array('value' => $blogs->title));
$description = elgg_view('output/longtext', array('value' => $blogs->description));


// display the image_block
$owner = $project->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$date = elgg_view_friendly_time($blogs->time_created);

$comments_count = $blogs->countComments();

//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";

} else {
	$text = elgg_echo("Comments(0)");
}

$comments_link = elgg_view('output/url', array(
		'href' => "#comments-add-$blog_guid",
		'text' => $text,
		'rel' => 'toggle',
	));


$options = array(
	'guid' => $blogs->getGUID(),
	'annotation_name' => 'generic_comment',
	'limit' => 20,
	'order_by' => 'n_table.time_created desc'
);
$comments = elgg_get_annotations($options);


	// why is this reversing it? because we're asking for the 3 latest
	// comments by sorting desc and limiting by 3, but we want to display
	// these comments with the latest at the bottom.
	$comments = array_reverse($comments);


/* $comment_link=<<<HTML
	<span class="elgg-river-comments-tab">
	$comments_link
	</span>
HTML; */


$comments_list=elgg_view_annotation_list($comments, array('list_class' => 'project-blogs-comments'));

// inline comment form
//$body_vars = array('entity' => $blogs, 'inline' => true);
$body_vars = array('entity' => $blogs);
$comment_form=elgg_view_form('comments/add', $form_vars, $body_vars);

$metadata = elgg_view_menu('entity', array(
	'entity' => $blogs,
	'handler' => 'projects/blogs',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
$params = array(
		'entity' => $blogs,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $date,

	);

	$summary = elgg_view('object/elements/summary', $params);
$image_block = elgg_view_image_block($owner_icon, $summary);




$excerpt = elgg_get_excerpt($blogs->description,650);
$title_link=elgg_view('output/url',array('href'=>$blogs->getURL(),'text'=>$title,'class'=>'center f2h'));
$more_link=elgg_view('output/url',array('href'=>$blogs->getURL(),'text'=>"/Read more"));

if ($full && !elgg_in_context('gallery')) {


echo <<<HTML
<div class="elgg-divide-bottom mbl">
$image_block
</div>
<div class="center">
$title_link
</div>
$description

HTML;


} elseif (elgg_in_context('gallery')) {
	echo <<<HTML
here is the gallery view
HTML;
} else {
	// list brief view	
	
$content=<<<HTML
<div class="pal">
	$image_block
	<div class="center">
	$title_link
	
	</div>
	<div class="lh150 mtl mbm">
	$excerpt 
	</div>
	
	<div class="fr mrs">
	$comments_link $more_link
	</div>
	<div id="comments-add-$blog_guid" style="display: none; " class="brm pam bgwhite">
	$comments_list
	$comment_form
	</div>
</div>

HTML;

echo $content;
}
