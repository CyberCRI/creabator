<?php 
$guid=get_input('guid');
$project=get_entity($guid);
// Twitter widget
$twitter_name=$project->twitter;
$data_id=$project->twitter_data_id;
$twitter='';
if($twitter_name && $data_id){
	$twitter=<<<html
	<div class="pts">
	<a class="twitter-timeline" data-dnt=true href="https://twitter.com/$twitter_name" data-widget-id=$data_id>Tweets by @$twitter_name</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
html;
}
echo $twitter;
?>