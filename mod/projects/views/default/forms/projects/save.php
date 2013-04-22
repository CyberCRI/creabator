<?php
/**
 * Edit / add a project
 *
 * @package projects
 */
$siteurl=elgg_get_site_url();

$title = elgg_extract('title', $vars, '');

$briefdes = elgg_extract('briefdes', $vars, '');
$plan = elgg_extract('plan', $vars, '');
$days = elgg_extract('days', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars,'');
$container_guid = elgg_extract('container_guid', $vars);



$guid = elgg_extract('guid', $vars, null);
$project=get_entity($guid);
if($guid){
	$f_title=elgg_view_title(elgg_echo('projects:edit'));
}

$categories = elgg_view('input/categories', $vars);
$f_cat='';
if ($categories) {
	$f_cat=$categories;
}



?>
<div class=" content  brm ">
	<?php echo $f_title; ?>
	<div class="pam">
	<div class="pbm">Title :</div>
		<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title,'id'=>'title','class'=>'required  elgg-autofocus'));  ?> 
	</div>
		
	<div  class="pam"  >
	<div class="pbm">Brief introduction(remain <span id="bfLen"></span> characters):</div>
		<?php echo elgg_view('input/plaintext', array('name' => 'briefdes', 'value' => $briefdes,'id'=>'brief','class'=>'required p-textarea'));  ?> 
	</div>
	
	
	<div class="pam" >
		Description:<br>
		<?php echo elgg_view('input/longtext', array('name' => 'plan', 'value' => $plan,'id'=>'plan','class'=>'required '));  ?>  
	</div>
	
	<div class="pam">
		Access:	<?php 
		$orgs=elgg_get_entities_from_relationship(array(
			'type'=>'group',
			'subtype'=>'org',
    		'relationship' => 'member',
    		'relationship_guid' => elgg_get_logged_in_user_guid(),
    		//'inverse_relationship'=>true,
    		));
		$org_options=array();
		$org_options['2']=elgg_echo('Public');
		$org_options['0']=elgg_echo('Draft');
		if($orgs){	
			foreach ($orgs as $org){
				$org_options[$org->guid]="Org:{$org->name}";
				
			}
		}
		
		echo elgg_view('input/access', array('name' => 'vis', 'value' => $access_id, 'class'=>'required w200 ','options_values' =>$org_options));  ?> 
		
		
		<blockquote class="mtm">If you want to create projects that only visiable for your organization, please choose <b>Org:example</b>.</blockquote>
	</div>
	
	<div  class="pam" >
	Category:<div style="display:inline-block;width:500px;margin-left:20px"><?php echo $f_cat  ?></div> 
	</div>
	<div  class="pam" >
	Tags:<div style="display:inline-block;width:300px;margin-left:20px;margin-right:20px"><?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags,'class'=>'required'));?></div>(comma-separated).
 	</div>

<h3 class="pam" > All field are required.</h3>
	<div class="elgg-foot">
		<?php
		
		echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

		if ($guid) {
		echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
		}
	
		?>
	</div>
		<div class="pam">
  			<?php echo elgg_view('input/submit', array('value' => elgg_echo("Submit"),'class'=>'green-button pll prl ptm pbm f1h ','id'=>'sub'));?>
       </div>          
    
  </div>       

		
<script type="text/javascript">
$(function(){
    $('form :input').blur(function(){
		 var $parent = $(this).parent();
		 $parent.find(".formtips").remove();
		
		 if( $(this).is('#title') ){
				if(this.value.length > 50 ){
				    var errorMsg = 'Limit 50 characters';
                 $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
				}
		 }if( $(this).is('#amount') ){
				if(this.value!="" && !/^[0-9]*[1-9][0-9]*$/.test(this.value)){
				    var errorMsg = 'Numbers';
				    $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
				}
		 }
		 if( $(this).is('#tagline') ){
				if( this.value.length > 50 ){
				    var errorMsg = 'Limit 50 characters';
              $parent.append('<div class="formtips onError">'+errorMsg+'</div>');
				}
		 }
	
		 
		 if( $(this).is('.p-textarea') ){
				if( this.value=="" || this.value.length < 20 ){
				    var errorMsg = 'At least 20 characters';
              $parent.append('<span  class="formtips onError clearfix">'+errorMsg+'</span>');
				}
		 }
	}).keyup(function(){
	   $(this).triggerHandler("blur");
	}).focus(function(){
  	   $(this).triggerHandler("blur");
	});
    $('#sub').click(function(){
		$("form :input.required").trigger('blur');
		var numError = $('form .onError').length;
		if(numError){
			alert("Please recheck and fill up the required info!");
			return false;
			
		} 
		
 });
	

})

</script>

<script type="text/javascript">
$(function(){
var max_len = 140;
$("#bfLen").text(max_len - $("#brief").val().length);
$("#brief").bind('change ' + ($.browser.msie ? "propertychange" : "input"), function(event){
        var val = $.trim($(this).val()), len = val.length;
        if(len > max_len)
        {
            $(this).val(val.substr(0, max_len));
        }
        else
        {
            $("#bfLen").text(max_len - len);
        }
    });
	
})


</script>