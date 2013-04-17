<?php
/*
 * Created on 2012-1-29
 *
 * @WiserIncubator
 * Weipeng Kuang
 */

$guid = elgg_extract('guid', $vars, null);
$project_guid = elgg_extract('project_guid', $vars, '');
$description = elgg_extract('content', $vars, '');
?>
<h3>Update Your Status(Remain <span id="remLen"></span> characters):</h3>
<?php echo elgg_view('input/plaintext', array('name' => 'content','value' => $description,'id'=>'status' )); ?>


<?php

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}
	echo elgg_view('input/hidden', array(
		'name' => 'project_guid',
		'value' => $project_guid,
	));
	?>

	<div style="float:right">
<?php
		echo elgg_view('input/submit', array('value' => elgg_echo("Project Updates!")));
?>
	</div>

<script type="text/javascript">
$(function(){
var max_len = 140;
$("#remLen").text(max_len - $("#status").val().length);
$("#status").bind('change ' + ($.browser.msie ? "propertychange" : "input"), function(event){
        var val = $.trim($(this).val()), len = val.length;
        if(len > max_len)
        {
            $(this).val(val.substr(0, max_len));
        }
        else
        {
            $("#remLen").text(max_len - len);
        }
    });
})
</script>
