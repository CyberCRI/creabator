<?php

?>
/*******************************
	Incubator-theme css file
	
********************************/
html{
background-image:url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/bg.png');
background-repeat:repeat;
*background:#666 !important;
}

.container{
padding-top:100px;

}

.wrapper{width:1024px;overflow:hidden;margin:0 auto;padding:0;}

ul.elgg-list{
border-top:0;
}

.lgrey{
background:#f9f9f9;
}
#menumap.linkable{
  cursor:pointer;
}

textarea {
height: 120px;
}
.elgg-form input{
    margin-top:10px;
}
.elgg-form-register .elgg-button-submit{
    padding:5px 10px;
    font-size:1.2em;
}
#header-wrap{
background:#FFF url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/bg-header-wrap.png') repeat-x bottom;
border-bottom:1px solid #CCC;
margin-bottom:15px;
position:fixed;
width:100%;
z-index:100;
-webkit-box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
-moz-box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
}
#header-wrap #header{height:59px;position:relative}
#logo{display:inline;float:left;margin-right:10px;margin-bottom:0;height: 40px;margin-top: 3px;}
#logo a span{
position:fixed;
margin-top: -2px;
}
#logo a{display:block;}
#header #menu-main{list-style:none;overflow:hidden;display:inline;float:left;padding-left:10px;margin:0;}
#menu-main li.selected{background:#FFF;border-color:#CCC;border-bottom:1px solid #FFF;z-index:1;}
#menu-main li{display:inline;float:left;height:30px;margin-top:20px}
#menu-main li a{display:block;padding:1px 5px;}
#menu-main li.selected a,#header-wrap #header #menu-main li a:hover{background:#FFF;}
#menu-main li a:hover{padding-bottom:12px;}
#menu-main #project,#menu-main #team{border-right:none;}

/*---header tabs---*/
ul.elgg-menu-htabs{
display:inline-block;
margin-left: 270px;
width: 740px;
margin-top: -2px;
}
.elgg-menu-htabs li a{
color:white;
margin:0 10px;
padding-top:5px;
width:45px;
}

/***
.elgg-menu-htabs li.elgg-state-selected {
background:url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/back.png') no-repeat;
margin: 0 10px;
padding-top: 2px;
}
.elgg-menu-htabs li.elgg-state-selected a {
margin:0;
padding:0;
}
***/





.content {

 color:#666;
 background: #fff;

 height: 100%;
 overflow: auto;

}
#chead{margin: 0;padding: 0;display: block;}
#headtitle{float: left;width: 600px;}
.menu-tabs{height: 31px;
padding: 16px 13px 0 0;
border-bottom: 1px solid #CFD5D9;
background: white;
clear: both;}
.menu-tabs li{float: left;
border-radius: 4px 4px 0 0;
-moz-border-radius: 4px 4px 0 0;
-webkit-border-radius: 4px 4px 0 0;
font-size: 14px;
margin: 0 7px 0 0;
border: solid 1px #CFD5D9;
border-bottom: 0;
cursor: pointer;
background: #F6F6F6;
width: 108px;

}
.menu-tabs li.current {
padding-bottom: 1px;
background: white;
filter: none;
-moz-box-shadow: none;
-webkit-box-shadow: none;
box-shadow: none;
}
.menu-tabs li a {
color: #333;
display: block;
padding: 7px 24px;
}

