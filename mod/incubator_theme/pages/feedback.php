<?php
$title="Feedback";
$site_url=elgg_get_site_url();
$feedback=elgg_view_form('feedback');
$content=<<<HTML
<div class="pam">
$feedback
</div>
HTML;
$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));

echo elgg_view_page($title,$body);
?>