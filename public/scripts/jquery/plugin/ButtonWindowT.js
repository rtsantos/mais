if (!loadButtonWindowT){
    var loadButtonWindowT = true;
    var vHeight = 0;
    var vWidth = 0;
    (function($) {	
        $.ButtonWindowT = function(options){
            if (!options.id) options.id = null;
            if (!options.url) options.url = null;
            if (!options.param) options.param = '';
            if (!options.type) options.type = 'WINDOW';
            if (!options.method) options.method = 'GET';
            if (!options.windowHeight) options.windowHeight = 450;
            if (!options.windowWidth) options.windowWidth = 750;
            if (!options.buttons) options.buttons = null;
            if (!options.fullscreen) options.fullscreen = false;

            options = $.extend(options, options ||{});

            var param = 'windowModal=1';
            if (options.param != ''){
                param+= '&' + options.param;
            }
            
            if (options.fullscreen) {
                vHeight = screen.availHeight;
                vWidth = screen.availWidth;
            } else {
                vHeight = options.windowHeight;
                vWidth = options.windowWidth;
            }
            
            $.WindowT.open({
                id: 'win-default-' + options.id,
                type:options.type,
                url: options.url,
                method: options.method,
                param: param,
                height: vHeight,
                width: vWidth,
                buttons: options.buttons
            });
        };
    })(jQuery);
}