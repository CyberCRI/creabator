<?php
/**
* setting edit page
*
* @package IncubatorProject
*/

$project_guid = get_input('project_guid');
$project = get_entity($project_guid);





$title=elgg_view_title('Basic Info:');
$vars = projects_prepare_form_vars($project);

if(elgg_is_active_plugin('ib_bank')){
$money_button=elgg_view('output/url',array(
		'href'=>'#start',
		'text'=>'Start',
		'id'=>'start',
		'class'=>'green-button pll prl mlm'
		));


$lists= <<<html
<div class="pam dashed" id='getmoney'>
<h3>Start to get money:</h3>
<blockquote>Onece you start, you couldn't change the numbers again</blockquote>
<span >Enter the total money you want to get within 30 days:</span>
<input type="text" id="amount" class="w100" placeholder="Numbers"/><span style="font-size:1.2">$</span>
$money_button

<div class="grey pam brs mas" style="color:red"> Attention: When you started, there will be a 30 days count down for you to get 100% of the money you need.After this, if your failed to get 100%, your project will be frozen and you couldn't continue to get money then.</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#start').click(function(){
	if(confirm('Are you sure to start?')){
	   elgg.action('projects/getmoney', {
			data: {
				project_guid:$project_guid,
				amount:$("#amount").val(),
			},
			success: function(data) {
			 if (data.output.get_money==1){
			   var amount=data.output.amount;
			   $('#getmoney').html(
			    "<h2 class='grey brs pam'><span class='prm'>Goal:</span>"+amount+"<span class='plm'>($)</span></h2>"
			   
			   )  
			  }
			 
			}
	   })
	}

	})
	
})
</script>

html;


// only the long term projects could have change to get money again
	$amount=$project->fund_amt;
	if($amount){
		$lists= "<h2 class='grey brs pam'><span class='prm'>Goal:</span>{$amount}<span class='plm'>($)</span></h2>";
	} 
}

/*
 * Twitter widget
 */
// set the twitter account:

$twitter_name=$project->twitter;
$data_id=$project->twitter_data_id;
$lists .=elgg_view_form('projects/twitter',array(),array('guid'=>$project_guid,'twitter'=>$twitter_name,'data_id'=>$data_id));





$content=elgg_view('projects/settings',array('project_guid'=>$project_guid,'content'=>$lists));

$body = elgg_view_layout('main_project', array(
	'ib_content' => $title.$content,
    'ib_guid'=>$project_guid,
));

echo elgg_view_page(null, $body);
