<?php 
/*
 *  Deposit money from Paypal
 * 
 */
gatekeeper();
$user_name=get_input('user_name');
$user=get_user_by_username($user_name);
$user_id=$user->guid;
if(elgg_get_logged_in_user_guid()!=$user_id){
	forward('projects/all');
	register_error('no permission');
}

$current=$user->bank;
if(!$current){
$current=0;
}
$title=elgg_echo("deposit:title",array($current));
// set breadcrumb
elgg_push_breadcrumb(elgg_echo('balence:title'), 'bank/balence/'.$user->username);
elgg_push_breadcrumb(elgg_echo("Deposit"));

$d_title=elgg_view_title($title,array('class'=>'elgg-divide-bottom  mbl'));

$checkouturl=elgg_get_site_url().'paypal/checkout.php';
$item_name=elgg_echo('deposit:item_name');
$attention=elgg_echo('deposit:attention');
$ip_info_title=elgg_view_title(elgg_echo('deposit:important'),array('class'=>'dashed pam'));
$link=elgg_view('output/url',array('href'=>'https://www.paypal.com/webapps/mpp/paypal-fees','text'=>'Palpal Fees','target'=>'blank'));		
$ip_info=elgg_echo('deposit:important:content',array($link));

// check if there is the session of last pay
if(isset($_SESSION['last_to_pay_amt']) && isset($_SESSION['last_to_pay_project']) && isset($_SESSION['last_to_pay_user'])){
	$amt_goal=$_SESSION['last_to_pay_amt'];
	$project_id=$_SESSION['last_to_pay_project'];
	$project=get_entity($project_id);
	$project_link=elgg_view('output/url',array(
			'href'=>$project->getURL(),
			'text'=>$project->title,
	        'target'=>'blank',
			));
	
	$gap=$amt_goal-$current;
	$cancel=elgg_view('output/url',array(
			'href'=>'action/bank/cancel',
			'text'=>'Cancel to pay',
			'is_action'=>true,
			'class'=>'pas elgg-button elgg-button-submit'
			));
	
$to_pay=<<<html
<div class="pam brs" style="background:#9c6">
It's better for you to pay more than <span style="font-size:1.5em"> $gap </span> dollars  to finish the payment of this project:<br>
$project_link. If you want to cancel this bill,click $cancel.
</div>
html;
	
}

$content=<<<html

$d_title
$to_pay
<div class="elgg-col-2of3 grey fl">
	<div class="mll  brm pal">
		<form action="$checkouturl" METHOD='POST'>
			<h1 class="mbl">Enter Deposit Amount:</h1>
	
			<div class="fl f3 mtl w50 " style="line-height:0">
			$
			</div>
			<input type="text" name="all_amt"   class='fl f2 w200 mrl' value='10' >
			<input type="hidden" name="user_id"  value="$user_id"  >
			<input type="hidden" name="item_name" value="$item_name" >
			<input type='image' name='paypal_submit' id='paypal_submit'  src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border='0' align='top' style="width:180px" alt='Pay with PayPal'/>
		</form>
		<div class="mtm">
		<p>$attention</p>
		</div>
		
	</div>
</div>
<div class="elgg-col-1of3 fl">
<div class="pam">
$ip_info_title
<p>$ip_info</p>
</div>
</div>


<script src='https://www.paypalobjects.com/js/external/dg.js' type='text/javascript'></script>


<script>

	var dg = new PAYPAL.apps.DGFlow(
	{
		trigger: 'paypal_submit',
		expType: 'instant'
	
	});

	
	
</script>

html;




$body=elgg_view_layout('home_two_column',array('content'=>$content));
echo elgg_view_page($title, $body);

?>