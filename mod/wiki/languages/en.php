<?php
/**
 * wiki languages
 *
 * @package Elggwiki
 */

$english = array(

	/**
	 * Menu items and titles
	 */

	'wiki' => "Wiki",
	'wiki:owner' => "%s's wiki",
	'wiki:all' => "Top-level wiki pages",
	'wiki:add' => "Create a page",
	'wiki:nopermission'=>'You do not have permission.',
	'wiki:edit' => "Edit this page",
	'wiki:delete' => "Delete this page",
	'wiki:history' => "History",
	'wiki:view' => "View page",
	'wiki:revision' => "Revision",
	'wiki:project'=>'Only Team Members',
	'wiki:none' => 'No wiki pages yet. Please create one!',
	'wiki:attention'=>'Here is the wikis that could co-edit within team members.You could create sub-page wiki.',	
	'wiki:navigation' => "Navigation",
	'wiki:title' => 'Title',
	'wiki:description' => 'Content',
	'wiki:tags' => 'Tags',
	'wiki:access_id' => 'Reading Access',
	'wiki:write_access_id' => 'Edit Access',
	
	/**
	 * Form fields
	 */

	'wiki:title' => 'Page title',
	'wiki:description' => 'Page text',
	'wiki:tags' => 'Tags',
	'wiki:access_id' => 'Read access',
	'wiki:write_access_id' => 'Write access',

	
	/**
	 * Page
	 */
	'wiki:strapline' => 'Last updated %s by %s',

	/**
	 * History
	 */
	'wiki:revision:subtitle' => 'Revision created %s by %s',

	

	'wiki:newchild' => "Create a sub-page",
	
);

add_translation("en", $english);