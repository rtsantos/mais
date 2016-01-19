(function($) {
	$.MenuT = function (){
		var elements = $('.fg-button');
		
                elements.hover(
                        function(){ $(this).removeClass('ui-state-default').addClass('ui-state-focus'); },
                        function(){ $(this).removeClass('ui-state-focus').addClass('ui-state-default'); }
                );
		
		for (var Idx=0; Idx<elements.length; Idx++){
			var v_name_ul = elements.eq(Idx).attr('href');
			var v_directionH = elements.eq(Idx).attr('directionH');
			if (v_directionH == '') v_directionH = 'right';
			
			var v_positionOpts = {
				posX: 'left', 
				posY: 'bottom',
				offsetX: 0,
				offsetY: 0,
				directionH: v_directionH,
				directionV: 'down', 
				detectH: false, // do horizontal collision detection  
				detectV:false, // do vertical collision detection
				linkToFront: false					
			};
			
			if (v_name_ul != '#' && v_name_ul.substr(0,1) == '#'){
				elements.eq(Idx).menu({ 
					content: $(v_name_ul).html(),
					showSpeed: 250,
					flyOut: true,
					callerOnState: 'ui-state-active',
					positionOpts:v_positionOpts
				});
			}
		}
	};
})(jQuery);