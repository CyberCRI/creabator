<?php
/**
 * themes chinese language file
 */

$fr = array(
	'sitename'=>'Creabator',
	'slogan'=>"Innovating Collectively",
	'apply'=>'Apply',
	'about'=>'About Us',
	'contact'=>'Contact Us',
	'help'=>'Get Help',
	//header menu
	'menu:index'=>"Home",
	'menu:all'=>"Explore",
	'menu:activity'=>'News feed',
	'menu:logout'=>"Logout",
	'menu:profile'=>"Profile",
	'menu:setting'=>"Setting",
	'menu:account'=>"Account",
	'menu:friends'=>"Following",
	'menu:friendsof'=>"Follower",
	'menu:message'=>"Messages",	
		/**
		 * Friends
		 */
		
		'friends' => "Following",
		'friends:yours' => "Your following",
		'friends:owned' => "%s's following",
		'friend:add' => "Follow",
		'friend:remove' => "Stop following",
		
		'friends:add:successful' => "You are now following %s.",
		'friends:add:failure' => "Error attempting to follow %s.",
		
		'friends:remove:successful' => "You are no longer following %s .",
		'friends:remove:failure' => "Error attempting to stop following %s .",
		
		'friends:none' => "No followers yet.",
		'friends:none:you' => "You don't have any followers yet.",
		
		'friends:none:found' => "No followers were found.",
		
		'friends:of:none' => "Nobody is following this user yet.",
		'friends:of:none:you' => "Nobody is followuing you yet. Start adding content and fill in your profile to let people find you!",
		
		'friends:of:owned' => "People who are following %s ",
		
		'friends:of' => "Followers",
		'friends:collections' => "Followers collections",
		'collections:add' => "New collection",
		'friends:collections:add' => "New Followers collection",
		'friends:addfriends' => "Select Followers",
		'friends:collectionname' => "Collection name",
		'friends:collectionfriends' => "Followers in collection",
		'friends:collectionedit' => "Edit this collection",
		'friends:nocollections' => "You do not have any collections yet.",
		'friends:collectiondeleted' => "Your collection has been deleted.",
		'friends:collectiondeletefailed' => "We were unable to delete the collection. Either you don't have permission, or some other problem has occurred.",
		'friends:collectionadded' => "Your collection was created",
		'friends:nocollectionname' => "You need to give your collection a name before it can be created.",
		'friends:collections:members' => "Collection members",
		'friends:collections:edit' => "Edit collection",
		'friends:collections:edited' => "Saved collection",
		'friends:collection:edit_failed' => 'Could not save collection.',
		
	//sidebar menu
	'sidebar:menu:all'=>'Explore',

		
	//help
	'help:help'=>'Help Center',
	'help:jobs'=>'Join Us',
	'help:service'=>'Service',
	'help:privacy'=>'Privacy',
	'help:feedback'=>'Feedback',
	'help:contact'=>'Contact Us',
	
	'feedback:title'=>'Title',
	'feedback:desc'=>'Please provide some details',

	// messages
	'messages' => "All messages",
	'messages:unreadcount' => "%s unread",
	'messages:back' => "back to inbox",
	'messages:user' => "%s 's inbox",
	'messages:posttitle' => "%s 's message: %s",
	'messages:inbox' => "Inbox",
	'messages:send' => "Send",
	'messages:sent' => "Sent",
	'messages:message' => "Message",
	'messages:title' => "Subject",
	'messages:to' => "To:",
	'messages:from' => "From:",
	'messages:fly' => "Send",
	'messages:replying' => "Reply to",
	'messages:inbox' => "Inbox",
	'messages:sendmessage' => "Send message",
	'messages:compose' => "Write message",
	'messages:add' => "Write message",
	'messages:sentmessages' => "Sent messages",
	'messages:recent' => "Recent messages",
	'messages:original' => "Original Message",
	'messages:yours' => "Your message",
	'messages:answer' => "Reply",
	'messages:toggle' => 'Toggle',
	'messages:markread' => 'Markread',
	'messages:recipient' => 'Select recipient',
	'messages:to_user' => 'To: %s',

	'messages:new' => 'New message',

	'notification:method:site' => 'Site',

	'messages:error' => 'Save failed, please try again later.',

	'item:object:messages' => 'All messages',

	/**
	* Status messages
	*/

	'messages:posted' => "Your message has sent.",
	'messages:success:delete:single' => 'This message has deleted.',
	'messages:success:delete' => 'Those messages have been deleted.',
	'messages:success:read' => 'These messages have been marked as read.',
	'messages:error:messages_not_selected' => 'You have not selected any messages.',
	'messages:error:delete:single' => 'Delete failed',

	/**
	* Email messages
	*/

	'messages:email:subject' => 'You have new messages.',
	'messages:email:body' => "You have a message from %s :


	%s


	If you want to read this message, please click this link::

	%s

	If you want to reply to %s, please click here:

	%s

	You were not able to reply to this message.",

	
	
	// system
	'reportedcontent:this'=>'Report problem',
);

add_translation('fr', $fr);