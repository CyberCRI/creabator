<?php
/**
 * Navigation menu for a user's or a group's wiki
 *
 * @uses $vars['page'] Page object if manually setting selected item
 */

// add the jquery treeview files for navigation
elgg_load_js('jquery-treeview');
elgg_load_css('jquery-treeview');


$selected_page = elgg_extract('page', $vars, false);
if ($selected_page) {
	$url = $selected_page->getURL();
}

$title = elgg_echo('wiki:navigation');

wiki_register_navigation_tree(elgg_get_page_owner_entity());

$content = elgg_view_menu('wiki_nav', array('class' => 'wiki-nav'));
if (!$content) {
	$content = '<p>' . elgg_echo('wiki:none') . '</p>';
}

echo elgg_view_module('aside', $title, $content);

?><?php //@todo JS 1.8: no ?>
<script type="text/javascript">
$(document).ready(function() {
	$(".wiki-nav").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

<?php
if ($selected_page) {
	// if on a history page, we need to manually select the correct menu item
	// code taken from the jquery.treeview library
?>
	var current = $(".wiki-nav a[href='<?php echo $url; ?>']");
	var items = current.addClass("selected").parents("ul, li").add( current.next() ).show();
	var CLASSES = $.treeview.classes;
	items.filter("li")
		.swapClass( CLASSES.collapsable, CLASSES.expandable )
		.swapClass( CLASSES.lastCollapsable, CLASSES.lastExpandable )
			.find(">.hitarea")
				.swapClass( CLASSES.collapsableHitarea, CLASSES.expandableHitarea )
				.swapClass( CLASSES.lastCollapsableHitarea, CLASSES.lastExpandableHitarea );
<?php
}
?>

});

</script>
