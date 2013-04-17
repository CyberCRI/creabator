
function C_slider(frame,list,Lframe,Llist,forwardEle,backEle,scrollType,LscrollType,acitonType,autoInterval){
	this.frame = frame;
	this.list = list;
	this.Lframe = Lframe;
	this.Llist = Llist;
	this.forwardEle = forwardEle;
	this.backEle = backEle;
	this.scrollType = scrollType;
	this.LscrollType = LscrollType;
	this.acitonType = acitonType;
	this.autoInterval = autoInterval;
	
	this.slideLength = $("#"+this.Llist+" > li").length;//�ܵ�slider����
	this.currentSlide = 0;
	this.FrameHeight = $("#"+this.frame).height();
	this.FrameWidth = $("#"+this.frame).width();
	this.lFrameHeight = $("#"+this.Lframe).height();
	this.lFrameWidth = $("#"+this.Lframe).width();
	this.lListHeight = $("#"+this.Llist+" >li").eq(0).outerHeight(true);
	this.lListWidth = $("#"+this.Llist+" >li").eq(0).outerWidth(true);
	
	var self = this;
	
	for(var i = 0; i<this.slideLength; i++) {
		$("#"+this.Llist+" > li").eq(i).data("index",i);
		$("#"+this.Llist+" > li").eq(i).bind(this.acitonType,function(){
			self.go($(this).data("index"));
		});
	};
	
	//������һ����������һ������ť��Ӷ���
	$("#"+this.forwardEle).bind('click',function(){
		self.forward();
		return false;
	});
	$("#"+this.backEle).bind('click',function(){
		self.back();
		return false;
	});
	
	//������껮��ʱ���Զ��ֻ��Ĵ���
	$("#"+this.frame+",#"+this.Lframe+",#"+this.forwardEle+",#"+this.backEle).bind('mouseover',function(){
		clearTimeout(self.autoExt);
	});
	
	$("#"+this.frame+",#"+this.Lframe+",#"+this.forwardEle+",#"+this.backEle).bind('mouseout',function(){
		clearTimeout(self.autoExt);
		self.autoExt = setTimeout(function(){
			self.extInterval();
		},self.autoInterval);
	});	
	
	
	//��ʼ�Զ��ֻ�
	this.autoExt = setTimeout(function(){
		self.extInterval();
	},this.autoInterval);
}
//ִ���˶�
C_slider.prototype.go = function(index){
	this.currentSlide = index;
	if (this.scrollType == "left"){
		$("."+this.list).animate({
			marginLeft: (-index*this.FrameWidth)+"px"
		}, {duration:600,queue:false}); 		
	} else if (this.scrollType == "top"){
		$("."+this.list).animate({
			marginTop: (-index*this.FrameHeight)+"px"
		}, {duration:600,queue:false}); 		
	}
	
	$("#"+this.Llist+" > li").removeClass("cur");
	$("#"+this.Llist+" > li").eq(index).addClass("cur");
		
	//��������ͼ�Ĺ�������
	if(this.LscrollType == "left"){
		if(this.slideLength*this.lListWidth > this.lFrameWidth){
			var spaceWidth = (this.lFrameWidth - this.lListWidth)/2;
			var hiddenSpace = this.lListWidth*this.currentSlide - spaceWidth;
			
			if (hiddenSpace > 0){
				if(hiddenSpace+this.lFrameWidth <= this.slideLength*this.lListWidth){
					$("#"+this.Llist).animate({
						marginLeft: -hiddenSpace+"px"
					}, {duration:600,queue:false}); 
				} else {
					var endHidden = this.slideLength*this.lListWidth - this.lFrameWidth;
					$("#"+this.Llist).animate({
						marginLeft: -endHidden+"px"
					}, {duration:600,queue:false}); 
				}
			} else {
				$("#"+this.Llist).animate({
					marginLeft: "0px"
				}, {duration:600,queue:false}); 
			}
		}
		
	} else if (this.LscrollType == "top"){
		if(this.slideLength*this.lListHeight > this.lFrameHeight){
			var spaceHeight = (this.lFrameHeight - this.lListHeight)/2;
			var hiddenSpace = this.lListHeight*this.currentSlide - spaceHeight;
			
			if (hiddenSpace > 0){
				if(hiddenSpace+this.lFrameHeight <= this.slideLength*this.lListHeight){
					$("#"+this.Llist).animate({
						marginTop: -hiddenSpace+"px"
					}, {duration:600,queue:false}); 
				} else {
					var endHidden = this.slideLength*this.lListHeight - this.lFrameHeight;
					$("#"+this.Llist).animate({
						marginTop: -endHidden+"px"
					}, {duration:600,queue:false}); 
				}
			} else {
				$("#"+this.Llist).animate({
					marginTop: "0px"
				}, {duration:600,queue:false}); 
			}
		}
		
	}
	
}
//ǰ��
C_slider.prototype.forward = function(){
	if(this.currentSlide<this.slideLength-1){
		this.currentSlide += 1;
		this.go(this.currentSlide);
	}else {
		this.currentSlide = 0;
		this.go(0);
	}
}
//����
C_slider.prototype.back = function(){
	if(this.currentSlide>0){
		this.currentSlide -= 1;
		this.go(this.currentSlide);
	}else {
		this.currentSlide = this.slideLength-1;
		this.go(this.slideLength-1);
	}
}
//�Զ�ִ��
C_slider.prototype.extInterval = function(){
	if(this.currentSlide<this.slideLength-1){
		this.currentSlide += 1;
		this.go(this.currentSlide);
	}else {
		this.currentSlide = 0;
		this.go(0);
	}
	
	var self = this;
	this.autoExt = setTimeout(function(){
		self.extInterval();
	},this.autoInterval);
}
//ʵ�������� 

var goSlide = new C_slider("big_frame","big_list","small_frame","small_list","forward","back","left","top","click",5000);
