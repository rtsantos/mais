(function($) {
    $.fn.extend({
        seeker: function(p_options){
		
            var options = {
                seekerControl: '',
                seekerDisplay: p_options.idDisplay,
                seekerFields: p_options.fieldsReturn,
                seekerName: p_options.name,
                seekerTypeModal: p_options.typeModal,
                seekerUrl: p_options.url,
                seekerOperationType: p_options.seekerOperationType,
                seekerWindowHeight: p_options.windowHeight,
                seekerWindowWidth: p_options.windowWidth,
                seekerIdButton: p_options.idButton,
                seekerIdHiddenId: p_options.idHiddenId,
                seekerIdSearchId: p_options.idSearch,
                seekerOnChange: p_options.onChange,
                seekerFilter: p_options.filter
            };
            p_options = null;
            
            if (options.seekerOnChange != null){
                if (typeof options.seekerOnChange == 'string'){
                    eval(" options.seekerOnChange = " + Base64.decode(options.seekerOnChange));
                }
            }
            
            if (options.seekerFilter != null){
                if (typeof options.seekerFilter == 'string'){
                    eval(" options.seekerFilter = " + Base64.decode(options.seekerFilter));
                }
            }
            			
            return this.each(function() {
                new $.seekerObject(this,options);
            });
        }
    });

    /**
     * Construtor do objeto Seeker
     *
     *
     */
    $.seekerObject = function (obj,options){
        options.id = obj.id;
        //options.seekerDisabled = false;
        $('#'+options.id).attr('valueold','');
        if(!options.seekerIdSearchId || options.seekerIdSearchId == ''){
            options.seekerIdSearchId = options.seekerName;
        }
        if($('#'+options.seekerDisplay)){
            $('#'+options.seekerDisplay).attr('readonly',true);
        }
        options.retornoField = [options.seekerIdHiddenId,
        options.seekerIdSearchId,
        options.seekerDisplay];
        options.seekerControl = '';
        var objButton = $('#'+options.seekerIdButton);
        
        if (jQuery(obj).hasClass('required')){
            var varNoFocus = false;
        }else{
            var varNoFocus = true;
        }
        
        objButton.attr('class','ui-button ui-widget ui-state-default ui-corner-right ui-button-icon-only')/*ui-corner-all*/
                 .attr('nofocus',varNoFocus)
                 .html('<span class="ui-button-icon-primary ui-icon ui-icon-search"></span><span>&nbsp;</span>')
                 .width(24)
                 .css('position','absolute')
                 .css('top','0')
                 .css('height', (objButton.prev().height() + 4) +  'px');
                 
        objButton.focus(function(){
            $(this).removeClass('ui-state-default').addClass('ui-state-focus');
        }).focusout(function(){
            $(this).removeClass('ui-state-focus').addClass('ui-state-default');
        }).hover(function(){$(this).removeClass('ui-state-default').addClass('ui-state-focus');}
                ,function(){$(this).removeClass('ui-state-focus').addClass('ui-state-default');});
        /*$('#'+options.seekerIdButton).button({
            icons:{
                primary: 'ui-icon-search'
            },
            text:false
        });*/
        
        var vFilter = '';
        if (options.seekerFilter != null){
            var vFilterResult = options.seekerFilter();
            if (vFilterResult == false) return false;
            else vFilter = '&' + vFilterResult;
        }
        
        /**
         * Função que retorna um resultado por ID
         *         
         */
        options.seekerRetriveByIdResult = function(jsonString){
            var vJson = decodeJson(jsonString);
            if (vJson == false){
                options.seekerClear();
            }else{
                options.seekerLoad(vJson,'seeker');
            }
        };
	
  
        options.seekerEventChangeResult = function (jsonString){
            var vJson = decodeJson(jsonString);
            if (vJson == false){
                alert('Erro gerado na solicitação!');
                $(this).addClass("seeker");
                options.seekerControl = 'erro';
                options.unblock();
            }else{
                if (vJson.error){
                    alert('Erro: ' + vJson.exception.message);
                    options.seekerControl = 'erro';
                    $(this).addClass("seeker");                    
                }else if(vJson.row){
                    options.seekerLoad(vJson.row,'seeker-no-window');
                }else{
                    options.seekerControl = 'loading';
                    var vParam = 'name=' + options.id + '&postData=' + vJson.postData;
                    if (options.seekerFilter != null){
                        var vFilterResult = options.seekerFilter();
                        if (vFilterResult == false) return false;

                        else vParam = vParam + '&' + vFilterResult;
                    }
                    options.seekerWindowSearch(vParam,vJson.postData);
                }
            }			
        };
		
        options.seekerClear = function(){
            $(this).addClass("seeker").attr('valueold','');
            options.seekerControl = '';
            var data = [];
            for(var IndexF in options.seekerFields){
                data[options.retornoField[IndexF]] = '';
                $('#' + options.retornoField[IndexF]).val('');
            }            
            if (options.seekerOnChange != null){
                options.seekerOnChange(data);
            }
            
            var objButton = $('#'+options.seekerIdButton);
            if (jQuery(obj).hasClass('required')){
                var varNoFocus = false;
            }else{
                var varNoFocus = true;
            }
            objButton.attr('nofocus',varNoFocus);
        };
		
        options.seekerLoad = function (data,access){               
            $(this).addClass("seeker");
            options.seekerControl = 'loading';
            if(typeof data[0] == 'object'){
                var vData = [];
                for (var Item in data[0]){
                    vData[Item.toLowerCase()] = data[0][Item];
                }
                if (vData.length > 0){  
                    data = vData;
                }else{
                    data = data[0];
                }
                vData = null;
            }else{
                var vData = [];
                for (var Item in data){
                    vData[Item.toLowerCase()] = data[Item];
                }
                if (vData.length > 0){  
                    data = vData;
                }
                vData = null;
            }
            if (data.length == 0){
                options.seekerClear();
            }
            for(var IndexF in options.seekerFields){
                if (data[options.seekerFields[IndexF]]){
                    var vFieldName = options.retornoField[IndexF];
                    var vValue     = data[options.seekerFields[IndexF]];                    
                    try{
                        $('input#'+vFieldName).val(vValue);
                        if(IndexF == 1){
                            $('input#'+vFieldName).attr('valueold',vValue);
                        }
                    }catch(er){
                        null;
                    }
                }
            }
            options.seekerControl = 'loaded';
            var objSearch = $('#'+options.id);
            objSearch.removeClass("erro");
            if (access == 'seeker'){
                objSearch.focus();
            }
            if (options.seekerOnChange != null){
                options.seekerOnChange(data);
            }
            /**
             * Objeto carregado não precisa dar o focus no botão para abrir janela.
             **/ 
            var objButton = $('#'+options.seekerIdButton);
            objButton.attr('nofocus',true);
            /**
             * Pula para o próximo campo
             */
            nextFocus($('#'+options.id));
        };
        options.id_div_block = '';
		
        options.block = function (){
            if (options.id_div_block == ''){
                var divBlock = $('#'+options.id).parents().find('.ui-dialog-content');
                if (divBlock.eq(0).attr('id')){
                    options.id_div_block = divBlock.eq(0).attr('id'); 
                }else{
                    options.id_div_block = 'div_content';
                }
            }
            var param  = {
                id:options.id_div_block
            };
        };
		
        options.unblock = function (){
        };
		
        options.seekerWindowSearch = function(param,vPostData){
            //options.seekerControl = 'window';
            if (!param) param = 'seekerAjax=1';
            else param = 'seekerAjax=1&'+param;
            
            var fAfterLoad = '';
            if (options.seekerControl == 'loading'){
                fAfterLoad = "\n\
                        if ($('#"+options.seekerIdHiddenId+"',top.opener.document).val() == ''){\n\
                            $('#"+options.seekerIdSearchId+"',top.opener.document).val('');\n\
                            if($('#"+options.seekerDisplay+"',top.opener.document)){\n\
                                $('#"+options.seekerDisplay+"',top.opener.document).val('');\n\
                            }\n\
                            $('#"+options.id+"',top.opener.document).attr('valueold','');\n\
                        ";
                if(options.seekerDisplay){
                    fAfterLoad+= "$('"+options.seekerDisplay+"',top.opener.document).val('');\n"
                }
                fAfterLoad+= '}';                
            }

            $.WindowT.open({
                id: 'win-seeker-'+ options.seekerName,
                url: options.seekerUrl.grid,
                onAfterLoad: fAfterLoad,                    
                type: options.seekerTypeModal,
                param: param,
                modal:true,
                height: options.seekerWindowHeight,
                width: options.seekerWindowWidth
            });
            /*if (!$('#'+'win-seeker-' + options.seekerName).seekerIdSearchId){
               $('#'+'win-seeker-' + options.seekerName).seekerIdSearchId = this.id;
            }*/
        };
	
		
        options = $.extend(options, options ||{});
		
        obj.seekerLoad = function(vJson,access){
            options.seekerLoad(vJson,access);
        };
		
        obj.seekerIsLoaded = function(){
            if ($('#'+options.seekerIdHiddenId).val() != '') return true;
            else if (options.seekerControl == 'window' || options.seekerControl == 'loaded') return true;
            else return false;
        };
		
        obj.seekerClear = function(){
            options.seekerClear();
        };
		
        obj.seekerWindowClose = function(){
            $('#win-seeker-' + options.seekerName).dialog('close');
            options.unblock();
        };
		
        obj.seekerRetriveById = function (param){
            options.block();
            $.ajax({
                type: 'POST',
                url: options.seekerUrl.retrive,
                data: 'id=' + escape(param.value) + '&seekerAjax=1&name=' + options.id,
                success: options.seekerRetriveByIdResult
            });
        };

        obj.seekerEventChange = function (){
            options.seekerControl = 'search';
            if ($(this).val() == ''){
                options.seekerClear();
            }else{
                if ($(this).attr('valueold') == ''){
                    obj.seekerExecute();
                }else if ($(this).attr('valueold') != $(this).val()){
                    obj.seekerExecute();
                }else{
                    //console.log('OLD: ' + $(this).attr('valueold'));
                    //console.log('Novo: ' + $(this).val());
                }
            }
        };
        
        obj.seekerExecute = function(dataParam){            
            var field = '';
            var value = '';
            if (options.seekerControl == 'detail'){
                value = $('#'+options.seekerIdHiddenId).val();
                field = 'id';
            }else{
                $('#'+options.seekerIdHiddenId).val('');
                value = $(this).val();
                field = '';
            }            
            options.block();

            var vFilter = '';
            if (options.seekerFilter != null){
                var vFilterResult = options.seekerFilter();
                if (vFilterResult == false) return false;
                else vFilter = '&' + vFilterResult;
            }
            $(this).removeClass("seeker");
            $.ajax({
                type: 'POST',
                url: options.seekerUrl.search,
                data: 'value=' + value + '&field=' + field + '&limit=10' + '&seekerAjax=1' + vFilter + '&' + dataParam,
                success: options.seekerEventChangeResult
            });
        }
                
        obj.seekerCreateEvents = function(){
            $('#'+options.seekerIdSearchId).focusout(function(){
                obj.seekerEventChange();
            });
			
            if (!$('#'+options.seekerIdButton).seekerIdSearch){
                $('#'+options.seekerIdButton).seekerIdSearch = this.id;
            }
            $('#'+options.seekerIdButton).click(function (){
                options.seekerControl = 'detail';
                obj.seekerExecute('makePostData=1');
            });
			
            if (!$('#'+options.seekerIdHiddenId).seekerIdSearch){
                $('#'+options.seekerName).seekerIdSearch = this.id;
            }
            if (!$('#'+options.seekerIdHiddenId).seekerRetrive){
                $('#'+options.seekerIdHiddenId).seekerRetrive = 1;
            }
        };
        obj.seekerEventChange();
    };
    
    /**
     * Função que retorna que inicia o retrive dos dados
     * 
     */
    $.seekerRetrive = function(obj,newValue){
        var seeker = $('#' + obj.seekerIdSearch)[0];
        if (newValue == null || newValue == ''){
            seeker.seekerClear();
        }else if (newValue != obj.value){
            obj.value = newValue;
            seeker.seekerRetriveById({
                value: newValue
            });
        }
    };
})(jQuery);