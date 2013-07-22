<?php 
$user_id=$vars['user_id'];
$user=get_user($user_id);

$deposit=elgg_view('output/url',array(
		'href'=>'bank/deposit/'.$user->username,
		'text'=>elgg_echo('Deposit'),
		'class'=>'elgg-button elgg-button-submit pas',
		));

$title=elgg_echo('Balence:');

$banlence=$user->bank;


?>
<div class="pam ">
	<div class="inline-block elgg-col-1of3">
		<h2 ><span class="mrm" style="color:#666"><?php echo $title ?></span><?php echo $banlence ?></h2>
	</div>
	<div class="inline-block  elgg-col-1of3">
		<span class="mrm"><?php echo $deposit;?></span>
	</div>
</div>
<div class="elgg-divide-bottom"></div>