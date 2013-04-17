<?php
$title="Help center";
$site_url=elgg_get_site_url();

$content=<<<HTML
<h3>Introduction Page</h3>
<div class="index-sprite bx mal" style="background-position:0 -1228px;height:135px;width:240px;"></div> 
<p>When you enter the site, a welcoming page will appear to you, showing slides presenting different projects hosted in the site.</p>
<p>You will have the possibility to sign in, to log in, or if you just want to visit the website, you can click on discover more to discover a new world of ideas and innovative concepts.</p>

<h3>Main Menu</h3>	
<div class="index-sprite bx mal" style="background-position:0 -1373px;height:135px;width:240px;"></div>	 
<p>Here is the main menu, where you can access to the differents parts of the website. 
It adds an interactive part to the concept, symbol of the vivacity and relationship in ideas.</p>
<h3>List of Projects</h3>
<div class="index-sprite bx mal" style="background-position:0 -1518px;height:135px;width:240px;"></div> 
<p>When you have chosen a categorie, a list of projects is presented to you in a more classic way.</p>
		
<h3>Backers</h3>
<div class="index-sprite bx mal" style="background-position:0 -1734px;height:140px;width:240px;"></div> 
 
<p>You can see all the people who participate in anyway to the project,and in the dedicated page you can see in which part they are involved in,but not the pourcentage they did, as it would make people feel pressure.
</p>

<h3>Project main page</h3>
 <div class="index-sprite bx mal" style="background-position:0 -1883px;height:250px;width:240px;"></div> 
 
<p>This is an example of main project with pictures,video,the profile of creator of the project, and the others.
	</p> 
<h3> Required proccess</h3>
<div class="index-sprite bx mal" style="background-position:0 -2143px;height:60px;width:220px;"></div> 
In any presentation of the project we can see the advancement of the different required elements of the projects,which participation might be rewarded.These items are divided into 3 kinds:
<ul>
<li>Money: money donation</li>
<li>Team: the project need your specific skill and your time. </li>
<li>Facility: Donation or Generous and interestes rent of places, machines, specific facility.</li>
</ul>

HTML;
$body=elgg_view_layout('ib_help',array('help_content'=>$content));

echo elgg_view_page($title,$body);
?>