<?php
$title="Contact Us";
$site_url=elgg_get_site_url();

$content=<<<HTML
<div class="pam">
<h3>For Funding</h3>
<p>If you come from a Foundation and would like to support some specific fields projects (public health, education, science etc.), you could contact us and deposit a big amount of funding and start to support some projects in our platform. You can send us Email: funding<span style="color:orange">#</span>creabator.org 
</p>

<h3>For Business</h3>
<p>If you want to corporate with us with some business staff, please contact us by sending us Email: business<span style="color:orange">#</span>creabator.org
</p>
<h3>
For Sponsor
</h3><p>
If you want to be our sponsor to support us to enhance our platform, please contact us by sending us email: sponsor<span style="color:orange">#</span>creabator.org 
</p>
<h3>
For others
</h3><p>
Please contact us with this email: contact<span style="color:orange">#</span>creabator.org
</p>
<h3>
<h4 class="bgwhite pam">Please change <span style="color:orange">#</span> to @ in the email address mention above when you contact us.</blockquote>
</div>
HTML;
$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));

echo elgg_view_page($title,$body);
?>