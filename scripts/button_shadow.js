function button_shadow(){	
	$btns = $("[type='submit']");
	
	$btns.each(function(){
		$(this).mouseenter(function(){
			$(this).animate({
				boxShadow: '0px 0px 10px #669999'
			})
		})
		$(this).mouseleave(function(){
			$(this).animate({
				boxShadow: '0px 0px 0px white'
			})
		})
	})
}

addLoadEvent( button_shadow );