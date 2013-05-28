<?php
/**
 * Main pageshell for Creabator
 */


// Set the content type
header("Content-type: text/html; charset=UTF-8");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php echo elgg_view('page/elements/head', $vars); ?>

</head>
<body>

	<div class="elgg-page-messages">
		<?php echo elgg_view('page/elements/messages', array('object' => $vars['sysmessages'])); ?>
	</div>


	  <div class="elgg-page-header">
		 <div class="wrapper">
		       <?php echo elgg_view('page/elements/header', $vars); ?>
		 </div>
		 </div>


			<div class="wrapper">
		      	<?php echo elgg_view('page/elements/body', $vars); ?>
 			</div>


<div class="footer">
		     <?php echo elgg_view('page/elements/footer', $vars); ?>
			<?php echo elgg_view('page/elements/foot'); ?>
	
	</div>
<!-- share this  -->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "4039a755-b347-49d4-81fb-f3641580a4c6"});</script>
	<!-- google analysic -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36410646-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</body>
</html>