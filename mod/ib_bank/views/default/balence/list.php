<?php 
$user_id=$vars['user_id'];
 $income_bills=elgg_get_entities(array(
		'type'=>'object',
		'subtype'=>'income_bill',
		'owner_guid'=>$user_id,
		));
if($income_bills){
	foreach($income_bills as $income_bill){
		$time=$income_bill->time_created;
		$title=elgg_echo('Deposit');
		$amt="+".$income_bill->amt;
		$bills[]=array('time'=>$time,'title'=>$title,'amt'=>$amt);
	}
}

$intra_bills=elgg_get_entities(array(
		'type'=>'object',
		'subtype'=>'intra_bill',
		'owner_guid'=>$user_id,
		));
if($intra_bills){
	foreach($intra_bills as $intra_bill){
		$time=$intra_bill->time_created;
		$project=get_entity($intra_bill->project_id);
		$title=elgg_echo('Backup Project:').$project->title;
		$amt="-".$intra_bill->amt;
		$bills[]=array('time'=>$time,'title'=>$title,'amt'=>$amt);
	}
}
function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


array_sort_by_column($bills, 'time');

if($bills){
	echo "<ul>";
	foreach ($bills as $bill){
		echo "<li class='dashed'><div class='inline-block elgg-col-1of4'>";
		echo elgg_get_friendly_time($bill['time']);
		echo "</div>";
		echo "<div class='inline-block elgg-col-1of2'>";
		echo $bill['title'];
		echo "</div>";
		echo "<div class='inline-block elgg-col-1of4'>";
		echo $bill['amt'];
		echo "</div>";
		echo "</li>";
	}
	echo "</ul>";
}else{
	echo "<div class='pal'><h3>";
	echo "No bill now,try to deposit some money here";
	echo "</h3></div>";
} 








?>