<?php
/*get unread messges*/
function ajax_get_unread_messages(){
	$guid=get_input('owner_guid');
	
	$num_messages = (int)messages_count_unread();
	if ($num_messages != 0) {
		$list = elgg_list_entities_from_metadata(array(
				'type' => 'object',
				'subtype' => 'messages',
				'metadata_name_value_pairs' => array(
						'toId' =>$guid,
						'readYet' => 0,
				),
				'owner_guid' => $guid,
				'full_view' => false,
				'pagination' => false,
				'limit'=>5,
		));
	}else{
		$list=elgg_echo('messages:nomessages');
	}
	
	return $list;
	
}

/* get all updates*/
function ajax_get_all_rivers(){
	$offset=get_input('offset');
	$river_number=elgg_get_river(array('count'=>true));
	if($offset >= $river_number){
	 return "You have reach the end.";
	}	
	$river =elgg_list_river(array('limit'=>'10','offset'=>$offset,'pagination'=>false));

	return $river;
	
}


/* get my projects' update*/
function ajax_get_projects_update(){
	$guid=get_input('guid');
	$projects=elgg_get_entities_from_relationship(array(
			'type'=>'object',
			'subtype'=>'project',
			'relationship'=>'member',
			'inverse_relationship'=>FALSE,
			'relationship_guid'=>$guid,
	));
	foreach($projects as $project){
		$blogs_entities=elgg_get_entities(array('type'=>'object','subtype'=>'blogs','container_guid'=>$project->getGUID()));
		foreach($blogs_entities as $blog){
			$blogs_guids[] .=$blog->getGUID();
		}
		
	  }
	
	$river =elgg_list_river(array(
			'object_guids'=>$blogs_guids,
			'type'=>'object',
			'subtype'=>'blogs',
			'pagenation'=>true,
			'limit'=>15
	));
	
	return $river;
}

function ajax_get_follow_update(){
	$guid=get_input('guid');
	$river=elgg_list_river(array(
			'relationship'=>'friend',
			'relationship_guid'=>$guid,
			'pagenation'=>true,
			'limit'=>15
	));
	return $river;
}

/* ajax search */
function ajax_get_search_result() {
	$query = stripslashes(get_input('q'));
	$display_query = preg_replace("/[^\x01-\x7F]/", "", $query);
	if (function_exists('mb_convert_encoding')) {
	$display_query = mb_convert_encoding($query, 'HTML-ENTITIES', 'UTF-8');
	} else {
	// if no mbstring extension, we just strip characters
	$display_query = preg_replace("/[^\x01-\x7F]/", "", $query);
	}
	$display_query = htmlspecialchars($display_query, ENT_QUOTES, 'UTF-8', false);
	
	if (!$query) {
		return  elgg_echo('search:no_query');
	}
	$params = array(
			'query' => $query,
			'offset' => 0,
			'limit' => 5,
			'sort' => 'alpha',
			'order' => 'desc',
			'search_type' => 'entities',
			'type' => 'object',
			'subtype' => 'projects',
			'pagination' =>false,
			'view_type'=>'ajax',
	);
	$results_html = '';
	$current_params = $params;
	$current_params['search_type'] = 'entities';
	$current_params['subtype'] = 'projects';
	$current_params['type'] = 'object';
	$type='object';
	$subtype='projects';
	
	$db_prefix = elgg_get_config('dbprefix');
	
	$join = "JOIN {$db_prefix}objects_entity oe ON e.guid = oe.guid";
	$params['joins'] = array($join);
	$fields = array('title', 'description');
	
	$where = search_get_where_sql('oe', $fields, $params, FALSE);
	
	$params['wheres'] = array($where);
	$params['count'] = TRUE;
	$count = elgg_get_entities($params);
	
	// no need to continue if nothing here.
	if (!$count) {
		return array('entities' => array(), 'count' => $count);
	}
	
	$params['count'] = FALSE;
	$entities = elgg_get_entities($params);
	
	// add the volatile data for why these entities have been returned.
	foreach ($entities as $entity) {
		$title = search_get_highlighted_relevant_substrings($entity->title, $params['query']);
		$entity->setVolatileData('search_matched_title', $title);
	
		$desc = search_get_highlighted_relevant_substrings($entity->description, $params['query']);
		$entity->setVolatileData('search_matched_description', $desc);
	}
	
	$results=array(
			'entities' => $entities,
			'count' => $count,
	);
		
	
	if ($results === FALSE) {
		
		continue;
	}
	if (is_array($results['entities']) && $results['count']) {
					
						$results_html .= elgg_view('search/ajax_list', array(
							'results' => $results,
							'params' => $current_params,
						));
					
				}
	$searched_words = search_remove_ignored_words($display_query, 'array');
	$highlighted_query = search_highlight_words($searched_words, $display_query);
	$body = elgg_echo('search:results', array("\"$highlighted_query\""));
	
	if (!$results_html) {
		$body .= elgg_view('search/no_results');
	} else {
		$body .= $results_html;
	}
	
	$layout = elgg_view('search/layout', array('params' => $params, 'body' => $body));
	return $layout;
	
}
