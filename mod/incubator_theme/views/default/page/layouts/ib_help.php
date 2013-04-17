<?php
/**
 *  main help center layout
 *
 @uses $vars['ib_content']        HTML of main content area
 */

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));


if (isset($vars['help_content'])) {
	$ibcontent=$vars['help_content'];
}
if (isset($vars['title'])) {
	$title=$vars['title'];
}

/* $about=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'about',
		'text'=>'About Us',
		'is_trusted' => true,
		));
$faq=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'faq',
		'text'=>'FAQ',
		'is_trusted' => true,
));
$hiw=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'help',
		'text'=>'Help Center',
		'is_trusted' => true,
));
$jobs=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'jobs',
		'text'=>'Join Us',
		'is_trusted' => true,
));
$service=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'service',
		'text'=>'Service',
		'is_trusted' => true,
));
$privacy=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'privacy',
		'text'=>'Privacy',
		'is_trusted' => true,
));
$feedback=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'feedback',
		'text'=>'Feedback',
		'is_trusted' => true,
));
$contact=elgg_view('output/url',array(
		'href'=>elgg_get_site_url().'contact',
		'text'=>'Contact',
		'is_trusted' => true,
)); */
$tabs=array(
		'about' => array(
				'text' => elgg_echo("About Us"),
				'href' => 'about',
				'priority' => 200,
		),
		'contact' => array(
				'text' => elgg_echo("Contact Us"),
				'href' => 'contact',
				'priority' => 300,
		),
		'help' => array(
				'text' => elgg_echo("Help Center"),
				'href' => 'help',
				'priority' => 400,
		),
		'feedback' => array(
				'text' => elgg_echo("Feedback"),
				'href' => 'feedback',
				'priority' => 500,
		),
		'jobs' => array(
				'text' => elgg_echo("Join Us"),
				'href' => 'jobs',
				'priority' => 600,
		),
		'faq' => array(
				'text' => elgg_echo("FAQ"),
				'href' => 'faq',
				'priority' => 700,
		),
		'service' => array(
				'text' => elgg_echo("Terms of Service"),
				'href' => 'service',
				'priority' => 800,
		),
		'privacy' => array(
				'text' => elgg_echo("Privacy"),
				'href' => 'privacy',
				'priority' => 900,
		),
);
foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('help_tabs', $tab);
}

$menu=elgg_view_menu('help_tabs',array('sort_by' => 'priority', 'class' => 'help-sidebar'));


echo <<<HTML
<div style="width:990px;margin:80px auto 0;">
	$menu
	<div class="help-content mbl">
	$nav
	<h2 class="dashed mbm">$title</h2>
	$ibcontent
	</div>
</div>
HTML;
