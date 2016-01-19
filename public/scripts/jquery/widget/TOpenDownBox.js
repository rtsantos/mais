/**
 * Classe para criação de uma div recipiente para receber conteudo.
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.ui.effects.*.js (depende da animação desejado)
 *
 * Opções:
 * - effectType(str): Define um tipo de efeito para a caixa; Default blind; Ref http://jqueryui.com/demos/show/
 * - boxId('str'): Define um ID para o box; Default ta-TOpenDownBox-div + element.id
 * - classButton(str): Define a classe do botão de ação; Default ta-TOpenDownBox-bt
 * - classInput(str): Define uma classe para o input; Default ta-TOpenDownBox-input
 * - classBox(str): Define uma classe para o Box; Defaulr ta-TOpenDownBox
 * - classDivElements(str): Define uma classe para a div que agrupa os elementos text e button; Default ta-TOpenDownBox-divEl
 * - showButton(bol): Habilita o botão para mostrar o DownBox; Default true
 * - icoShowButton(str): Modifica o icone padrão do botão que mostra o DownBox; Default ui-icon-carat-1-s
 * - open(function): Recebe uma função para ser executada quando o box é aberto: Default false;
 * - close(function): Recebe uma função para ser executada quando o box é fechado: Default false;
 * - success(function): Recebe uma função para ser executada quando o box é criado com sucesso: Default false;
 * - marginTop(int): Quantidade de px do DownBox em relação ao elemento; Default 0;
 * - width(int): Define a width para o DownBox; Default Mesma width do elemento;
 * - height(int): Define o height para o DownBox; Default auto;
 * - url(str): Define uma URL para ser carregada no DownBox; Default false; - O retorno será HTML
 * - methodUrl(str): Define o metodo da URL que será carregada. Essa opção dependa da url; Default POST
 * - paramUrl(str): Recebe os parametros para serem passados na URL a ser carregada no Box; Default false
 * - content(obj): Recebe um objeto para ser colocado entro do Box; Default false;
 */

(function( $ ) {
    $.widget( 'ta.TOpenDownBox',{
        options: {
            boxId: 'ta-TOpenDownBox-div',
            classButton: 'ta-TOpenDownBox-bt',
            classInput: 'ta-TOpenDownBox-input',
            classBox: 'ta-TOpenDownBox',
            classDivElements: 'ta-TOpenDownBox-divEl',
            methodUrl: 'POST',
            icoShowButton: 'ui-icon-carat-1-s',
            showButton: true,
            marginTop:0
        },
        
        _create: function (){
            var self = this,
            doc = this.element[ 0 ].ownerDocument;
            var zindex = 0;
            if(self.options.boxId == 'ta-TOpenDownBox-div'){
                self.options.boxId = self.options.boxId + '-' + this.element.index();
            }
            if(this.element.css('z-index') != 'auto'){
                zindex = this.element.css('z-index');
            }
            self.closeClock = 0;
            
            this.divBox = $("<div></div>")
            .addClass(self.options.classBox)
            .attr('id',self.options.boxId)
            .css('display','none')
            .css('z-index',(parseInt(zindex)+1))
            .appendTo($('body',doc)[0])
            .mouseleave(function(){
                self.closeClock = setTimeout(function(){
                    self.close();
                },500);
            }).mouseenter(function(){
                clearTimeout(self.closeClock);
            });
            
            this.divElementos = $("<div></div>")
            .addClass(self.options.classDivElements)
            .insertAfter(this.element)
            .append(this.element)
            .height(this.element.height()+4)
            .width(this.element.width())
            .css('position','relative');
            
            if(self.options.showButton == true){
                this.btBusca = $("<span></span>")
                .insertAfter(this.element)
                .addClass('ui-button ui-state-default ui-corner-right ui-button-icon-only')
                .height(self.element.height())
                .width(24)
                .css('margin-right','0')
                .css('position','absolute')
                .css('top','0')
                .css('right','-4px')
                
                .click(function(){
                    self.openClose();
                });
                this.innerBtBusca = $("<span></span>")
                .addClass('ui-button-icon-primary ui-icon ' + self.options.icoShowButton)
                .appendTo(this.btBusca);    
                $('<span>&nbsp;</span>')
                .insertAfter(this.innerBtBusca);
            }    
            
            this.element
            .addClass(self.options.classInput)
            .css('padding-right','18px')
            .width(this.element.width()-18);
            this.success();
        },
        
        close: function(){
            var self = this;
            self.element.attr('status',0);
            if(self.options.effectType){
                self.divBox.hide(self.options.effectType,'','fast');
            }else{
                self.divBox.hide();
            }
            if(self.options.close){
                this.options.close();
            }  
        },
        
        openClose: function(){
            var self = this;
            if(self.element.attr('status') == 1){
                self.close();
            }else{
                self.open();
            }
        },
        
        open: function(){
            var self = this;
            var elementPosition = self.divElementos.position();
            self.divBox.css('top',elementPosition.top +self.element.height()+5+self.options.marginTop);
            self.divBox.css('left',elementPosition.left);
            if(self.options.width){
                self.divBox.width(self.options.width+18);
            }else{
                self.divBox.width(self.element.width()+parseInt(self.element.css('padding-left'))+18);
            }
            if(self.options.height){
                self.divBox.height(self.options.height);
            }
            self.divBox.css('position','absolute');
            self.element.attr('status',1);
            if(self.options.effectType){
                self.divBox.show(self.options.effectType,'','fast');
            }else{
                self.divBox.show();   
            }
            if(self.options.open){
                this.options.open();
            }    
            if(self.options.url){
                self.loadAjax(self.options.url,self.options.paramUrl);
            }
        },
        
        success: function(){
            var self = this;
            if(self.options.content){
                self.divBox.append(self.options.content);
            }
            if(self.options.success){
                self.options.success();
            }
        },
   
        
        loadAjax: function(urlBusca,param){
            var self = this;
            //if(urlBusca && param && (param != self.options.paramUrl || urlBusca != self.options.url)){
                self.divBox.html = '';
                $.ajax({
                    type: self.options.methodUrl,
                    url: urlBusca,
                    data: param,
                    success:function(vretorno){
                        $(self.divBox).html(vretorno);
                    }
                });
                self.options.url = urlBusca;
                self.options.paramUrl = param;
           // }
        },
        
        changeOptions: function(vparam,value){
            var self = this;
            if(vparam == 'url'){
                self.options.url = value;
            }else if(vparam == 'param'){
                self.options.param = value;
            }
        },
        
        destroy: function() {
            var self = this;
            self.element.removeClass('ta-TOpenDownBox-input');
            self.element.insertAfter(self.divElementos);
            self.divElementos.remove();
            self.divBox.remove();
            $.Widget.prototype.destroy.call( this );
        }
         
    });
})(jQuery);
