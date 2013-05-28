<?php 
/*
 *  Index page 
*
* @package Ib_index
* @author Weipeng Kuang
* @website http://www.creabator.org
*
*/

if (elgg_is_logged_in()) {
	forward('activity');
}


$logo=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/ib_index/graphics/index-logo.png','title'=>elgg_echo('sitename')));

// login form
$login_url = elgg_get_site_url();
if (elgg_get_config('http_login')) {
	$login_url = str_replace("http:", "http:", elgg_get_site_url());
}
$login=elgg_view_form('index-login', array('action' => "{$login_url}action/login"), array('returntoreferer' => TRUE));


$slogan=elgg_echo('slogan');


$explore=elgg_view('output/url',array('href'=>'projects/all','text'=>elgg_echo('Explore'),'class'=>'blue-button','style'=>'padding:10px 15px;font-size:1.4em;'));
$apply=elgg_view('output/url',array('href'=>'register','text'=>elgg_echo('Sign up now !'),'class'=>'green-button','style'=>'padding:10px 15px;font-size:1.4em;'));


$footer=elgg_view('page/elements/footer');

$img_url=elgg_get_site_url().'mod/ib_index/graphics/slide/';

// sponsors 
$img1=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/ib_index/graphics/sponsors/cri.jpeg','alt'=>'Centre for Research and Interdisciplinarity (CRI)','class'=>' h100 bgwhite'));
$img2=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/ib_index/graphics/sponsors/ccl.png','alt'=>'CitizenCyber Lab','class'=>' h100 bgwhite'));
$img3=elgg_view('output/img',array('src'=>elgg_get_site_url().'mod/ib_index/graphics/sponsors/fp7.jpg','alt'=>'European Commission','class'=>' h100 bgwhite'));
$sponsor1=elgg_view('output/url',array('href'=>'http://www.cri-paris.org/','text'=>$img1,'target'=>'blank'));
$sponsor2=elgg_view('output/url',array('href'=>'http://citizencyberlab.com/','text'=>$img2,'target'=>'blank'));
$sponsor3=elgg_view('output/url',array('href'=>'http://cordis.europa.eu/fp7/home_en.html','text'=>$img3,'target'=>'blank'));


// list members
$members=elgg_get_entities_from_metadata(array('type'=>'user','metadata_names'=>'icontime','limit'=>20));
if($members){
	$memberlist="<ul>";
	foreach ($members as $member){
		
		$m_icon=elgg_view_entity_icon($member,'small');
		$memberlist.="<li class='inline-block pas'>{$m_icon}</li>";
	
	}
	$memberlist.="</ul>";
}

// project list module

if(elgg_is_active_plugin('projects')){
	


$project_module=<<<html
	<h2 class="mtm dashed plm" style="color:#666;width:90%">Latest Projects:</h2>
		 <a class="arrow left list_prev"  id="-3" href="#projects" >&lsaquo;</a>
		 <a class="arrow right list_next" id="3" href="#projects" >&rsaquo;</a>
		<div id="projects-slide" class='inline-block' style="width:89%"></div>
html;
$project_list_script=<<<js
<script type="text/javascript">
$(document).ready(function(){
//get projects slides in font page

function ajax_load(number){
elgg.get('/ajax/view/projects/list', {
data: {offset:number},

success: function(data) {
if(data && data !=""){
$('#projects-slide').html(data)
}
},

});
}

ajax_load(0);

$(".list_next").click(function(){
var offset=$(this).attr('id');
ajax_load(offset);

offset=parseInt(offset)+parseInt('3');
$(this).attr('id',offset);

var prev_id=$(".list_prev").attr('id');
$(".list_prev").attr('id',parseInt(prev_id)+parseInt('3'));
});
$(".list_prev").click(function(){
var offset=$(this).attr('id');
if (parseInt(offset)>=0){
ajax_load(offset);
// change id of the prev and next
offset=parseInt(offset)-parseInt('3');
$(this).attr('id',offset);

var next_id=$(".list_next").attr('id');
$(".list_next").attr('id',parseInt(next_id)-parseInt('3'));
}
});

});
</script>
js;

}

$body=<<<html
<div class="w" >
		<div class="wrapper" style="height:80px">
		<div id="index-logo"  >
		$logo
		</div>
		<div id='slogan' class="pas">
			$slogan
	
		</div>
		</div>
		
	<div class='bgwhite w ptl pbm' style="height:auto;min-height:540px ">	
		<div class=" pal  mtl " id="index_tagline" ><div class='wrapper'>A collaboration platform to incubate innovative projects.</div></div>
	<div class="wrapper">
		<div id="index-slide">
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<a href="" title="Where are my resources?" ><img src=$img_url/slide1.jpg width="560" height="315" ></a>
						<div class="caption" style="bottom:0">
							<p class="center">Where to find my resources to develop my idea ?</p>
						</div>
					</div>
					<div class="slide">
						<a href="" title="Creabator helps you find your team." ><img src=$img_url/slide2.jpg width="560" height="315" "></a>
						<div class="caption">
							<p class="center">Creabator helps you find your team.</p>
						</div>
					</div>
				
					<div class="slide">
						<a href="" title="Creabator helps you get facilities." ><img src=$img_url/slide3.jpg width="560" height="315" ></a>
						<div class="caption">
							<p class="center">Creabator helps you get facilities.</p>
						</div>
					</div>
					
					<div class="slide">
						<a href="" title="Creabator helps you collect money." ><img src=$img_url/slide4.jpg width="560" height="315" ></a>
						<div class="caption">
							<p class="center">Creabator helps you collect money.</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://www.creabator.org/register" title="Join Us Now" ><img src=$img_url/slide5.jpg width="560" height="315" ></a>
						<div class="caption">
							<p class="center">Let's innovate together!</p>
						</div>
					</div>
					
				</div>
				<a href="#" class="prev"><img src=$img_url/arrow-prev.png width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src=$img_url/arrow-next.png width="24" height="43" alt="Arrow Next"></a>
		
			</div>
			<img src=$img_url/example-frame.png width="728" height="390" id="frame">
		</div>
		<div class="fl w300 " id="index-login">
		 $login
		 
		 <div  >
		 $explore
			$apply
		</div>
		
		</div>
			<div class="clearfloat"></div>	
 	
		$project_module
	
		<div class="clearfloat"></div>
		   <h2 class="mtm dashed plm" style="color:#666;width:90%" >Latest Users：</h2>
		$memberlist 
		
		
	</div> 		
	</div>
	
		
		<div class="clearfloat"></div>
      
			<div  class="wrapper">
			
		
		<h2 style="color:white" >Sponsors</h2>
			<ul class="elgg-col-2of3 pam">
			<li class="inline-block grey pas mrm" >$sponsor1</li>
			<li class="inline-block grey pas" >$sponsor2</li>
			<li class="inline-block grey pas" >$sponsor3</li>
			</ul>
			
			</div>
			$footer
		
</div>	
$project_list_script
html;


echo elgg_view_page($title,$body,'index');
?>