<?php
/**
 * contribute page
 *
 * @package Elggprojects
 */


		$title = elgg_echo('projects:contribute');
		$offset = (int)get_input('offset', 0);
		$entities = elgg_get_entities(array(
				'type' => 'object',
				'subtype' => 'projects',
		));
		foreach($entities as $entity){
			$e_guid=$entity->guid;
			// only for projects in open status
			if(elgg_trigger_plugin_hook('project:status', 'all',array('guid'=>$e_guid),'1')!="2"){
				$guids[]=$e_guid;
			}
		}
		
		
		$selected_tab = get_input('filter','task');
		switch ($selected_tab) {
			case 'task':
			default:
				$content=elgg_view('contribute/task',array('guids'=>$guids));
				break;
			case 'team':
				$content=elgg_view('contribute/team',array('guids'=>$guids));
				break;
			case 'facility':
				$content=elgg_view('contribute/facility',array('guids'=>$guids));
				break;
		}
		// explain the open task and team
	$info="<div class='well well-small muted'>".elgg_echo('explain:task')."</div>";

	$fliter = elgg_view('projects/contribute_menu', array('selected' => $selected_tab));
	$body = elgg_view_layout('ib_two_column', array(
				'ib_content' => $content,
				'ib_filter'=>$info.$fliter,
	));
	
	
echo  elgg_view_page($title, $body,'list');

