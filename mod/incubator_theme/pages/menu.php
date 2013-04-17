<?php
$owner=elgg_get_logged_in_user_entity();
$owner_name=$owner->username;

$body =<<<html
<canvas id="menumap" width="1280" height="300" style="opacity: 1; "></canvas>
html;
$mainmenu="['Creabator','Projects','MyProfile','General']";
$mapid="#menumap";
 $theUI=<<<html
{
nodes:{

Creabator:{color:"green", shape:"dot", alpha:1,level:0,fcolor:"white"},
Projects:{color:"blue", alpha:1,shape:"dot",level:1,link:'/incubator/projects/all?order=menu'},

MyProfile:{color:"red",alpha:1,shape:"dot",level:1,link:'/incubator/profile/$owner_name'},
MyPresentation:{color:"white", alpha:0,link:'/incubator/profile/$owner_name?section=MyPresentation'},
JoinProjects:{color:"white", alpha:0,link:'/incubator/profile/$owner_name?section=JoinProjects'},
MyProjects:{color:"white", alpha:0,link:'/incubator/profile/$owner_name?section=MyProjects'},

General:{color:"#a7af00", alpha:1,shape:"dot",level:1, link:'/incubator/about'},
FAQ:{color:"white", alpha:0,link:'/incubator/faq'},
Contact:{color:"white", alpha:0,link:'/incubator/contact'},
Sponsors:{color:"white", alpha:0,link:'/incubator/sponsors'},

},
edges:{
Creabator:{
Projects:{length:.5},
MyProfile:{length:.5},
General:{length:.5},
},

MyProfile:{
MyPresentation:{},
JoinProjects:{},
MyProjects:{},
},

General:{
FAQ:{},
Contact:{},
Sponsors:{},
},

}

}
html;
 
echo elgg_view_page(null, $body,'arbor');
?>
<script type="text/javascript">
// the creabator index page js
(function($){
  

  $(document).ready(function(){
	    var CLR = {
	     
	    
	      project:"#a7af00"
	    }

	    var theUI = <?php echo $theUI?>
	    
	   

	    var sys = arbor.ParticleSystem()
	   
	    sys.parameters({stiffness:900, repulsion:2000, gravity:true, dt:0.015})
	    
	    sys.renderer = arbor.SiteRenderer("<?php echo $mapid ?>",<?php echo $mainmenu ?>,.9)
	    sys.graft(theUI)
	   
	  })
  
 

  
})(this.jQuery)
</script>