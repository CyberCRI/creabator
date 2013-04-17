<?php
/**
 * themes chinese language file
 */

$chinese = array(
	'sitename'=>'觅方',
	'slogan'=>"刨根问底探索未知世界",
	'apply'=>'申请账户',
	'about'=>'关于我们',
	'contact'=>'联系我们',
	'help'=>'获得帮助',
	'item:object:question'=>'所答问题',
	'item:object:question-top'=>'所提问题',
	//header menu
	'menu:index'=>"首页",
	'menu:all'=>"探索",
	'menu:activity'=>'最新动态',
	'menu:logout'=>"退出",
	'menu:profile'=>"档案",
	'menu:setting'=>"设置",
	'menu:account'=>"账户设置",
	'menu:friends'=>"关注",
	'menu:friendsof'=>"粉丝",
	'menu:ask'=>"提出问题",
	'menu:message'=>"消息",	
	
		
		
	//sidebar menu
	'sidebar:menu:all'=>'分类探索',

	//reference messgae
       	'reference:subject'=>'有新参考资料',
       	'reference:body'=>' %s 在您的问题(<a href="%s">%s</a>):提供新参考资料:%s 。',
	
	// apply form
	'realname'=>'真实姓名',
	'apply-desc'=>'个人简介(专业背景，研究方向等)',

		
	// river menu
        'river:no question'=>'您还没有关注任何问题，请尝试关注一些您感兴趣的问题。',
        'river:no follow'=>'您还没关注任何人，请尝试关注一些您感兴趣的人。',
	'forward:this'=>'转发帮问这个问题',
	'question:this'=>'反问这个问题',
	//help
	'help:about'=>'关于觅方',
	'help:help'=>'帮助中心',
	'help:jobs'=>'加入我们',
	'help:service'=>'服务条款',
	'help:privacy'=>'隐私政策',
	'help:feedback'=>'反馈问题',
	'help:contact'=>'联系我们',

	// messages
	'messages' => "所有消息",
	'messages:unreadcount' => "%s 未读",
	'messages:back' => "返回收件箱",
	'messages:user' => "%s 的收件箱",
	'messages:posttitle' => "%s 的信息: %s",
	'messages:inbox' => "收件箱",
	'messages:send' => "发送",
	'messages:sent' => "已发送",
	'messages:message' => "消息",
	'messages:title' => "题目",
	'messages:to' => "收件人:",
	'messages:from' => "发件人:",
	'messages:fly' => "发送",
	'messages:replying' => "回复给",
	'messages:inbox' => "收件箱",
	'messages:sendmessage' => "发送私信",
	'messages:compose' => "写私信",
	'messages:add' => "写私信",
	'messages:sentmessages' => "已发送消息",
	'messages:recent' => "最近消息",
	'messages:original' => "原有消息",
	'messages:yours' => "您的消息",
	'messages:answer' => "回复",
	'messages:toggle' => '反选',
	'messages:markread' => '标记已读',
	'messages:recipient' => '选择收件人',
	'messages:to_user' => '收件人: %s',

	'messages:new' => '新消息',

	'notification:method:site' => '站点',

	'messages:error' => '信息保存出错，请稍后再试。',

	'item:object:messages' => '所有消息',

	/**
	* Status messages
	*/

	'messages:posted' => "您的消息已发送成功。",
	'messages:success:delete:single' => '这条消息已删除',
	'messages:success:delete' => '这些消息已成功删除。',
	'messages:success:read' => '这些信息已标记为已读',
	'messages:error:messages_not_selected' => '没有选择到任何消息',
	'messages:error:delete:single' => '删除不成功',

	/**
	* Email messages
	*/

	'messages:email:subject' => '您有新消息',
	'messages:email:body' => "您有来自 %s 的新消息:


	%s


	需要阅读这条消息，请点击:

	%s

	需要给 %s 发私信, 请点击:

	%s

	您不能回复这封邮件。",

	/**
	* Error messages
	*/

	'messages:blank' => "抱歉，您需要填写私信内容。",
	'messages:notfound' => "抱歉，我们找不到您需要的消息。",
	'messages:notdeleted' => "抱歉，无法删除此消息。",
	'messages:nopermission' => "您没有权限改变这条消息",
	'messages:nomessages' => "没有消息",
	'messages:user:nonexist' => "我们无法在数据库中无法找到此收件人。",
	'messages:user:blank' => "您没有选择收件人。",

	'messages:deleted_sender' => '用户不存在',
	
	// system
	'reportedcontent:this'=>'报告问题',
);

add_translation('zh', $chinese);