<?php 

?>
/*index page*/
.projest_index_list li{
width:33.33%;
height:265px;
position: relative;
overflow: hidden;
display: inline-block;
}
.index_list_img{width:100%;height:265px;display:block; position:absolute; left:10px; top:10px;}
.index_list_img img{width:auto;height:260px;}
.index_list_div{background: rgba(0, 0, 0,0.6);padding:10px;width: 70%;position: relative;left:0px;top: 80px;z-index:2;color: white;float: right;left:500px;border-radius: 10px 0 0 10px;-moz-border-radius: 10px 0 0 10px;-webkit-border-radius: 10px 0 0 10px;}
.index_list_title{background: rgba(0, 0, 0, 0.5);z-index: 10;position: relative;top: 25px;left:10px;padding: 2px 10px;float: left;color:white;max-width: 70%;border-radius: 0 5px 5px 0;-moz-border-radius:  0 5px 5px 0;-webkit-border-radius: 0 5px 5px 0;}


#index-logo{
	position:relative;
	left:20px;
	z-index:100;
	
}
#slogan{
color:white;
font-size:1.8em;
font-family: "PT Serif",'Helvetica Neue', Helvetica, Arial, sans-serif;
position:relative;
top: -75px;
left: 330px;
}
#index_tagline{
color: white;
font-size: 1.5em;
background: #0BF;
font-family: century;
}
#index-list-project{
box-shadow: 5px 5px 5px #999;
height: 415px;
}
#index-list-title{
position: relative;
top: -360px;
left: 5%;
background: rgba(0, 0, 0, 0.5);
color: white;
padding: 5px;
line-height: 1.2em;
width: 80%;
}
.elgg-menu-index,
.elgg-menu-index li,
.elgg-menu-index li a{
display:inline-block;
color:#666;
}



#apply{margin-left:10px;}
/* Submit: This button should convey, "you're about to take some definitive action" */
.elgg-button-index {
	color: white;
	padding:5px 10px;
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


.elgg-form-index-login input, textarea{
font-size:120%;
}

#index-login{
margin-top:50px;
padding-left:40px
}

#index-video {
	width:660px;
	height:350px;
	margin:50px 0 0 100px;
	position:relative;
	float:left;
	display:inline-block;
	
}

/*
Slide
*/



#index-slide {
	width:600px;
	height:350px;
	margin:50px 0 0 50px;
	position:relative;
	float:left;
	display:inline-block;
}

#ribbon {
	position:absolute;
	top:-3px;
	left:-15px;
	z-index:500;
}

#frame {
	position:absolute;
	z-index:0;
	width: 728px;
	height: 390px;
	left:-80px;
}


/*
	Slideshow
*/

#slides {
	position:absolute;
	top:15px;
	left:4px;
	z-index:100;
}


/*
	Slides container
	Important:
	Set the width of your slides container
	Set to display none, prevents content flash
*/

.slides_container {
	width:560px;
	overflow:hidden;
	position:relative;
	display:none;
	border:1px solid #eee;
}

/*
	Each slide
	Important:
	Set the width of your slides
	If height not specified height will be set by the slide content
	Set to display block
*/

.slides_container div.slide {
	width:560px;
	height:310px;
	display:block;
}


/*
	Next/prev buttons
*/

#slides .next,#slides .prev {
	position:absolute;
	top:107px;
	left:-39px;
	width:24px;
	height:43px;
	display:block;
	z-index:101;
	border:0;
}

#slides .next {
	left: 575px;
	border:0;
}

/*
	Pagination
*/

.pagination {
	margin:26px auto 0;
	width:100px;
}

.pagination li {
	float:left;
	margin:0 1px;
	list-style:none;
}

.pagination li a {
	display:block;
	width:12px;
	height:0;
	padding-top:12px;
	background-image:url(<?php echo $vars['url']; ?>mod/ib_index/graphics/slide/pagination.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}

.pagination li.current a {
	background-position:0 -12px;
}

/*
	Caption
*/

.caption {
	z-index:500;
	position:absolute;
	bottom:-35px;
	left:0;
	height:30px;
	padding:5px 20px 0 20px;
	background:#000;
	background:rgba(0,0,0,.5);
	width:540px;
	font-size:1.3em;
	line-height:1.33;
	color:#fff;
	border-top:1px solid #000;
	text-shadow:none;
}

.arrow{
margin-top: 120px;
display: inline-block;
width: 40px;
height: 40px;
margin-top: px;
font-size: 60px;
font-weight: 100;
line-height: 30px;
color: white;
text-align: center;
background: #222;
border: 3px solid white;
-webkit-border-radius: 23px;
-moz-border-radius: 23px;
border-radius: 23px;
opacity: .5;
filter: alpha(opacity=50);
}
.arrow.left{
float: left;
margin-left: 10px;
}
.arrow.right{
float: right;
margin-right: 10px;
}