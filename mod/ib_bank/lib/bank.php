<?php 

/*
 * check if this guid belong to a user
 */
function is_system_user($user_id){
	$user=get_entity($user_id);
	if(elgg_instanceof($user,'user')){
		return true;
	}
	return false;
}

/*
 * check if this guid belong to a system projects
*/
function is_system_project($project_guid){
	$project=get_entity($project_guid);
	if(elgg_instanceof($project,'object','projects')){
		return true;
	}
	return false;
}


/*
 * check token in case create more then one same bills
 * @param $token
 */
function has_this_token($token){
	$strSql = mysql_query("select string from {$CONFIG->dbprefix}metastrings where string ='$token'");
	$line = mysql_fetch_array($strSql,MYSQL_ASSOC);
	
	if($line['string']){
		return true;
	}else{
		return false;
	}
}

/*
 * add money to creabator bank account
 * 
 * @param $user_id the guid of the user
 * @param $amount the total amount of the money to add
 * @param $token the transaction token from paypal
 */
 function add_money_by_paypal($user_id,$amount,$token){

	if(is_system_user($user_id)){
		
		$bill=new ElggObject();
		$bill->subtype="income_bill";
		$bill->container_guid=$user_id;
		$bill->owner_guid=$user_id;
		$bill->amt=$amount;
		$bill->token=$token;
		if($bill->save()){
			// add money to user account
			$user=get_entity($user_id);
			$amt=$user->bank;
			$user->bank=$amt+$amount;
			
			return true;
		}
	}
	return false;
}

/*
 * @param $user_id the guid of the user
 */
function get_all_income_money($user_id){
	if(is_system_user($user_id)){
		$bills=elgg_get_entities(array(
				'type'=>'object',
				'subtype'=>'income_bill',
				'owner_guid'=>$user_id,
				));
		$total=0;
		foreach ($bills as $bill){
			$amt=$bill->amt;
			$total=$total+$amt;
		}
		return $total;
	}
	return false;
}





//intra_bill 

/*
 * check if user have enough money to pay
* @param $user_id the guid of the payer
* @param $amt the amount to pay
*/
function has_enough_money_to_pay($user_id,$amt){
   if(is_system_user($user_id)){
   	$user=get_entity($user_id);
   	$amount=$user->bank;
   	if($amount>=$amt){
   		return true;
   	}
   }
   return false;
}

/*
 * 
 */



/*
 *  freeze money &update the money into the project
 * @param $user_id the guid of the payer
 * @param $project_guid the guid of thel project
 * @param $amt the amount of the freeze money
 */
function add_money_to_project($user_id,$project_guid,$amt){
	if(is_system_user($user_id)){
		if(is_system_project($project_guid)){
			if (has_enough_money_to_pay($user_id, $amt)){
				
				//creabe an backup bill
				$bill=New ElggObject();
				$bill->subtype="intra_bill";
				$bill->project_id=$project_guid;
				$bill->owner_guid=$user_id;
				$bill->access_id=2;
				$bill->amt=$amt;
				if ($bill->save()){
				// freeze money from user's account
				$user=get_entity($user_id);
				$current_amt=$user->bank;
				$current_amt=$current_amt-$amt;
				$user->bank=$current_amt;
				
				// update money into the project backup
				$project=get_entity($project_guid);
				$project->annotate('m_state', $amt,2,$user_id,'integer');
				add_entity_relationship($user_id, 'mbacker', $project_guid);
				system_message('Pay success!');
				return 1;
				}
			}else{
				// not enough money
			return 2;
			}
			
		}else{
		register_error('not project');
		}
		
	}else{
	register_error('not user');
	}
	return 0;
}


/*
 *  refund money back when the project failed
 *  @param $guid the guid of the project
 */
function refund_money_to_backer($guid){
	if(is_system_project($project_guid)){
		$project=get_entity($guid);
		$bills=elgg_get_entities(array(
				'type'=>'object',
				'subtype'=>'intra_bill',
				'container_guid'=>$guid,
				));
		if ($bills){
			foreach ($bills as $bill){
				$bill_owner_guid=$bill->owner_guid;
				$bill_owner=get_entity($bill_owner_guid);
				$bill_amt=$bill->amt;
				$bill_owner_current=$bill_owner->bank;
				$bill_owner_current=$bill_owner_current+$bill_amt;
				$bill_owner->bank=$bill_owner_current;
				
				//@todo notify the backer of the refund
				
			}
		}
		
	}
	
}


?>