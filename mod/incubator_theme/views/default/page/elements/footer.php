<?php
/**
 *  footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */

?>

<div class="wrapper clearfloat ">

	<ul class="footer-bottom elgg-menu-hz" style="border-top:1px dashed #fff">
	<li>
	<?php 
	echo elgg_view('output/url', array(
		'href' => elgg_get_site_url().'about',
		'text' => elgg_echo('about'),
		'is_trusted' => true,
		));
	?></li>
	<li>
	<?php 
	echo elgg_view('output/url', array(
		'href' => elgg_get_site_url().'contact',
		'text' =>elgg_echo('contact'),
		'is_trusted' => true,
		));
	?></li>
	<li>
	<?php 
	 echo elgg_view('output/url', array(
		'href' => elgg_get_site_url().'help',
		'text' => elgg_echo('help'),
		'is_trusted' => true,
		));
	 ?></li>
	
	 
		<li>
	<?php 
	echo elgg_view('output/url', array(
		'href' => elgg_get_site_url().'feedback',
		'text' => elgg_echo('feedback'),
		'is_trusted' => true,
		));
	?></li>
	
	  <?php echo elgg_view('output/url', array(
		'href' => 'http://elgg.org',
		'text' => elgg_echo('elgg'),
	  	'title'=>"Powered by Elgg",
	  	'target'=>'blank',
	  	'style'=>'color:white;vertical-align: middle;',
		'is_trusted' => true,
		));
		?>
		
		<div style="float:right;color:#ccc">
		
	 &#169;2013 Creabator
		</div>
	</ul>
	
</div>
<?php echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz mbm'));
 ?>