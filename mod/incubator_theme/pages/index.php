<?php
if (elgg_is_logged_in()){
	forward('projects/all');
}

$slideurl=elgg_get_site_url().'mod/incubator_theme/graphics/slides';

$logo=project_backup_icon_with_link('mod/incubator_theme/graphics/index-logo.png', 'Creabator', elgg_get_site_url(), '', '');
$login_url = elgg_get_site_url();
if (elgg_get_config('http_login')) {
	$login_url = str_replace("http:", "http:", elgg_get_site_url());
}
$login=elgg_view_form('index-login', array('action' => "{$login_url}action/login"), array('returntoreferer' => TRUE));


$about= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'about',
		'text' =>elgg_echo('About'),
		'is_trusted' => true,
		));
$contact=elgg_view('output/url', array(
		'href' => elgg_get_site_url().'contact',
		'text' => elgg_echo('Contact'),
		'is_trusted' => true,
		));
$help=elgg_view('output/url', array(
		'href' => elgg_get_site_url().'help',
		'text' => elgg_echo('Help'),
		'is_trusted' => true,
		));

$relation=project_backup_icon_with_link('mod/incubator_theme/graphics/relation.png', 'About Creabator', elgg_get_site_url().'about', '', '');
$signup=elgg_view('output/url', array(
		'href' => elgg_get_site_url().'register',
		'text' => elgg_echo('Contribute Now!'),
		'is_trusted' => true,
		'class'=>'elgg-button-index pam',
		'style'=>'font-size:1.2em;'
		));
$explore=elgg_view('output/url', array(
		'href' => elgg_get_site_url().'projects/all',
		'text' => elgg_echo('Explore Projects'),
		'is_trusted' => true,
		'class'=>'elgg-button-index pam',
		'style'=>'font-size:1.2em;'
));
$howitwork=elgg_view('output/url',array('href'=>'#','text'=>elgg_echo('How it works?'),'class'=>'pam'));
$body= <<<HTML
<div id="index">
<div id="index-header">
	<div class="wrapper">
	<div class="fl w200 mal"  >
	$logo
	</div>
	<div style="" class="w500 mal fr">
	$login
	</div>
	</div> 
</div>
<div class="wrapper">
	<div style="font-size: 40px;font-weight: bold;color: #555;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;" class="mtl center pam">
	Innovating collectively
	</div>
	<div style="margin-left:20px;margin-top:30px;">
	<div  class="fr pll">
	$relation
	</div>
	<div  class="pal mtl" >
	<h4>Creabator is a crowdsourcing platform for pulling together the necessary ingredients for novel science projects: ideas, participants, tools and funding.
	</h4>

	</div>
	
	
		<div  class="fl pal ">
		$explore
		</div>
		<div  class="fl pal">
		$signup
		</div>
	
	</div>
</div>
<div id="index-foot">
	
	<ul class="elgg-menu-hz wrapper">
	<li class='fr pas'>
	 	$help
	 </li>
	
	<li class='fr pas'>
		$contact
	</li>
	<li class='fr pas'>
		$about
	</li>
		<div style="float:left;color:white" class="pas">
		
	 &#169;2012 Creabator.
		</div>
	</ul>
	
</div>

</div>
HTML;
echo elgg_view_page($title,$body,'index');

?>
