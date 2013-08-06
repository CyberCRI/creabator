<?php
$title="About Us";
$site_url=elgg_get_site_url();
$content=<<<HTML

<h3>What's Creabator?</h3>
<p>Creabator is a crowdsourcing platform for pulling together the necessary ingredients for novel science projects: ideas, participants, tools and funding.</p>

<h3>How does Creabator Work ?</h3>
<p>
In our first stage, we will focus on helping science projects to getting micro-help from students and citizen. In order to get help from the crowd, Scientist should add the open task lists in their project home page and should promise that they will give a small certificate that with their signature to award students who has help them.
</p>

<h3>Background:</h3>
<p>Education systems need to empower the next generation of learners with creative spirits and skills, to prepare them for a world that is changing at an unprecedented pace. Pedagogy based on learning by doing research has been successfully used in universities to train a creative elite. However, traditional schools and universities are not equipped to deliver high-quality creative learning to large numbers of students with a wide range of talents and interests. New solutions are required to enable creative learning in a large population of citizens.
Online crowd funding has been developed as a way for artists and designers to find support for their creative projects. Users can register on websites such as kickstarter, and explain their projects to attract the micro-donations from visitors. Once the donations reach the requested level, funding is delivered and work starts on the project. Innocentive is a pioneer website that promotes the solving of economic and R&D issues via crowd-sourcing services. These websites work very well as distributed funding/investment systems to facilitate innovation but none of them can systematically support learners to work on creative science projects, which usually require more diverse resources.
</p>


HTML;

$body=elgg_view_layout('ib_help',array('help_content'=>$content,'title'=>$title));


echo elgg_view_page($title,$body);
?>