.elgg-menu-tabs li.selected{position: relative;background:#FFF;border-color:#CCC;border-bottom:1px solid #FFF;z-index:101;border-right: 1px solid #CCC;border-left: 1px solid #CCC;}
.elgg-menu-tabs{display:inline;float:right;margin-top:20px;border:0;overflow:hidden;overflow:visible;padding:0 0 0 8px;}
.elgg-menu-tabs li{list-style-image:none;list-style-type:none;white-space:nowrap;display:inline;float:left;padding:0 5px;}
.elgg-menu-tabs a{float:left;line-height:30px;background-image:url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/sprite.png')!important;width:32px;height:32px;}
.elgg-menu-tabs li.elgg-state-selected{
-webkit-box-shadow: 0px 3px rgba(0, 0, 0, 0.20);
-moz-box-shadow:  0px 3px rgba(0, 0, 0, 0.20);
box-shadow: 0px 3px rgba(0, 0, 0, 0.20);
}
#header-messages-new{
color: #666;
background:url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/mail_over.png') no-repeat;
top: -55px;
position: relative;
left: 29px;
padding-left: 5px;
}


.footer-title{
 color:#666;
 font-size:20px;
 margin-bottom:10px;
}
li.footer-left{
width:450px;
}
.footer-up li{
height:250px;
}
.footer-left p{
font-size:16px;
}
li.footer-sponsor{
width:280px;
}
li.footer-sponsor img{
border-radius:5px;
margin-left:5px;
}
li.footer-right{
width:250px;
}
ul.footer-bottom {
text-align:left;

height:30px;
}
ul.footer-bottom li{
border-right:1px solid #fff;
padding:0 5px;
height:20px;
}
ul.footer-bottom li a{
color:white;
}

.clear{
margin: 0 0 2px;
}
.dashed {
border-bottom: 1px dashed #CCC;
padding-bottom: 4px;
}
h4.dashed {
border-bottom: 1px dashed #CCC;
margin: 0 0 1em;
padding-bottom: 4px;

}

.sidebar {
 background-color: white;
 height: 600px;
 width: 350px;
 float: left;
}
.sidebar-box {
 float: left;
 background-color: #E7E7E7;
 margin-top:1px;
 margin-left:1px;
 width:322px;
 border: 1px solid #D4D4D4;
 border-radius: 5px;
}

.list-sidebar-box {
 float: left;
 width: 326px;
 margin-left:4px;
 border-bottom: 1px solid #CCC;
}

.elgg-layout-one-column{
border: 1px solid #F7F7F7;
background: white;
border-radius: 5px;
}


/* ***************************************
	PTABS MENU 
*************************************** */
.elgg-menu-ptabs {
	display: table;
	width: 100%;
}
.elgg-menu-ptabs  li {
border: 1px solid #eee;
border-bottom: 0;
background: #666;
margin: 0 -25px 0 0;
-webkit-border-radius: 15px 15px 0 0;
-moz-border-radius: 5px 5px 0 0;
border-radius: 15px 15px 0 0;
width: 150px;
z-index: 0;
top: -1;

}

.elgg-menu-ptabs li  a {
	text-decoration: none;
	display: block;
	padding: 3px 10px 0;
	text-align: center;
	height: 21px;
	color: white;
	line-height: 1.2;
}

.elgg-menu-ptabs  .elgg-state-selected {
	border-color: #ccc;
	background: white;	
	z-index: 1;
	top: 0;
	height: 110%;

}
.elgg-menu-ptabs  .elgg-state-selected  a {
	position: relative;
	top: 2px;
	color:#666;

}
li.elgg-menu-item-access{
	display:none;
}



/*river-tab css*/
ul.river-tab{
display:block;
}
ul.river-tab li {
border: 1px solid #eee;
border-bottom: 0;
background: #666;
margin: 0 -25px 0 0;
-webkit-border-radius: 15px 15px 0 0;
-moz-border-radius: 5px 5px 0 0;
border-radius: 15px 15px 0 0;
width: 150px;
z-index: 0;
top: 0;
}
ul.river-tab li a{
	text-decoration: none;
	display: block;
	padding: 3px 10px 0;
	text-align: center;
	height: 21px;
	color: white;
}

ul.river-tab li.elgg-state-selected {
	border-color: #eee;
	background: white;
	z-index: 1;
	top: 1px;
	padding-bottom:1px
	
}
ul.river-tab li.elgg-state-selected a{
	color:#666;
	position: relative;
}
.elgg-river-responses > div, .elgg-river-responses > form, .elgg-river-responses > ul > li {
background-color: #ffffff;
margin-bottom: 2px;
padding: 4px;
}
.elgg-river-comments-tab {
	display: block;
	background-color: #fff;
	color: #4690D6;
	margin-top: 5px;
	width: auto;
	float: right;
	font-size: 85%;
	padding: 1px 7px;
	-webkit-border-radius: 5px 5px 0 0;
	-moz-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}
.elgg-form-small input,
.elgg-form-small textarea {
	font-size: 16px;
}
.project-status{
width:50px;
}
.formtips{width: 200px;padding:2px;}
.onError{
    background:#FFE0E9  no-repeat 0 center;
	padding:1px 5px;
	border-radius:5px;
	z-index:2;
	border: 1px solid white;
}
.onSuccess{
    background:#E9FBEB  no-repeat 0 center;
	padding:1px 5px;
	border-radius:5px
}
.high{
    color:#666;
}

#learn-more{
width:700px;
background:whitesmoke;
color:#666;
font-size:20px;
line-height:30px;
border-radius:5px;

}


