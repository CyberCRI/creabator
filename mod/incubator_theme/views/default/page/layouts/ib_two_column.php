<?php
/**
 * Main project list view area layout
 *
 * @uses $vars['ib_content']        HTML of main content area
 * @uses $vars['ib_sidebar']        HTML of the sidebar
 * @uses $vars['ib_filter']         HTML of the content area filter (override)

 */

// give plugins an opportunity to add to content sidebars
$ibcontent=null;
$ibsidebar=null;
$ibfilter=null;
if (isset($vars['ib_filter'])) {
	$ibfilter=$vars['ib_filter'];
			}

if (isset($vars['ib_content'])) {
	$ibcontent=$vars['ib_content'];
			}

if (isset($vars['ib_sidebar'])) {
		$ibsidebar=$vars['ib_sidebar'];
	
	}
echo <<<HTML
<div class="container">
$ibfilter
<div class="content pam brs mbl">
		$ibcontent
</div>
</div>
HTML;





?>
