<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'ib_bank_init');

function ib_bank_init() {
	
	// Register an action for cancel to pay project without enough money
	$base_dir = elgg_get_plugins_path() . 'ib_bank/actions/bank';
	elgg_register_action('bank/cancel',"$base_dir/cancel.php");
	
	// Extend the main CSS file
	elgg_extend_view('css/elgg', 'ib_bank/css');

	elgg_register_page_handler('bank', 'bank_page_handler');
	
	//register lib
	$root = dirname(__FILE__);
	elgg_register_library('elgg:bank', "$root/lib/bank.php");
	
	
	
}

function bank_page_handler($page)
{
	elgg_load_library('elgg:bank');

	$pages = dirname(__FILE__) . '/pages/bank';

	switch ($page[0]) {
		case "deposit":
			set_input('user_name',$page[1]);
			
			include "$pages/deposit.php";
		    break;
		case "withdraw":
			set_input('user_id',$page[1]);
			include "$pages/withdraw.php";
			break;
		case "balence":
			set_input('user_name',$page[1]);
			include "$pages/balence.php";
			break;
		default:
			return false;
}


return true;
}
