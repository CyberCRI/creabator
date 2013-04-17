<?php
/**
 * Search box in page header
 */

//$url = elgg_get_site_url() . 'search';
echo elgg_view_form('projects/search', array(
	'action' => '/',
	'method' => 'get',
	'disable_security' => true,
	'class'=>'fr',
	'style'=>'display:inline-block',
	'id'=>'s_f',
	
), $vars); 


