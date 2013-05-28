<?php
/**
 *  one-column layout
 *
 */

$class = 'elgg-layout elgg-layout-one-column clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

?>
<div class="container pbl">
<div class="<?php echo $class; ?>">
	<div class="elgg-body elgg-main">
	<?php
		echo $nav;

		if (isset($vars['title'])) {
			echo elgg_view_title($vars['title']);
		}

		echo $vars['content'];
		
	?>
	</div>
</div>
</div>