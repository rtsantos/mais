/**
 * Classe para utilização de abas
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 *  
 *
 *
 *  Options:
 *  
 *  
 */

(function($) {
    $.widget( 'ta.TTabs',{  
        options: {
            onError: function(xhr, status, index, anchor){
                $(anchor.hash).html(
                    "Carregando conteudo, aguarde..."
                );
            },
            idPrefix: 'taAba'
        },
        
        /**
         * Método cosntrutor
         *
	 * @access private
	 * @return void
         * 
         * 
	 */
        _create: function(){    
            this.options.ajaxOptions = { error: this.options.onError};
            this.options.fx = this.options.effects;
            if(this.options.disabled == false){
                delete this.options.disabled;
            }
            this.element.tabs(this.options);
        },

        /**
         * Muda a url de uma aba
         * 
         * @param string url
         * @param numeric index
         */
        changeUrl: function(url,index){
            this.element.tabs('url',index,url);
        },
        
        currentTab: function(){
            return this.element.tabs('option', 'selected');
        },
       
        
        /**
         * Desabilita uma aba
         * 
         * @param numeric index
         */
        disable: function(index){
            /*if(index == 1){
                this.element.tabs('select',2);
            }else{
                this.element.tabs('select',1);
            }*/
            this.element.tabs('disable',index);
        },
        
        select: function(index){
            this.element.tabs('select',index);
        },
        /**
         * Desabilita varias abas
         * 
         * @param array indexes
         */
        disableMulti: function(indexes){
            this.element.tabs('options','disabled',indexes);
        },
        
        /**
         * Habilita as abas
         * 
         * @param numeric index
         */
        enable: function(index){
            this.element.tabs('enable',index);
        },
        
        /**
         * Habilita todas as abas
         *  
         * @param array indexes
         */
        enableAll: function(){
            this.element.tabs('options','disabled',[]);
        }
        
    });   
})(jQuery);
