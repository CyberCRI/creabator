<?php
/**
 * Main project list view area layout
 *
 * @uses $vars['ib_content']        HTML of main content area
 * @uses $vars['ib_sidebar']        HTML of the sidebar
 
 */

// give plugins an opportunity to add to content sidebars

if (isset($vars['ib_filter'])) {
	$ibfilter=$vars['ib_filter'];
			}

if (isset($vars['ib_content'])) {
	$ibcontent=$vars['ib_content'];
			}


echo <<<HTML
<div class="wrapper">
$ibfilter
$ibcontent


</div>
HTML;



?>
