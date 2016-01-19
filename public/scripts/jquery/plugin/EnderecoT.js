if (!loadedEnderecoT){
    var loadedEnderecoT = true;
    (function($) {
        $.EnderecoT = {
            searchGPB: function (options){
                var settings = {
                    value: null,
                    url: '/Mais/index.php/gpb/localidade/retrive'
                };
                if(options){
                    jQuery.extend(settings, options);
                }
                var json = $.ajax({
                                type: 'POST',
                                url: options.url,
                                data: 'cep=' + options.value,
                                async: false
                            }).responseText;
                json = decodeJson(json);
            }
        };
    })(jQuery);
}