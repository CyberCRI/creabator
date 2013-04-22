<?php
/**

 * @uses $vars['title'] The page title
 * @uses $vars['body'] The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */


$css = elgg_get_loaded_css();
$title = elgg_get_config('sitename');
$version = get_version();
$release = get_version(true);
$js = elgg_get_loaded_js('head');

// Set the content type
header("Content-type: text/html; charset=UTF-8");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="ElggRelease" content="<?php echo $release; ?>" />
	<meta name="ElggVersion" content="<?php echo $version; ?>" />
	<title><?php echo $title; ?></title>
	<?php echo elgg_view('page/elements/shortcut_icon', $vars); ?>
<?php foreach ($js as $script) { ?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<?php foreach ($css as $link) { ?>
	<link rel="stylesheet" href="<?php echo $link; ?>" type="text/css" />
<?php } 
$siteurl=elgg_get_site_url();
$scripts[1]=$siteurl.'mod/ib_index/js/slide.js';
$scripts[2]=$siteurl.'mod/ib_index/js/slides.min.jquery.js';
foreach ($scripts as $script){
?>

<script type="text/javascript" src="<?php echo $script; ?>" ></script>

<?php
}

	$ie_url = elgg_get_simplecache_url('css', 'ie');
	$ie7_url = elgg_get_simplecache_url('css', 'ie7');
	$ie6_url = elgg_get_simplecache_url('css', 'ie6');
?>
	<!--[if gt IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo $ie_url; ?>" />
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo $ie7_url; ?>" />
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="<?php echo $ie6_url; ?>" />
	<![endif]-->





</head>
<body>

	<div class="elgg-page-messages">
		<?php echo elgg_view('page/elements/messages', array('object' => $vars['sysmessages'])); ?>
	</div>

	

		
	<?php echo elgg_view('page/elements/body', $vars); ?>
 	<script type="text/javascript">
	<?php echo elgg_view('js/initialize_elgg'); ?>
</script>		
	
</body>
</html>