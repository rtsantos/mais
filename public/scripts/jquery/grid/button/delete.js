(function($) {
    $.gridButtonDelete = function(options){
        options : {
            idGrid:''
            url:''
        }

    options = $.extend(options, options || {} );

        var grid = $('#' + options.idGrid );
        if( grid.jqGrid('getGridParam','multiselect') ){
            var rowToDelete = grid.jqGrid('getGridParam','selarrrow');
        }else{
            var rowToDelete = grid.jqGrid('getGridParam','selrow');
        }
        //alert(rowToDelete);
        //exit;
        //var rowToDelete = $('#' + options.idGrid ).jqGrid('getGridParam','selrow');

        $('#' + options.idGrid ).jqGrid(
            'delGridRow',
            rowToDelete,
            {
                url: options.url, 
                reloadAfterSubmit:true,
                afterSubmit: function(data,postdata){
                    var json = decodeJson(data.responseText);
                    var result = [];
                    if (!json){
                        result = [false,result];
                    }else if (json.exception){
                        result = [false,json.exception.message];
                    }else{
                        result = [true,''];
                    }
                    return result;
                }
            }
            );
    }
})(jQuery);

