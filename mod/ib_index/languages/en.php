<?php
/**
 * themes chinese language file
 */

$english = array(
	'sitename'=>'Creabator',
	'slogan'=>"Innovating Collectively",
	'apply'=>'Apply account',
	'about'=>'About Us',
	'contact'=>'Contact Us',
	'help'=>'Get Help',
	'item:object:question'=>'Answer',
	'item:object:question-top'=>'Question',
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
	'menu:ask'=>"Ask question",
	'menu:message'=>"Messages",	
	
	/**
	 * widget 
	 */
	'question:more'=>'More...',
	'question-top:widget:description'=>'Questions that he ask',
	'question-top:widget:description'=>'Questions that he answer',
	'question:num_questions'=>'Numbers to display',
	
		/**
		 * Friends
		 */
		
		'friends' => "Following",
		'friends:yours' => "Your following",
		'friends:owned' => "%s's following",
		'friend:add' => "Follow",
		'friend:remove' => "Remove follow",
		
		'friends:add:successful' => "You have successfully follow %s.",
		'friends:add:failure' => "We couldn't follow %s.",
		
		'friends:remove:successful' => "You have successfully removed following %s .",
		'friends:remove:failure' => "We couldn't remove following %s .",
		
		'friends:none' => "No followers yet.",
		'friends:none:you' => "You don't have any followers yet.",
		
		'friends:none:found' => "No followers were found.",
		
		'friends:of:none' => "Nobody has followed this user yet.",
		'friends:of:none:you' => "Nobody has followed you yet. Start adding content and fill in your profile to let people find you!",
		
		'friends:of:owned' => "People who have followed %s ",
		
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
		'friends:collectionadded' => "Your collection was successfully created",
		'friends:nocollectionname' => "You need to give your collection a name before it can be created.",
		'friends:collections:members' => "Collection members",
		'friends:collections:edit' => "Edit collection",
		'friends:collections:edited' => "Saved collection",
		'friends:collection:edit_failed' => 'Could not save collection.',
		
	//sidebar menu
	'sidebar:menu:all'=>'Explore',

	//reference messgae
       	'reference:subject'=>'New reference',
       	'reference:body'=>' %s in question(<a href="%s">%s</a>):add new reference:%s ��',
	
	// apply form
	'realname'=>'Real name',
	'apply-desc'=>'Personal info(professional background,study field and so on)',

		
	// river menu
        'river:no question'=>'You are not follow any question yet, try to follow questions that you might interested in.',
        'river:no follow'=>'You are not follow any people yet, try to follow some interesting people',
	'forward:this'=>'Forward this question:',
	'question:this'=>'Question this question',
	//help
	'help:about'=>'About Miifang',
	'help:help'=>'Help Center',
	'help:jobs'=>'Join Us',
	'help:service'=>'Service',
	'help:privacy'=>'Privacy',
	'help:feedback'=>'Feedback',
	'help:contact'=>'Contact Us',
	
	'feedback:title'=>'Title',
	'feedback:desc'=>'Please decribe it with more detail.',

	// messages
	'messages' => "All news",
	'messages:unreadcount' => "%s unread",
	'messages:back' => "back to inbox",
	'messages:user' => "%s 's inbox",
	'messages:posttitle' => "%s 's message: %s",
	'messages:inbox' => "Inbox",
	'messages:send' => "Send",
	'messages:sent' => "Sent",
	'messages:message' => "Message",
	'messages:title' => "Subtitle",
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
	'messages:answer' => "reply",
	'messages:toggle' => 'Toggle',
	'messages:markread' => 'Markread',
	'messages:recipient' => 'Select recipient',
	'messages:to_user' => 'To: %s',

	'messages:new' => 'New message',

	'notification:method:site' => 'Site',

	'messages:error' => 'Save failed,please try again later.',

	'item:object:messages' => 'All messages',

	/**
	* Status messages
	*/

	'messages:posted' => "Your message has sent.",
	'messages:success:delete:single' => 'This message has deleted.',
	'messages:success:delete' => 'These messages have deleted.',
	'messages:success:read' => 'These messages have marked read.',
	'messages:error:messages_not_selected' => 'you do not selected any message.',
	'messages:error:delete:single' => 'delete failed',

	/**
	* Email messages
	*/

	'messages:email:subject' => 'You have new message.',
	'messages:email:body' => "You have message from %s :


	%s


	If you want to read this message,please click this link::

	%s

	If you want to send message to %s , please click here:

	%s

	You could not reply this email.",

	
	
	// system
	'reportedcontent:this'=>'Report problem',
);

add_translation('en', $english);