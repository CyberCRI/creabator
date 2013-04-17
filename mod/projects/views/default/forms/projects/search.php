<?php
/*
 * Created on 2012-2-9
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$params = array(
	'name' => 'q',
	'value' => '',
	'class'=>'elgg-input-text brs mtm mrm fl w200',
	'placeholder'=>elgg_echo('search:header'),
	'id'=>'search_ajax',
	'autocomplete'=>'off',
	'rel'=>'popup',
	'href' => '#s_ajax',

);
echo elgg_view('input/text', $params);
$s_content=<<<html
<div id='search_result'></div>
html;
$s_ajax = elgg_view_module('popup', '', $s_content, array(
		'id' => 's_ajax',
		'class' => 'hidden w250 '
));
echo $s_ajax;
echo elgg_view('input/hidden',array('name'=>'search_type','value'=>'entities'));
echo elgg_view('input/hidden',array('name'=>'entity_type','value'=>'object'));
echo elgg_view('input/hidden',array('name'=>'entity_subtype','value'=>'projects'));
echo elgg_view('input/submit', array('value' => elgg_echo('Search Projects'),'style'=>'display:none;'));

?>
