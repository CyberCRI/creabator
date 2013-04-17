<?php
/**
 * Main project content area layout
 *
 * @uses $vars['ib_content']        HTML of main content area
 * @uses $vars['ib_sidebar']        HTML of the sidebar
 * @uses $vars['nav']            HTML of the content area nav (override)
 * @uses $vars['ib_guid']         GUID of the project
 */

//load the lightbox js
elgg_load_js('lightbox');
elgg_load_css('lightbox');

$guid=$vars['ib_guid'];
$project = get_entity($guid);
$title = elgg_view('output/url', array(
		'text' => $project->title,
		'href' => $project->getURL(),
		'is_trusted' => true,));
$site_url = elgg_get_site_url();

// buttons(backup,join&lend)
$backup_link = $site_url.'projects/backup/'.$guid;
$backup=elgg_view('output/url', array(
		'href' => $backup_link,
		'text' => "Backup",
		'is_trusted' => true,
		'title'=>"Donate this project",
		'style'=>"width:60px;text-align:center;padding:1px 12px",
		'class'=>"index-button elgg-lightbox",
	));
$join_link = $site_url.'projects/apply/'.$guid;
$join=elgg_view('output/url', array(
		'href' => $join_link,
		'text' => "Join",
		'is_trusted' => true,
		'title'=>"Join this team",
		'style'=>"width:60px;text-align:center;padding:1px 12px",
		'class'=>"index-button elgg-lightbox",
	));
$facility_link =$site_url.'projects/lend/'.$guid;
$facility=elgg_view('output/url', array(
		'href' => $facility_link,
		'text' => "Lend",
		'is_trusted' => true,
		'title'=>"Lend facility to this project",
		'style'=>"width:60px;text-align:center;padding:1px 12px",
		'class'=>"index-button elgg-lightbox",
	));
$setting_link=$site_url.'projects/setting/'.$guid;
$t_proccess=$project->t_state;
$f_proccess=$project->f_state;
$m_bp_total = $project->getAnnotationsSum('m_state');
$total_money=$project->rqmoney;
$m_proccess=number_format(($m_bp_total/$total_money)*100);
$update_text=$project->getAnnotations('p_update');
$update=elgg_view("output/longtext", array("value" =>$update_text->value));

// nav for blogs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));


// approve link
$activated='';
	if (elgg_is_admin_logged_in()) {
		if ($project->access_id =='0'   ) {
			$url = "action/projects/approve?project_guid={$project->guid}&action_type=activated";
			$text = elgg_echo("Activated");
		} else {
			$url = "action/projects/approve?project_guid={$project->guid}&action_type=desactivated";
			$text = elgg_echo("Desactivated");
		}
		$activated=elgg_view('output/url',array('href'=>$url,'text'=>$text,'is_action' => true));

	}

$warning='';
if($project->access_id =='0' ){
$warning=<<<HTML
<div style="background: #e60;color:white;border-radius:10px;width:600px;padding:2px 5px;">
Congratulations! Your project has been successfully submitted. Please wait for the Committee to activate it. Thanks for your patience.</div>
HTML;
}
if (isset($vars['ib_content'])) {
				$ibcontent=$vars['ib_content'];
			}

if (isset($vars['ib_sidebar'])) {
				$ibsidebar=$vars['ib_sidebar'];
			}

$featured_projects = elgg_list_entities_from_metadata(array(
	'metadata_names' => 'featured_project',
	'metadata_values' => 'yes',
	'type' => 'object',
	'subtype' => 'projects',
	'limit' => 6,
	'full_view' => false,
	'list_type'=>'gallery',
	'view_toggle_type' => false,
	
	'item_class'=>'project-gallery-item',
));
//backer list
$m_states = elgg_get_annotations(array(
	'guid' => $guid,
	'annotation_name' => 'm_state',
	'limit' => 20,
	'order_by' => 'n_table.time_created desc'
));
$backers="";
// delete the default 0 value
foreach ($m_states as $mst){

	$mstvs[] .=$mst->value;

}
$mstnum=array_search("0",$mstvs);
array_splice($m_states,$mstnum,1);
$num=count($m_states);
if($m_states){
$states_list=elgg_view_annotation_list($m_states);

$backers=<<<HTML
<div class="sidebar-box">
<h3 class="dashed">Backers:$num</h3>
$states_list
</div>
HTML;
}
$sidebar =<<<HTML
 <div class="sidebar-box">



		 	<div style="display:inline-block;width:63%;margin-left:5px;"class="progress-bar money blue shine ">
    		
				<span style="width: $m_proccess%">Money:$m_proccess%</span>
		</div>
		<div class="backup-title">
		 	$backup
		 	</div>
		 	 <div style="display:inline-block;width:63%;margin-left:5px;" class="progress-bar team green shine ">
    			<span style="width: $t_proccess%">Team:$t_proccess%</span>
			</div>
			<div class="backup-title">
		 	$join
		 	</div>

		 	 <div style="display:inline-block;width:63%;margin-left:5px;" class="progress-bar facility orange shine ">
		 	 	<span style="width:$f_proccess%;" >Facility:$f_proccess%</span>
		 	 </div>
		 	 <div class="backup-title">
		 	$facility
		 	</div>

</div>
$backers
 <div class="sidebar-box">
    <h3 class="dashed">
    Recommended Projects
    </h3>

	$featured_projects

    </div>

HTML;
//setting display or not
if (elgg_is_logged_in() & elgg_get_logged_in_user_guid() == $project ->owner_guid){
	$style="";
}else{
$style="display:none;";
}

// menu tab

$ptabs=array(

	'Settings' => array(
		'text' => elgg_echo('Settings'),
		'href' => 'projects/setting/'.$guid,
		'priority' => 600,
	),
	'Discussion' => array(
		'text' => elgg_echo('Blogs'),
		'href' => 'projects/blogs/all/'.$guid,
		'priority' => 500,
	),
	'Updates' => array(
		'text' =>elgg_echo('Updates'),
		'href' => 'projects/updates/'.$guid,
		'priority' => 400,
	),

	'Required' => array(
		'text' =>elgg_echo('Required'),
		'href' => 'projects/required/'.$guid,
		'priority' => 300,

	),
	'Home' => array(
		'text' =>elgg_echo('Home'),
		'href' => $project->getURL(),
		'priority' => 200,

	),

);


foreach ($ptabs as $name => $ptab) {
	$ptab['name'] = $name;

	elgg_register_menu_item('ptabs', $ptab);
}

$menu=elgg_view_menu('ptabs',array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));



$body =<<<HTML
<div id="chead">
$activated
$warning
      <div class="headtitle">
         <h1>$title</h1>
      </div>


$menu


</div>

<div class="content">
$nav
$ibcontent
 </div>
 $sidebar

$ibsidebar

HTML;


echo $body;
?>

<style type="text/css">
li.elgg-menu-item-settings{
	<?php echo $style ?>;
}
</style>
