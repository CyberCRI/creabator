<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'cb_api_init');

function cb_api_init() {
	
	
}

// universe for getting a group of entity with server metadata returns
function get_custom_entities($array,$metadata){	
		if($array['metadata_names']){
			$entities=elgg_get_entities_from_metadata($array);
		}elseif($array['annotation_names']){
			$entities=elgg_get_entities_from_annotations($array);
		}else{
			$entities=elgg_get_entities($array);
		}
	
		
		if($entities){
			$metadata=json_decode($metadata);
			// eg. $metadata=["test1","test2","test3"];
			foreach($entities as $entity){
				$export = new stdClass;
					$i=0;
					while($i<sizeof($metadata)){
						switch ($metadata[$i]){
							case "icon_tiny":
								$export->icon_tiny=$entity->getIconURL('tiny');
								break;
							case "icon_small":
								$export->icon_small=$entity->getIconURL('small');
								break;
							case "icon_medium":
								$export->icon_medium=$entity->getIconURL('medium');
								break;
							case "icon_large":
								$export->icon_large=$entity->getIconURL('large');
								break;
								// get icon url
							case "icon_master":
								$export->icon_master=$entity->getIconURL('master');
								break;
								// customize for jizhi
							case "owner_name":
								$export->owner_name=$entity->getOwnerEntity()->username;
								break;
				
							default:
								$export->$metadata[$i]=$entity->$metadata[$i];
						}
				
						$i++;
					}
			
		   $data[]=$export;
		}
			return json_encode($data);
		}
		return false;
}

expose_function('cb_entities.getCustom',
		"get_custom_entities",
		array('array'=>array('type'=>'array'),
			  'metadata'=>array('type'=>'string',
			  		'required'=>false)
				),
		"get entities with custom metadata",
		'GET',
		true,
		false
);

/*
*  Create an universe api for each object, group, entity, user, etc.
*/
// create object (include entitiy, metadata and annotation relationship etc)

function cb_create_entity(){
	// user Post method to get data
	$postdata = get_post_data();	
	
	
		if($postdata){
			$entity=json_decode($postdata);
			$guid=$entity->guid;
			switch ($entity->type){
				case "object":
					if($guid){
						$object=get_entity($guid);
						if(!elgg_instanceof($object,'object')){
							return json_encode(array('error'=>'guid not exsit'));
						}
					}else{
						$object=new ElggObject();
						if($entity->subtype){
						$object->subtype=$entity->subtype;
						}
						if(!$entity->container_guid){
							$object->container_guid=elgg_get_logged_in_user_guid();
						}
						if(!$entity->owner_guid){
							$object->owner_guid=elgg_get_logged_in_user_guid();
						}

						$new=true;
					}
					// acess id could change
					if(!$entity->access_id){
						$object->access_id=2;
					}
					
					foreach($entity as $key =>$value){	
						if(!in_array($key, array('type','guid','subtype'))){
						$object->$key=$value;
						}
					}

					if($object->save()){
						return json_encode(array('guid'=>$object->guid));

					}else{
						return json_encode(array('error'=>'could not save.'));
					}
					break;
				case "group" :
					if($guid){
						$object=get_entity($guid);
						if(!elgg_instanceof($object,'group')){
							return json_encode(array('error'=>'guid not exsit'));
						}
					}else{
						$object=new ElggGroup();
						// @todo check if the server exsit, if exsit ,couldn't save
						$object->name=$entity->name;
						
						if($entity->subtype){
						$object->subtype=$entity->subtype;
						}
						if(!$entity->container_guid){
							$object->container_guid=elgg_get_logged_in_user_guid();
						}
						if(!$entity->owner_guid){
							$object->owner_guid=elgg_get_logged_in_user_guid();
						}

						$new=true;
					}
					// acess id could change
					if(!$entity->access_id){
						$object->access_id=2;
					}
				
					
					foreach($entity as $key =>$value){
						if(!in_array($key, array('type','guid','name','subtype'))){	
							$object->$key=$value;
						}
					}
				
					if($object->save()){
						
						return json_encode(array('guid'=>$object->guid));

					}else{
						return json_encode(array('error'=>'could not save.'));
					}


					break;
				default:		
				register_error('type not exsit.');
				return false;
			}


		}else{
		
			register_error('entity could not by empty');
			return false;
		}
	
}


expose_function('cb_entity.create',
		"cb_create_entity",
		'',
		" Create and entity object/group",
		'POST',
		true,
		true
);

/*
 *  User CURD
*/

// get user by username

function cb_get_user($username){
	$user=get_user_by_username($username);
	if($user){
	// 	@todo return the whole user entity
	  
	 return json_encode($user->guid);
		
	}

}
expose_function('cbuser.getbyusername',
		"cb_get_user",
		array('username'=>array('type'=>'string')),
		" get user by username",
		'GET',
		true,
		false
);


// get entity & custimize metadata
function cb_get_entity($guid,$metadata){
	
	$entity=get_entity($guid);
	if(elgg_instanceof($entity)){
		$export = new stdClass;
		if($metadata){
			$metadata=json_decode($metadata);
			// eg. $metadata=["test1","test2","test3"];
			$i=0;
			while($i<sizeof($metadata)){
				switch ($metadata[$i]){
					case "icon_tiny":
					$export->icon_tiny=$entity->getIconURL('tiny');
						break;
					case "icon_small":
						$export->icon_small=$entity->getIconURL('small');
						break;
					case "icon_medium":
						$export->icon_medium=$entity->getIconURL('medium');
						break;
					case "icon_large":
						$export->icon_large=$entity->getIconURL('large');
						break;
					// get icon url
					case "icon_master":
						$export->icon_master=$entity->getIconURL('master');
						break;

					default:
						$export->$metadata[$i]=$entity->$metadata[$i];
				}
				
				$i++;
			}
		
		}
	
		return json_encode($export);
		
	}
	
		// syetem message
		register_error('not entity');
		return false;
	
}