.help-sidebar{
float: left;
padding: 12px 10px;
width: 200px;
border: 1px solid #C7CACC;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
position: fixed;
}
ul.help-sidebar {
text-align:center;
padding: 5px;
border:1px solid #EEE;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
-o-border-radius: 10px;
-ms-border-radius: 10px;
-khtml-border-radius: 10px;
border-radius: 10px;
background-color:#eee;
}
.help-sidebar li{
height: 20px;
border-bottom: 1px solid white;
font-size: 16px;
padding: 5px;
margin-top: 5px;
}
.help-sidebar .elgg-state-selected{
border-color: #CCC;
background: white;	
}

.separator{
border-top: 1px solid #E2E6E8;
overflow: hidden;
border-bottom: 1px solid #FEFFFE;
border-width: 1px 0;
}
.help-content{
float:right;
width: 700px;
padding:20px;
min-height:600px;
display:inline-block;
background: white;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
background:#f8f8f8;
font-size:1.15em;
font-family:"PT Serif", Georgia, Times, "Times New Roman", serif;
line-height:1.5em;
color:#222;
}

.help-content h3{
    color:#666;
   
}

/***index-spirte***/
.index-sprite{
background-image:url('<?php echo $vars['url']; ?>mod/incubator_theme/graphics/index-sprite.png');
}

.elgg-menu-tabs li a.login-button{
	color: white;
	font-size:1.5em;
	text-shadow: 1px 1px 0px black;
	text-decoration: none;
	border:1px solid #84bbf3;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
	background-color: #79bbff;
	width: 60px;
	background-position: -100px 0;
}

.elgg-menu-tabs li a.login-button:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
	background-color:#378de5;
	background-position: -100px 0;
}

