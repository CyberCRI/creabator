<?php
$title="About Us";
$site_url=elgg_get_site_url();
$backup_name=array('money','team','facility');
foreach($backup_name as $bname){

	$backup_img[] .=elgg_view('output/img', array(
			'src' => 'mod/incubator_theme/graphics/'.$bname.'.png',
			'alt' => 'backup-'.$bname,
			'title' => 'backup-'.$bname,
			'class'=>"mlm w80",
	));


}
$content=<<<HTML

<h3>What's Creabator?</h3>
<p>Creabator is a crowdsourcing platform for pulling together the necessary ingredients for novel science projects: ideas, participants, tools and funding.</p>
<div class="mtl" >
		$backup_img[0]
		$backup_img[1]
		$backup_img[2]
		</div>
<h3>How does Creabator Work ?</h3>
<p>Creabator is different from other crowdfunding platforms because it puts an emphasis on all aspects 
of what makes a successful science project. This includes ideas for how to optimize the project's design. Creabator projects rely on support from participants – both experts and dedicated amateurs – to collect and analyze data. An equally important ingredient is access to scientific tools, ranging from ordinary smartphones to advanced electron microscopes. For Creabator projects, funding is typically a necessary, but not sufficient requirement for success.</p>


HTML;

$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));


echo elgg_view_page($title,$body);
?>