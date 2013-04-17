<?php
$title="Join Us";
$site_url=elgg_get_site_url();

$content=<<<HTML
<h3>
Work at Creabator
</h3><p>
We are a team who passion to speed up the innovation process. At this stage, we still designing and coding our platform as well as starting to build the community. If you are passion to one of them, just contact and join us. 
</p><h3>
Position:
</h3><p>
<h3 class="mlm">Development Part:</h3>
<p class="mlm">Basically we use PHP for our platform at this time. If you good at PHP or just getting started but passion with PHP, you could definitely contact us and apply for it to work with us together.
</p>
<h3 class="mlm">Design Part:</h3>
<p class="mlm">As you can see, we still have a long way to make our platform even simple to use and user friendly. So if you are good at graphic as well as UI&UE and also passion with our platform, just join us! It will be better with your help. 
</p>
<h3 class="mlm">Community Part:</h3>
<p class="mlm">We just start to launch our alpha version of Creabator, if you are a person who is good at building and running an online community, just join us! Our platform will be better with your help.
</p>
HTML;
$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));

echo elgg_view_page($title,$body);
?>