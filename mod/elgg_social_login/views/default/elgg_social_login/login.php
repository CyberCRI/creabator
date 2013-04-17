<?php
	global $CONFIG;
	global $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG;

	require_once "{$CONFIG->pluginspath}elgg_social_login/settings.php"; 

	// display "Or connect with" message, or not.. ?
	echo "<div style='padding:0 10px 10px 0;margin-top:0px;'><div style='padding: 5px;
color: white;
background: -webkit-gradient(linear, left top, right top, color-stop(83%,rgba(252, 168, 58, 1)), color-stop(84%,rgba(252, 168, 58, 0.94)), color-stop(100%,rgba(255, 255, 255, 0)));
margin-bottom: 10px;
font-size: 1.2em;'><b>Or connect with:</b></div>";

	// display provider icons
	foreach( $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG AS $item ){
		$provider_id     = @ $item["provider_id"];
		$provider_name   = @ $item["provider_name"];

		$assets_base_url = "{$vars['url']}mod/elgg_social_login/graphics/";

		if( elgg_get_plugin_setting( 'ha_settings_' . $provider_id . '_enabled', 'elgg_social_login' ) ){
			?>
			<a href="javascript:void(0);" title="Connect with <?php echo $provider_name ?>" class="ha_connect_with_provider" provider="<?php echo $provider_id ?>">
				<img alt="<?php echo $provider_name ?>" title="<?php echo $provider_name ?>" src="<?php echo $assets_base_url . "32x32/" . strtolower( $provider_id ) . '.png' ?>" />
			</a>
			<?php
		} 
	} 

	// provide popup url for hybridauth callback
	?>
		<input id="ha_popup_base_url" type="hidden" value="<?php echo "{$vars['url']}mod/elgg_social_login/"; ?>authenticate.php?" />
	
	
	<?php   
	echo "</div>";
?>
<script>
	$(function(){
		$(".ha_connect_with_provider").click(function(){
			popupurl = $("#ha_popup_base_url").val();
			provider = $(this).attr("provider");

			window.open(
				popupurl+"provider="+provider,
				"hybridauth_social_sing_on", 
				"location=1,status=0,scrollbars=0,width=800,height=570"
			); 
		});
	});  
</script> 