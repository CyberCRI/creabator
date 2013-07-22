<?php
/**
 * The core language file is in /languages/en.php and each plugin has its
 * language files in a languages directory. To change a string, copy the
 * mapping into this file.
 *
 * For example, to change the blog Tools menu item
 * from "Blog" to "Rantings", copy this pair:
 * 			'blog' => "Blog",
 * into the $mapping array so that it looks like:
 * 			'blog' => "Rantings",
 *
 * Follow this pattern for any other string you want to change. Make sure this
 * plugin is lower in the plugin list than any plugin that it is modifying.
 *
 * If you want to add languages other than English, name the file according to
 * the language's ISO 639-1 code: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 */

$mapping = array(
	'deposit:title' => 'Deposit Money:(current:%s $)',
	'deposit:item_name'=>'Deposit',
	'deposit:attention'=>'If you are the <span style="color:red">first time</span> to deposit, please see the <span style="color:red"> Important Info</span> in the right side first.',
	'deposit:important'=>'Important Info:',
	'deposit:important:content'=>'Each time your deposit money into our account will cost transaction fee by paypal,but we will save the equal amount of the money into your creabator bank account. You should consider how much you want to pay to support projects in total.  We also recommend you to deposit one bulk sum to reduce this transaction free as much as possible.<br><span style="color:red">Attention:</span>The money you deposit in your creabator bank account can not be withdrawn at this time.',
		
	'balence:title'=>'Balance',
		);
	

add_translation('en', $mapping);
