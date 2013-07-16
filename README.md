Creativity Incubator
========
1. How to install?
======
Creabator is powered by Elgg. 
1.1 Install Elgg
==
Here is the guide of how to install Elgg:http://docs.elgg.org/wiki/Installation

1.2 unzip the zend.zip into your webroot directory 
==
Creabator is using youtube api to hosting the project video. In order to activate the video function, you need to install the zend libary for the youtube.You could go to this page for more detail:https://developers.google.com/youtube/.
For convenience, i make a zip of the libary which you could find in zend.zip.You should unzip it into your root libary and after that,you need to change some code in the mod/project/lib/projects.php,
$clientLibraryPath = '/you/path/to/the/Zend/library/';
$_SESSION['developerKey'] = 'you developer key';
$_SESSION['sessionToken']='you session token';
you could find out more infomation of how to create an account the get the key in this link:https://developers.google.com/youtube/

1.3 Copy the mod folder and go to admin panel to activate the plugins.
==
Go the http://www.youdomain.com/admin and login with you admin account and then click "plugins" tab in the right sidebar.
Attentions:
Before activate the plugin of "incubator_theme", you should activate the plugin of "projects" and "search". 

1.4 Localization



2. How to create an Elgg plugin
======
Creabator is powered by Elgg. So, before learning how to write plugins for Creabator, you should learn about how to write an Elgg plugin.
For this part, There are already some documents in Elgg's website. So i will just paste some useful links so that you could learn from that.

Code Stuctures
===
One important things that you should keep in mind that the plugin files could replace the default system one if there are in the same folder strutures. For example,if you want to change the header of the default page templete, you could create a files "mod/plugin_name/views/default/page/elements/header.php" which will replace the default one  "views/default/page/elements/header.php".

Plugin lists for Creabator:
Third party plugins:
categories
developers
embed
file
htmlawed
invitefriends
messages
notifications
profile_manager
search
tinymce
uservalidationbyemail

Plugins that we change some of the code:
profile
reportedcontent
elgg_social_login
wiki

Plugins that we develop for Creabator
ib_index
-graphics
-js (slide js)
-languages
-pages
	-index.php (index page content)
-views
	-default
		-forms
			-index-login.php
		-ib_index
			-css.php
		-page
			-index.php (index page templete)
		-projects
			-list.php(index project lists view)
manifest.xml
start.php 


incubator_theme

projects







Userful Resources:
===
Getting Started with Development:(Super Important !!! ) http://docs.elgg.org/wiki/Getting_Started_With_Development

Plugin Development Guide: http://docs.elgg.org/wiki/Plugin_development

Books about Elgg 1.8: http://www.amazon.com/Elgg-Social-Networking-Cash-Costello/dp/1849511306

3. License
======
Creabator is under the GPLv2 Licence. Please check the LICENSE.txt for more detail.




