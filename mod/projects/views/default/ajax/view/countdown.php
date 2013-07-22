<?php 
$guid=get_input('guid');
$project=get_entity($guid);


elgg_load_library('elgg:projects');;

$remain_day=remain_days($project);
$remain_day_sub=elgg_echo('remain:sub');
$goal=$project->fund_amt;

$title="<h3><span class='prm'>Goal:</span>{$goal}<span class='plm'>($)</span></h3>";
$backup=elgg_view('output/url',array('href'=> $site_url.'projects/backup/'.$guid,'is_trusted' => true,'text'=>'Backup','class'=>'green-button w','style'=>'margin-left:-11px'));

$count_down=<<<html
<div class="pam center">
<div class="f3 mbl">$remain_day</div>
$remain_day_sub
<br>
$backup
</div>
html;
$count_down=elgg_view_module('aside',$title, $count_down,array('class'=>'mtm'));
echo $count_down;


?>