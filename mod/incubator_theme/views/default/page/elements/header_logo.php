<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name= $site->name;

$site_url = elgg_get_site_url();
$img=$site_url.'mod/incubator_theme/graphics/logo.png'
?>

 <h2 id="logo"><a href="<?php echo $site_url; ?>" title="<?php echo $site_name; ?>"><span><img src=<?php echo $img?> ></span></a></h2>