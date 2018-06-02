function a_shadow(){	
	$imgs = $("#question_list img");
	
	$imgs.each(function(){
		$(this).mouseenter(function(){
			$(this).animate({
				boxShadow: '0px 0px 10px #9933FF'
			})
		})
		$(this).mouseleave(function(){
			$(this).animate({
				boxShadow: '0px 0px 0px white'
			})
		})
	})

}

addLoadEvent( a_shadow );

