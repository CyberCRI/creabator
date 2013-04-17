<?php
/**
 * setting basic info 
 */


$fund_exit = elgg_extract('fund_exit', $vars, '');


$guid= get_input('project_guid');
echo elgg_view('input/hidden', array(
	'name' => 'project_guid',
	'value' => $guid,

));



?>


<div class="pam">
	<a href="#" id="test_submit">Submit</a>
	<div id="output"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#test_submit").click(function() {
		
		elgg.action('projects/basic', {
			data: {
				guid:<?php echo $guid ?>,
				test: 1235
			},
			success: function(resultText, success, xhr) {
				elgg.get('/ajax/view/ajax/test', {
					data: {guid:<?php echo $guid ?>},
		      beforeSend:function(XMLHttpRequest)  
		        {  
		    	  $('#output').html("<div class=\"elgg-ajax-loader\"></div>"); 
		            },  
		      success: function(resultText, success, xhr) {
		   	      $('#output').html(resultText);
						},	

				});
			}
		});

		
	
	});
	

	
})
</script>




