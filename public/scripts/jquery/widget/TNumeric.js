/**
 * Classe para campo com valores numericos, formata, valida e possui opções para 
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js]
 *	autoNumeric.js
 *
 * Opções:
 * - allowNegative(bol): Permite numeros negativos no campo; Default false;
 * - numDecimal(int): Quantidade de casas decimais do campo de texto; Default 2
 * - numInteger(int): Quantidade de casas numericas (não inclui decimais na conta); Default 5
 * - minVal(float): Define o numero minimo que o campo aceita (essa função ignora a numDecimal e allowNegative); Default false;
 * - maxVal(float): Define o numero maximo que o campo aceita (essa função ignora a numDecimal); Default false;
 * - numFormat(str): Define os separadores do numero. Possiveis: BR US; Default BR;
 * - symbol(str): Define um tipo de marcador de moeda para o campo. Ex: R$; Default false;
 * - showButtons(bol): Exibe ou não os botões de incremento e decremento para o campo numerico; Default true;
 * - increment(float): Define o valor do incremento; Default 0.1
 * - decrement(float): Define o valor do incremento; Default 0.1
 * - superIncrement(float): Define  o valor do super incremento (quando PageUp é pressionado); increment *10
 * - superDecrement(float): Define o valor do super decremento (quando PageDOWN é pressionado); decrement *10
 */

(function( $ ) {
    $.widget( 'ta.TNumeric',{
        options: {
            numDecimal:2,
            numInteger:5,
            numFormat: 'BR',
            increment: parseFloat('0.01'),
            decrement: parseFloat('0.01'),
            showButtons: true
        },
        
        /**
         * Método construtor
         *
	 * @access private
	 * @return void
	 */
        
        _create: function(){
            var self = this;
            //doc = this.element[ 0 ].ownerDocument;
            
            this.paramAuto = {};
            
            if(self.options.numDecimal <1){
                self.options.increment = 1;
                self.options.decrement = 1;
            }
            
            if(self.options.minVal || self.options.maxVal){
                this.paramAuto.vMin = self.options.minVal;
                this.paramAuto.vMax = self.options.maxVal;
            }else{
                if(self.options.allowNegative){
                    this.paramAuto.vMin = self._numberMask(self.options.numInteger,'-');
                }else{
                    this.paramAuto.vMin = 0;
                }
                this.paramAuto.vMax = self._numberMask(self.options.numInteger,'');
                this.paramAuto.mDec = self.options.numDecimal;
            }
            if(self.options.numFormat == 'BR'){
                this.paramAuto.aSep = '.';
                this.paramAuto.aDec = ',';
            }           
            
            
            this.element
            .autoNumeric(this.paramAuto)
            .keydown(function(e){
                self._timeInc(e,1);
            });

            this.disabled(this.element.attr('disabled'));
            
            /*self.element.attr('widget_instance', this.widgetName + '(' + replaceAll('"', "'", JSON.stringify(self.options)) + ')');
            self.element.attr('widget_name', this.widgetName);*/
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
                $("#group-" + this.element.attr('id') + " button").attr('disabled',true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
                $("#group-" + this.element.attr('id') + " button").removeAttr('disabled');
            }
        },
        
        /**
         * Método habilitado via setTimeout para ativar incremento ou decremento
         *
	 * @access private
	 * @return void
	 */        
        _timeInc: function(event,val){
            var self = this;
            if(event.which == 38){
                self.incNumber();
            }else if(event.which == 40){
                self.decNumber();
            }else if(event.which == 33){
                self.superIncNumber();
            }else if(event.which == 34){
                self.superDecNumber();
            }
        },
        
        
        /**
         * Método para incrementar um valor self.options.increment no elemento
         *
	 * @access public
	 * @return void
	 */
        incNumber: function(){
            var self = this;
            var novoValor = parseFloat(self.element.autoNumericGet())+self.options.increment;
            if(novoValor < self.paramAuto.vMax){
                self.element.autoNumericSet(novoValor);
            }else{
                self.element.autoNumericSet(self.paramAuto.vMax);
            }
            $(self.element).change();
        },
        
        /**
     * Método para incrementar um valor self.options.increment*10 no elemento
     *
     * @access public
     * @return void
     */
        superIncNumber: function(){
            var self = this;
            var novoValor = parseFloat(self.element.autoNumericGet())+(self.options.increment*10);
            if(novoValor < self.paramAuto.vMax){
                self.element.autoNumericSet(novoValor);
            }else{
                self.element.autoNumericSet(self.paramAuto.vMax);
            }
            $(self.element).change();
        },
        
        
        /**
     * Método para decrementar um valor self.options.decrement*10 no elemento
     *
     * @access public
     * @return void
     */
        superDecNumber: function(){
            var self = this;    
            var novoValor = parseFloat(self.element.autoNumericGet())-(self.options.decrement*10);
            if(novoValor > self.paramAuto.vMin){
                self.element.autoNumericSet(novoValor);
            }else{
                self.element.autoNumericSet(self.paramAuto.vMin);
            }
            $(self.element).change();
        },
        
        
        /**
     * Método para decrementar um valor self.options.decrement no elemento
     *
     * @access public
     * @return void
     */
        decNumber: function(){
            var self = this;
            var novoValor = parseFloat(self.element.autoNumericGet())-self.options.decrement;
            if(novoValor > self.paramAuto.vMin){
                self.element.autoNumericSet(novoValor);
            }else{
                self.element.autoNumericSet(self.paramAuto.vMin);
            }
            $(self.element).change();
        },
        
        
    /**
     * Método que auxilia na criação da mascara para o autoNumeric
     *
     * @access private
     * @return integer
     */
        _numberMask: function(number,negative){
            var retorno = '';
            var i;
            if(number == 0){
                return 0
            }
            for(i=0;i<number;i++){
                retorno+= '9';
            }           
            return parseInt(negative+retorno);
        }
       
    });
    
})(jQuery);