.bx{
-webkit-box-shadow:0 0 10px 2px rgba(0, 0, 0, 0.40);
-moz-box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.40);
box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.40);
}
.creabator-button-blue{
background-color:#378de5;    
background:-webkit-gradient(linear, 0 0, 0 100%, from(#378de5), color-stop(30%, #79bbff), color-stop(70%, #378de5));
background:-moz-linear-gradient(top, #378de5, #79bbff 30%, #378de5 70%);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
color:white;
padding: 5px 10px;
}
.creabator-button-orange{
background-color: #065fb9;
background:-moz-linear-gradient(top, #ee6600, #ff9966 30%, #ee6600 70%);
background:-webkit-gradient(linear, 0 0, 0 100%, from(#ee6600), color-stop(30%, #ff9966), color-stop(70%, #ee6600));
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff9966', endColorstr='#ee6600');
color:white;

padding: 5px 10px;
}
.creabator-button-green{
background-color:  rgba(124, 186, 87, 0.7);
background:-moz-linear-gradient(top, rgba(124, 186, 87, 0.7), rgba(124, 186, 87, 1) 30%, rgba(124, 186, 87, 0.7) 70%);
background:-webkit-gradient(linear, 0 0, 0 100%, from(rgba(124, 186, 87, 0.7)), color-stop(30%, rgba(124, 186, 87, 1)), color-stop(70%, rgba(124, 186, 87, 0.7)));
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='rgba(124, 186, 87, 1)', endColorstr='rgba(124, 186, 87, 0.7)');
color:white;

padding: 5px 10px;
}

fieldset > div:first-child {
	margin-top: 15px;
}





/*
.elgg-button-index {
	color: white;
	text-shadow: 1px 1px 0px black;
	text-decoration: none;
	border:1px solid #065fb9;	
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#065fb9), color-stop(30%, #049ff1), color-stop(70%, #065fb9));
	background: -moz-linear-gradient(top, #065fb9, #049ff1 30%, #065fb9 70%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#065fb9', endColorstr='#049ff1');
	background-color:#065fb9;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	moz-box-shadow: inset 0px 1px 0px 0px #fff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #fff;
	box-shadow: inset 0px 1px 0px 0px #fff;
}

.elgg-button-index:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #065fb9), color-stop(1, #049ff1) );
	background:-moz-linear-gradient( center top, #065fb9 5%, #049ff1 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#065fb9', endColorstr='#049ff1');
	background-color:#049ff1;
}
 */
 .elgg-button-index {
	color: white;
	text-shadow: 1px 1px 0px black;
	text-decoration: none;
	border:1px solid rgba(0,0,0,0.1);	
	background: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(0,0,0,0.1)), color-stop(30%, rgba(0,0,0,0.3)), color-stop(70%, rgba(0,0,0,0.2)));
	background: -moz-linear-gradient(top, rgba(0,0,0,0.1), rgba(0,0,0,0.3) 30%, rgba(0,0,0,0.1) 70%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='rgba(0,0,0,0.1)', endColorstr='rgba(0,0,0,0.3)');
	background-color:rgba(0,0,0,0.1);
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	moz-box-shadow: inset 0px 1px 0px 0px #fff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #fff;
	box-shadow: inset 0px 1px 0px 0px #fff;
}

.elgg-button-index:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, rgba(0,0,0,0.1)), color-stop(1, rgba(0,0,0,0.3)) );
	background:-moz-linear-gradient( center top, rgba(0,0,0,0.1) 5%, rgba(0,0,0,0.3) 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='rgba(0,0,0,0.1)', endColorstr='rgba(0,0,0,0.3)');
	background-color:rgba(0,0,0,0.3);
}




#index-footer{
margin-top:90%;
margin-left:45%;
width:50%;
position:fixed;
}

#index-footer li a{
color:white;
}
/* settings sidebar menu*/
ul.sidebar-menu{
padding:5px;
background:#f5f5f5;
}
.sidebar-menu li {
display:block;
padding:5px;
}

.sidebar-menu li.elgg-state-selected {
background:white;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
-moz-box-shadow: 0 1px 1px #b8bbbf;
-webkit-box-shadow: 0 1px 1px 
#B8BBBF;
-o-box-shadow: 0 1px 1px #b8bbbf;
box-shadow: 0 1px 1px 
#B8BBBF;
}

/* new header theme css*/
.elgg-page-header {
	position: fixed;
	background:white;
	height: 44px;
	width: 100%;
	z-index:2;
}

#menubar ul.menus li {
	float:left;
	list-style:none; 
	margin-right:1px; 
}

#menubar ul.menus li a {
	padding:5px 10px; 
	display:block;
	color:#FFF; 
	text-decoration:none;
	font-size:0.9em; 
}


#menubar ul.menus ul {
	position:fixed;
	right:55px;
	top:44px;
	background:black;
	width:100px;
}

#menubar li.children a:hover {
	background:white;
	width:80px;
	color:#333;	
}

#menubar ul.children {
	display:none; 
	padding:0;
	margin:0;
}

#menubar ul.children li {
	float:none; 
	margin:0;
	padding:0;
}
