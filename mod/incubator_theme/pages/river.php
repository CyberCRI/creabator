<?php
/**
 * Main activity stream list page
 */
gatekeeper();

$fliter=get_input('fliter');
// load the new guide
$finish_guide=$_COOKIE['finish_guide'];
if($finish_guide!=1){
	elgg_load_js('jquery.newguide');
	elgg_load_css('jquery.newguide');
}

$activity = elgg_list_river(array());
if (!$activity) {
	$activity = elgg_echo('river:none');
}
$t_title1=elgg_echo("river:all");
$t_title2=elgg_echo("river:project");
$t_title3=elgg_echo("river:follow");

$list =<<<html

<div class="elgg-border-plain pam">

<div id="rt0_content"></div>
</div>
html;

switch ($fliter){
	case "project":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"rt1_content\"></div></div>";
		break;
	case "follow":
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"rt2_content\"></div></div>";
		break;
	default:
		$tab_content="<div class=\"elgg-border-plain pam\"><div id=\"rt0_content\"></div><div id='0' class='load_next block elgg-button-submit elgg-button brs grey f1h center pas' >Load Next</div></div>";

}
$menu=elgg_view('incubator_theme/river_menu');
$title=elgg_echo('menu:activity');
$content=<<<html
$menu
$tab_content
html;
$body=elgg_view_layout('home_two_column',array('content'=>$content,'title'=>$title));

echo elgg_view_page($title, $body);

$siteurl=elgg_get_site_url()."mod/incubator_theme/js/setwaterfall.js";
?>
<script type="text/javascript" src="<?php echo $siteurl ?>"></script>
<script type="text/javascript">
$(document).ready(function(){

	var ajax_all_river=function(offset){
		elgg.get('/ib_ajax/rivers',{
			 data:{offset:offset},
		      beforeSend:function(XMLHttpRequest)  
	            {  
		    	  $('#rt0_content').html("<div class=\"elgg-ajax-loader\"></div>"); 
	                },  
		      success: function(data, success, xhr) {
	       	      $('#rt0_content').html(data);
	       	   $("ul.elgg-list-river>li.elgg-item").setwaterfall();
			      
    				}
			 });
		}
	var ajax_project_update=function(){
		elgg.get('/ib_ajax/project_update', {
		      data:{guid:elgg.get_logged_in_user_guid()},
		      beforeSend:function(XMLHttpRequest)  
	            {  
		    	  $('#rt1_content').html("<div class=\"elgg-ajax-loader\"></div>"); 
	                },  
		      success: function(resultText, success, xhr) {
	       	      $('#rt1_content').html(resultText);
	       	   $("ul.elgg-list-river>li.elgg-item").setwaterfall();
    				},
    
			});
		}

	var ajax_follow_update=function(){
		elgg.get('/ib_ajax/follow_update', {
		      data:{guid:elgg.get_logged_in_user_guid()},
		      beforeSend:function(XMLHttpRequest)  
	            {  
		    	  $('#rt2_content').html("<div class=\"elgg-ajax-loader\"></div>"); 
	                },  
		      success: function(resultText, success, xhr) {
	       	      $('#rt2_content').html(resultText);
	       	   $("ul.elgg-list-river>li.elgg-item").setwaterfall();
    				}
			});
		}
	  //get the value from url 
	String.prototype.GetValue= function(para) {  
		  var reg = new RegExp("(^|&)"+ para +"=([^&]*)(&|$)");  
		  var r = this.substr(this.indexOf("\?")+1).match(reg);  
		  if (r!=null) return unescape(r[2]); return null;  
		}  
		var str = location.href;  
		fliter=str.GetValue("fliter");		
	if(fliter=='project'){
		ajax_project_update()
	 	
	}else if (fliter=='follow'){
		ajax_follow_update()
	 
	}else{
	
		ajax_all_river(0);
		}

	//load more function 
	
	$(".load_next").click(function(){
		var offset=$(this).attr('id');
		 offset=eval(offset)+eval('10');	
		 $(this).attr('id',offset);
			ajax_all_river(offset);

		
	 });
	
})

</script>