expose_function('cb_entity.get',
		"cb_get_entity",
		array('guid'=>array('type'=>'string'),
			 'metadata'=>array('type'=>'string'),
		),
		" get entity with cusomize variables",
		'GET',
		true,
		false
);

// delete entity
function del_entity($guid){
	$entity=get_entity($guid);
	if(elgg_instanceof($entity)){
		if($entity->delete()){
			system_message("delete failed");
			return true;
		}else{
			register_error("delete failed");
			return false;
		}
	}
	
}
expose_function('cb_entity.del',
		"del_entity",
		array('guid'=>array('type'=>'string'),

		),
		" Delete entity",
		'POST',
		true,
		true
);

/*
 *  metadata CURD
*/
// get metadata
function cb_get_metadata($names){
	$array=json_decode($names);
	$entity=get_entity($array->guid);
	if($entity){
		$key=$array->name;
		$metadata=$entity->$key;
		if($metadata){
			return json_encode($metadata);
		}
	}

}
expose_function('cb_metadata.get',
		"cb_get_metadata",
		array('names'=>array('type'=>'string')),
		" get metadata value",
		'GET',
		true,
		false
);

// create single metadata
function cb_create_metadata()
{
	$postdata=get_post_data();
	if(!$postdata){
		register_error("postdata not exsist");
		return false;
	}
	$data=json_decode($postdata);
	$guid=$data->guid;
	$entity=get_entity($guid);
	if(elgg_instanceof($entity)&&$entity->canEdit()){
		foreach($data as $key=>$value){
			if($key!='guid'){
				$entity->$key=$value;
			}
		}
		$entity->save();
		system_message("save success.");
		return true;
	}
	register_error("guid is not valid");
	return false;
}
expose_function('cb_metadata.create',
		"cb_create_metadata",
		'',
		" Create metadata value",
		'POST',
		true,
		true
);


/* tags 
 *  get poppular tags
 */
function get_entity_tags($array,$tagsname){
	if($tagsname){
		$array['tag_names']=$tagsname;
	}

	return json_encode(elgg_get_tags($array));
}

expose_function('entity_tags.get',
		"get_entity_tags",
		array('array'=>array('type'=>'array'),
			'tag_names'=>array('type'=>'array','required'=>false)),
		" GET pop Tags ",
		'GET',
		true,
		false
);

/*
 *  Message
 */
// create single metadata
function Send_message()
{
	$postdata=get_post_data();
	if(!$postdata){
		return false;
	}
	$data=json_decode($postdata);
	
	$from=$data->from;
	$to=$data->to;
	$subject=$data->subject;
	$message=$data->content;

	
	if($from && $to && $subject && $message){

		if(messages_send($subject,$message,$to,$from)){
			return true;
		}
	}
	
	return false;
	
}
expose_function('cb_message.send',
		"Send_message",
		'',
		" Send message to other user",
		'POST',
		true,
		true
);

function inbox_messages($array)
{
	$msgs=elgg_get_entities_from_metadata($array);
	if($msgs){
		foreach ($msgs as $msg) {
			$export=new stdClass;
			$export->title=$msg->title;
			$export->description=$msg->description;
			$export->time_created=$msg->time_created;
			$from=$msg->fromId;
			$from_user=get_user($from);
			$export->fromUser=$from_user->name;
			$export->fromId=$from; 
			$to=$msg->toId;
			$to_user=get_user($to);
			$export->toUser=$to_user->name;
			$export->toId=$to;
			$data[]=$export;
		}
		
		return json_encode($data);
	}
	return false;
}
expose_function('cb_inbox_message.get',
		"inbox_messages",
		array('array'=>array('type'=>'array')),
		" Get inbox messages",
		'GET',
		true,
		true
);



/*
 *  Login & Register
 */
// login auth token

function cb_auth_gettoken(){
	$postdata=get_post_data();
	if(!$postdata){
		return false;
	}	
	$data=json_decode($postdata);
	$username=$data->username;
	$password=$data->password;
	$remember=$data->remember;
	$user=get_user_by_username($username);
	if(!$user){
		register_error("Username is not correct.");
	}
	
	$auth=elgg_authenticate($username, $password);
	if (true === $auth) {
		
		if($remember){
			//set expire to one year
			$expire=60*24*365;
		}
		// token expire time one day
		$expire=60*24;
		$token = create_user_token($username,$expire);
		if ($token) {
			$export = new stdClass;
			
			$exportable_values = $user->getExportableValues();
			
			foreach ($exportable_values as $v) {
				$export->$v = $user->$v;
			
			}
			
			$export->url = $user->getURL();
			$export->icon_tiny=$user->getIconURL('tiny');
			$export->icon_large=$user->getIconURL('large');
			$export->token=$token;
			
			return json_encode($export);
			
		}

	}

	throw new SecurityException($error);

}

// The authentication token api
expose_function("cbauth.getLoginUser",
		"cb_auth_gettoken", 
		'',
		"user get token",
		'POST',
		false,
		false);


// logout (the token will expire, so do not needed to tell the server to logout)

function cb_logout(){
	$result=logout();
	if($result){
		
		 return true;
		
	}else{
	  
		return false;
	}
}
expose_function('cb.logout', 'cb_logout',
		array(),
		"logout the current user",
		'GET',
		true,
		false
);
