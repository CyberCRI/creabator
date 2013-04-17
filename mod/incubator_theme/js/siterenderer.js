
// the creabator index page js
(function($){
  
	  var SiteRenderer = function(elt,mainMenu,ch){
		    var dom = $(elt)
		    var canvas = dom.get(0)
		    var ctx = canvas.getContext("2d");
		    var gfx = arbor.Graphics(canvas)
		    var sys = null
		    var _vignette = null
		    var selected = null,
		        nearest = null,
		        _mouseP = null;

		    
		    var that = {
		      init:function(pSystem){
		        sys = pSystem
		        sys.screen({size:{width:dom.width(), height:dom.height()},
		                    padding:[36,60,36,60]})

		        $(window).resize(that.resize)
		        that.resize()
		        that._initMouseHandling()


		      },
		      resize:function(){
		    	  
		        canvas.width = $(window).width()
		        canvas.height = ch* $(window).height()
		        sys.screen({size:{width:canvas.width, height:canvas.height}})
		        _vignette = null
		        that.redraw()
		      },
		      redraw:function(){
		        gfx.clear()
		        
		        sys.eachEdge(function(edge, p1, p2){
		          if (edge.source.data.alpha * edge.target.data.alpha == 0) return
		          gfx.line(p1, p2, {stroke:"#000000", width:2, alpha:edge.target.data.alpha})
		        })
		        sys.eachNode(function(node, pt){
		        
		          var w = Math.max(30, 30+gfx.textWidth(node.name) )
		          var tc="white"
		          
		          if (node.data.alpha===0) return
		          if (node.data.size){
	        		  w=w+node.data.size
	        	  }
	        	 
	        	  if(node.data.imglink){
			        	
			        	 var img=new Image(); 
			        	 img.src=node.data.imglink;
			        	 ctx.drawImage(img,pt.x-w/2,pt.y-16)
			        	 node.name='                               '
			        
			        	 }
	        	  
	        	  if(node.data.fcolor){
	        		  tc=node.data.fcolor
	        	  }
	        	 if (node.data.shape=='dot'){
	        		 if(node.data.level==0){
		        		 w=w+50
		        	 }
		            gfx.oval(pt.x-w/2, pt.y-w/2, w, w, {fill:node.data.color, alpha:node.data.alpha,})
		            gfx.text(node.name, pt.x, pt.y+9, {color:tc, align:"center",  size:16})
		            gfx.text(node.name, pt.x, pt.y+9, {color:tc, align:"center", size:16})
		        }else{
		            gfx.rect(pt.x-w/2, pt.y-12, w, 28, 16, {fill:node.data.color, alpha:node.data.alpha})
		            gfx.text(node.name, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:16})
		            gfx.text(node.name, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:16})
		          } 
		             
		          
		        })
		       
		      },
		      
		     

		      switchMode:function(e){
		        if (e.mode=='hidden'){
		          dom.stop(true).fadeTo(e.dt,0, function(){
		            if (sys) sys.stop()
		            $(this).hide()
		          })
		        }else if (e.mode=='visible'){
		          dom.stop(true).css('opacity',0).show().fadeTo(e.dt,1,function(){
		            that.resize()
		          })
		          if (sys) sys.start()
		        }
		      },
		      
		      switchSection:function(newSection){
		        var parent = sys.getEdgesFrom(newSection)[0].source
		        var children = $.map(sys.getEdgesFrom(newSection), function(edge){
		          return edge.target
		        })
		       
		        sys.eachNode(function(node){
		          if (node.data.shape=='dot'){
		        	if(node.name==parent.name&&node.data.level==1){
		        		node.data.size=10
		        		
		        	}else{
		        		node.data.size=null
		        	}
		          
		          return // skip all but leafnodes
		          } 
		          var nowVisible = ($.inArray(node, children)>=0)
		          var newAlpha = (nowVisible) ? .5 : 0
		          var dt = (nowVisible) ? .5 : .5
		          
		          sys.tweenNode(node, dt, {alpha:newAlpha})
		           
		          if (newAlpha==0.5){
		            node.p.x = parent.p.x + .05*Math.random() - .025
		            node.p.y = parent.p.y + .05*Math.random() - .025
		            node.tempMass = .001
		          
		          }
		        })
		      },
		    
		      
        	  
		      _initMouseHandling:function(){
		        // no-nonsense drag and drop (thanks springy.js)
		        selected = null;
		        nearest = null;
		        var dragged = null;
		        var oldmass = 1

		        var _section = null

		        var handler = {
		          moved:function(e){
		            var pos = $(canvas).offset();
		            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
		            nearest = sys.nearest(_mouseP);

		            if (!nearest.node) return false
		            
		            if (nearest.node.data.shape!='dot'){
		            	selected = (nearest.distance < 50) ? nearest : null
		              if (selected){
		                 dom.addClass('linkable')
		                 window.status = selected.node.data.link.replace(/^\//,"http://"+window.location.host+"/").replace(/^#/,'')
		              }
		              else{
		                 dom.removeClass('linkable')
		                 window.status = ''
		              }
		            }else if ($.inArray(nearest.node.name, mainMenu) >=0 ){
		            	
		            	
		            if (nearest.node.name!=_section){
		            	
		                _section = nearest.node.name
		                that.switchSection(_section)
		              }
		            if(nearest.node.data.level==1){
		            	selected = (nearest.distance < 50) ? nearest : null
		            	dom.addClass('linkable')
		                 window.status = selected.node.data.link.replace(/^\//,"http://"+window.location.host+"/").replace(/^#/,'')
		            
		            }else{
		              dom.removeClass('linkable')
		              window.status = ''
		            }	
		            }
		            
		            return false
		          },
		          clicked:function(e){
		            var pos = $(canvas).offset();
		            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
		            nearest = dragged = sys.nearest(_mouseP);
		           
		            
		            if (nearest && selected && nearest.node===selected.node){
		              var link = selected.node.data.link
		             
		              
		                  window.location = link
		               
		              
		              return false
		            }
		            
		           
		            
		            if (dragged && dragged.node !== null) dragged.node.fixed = true

		            $(canvas).unbind('mousemove', handler.moved);
		            $(canvas).bind('mousemove', handler.dragged)
		            $(window).bind('mouseup', handler.dropped)

		            return false
		          },
		          dragged:function(e){
		            var old_nearest = nearest && nearest.node._id
		            var pos = $(canvas).offset();
		            var s = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)

		            if (!nearest) return
		            if (dragged !== null && dragged.node !== null){
		              var p = sys.fromScreen(s)
		              dragged.node.p = p
		            }

		            return false
		          },

		          dropped:function(e){
		            if (dragged===null || dragged.node===undefined) return
		            if (dragged.node !== null) dragged.node.fixed = false
		            dragged.node.tempMass = 1000
		            dragged = null;
		            // selected = null
		            $(canvas).unbind('mousemove', handler.dragged)
		            $(window).unbind('mouseup', handler.dropped)
		            $(canvas).bind('mousemove', handler.moved);
		            _mouseP = null
		            return false
		          }

		        
		        }

		        $(canvas).mousedown(handler.clicked);
		        $(canvas).mousemove(handler.moved);

		      }
		    }
		    
		    return that
		  }
		  arbor = (typeof(arbor)!=='undefined') ? arbor : {}
		  $.extend(arbor, {
		    
			  SiteRenderer:function(elt,mainMenu,ch){ return SiteRenderer(elt,mainMenu,ch) },
		  })
 

  
})(this.jQuery)