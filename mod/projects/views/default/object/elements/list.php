<?php
/**
 * project list summary
 *
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 * @uses $vars['metadata']  HTML for entity menu and metadata (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['content']   HTML for the entity content (optional)
 */

$entity = $vars['entity'];

$title_link = elgg_extract('title', $vars, '');
if ($title_link === '') {
	if (isset($entity->title)) {
		$text = $entity->title;
	} else {
		$text = $entity->name;
	}
	$params = array(
		'text' => $text,
		'href' => $entity->getURL(),
		'is_trusted' => true,
	);
	$title_link = elgg_view('output/url', $params);
}

$content = elgg_extract('content', $vars, '');
$process=elgg_extract('process',$vars,'');
$subtitle=elgg_extract('subtitle',$vars,'');
echo "<h3>$title_link</h3>";
if ($subtitle) {
	echo $subtitle;
}
if ($content) {
	echo "$content";
}
if ($process) {
	echo $process;
}

?>



