/**
 * Classe para campo com valores numericos, formata, valida e possui opções para 
 * 
 * @author: TESILVA
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
 * - allowNegative(bol): Permite uma quantidade específica de números (1 = somente 1 / 2 = somente 2 / acima de 2 ou false = vários); Default false;
 */

(function( $ ) {
    $.widget( 'ta.TNumericMulti',{
        options: {
            numDecimal:2,
            numInteger:5,
            numFormat: 'BR',
            increment: parseFloat('0.01'),
            decrement: parseFloat('0.01'),
            showButtons: true,
			allowMax: false,
			minVal: false,
			maxVal: false
        },
        values: {
            arrayPos:[],
            arrayNum:[]
        },
        config: {
            position:0,
            newSep:false,
            newFilter:false,
            separator:' ',
            filter:''
        },
        
        /**
         * Método construtor
         *
	 * @access private
	 * @return void
	 */
        
        _create: function(){
            var self = this;

            this.divElement = $('<div></div>')
            .width(self.element.width())
            .height(self.element.height())
            .css('position','relative')
            .css('text-align','left')
            .insertAfter(this.element);
            
            this.paramAuto = {};
            
            if(self.options.numDecimal < 1){
                self.options.increment = 1;
                self.options.decrement = 1;
            }
			
			if(self.options.numDecimal){
                this.paramAuto.mDec = self.options.numDecimal;
			}
			
			if(self.options.minVal < 0){
				self.options.allowNegative = true;
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
            }
            if(self.options.numFormat == 'BR'){
                this.paramAuto.aSep = ',';
                this.paramAuto.aDec = '.';
            }

            //self.setNumbers(self.getNumbersStart());

            var pressedCtrl  = false,
                pressedShift = false,
                validFilter  = false;
            
            this.element
            //.autoNumeric(this.paramAuto)
            .appendTo(this.divElement)
            .bind("contextmenu",function(e){ //desabilita botão direito do mouse
                return false;
            })
            .keyup(function(e){
                if(e.which == 16){
                    pressedShift = false;
                }
                if(e.which == 17){
                    pressedCtrl = false;
                }
                if(validFilter){ //verifica se houve filtros adicionados
                    self.config.newFilter = true;
                    self.setNumbers([self.values.arrayNum[0]]);
                    validFilter = false;
                }
            })
            .keydown(function(e){
                if(e.which == 16){
                    pressedShift = true;
                }
                if(e.which == 17){
                    pressedCtrl = true;
                }
                
                self.config.position = self.getCursorPosition(this);
                self.updateNumbers(self.values);
                var index = self.getPosNumber(self.values.arrayPos, self.config.position);
                var val = self.element.val();
                    
                /*** Validação caractere: espaço ***/
                if(e.which == 32 /*Space*/){
                    if(val.indexOf(' ') != -1){
                        return false; //não permite caso já tenha um espaço
                    }
					if(self.options.allowMax == 1){
						return false; //não permite caso a quantidade máxima seja igual a 1
					}
                    self.config.separator = ' ';
                    self.config.filter = '';
                    self.config.newSep = true;
                    self.setNumbers([self.values.arrayNum[0], self.values.arrayNum[1]]);
                    return false;
                }

                /*** Validação caractere: ; ***/
                if(e.which == 59 || e.which == 191 /*; navegadores: Firefox e IE, Chrome*/){
                    if(pressedShift){
                        return false; //não permite o caractere :
                    }
					if(self.options.allowMax < 3 && self.options.allowMax != false){
                        return false; //não permite caso a quantidade máxima seja menor que 3 ou false
                    }
                    self.config.separator = ';';
                    self.config.filter = '';
                    self.config.newSep = true;
                    self.setNumbers(self.values.arrayNum);
                    return false;
                }

                /*** Validação caractere: - ***/
                var validMinus = false;
                if(e.which == 109 /*-*/ || e.which == 189 || e.which == 173 /*- navegadores: IE e Chrome, Firefox*/){
                    if(pressedShift && e.which != 109){
                        return false; //não permite o caractere _
                    }
                    if(!self.options.allowNegative){
                        return false; //não permite caso allowNegative seja false
                    }
                    if(self.values.arrayNum[index].indexOf('-') != -1){
                        return false; //não permite caso já exista o caractere no número posicionado
                    }
                    if(self.config.position != self.values.arrayPos[index][0]){
                        return false; //não permite caso não esteja na posição inicial do número posicionado
                    }
                    validMinus = true;
                }

                /*** Validação caractere: , ***/
                var validComma = false;
                if(e.which == 188 || e.which == 110 /*, */){
                    if(!pressedShift && self.values.arrayNum[index].indexOf(',') != -1){
                        return false; //não permite caso já exista o caractere no número posicionado
                    }
                    if(!pressedShift){
                        validComma = true; //permite o caractere ,
                    }
                }

                validFilter = false;
                /*** Validação filtros ***/
                if((e.which == 190 && pressedShift) /*>*/ ||
                    (e.which == 188 && pressedShift) /*<*/ ||
                    (e.which == 49 && pressedShift) /*!*/  ||
                    ((e.which == 187 || e.which == 61 /*= navegadores: IE e Chrome, Firefox*/) && !pressedShift)){

                    validFilter = true;
                }
				
				/*** Validação teclas permitidas ***/
				validKey = false;
				if((e.which == 9) /*TAB*/ || (e.which == 13) /*ENTER*/ || (e.which == 27) /*ESC*/) {
					validKey = true;
				}

                /*** Condições e caracteres válidos: ***/
                if( e.which == 38 /*Up arrow*/   || e.which == 40 /*Down arrow*/  ||
                    e.which == 33 /*Page Up*/    || e.which == 34 /*Page Down*/   ||
                    e.which == 37 /*Left arrow*/ || e.which == 39 /*Right arrow*/ ||
                    e.which == 8 /*Backspace*/   || e.which == 46 /*Delete*/      ||
                    e.which == 36 /*Home*/       || e.which == 35 /*End*/

                    || validMinus == true
                    || validComma == true
                    || validFilter == true

                    || (e.which == 65 && pressedCtrl) == true /*Ctrl + A*/
                    || (e.which >= 96 && e.which <= 105) == true //Números teclado NUM LOCK
                    || (!pressedShift && (e.which >= 48 && e.which <= 57)) == true){ //Números teclado normal

					var comma = self.getCommaPosition(self.values.arrayPos, self.config.position, index);
					self._timeInc(e.which, self.values.arrayNum, index, comma, false);

					if(e.which == 33 /*Page Up*/ || e.which == 34 /*Page Down*/){ //Bloqueia Page Up e Page Down pois no IE altera a posição do cursor
						return false;
					}
                } else if(validKey == false) {
                    return false;
                }
            })
            .blur(function(){
                self.updateNumbers(self.values);
                self.setNumbers(self.values.arrayNum, false);
            })
            .css('text-align','right')
            .click(function(){
                self.config.position = self.getCursorPosition(this);
                self.updateNumbers(self.values);
            });
            
            if(self.options.showButtons){
                this.btCima = $('<span></span>')
                .width(24)
                .height((self.element.height()/2)+1)
                .button({
                    icons:{
                        primary: 'ui-icon-triangle-1-n'
                    },
                    text: false
                })
                .css('margin-right','0')
                .css('position','absolute')
                .css('top','0')
                /*.css('right',rightbts)*/
                .css('font-size','10')
                .click(function(){
                    var index = self.getPosNumber(self.values.arrayPos, self.config.position);
                    var comma = self.getCommaPosition(self.values.arrayPos, self.config.position, index);
					self._timeInc(38, self.values.arrayNum, index, comma, true);
                })
                .appendTo(this.divElement);
            
            
                this.btBaixo = $('<span></span>')
                .width(24)
                .height((self.element.height()/2)+1)
                .css('position','absolute')
                .css('bottom','0')
                /*.css('right',rightbts)*/
                .css('margin-right','0')
                .css('font-size','10')
                .css('top',9)
                .button({
                    icons:{
                        primary: 'ui-icon-triangle-1-s'
                    },
                    text: false
                })
                .css('font-size','10')
                .click(function(){
                    var index = self.getPosNumber(self.values.arrayPos, self.config.position);
                    var comma = self.getCommaPosition(self.values.arrayPos, self.config.position, index);
					self._timeInc(40, self.values.arrayNum, index, comma, true);
                })
                .appendTo(this.divElement);
                this.element.width(this.element.width()-28);
            }
            this.disabled(this.element.attr('disabled'));
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
                $("#group-" + this.element.attr('id') + " span").hide();
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
                $("#group-" + this.element.attr('id') + " span").show();
            }
        },
        
        /**
         * Método habilitado via setTimeout para ativar incremento ou decremento
         *
	 * @access private
	 * @return void
	 */        
        _timeInc: function(event, arrayNum, index, comma, byButton){
			if(typeof(byButton) === 'undefined'){
				byButton = false;
			}
            var self = this;

			if(self.element.val() == '' && byButton == true){
				self.setNumbers([self.options.minVal]);
				//reseta os valores caso não seja uma tecla de incremento e não possua um index
			} else {
				if(event == 38){
					self.incNumber(arrayNum, index, comma);
				}else if(event == 40){
					self.decNumber(arrayNum, index, comma);
				}else if(event == 33){
					self.superIncNumber(arrayNum, index, comma);
				}else if(event == 34){
					self.superDecNumber(arrayNum, index, comma);
				}
			}
        },
        
        /**
         * Método para incrementar um valor self.options.increment no elemento
         *
	 * @access public
	 * @return void
	 */
        incNumber: function(arrayNum, index, comma){
            var self = this;
            var aux = self.formatDecimals(arrayNum[index], 'get');
            aux = parseFloat(aux) + self.options.increment * (comma == 'E'?100:1);

            if(aux <= self.paramAuto.vMax){
                aux = self.formatDecimals(aux, 'set');
                arrayNum[index] = aux;
            } else {
                arrayNum[index] = self.paramAuto.vMax;
            }
            self.setNumbers(arrayNum);
        },
        
        /**
        * Método para incrementar um valor self.options.increment*10 no elemento
        *
        * @access public
        * @return void
        */
        superIncNumber: function(arrayNum, index, comma){
            var self = this;
            var aux = self.formatDecimals(arrayNum[index], 'get');
            aux = parseFloat(aux) + self.options.increment * 10 * (comma == 'E'?100:1);

            if(aux <= self.paramAuto.vMax){
                aux = self.formatDecimals(aux, 'set');
                arrayNum[index] = aux;
            } else {
                arrayNum[index] = self.paramAuto.vMax;
            }
            self.setNumbers(arrayNum);
        },
        
        
        /**
        * Método para decrementar um valor self.options.decrement*10 no elemento
        *
        * @access public
        * @return void
        */
        superDecNumber: function(arrayNum, index, comma){
            var self = this;
            var aux = self.formatDecimals(arrayNum[index], 'get');
            aux = parseFloat(aux) - self.options.decrement * 10 * (comma == 'E'?100:1);

            if(aux >= self.paramAuto.vMin){
                aux = self.formatDecimals(aux, 'set');
                arrayNum[index] = aux;
            } else {
                arrayNum[index] = self.paramAuto.vMin;
            }
            self.setNumbers(arrayNum);
        },
        
        
        /**
        * Método para decrementar um valor self.options.decrement no elemento
        *
        * @access public
        * @return void
        */
        decNumber: function(arrayNum, index, comma){
            var self = this;
            var aux = self.formatDecimals(arrayNum[index], 'get');
            aux = parseFloat(aux) - self.options.decrement * (comma == 'E'?100:1);

            if(aux >= self.paramAuto.vMin){
                aux = self.formatDecimals(aux, 'set');
                arrayNum[index] = aux;
            } else {
                arrayNum[index] = self.paramAuto.vMin;
            }
            self.setNumbers(arrayNum);
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
        },

        /**
         * Método para obter a posição do cursor
         *
	 * @access public
	 * @return integer
	 */
        getCursorPosition: function(o){
			return o.selectionStart;
            /*if (o.createTextRange) {
				if (document.selection){
					var r = document.selection.createRange().duplicate();
				} else if (document.getSelection){
					var r = document.getSelection();
				}
                r.moveEnd('character', o.value.length);
                if (r.text == '') return o.value.length;
                return o.value.lastIndexOf(r.text);
            } else 
                return o.selectionStart;*/
        },

        /**
         * Método para posicionar o cursor dentro do elemento
         *
	 * @access public
	 * @return void
	 */
        setCursorPosition: function(start, end){
            var self = this;
            var input = document.getElementById(self.element.attr('id'));
            input.focus();
            input.setSelectionRange(start, end);
        },

        /**
         * Método para substituir todas as correspondências em uma string
         *
	 * @access public
	 * @return string
	 */
        replaceAll: function(str, search, replace){
			if(str){
				str = str.toString();
				if(!str || search == replace){
					return str;
				}
				while(str.indexOf(search) != -1) {
					str = str.replace(search, replace);
				}
			}
            return str;
        },

        /**
         * Método para obter quais valores devem ser utilizados como padrão
         *
	 * @access public
	 * @return array
	 */
        getNumbersStart: function(){
            var self = this;
            var array = [self.paramAuto.vMin, self.paramAuto.vMin];
            return array;
        },

        /**
         * Método para setar os valores de um array no campo
         *
	 * @access public
	 * @return void
	 */
        setNumbers: function(arrayNum, updatePos){
			if(typeof(updatePos) === 'undefined'){
				updatePos = true;
			}
			
            var self = this;
            var i, aux = [], pos;

            if(self.config.newSep == false){ //somente verifica o filtro se não foi digitado um novo separador
                var filterBef = self.config.filter,
                    filter = self.getActualFilter();
                if(filterBef != filter){
                    self.config.filter = filter;
                    self.config.separator = '';
                }
            } else {
                self.config.filter = '';
            }

            self.element.val('');
            for(i = 0; i < arrayNum.length; i ++){
                /*Obs.: no método $.autoNumeric.Format, é necessário comentar a linha 862
                 *que chama a função autoRound, caso o autoNumeric / autoCheck não esteja ativado.
                 *Pois caso a mesma seja ativa, valores negativos são desconsiderados.*/
                if(arrayNum[i] != null){
                    self.element.autoNumericSet(self.formatDecimals(arrayNum[i], 'get'), self.paramAuto);
                    aux[i] = self.element.val();
                    aux[i] = self.formatDecimals(aux[i], 'set');
                }
            }

            self.element.val('');
            for(i = 0; i < aux.length; i ++){
                if(i > 0){
                    self.element.val(self.element.val() + self.config.separator);
                }
                self.element.val(self.element.val() + aux[i]);
            }

            pos = self.config.position;
            if(self.config.filter){
                self.element.val(self.config.filter /*+ ' '*/ + self.element.val());
                if(self.config.newFilter == true){
                    pos = self.config.filter.length;
                    self.config.newFilter = false;
                }
            }
            if(self.config.newSep == true){
                if((self.config.separator == ' ' && self.element.val().indexOf(' ') == -1) || self.config.separator != ' ')
                    self.element.val(self.element.val() + self.config.separator);
                pos = self.element.val().length;
                self.config.newSep = false;
            }
			if(updatePos == true){
				self.setCursorPosition(pos, pos);
			}
        },

        /**
         * Método para obter qual filtro existe no elemento
         *
	 * @access public
	 * @return string
	 */
        getActualFilter: function(){
            var self = this;
            var val = self.element.val();
            var filter = '';
            if(val[0] != null && self.existsFilter(val[0])){
                filter = filter + '' + val[0];
            }
            if(val[1] != null && self.existsFilter(val[1])){
                filter = filter + '' + val[1];
            }
            return filter;
        },

        /**
         * Método para obter qual o elemento referente a uma determinada posição
         *
	 * @access public
	 * @return integer
	 */
        getPosNumber: function(arrayPos, pos){
            var i = 0;
            for(i = 0; i < arrayPos.length; i ++){
                if(pos >= arrayPos[i][0] && pos <= arrayPos[i][1]){
                    return i;
                }
            }
            return -1;
        },

        /**
         * Método para obter a posição (esquerda ou direita) referente a vírgula do número posicionado
         *
	 * @access public
	 * @return string
	 */
        getCommaPosition: function(arrayPos, pos, indice){
			if(indice != -1){
				if(pos <= arrayPos[indice][2] || arrayPos[indice][2] == -1){
					return 'E';
				}
				return 'D';
			}
			return false;
        },

        /**
         * Método para obter as posições (início, fim e vírgula) dos números
         *
	 * @access public
	 * @return array
	 */
        getNumbersPositions: function(val){
            var self = this;
            var i = 0, j = 0, doing = false, valid,
            length = val.length,
            arrayPos = [];

            for(i = 0; i < length; i ++){
                valid = self.isValidCaracter(val[i]);
                if(valid && !doing){
                    arrayPos[j] = [];
                    arrayPos[j][0] = i;
                    arrayPos[j][2] = '-1';
                    doing = true;
                }
                if((!valid || i+1 == length) && doing) { //não pode ser else, pois pode acontecer de começar a terminar no mesmo caractere (1 dígito)
                    arrayPos[j][1] = (valid == false?i:i+1); //se não for válido, salva a posição atual; caso contrário, salva a última posição
                    j ++;
                    doing = false;
                }
                if(val[i] == ',' && doing){
                    arrayPos[j][2] = i;
                }
            }
            return arrayPos;
        },

        /**
         * Método para obter os valores referente as posições dos números
         *
	 * @access public
	 * @return array
	 */
        getNumbersValues: function(val, arrayPos){
            var i = 0,
            arrayNum = [];

            for(i = 0; i < arrayPos.length; i ++){
                arrayNum[i] = val.substr(arrayPos[i][0], (arrayPos[i][1] - arrayPos[i][0]) + 1 /*+ 1 soma posição zero*/);
            }
            return arrayNum;
        },

        /**
         * Método para atualizar os valores no array de posições e de números
         *
	 * @access public
	 * @return void
	 */
        updateNumbers: function(arrayVal){
            var self = this;
            var val = self.element.val();

            arrayVal.arrayPos = self.getNumbersPositions(val);
            arrayVal.arrayNum = self.getNumbersValues(val, arrayVal.arrayPos);
        },

        /**
         * Método para verificar se existe um filtro ou se o filtro informado é válido
         * (caso não seja passado o parâmetro, verifica se existe um filtro no elemento,
         *  caso contrário, verifica se o filtro informado é válido)
         *
	 * @access public
	 * @return boolean
	 */
        existsFilter: function(filter){
            var self = this;
            var val;
            if(filter){
                val = filter;
            }else{
                val = self.element.val();
            }
            return (val.indexOf('>') != -1 ||
                    val.indexOf('<') != -1 ||
                    val.indexOf('=') != -1 ||
                    val.indexOf('!') != -1);
        },

        /**
         * Método para verificar se existe um separador
         *
	 * @access public
	 * @return boolean
	 */
        existsSep: function(){
            var self = this;
            var val = self.element.val();
            return !(val.indexOf(' ') == -1 && val.indexOf(';') == -1);
        },

        /**
         * Método para verificar se o caractere é válido para o array de números
         *
	 * @access public
	 * @return boolean
	 */
        isValidCaracter: function(val){
            var self = this;
            if(val == ',' || val == '.' || val == '-' || self.isNumber(val))
                return true;
            return false;
        },

        /**
         * Método para verificar se o caractere é um número
         *
	 * @access public
	 * @return boolean
	 */
        isNumber: function(val){
            for(var i = 0; i <= 9; i ++){
                if(val == i.toString())
                    return true;
            }
            return false;
        },
        
        /**
         * Método para formatar conforme o padrão brasileiro
         * Utilizado no GET (converte para o formato de cálculo) e no SET (converte para o formato apresentado ao usuário)
         *
	 * @access public
	 * @return string
	 */
        formatDecimals: function(val, type){
            var self = this;
            var rep = '§';
            val = self.replaceAll(val, '.', rep);
            val = self.replaceAll(val, ',', '.');
            val = self.replaceAll(val, rep, ',');
            if(type.toString().toUpperCase() == 'GET'){ //quando for get, as vírgulas devem ser retiradas para que o valor possa ser somado
                val = self.replaceAll(val, ',', '');
            }
            return val;
        }
        
        /*formatValueCalc: function(val){
            var self = this;
            val = self.replaceAll(val, '.', '');
            val = self.replaceAll(val, ',', '.');
            return val;
        },
        
        formatValueShow: function(val){
            var self = this;
            val = self.replaceAll(val, '.', ',');
            return val;
        },*/
       
    });
    
})(jQuery);