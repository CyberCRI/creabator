<?php
$title="All Users";
$memberlist=elgg_view_title($title);
$memberlist.=elgg_list_entities(array('type'=>'user','full_view'=>false,'item_class'=>'well well-small span4','limit'=>'10'));
$body=elgg_view_layout('one_column',array('content'=>$memberlist));

echo elgg_view_page($title,$body);