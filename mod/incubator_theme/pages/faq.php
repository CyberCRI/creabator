<?php
$title="FAQ";
$site_url=elgg_get_site_url();

$content=<<<HTML
<h3>What is Creabator?</h3>
<p><span>Creabator is a crowd-sourcing platform for research and learning projects. It allows everyone to present creative ideas and to attract various resources including money, team member, facility and mentorship around the world and eventually to start the development of their projects.</span>&nbsp;</p>
<h3>What does Creabator do?</h3>
<p><span>We offer the platform for those idea generators to meet the others sharing common points or having professional skills to help, and to reach necessary resources to start their projects. At the same time, the resources owners with time, money or facilities have the chance to meet and invest to really cool projects.</span></p>
<h3>Who should use Creabator?</h3>
<p>In general Creabator is for anyone eager to explore and to learn. You don&rsquo;t do need to be a professional scientist or university student to start a research or learning project. If you are curious about the world and want to learn something by doing a project, Creabator is perfect for you to meet people sharing same interests with you and get some resources to start your project. Please don&rsquo;t hesitate to have a try.</p>
<p>&nbsp;</p>
<h3>Why do we need Creabator given other nice crowd-sourcing and crowd-funding platforms already online?</h3>
<p>The simple answer is that there is no single solution to meet all challenges. If you want to get funding to publish a novel or an album, maybe some crowd-funding websites as kickstarter fit the best of your need. However, if you are interested in carrying out a research or learning project, there is few choice available online for you to get every elements to start it. Creabator is designed and optimized to help everyone do exciting creative projects in both research and learning.</p>
<p>&nbsp;</p>
<h3>What is the future plan for Creabator?</h3>
<p>For the moment we are doing the internal testing for the alpha version of the platform. We are accumulating the feedbacks from the invited users to understand the needs and to improve the user experiences. The public beta version of the platform will be available by the end of 2012.</p>
<p>And at the same time, we are working on building collaborations with research institutes and universities around the world to offer better opportunities for good projects to get real-world support. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;</p>
<h3>Who are the creators of Creabator?</h3>
<p>We are a small team from a non-profit organization called Wiser-U (world-wide interaction for science, education and research in universities) based at Paris and Beijing. We are collaborating with the center for research and interdisciplinarity (CRI) at Paris, the center for nano and micro mechanics (CNMM) of Tsinghua University at Beijing and the Citizen Cyberscience Center community. Creabator is financially supported by Shuttleworth foundation.</p>

<h3>How to avoid the Intellectual property rights? </h3>
 <p>When you create and explain your project, you need to think about which information could be public and which not. You could choose to explain with the limited information to the public without mentioned any information related to your Intellectual property rights.
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
HTML;
$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));

echo elgg_view_page($title,$body);
?>