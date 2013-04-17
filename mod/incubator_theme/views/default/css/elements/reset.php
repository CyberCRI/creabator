<?php
/**
 * CSS reset
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	RESET CSS
*************************************** */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,
blockquote,th,td {margin:0;padding:0;}
table {border-collapse:collapse;border-spacing:0;}
fieldset,img {border:0}
address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal}
ol,ul {list-style:none}
caption,th {text-align:left}
h1,h2,h3,h4,h5,h6 {font-size:100%;font-weight:normal;font-family:"PT Serif", Georgia, Times, "Times New Roman", serif;
line-height: 1.5;}
q:before,q:after {content:''}
abbr,acronym { border:0}


<?php // force vertical scroll bar ?>
html, body {
	height: 100%;
	margin-bottom: 1px;
}
img {
	border-width:0;
	border-color:transparent;
}
:focus {
	outline: 0 none;
}
ol, ul {
	list-style: none;
}
em, i {
	font-style:italic;
}
ins {
	text-decoration:none;
}
del {
	text-decoration:line-through;
}
strong, b {
	font-weight:bold;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
caption, th, td {
	text-align: left;
	font-weight: normal;
	vertical-align: top;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}
blockquote, q {
	quotes: "" "";
}
a {
	text-decoration: none;
}

