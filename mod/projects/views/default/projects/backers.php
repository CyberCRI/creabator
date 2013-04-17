<?php
if (!empty($vars['backers']) && is_array($vars['backers'])) {
	foreach($vars['backers'] as $backer){
		$backers_icon=elgg_view_entity_icon($backer,'medium',array('class'=>'pas'));
		echo $backers_icon;
	}
}