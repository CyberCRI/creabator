Creativity Incubator
======
1. How to install?
====
Creabator is powered by Elgg. 
1.1 Install Elgg
==
Here is the guide of how to install Elgg:`http://docs.elgg.org/wiki/Installation`

1.2 unzip the zend.zip into your webroot directory 
==
Creabator is using youtube api to hosting the project video. In order to activate the video function, you need to install the zend libary for the youtube.You could go to this page for more detail:https://developers.google.com/youtube/.
For convenience, i make a zip of the libary which you could find in zend.zip.You should unzip it into your root libary and after that,you need to change some code in the `mod/project/lib/projects.php`,
`$clientLibraryPath = '/you/path/to/the/Zend/library/';`
`$_SESSION['developerKey'] = 'you developer key';`
`$_SESSION['sessionToken']='you session token';`
you could find out more infomation of how to create an account the get the key in this link:`https://developers.google.com/youtube/`

1.3 Copy the mod folder and go to admin panel to activate the plugins.
==
Go the `http://www.youdomain.com/admin` and login with you admin account and then click `plugins` tab in the right sidebar.
Attentions:
Before activate the plugin of `incubator_theme`, you should activate the plugin of `projects` and `search`. 

1.4 unzip the paypal.zip into your app root directory
==
Creabator is using paypal api for crowdfunding.If you want to have the bank system for crowdfunding, you needed to unzip paypal.zip into the root directory(the same directory with the `mod`directory).And then you should apply for your paypal api account.When you get your api key, you should add your information into the `paypal/paypalfunctions.php`。



2. How to create an Elgg plugin
====
Creabator is powered by Elgg. So, before learning how to write plugins for Creabator, you should learn about how to write an Elgg plugin.
For this part, There are already some documents in Elgg's website. So i will just paste some useful links so that you could learn from that.

#Code Stuctures#

One important things that you should keep in mind that the plugin files could replace the default system one if there are in the same folder strutures. For example,if you want to change the header of the default page templete, you could create a files `mod/plugin_name/views/default/page/elements/header.php` which will replace the default one  `views/default/page/elements/header.php`.

##Third party plugins:##
- categories
- developers
- embed
- file
- htmlawed
- invitefriends
- messages
- notifications
- profile_manager
- search
- tinymce
- uservalidationbyemail

##Plugins that we change some of the code:##
- profile
- reportedcontent
- elgg_social_login
- wiki

##Plugins that we develop for Creabator##
- ib_index
	- graphics
	- js  `slide js`
	- languages
	- pages
		- index.php  `index page content`
	- views
		- default
			- forms
				- index-login.php
			- ib_index
				- css.php
			- page
				- index.php `index page templete`
			- projects
				- list.php `index project lists view`
	- manifest.xml
	- start.php 
- incubator_theme
	- actions
		-feedback.php 
	- graphics
	- js
		- setwaterfall `waterfall effect for the feed`
	- languages
	- lib
		- ib_ajax.php `ajax functions which include get search reslut and get feeds or projects udpate`
	- pages
		- avatar `change default avater layout`
		- friends `change the default friends layout`
		- notifications `change the default notification layout`
		- profile `change the default profile layout`
		- settings `change the layout of the account`
		- about.php 
		- contact.php
		- faq.php
		- feedback.php
		- help.php
		- jobs.php
		- menu.php
		- privacy.php
		- river.php
		- service.php
		- signup.php
	- views
		- default
			- annotation `change the default comments view`
			- core `change the default login dropdown view`
			- css
			- forms
				- comments `add comment form view`
				- feedback.php `feedback view`
			- incubator_theme
			- input `change the default categories and plaintext view`
			- page 
				- elements `change the default header,footer logo etc view`
				- layouts
					- home_two_column.php `the home page layout`
					- ib_help.php `the about,help etc pages layout`
					- ib_two_column.php 
					- one_column.php 'change the default one_column layout'
				- default.php `default page templete`
			- river `change the default response(comment) view in river`
			- search `ajax search view`
			- widgets `friends of and river widget view`
	- manifest.xml
	- start.php


- projects
	- actions
		- comments `comment add functions`
		- projects 
			- blogs `delete blog action`
			- fbacker `facility backup guid actions`
			- issue `project issue guid actions`
			- membership `add or remove membership actions`
			- apply.php `apply team message`
			- blogs.php `project blogs saving action`
			- delete.php `delete project action`
			- featured.php `admin make project featured`
			- poster.php `save poster action`
			- save.php `project save actoin`
			- twitter.php `twitter widget setting action`
	- classes `ElggProject class`
	- graphics
	- languages
	- lib `projects helper functions as well as the youtube api intergate funciotn`
	- pages 
		- categories `change the default categories page`
		- projects
			- blogs
			- issues
			- setting
			- add.php
			- all.php
			- apply.php
			- backers.php
			- contribute.php
			- edit.php
			- lend.php
			- owner.php
			- required.php
			- resource.php
			- view.php
	- vendors
	- views 
	- activate.php `activate the ElggProject Class`
	- deactivate.php `deactivate the ElggProject Class`
	- icon.php `project poster url tranformation`
	- mainifest.xml
	- start.php








Userful Resources:
===
Getting Started with Development:(Super Important !!! ) http://docs.elgg.org/wiki/Getting_Started_With_Development

Plugin Development Guide: http://docs.elgg.org/wiki/Plugin_development

Books about Elgg 1.8: http://www.amazon.com/Elgg-Social-Networking-Cash-Costello/dp/1849511306

3. License
======
Creabator is under the GPLv2 Licence. Please check the LICENSE.txt for more detail.




