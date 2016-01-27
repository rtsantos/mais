<?php

   class Profile_Form_ObjectView_ConfigColumn extends ZendT_Form {

       /**
        *
        * @var string
        */
       protected $_columnType;

       /**
        *
        * @var string
        */
       protected $_seeker;

       /**
        *
        * @param string $value
        * @return \Profile_Form_ObjectView_ConfigColumn 
        */
       public function setColumnType($value) {
           $this->_columnType = $value;
           return $this;
       }

       /**
        *
        * @param string $value
        * @return \Profile_Form_ObjectView_ConfigColumn 
        */
       public function setSeeker($value) {
           $this->_seeker = $value;
           return $this;
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsPColsDetail($parent = '') {
           $element = new ZendT_Form_Element_Text('label');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Descrição:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('width');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setAttrib('class','ui-input-num');
           $element->setLabel(ZendT_Lib::translate('Largura:'));
           $this->addElement($element);

           //$element = new ZendT_Form_Element_Text('box-width');
           if ($parent == 'form') {
               $element = new ZendT_Form_Element_Text('box-width');
               $element->setAttrib('class','ui-input-num');
               $element->setAttrib('onKeyUp', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Largura da Caixa:'));
               $this->addElement($element);
           }

           $element = new ZendT_Form_Element_Numeric('font-size');
           $element->setAttrib('numDecimal', 0);
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setValue(7);
           $element->setLabel(ZendT_Lib::translate('Tamanho da Fonte:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('align');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Alinhamento:'));
           $element->addMultiOption('', ZendT_Lib::translate(''))->setAttrib('selected', 'selected');
           $element->addMultiOption('left', ZendT_Lib::translate('Esquerda'));
           $element->addMultiOption('center', ZendT_Lib::translate('Centralizado'));
           $element->addMultiOption('right', ZendT_Lib::translate('Direita'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('border');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Borda(Esq. Dir. Acima Abaixo):'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('url');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Hiperlink:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('input');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Entrada:'));
           $element->addMultiOption('', ZendT_Lib::translate('Não se aplica'))->setAttrib('selected', 'selected');
           $element->addMultiOption('text', ZendT_Lib::translate('Texto'));
           $this->addElement($element);
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsForm() {

           $this->loadElementsPColsDetail('form');

           $element = new ZendT_Form_Element_Text('value');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Valor Padrão:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('filter_value');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Filtro de Valores:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('hidden');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Deixar Invisível:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('required');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Obrigatório:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('readonly');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Somente leitura:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           if (1 == 1) {//$this->_seeker) {
               $element = new ZendT_Form_Element_Select('autoselect');
               $element->setAttrib('onChange', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Exibição:'));
               $element->addMultiOption('0', ZendT_Lib::translate('Pesquisa'))->setAttrib('selected', 'selected');
               $element->addMultiOption('1', ZendT_Lib::translate('Seleção'));
               $this->addElement($element);
           }
           
           $element = new ZendT_Form_Element_Textarea('eventChange');
           $element->setAttrib('cols', 20);
           $element->setAttrib('rows', 5);
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Script de Mudança:'));
           $this->addElement($element);
       }

       public function loadElementsXColsFilter() {
           $element = new ZendT_Form_Element_Text('value');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Valor Padrão:'));
           $this->addElement($element);
       }

       public function loadElementsPColsFilter() {
           $this->loadElementsXColsFilter();
       }

       public function loadElementsCColsFilter() {
           $element = new ZendT_Form_Element_Text('label');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Descrição:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('value');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Valor Padrão:'));
           $this->addElement($element);

           if ($this->_columnType != 'Date' && !$this->_seeker) {
               $element = new ZendT_Form_Element_Select('autocomplete');
               $element->setAttrib('onChange', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Habilita Sugestão:'));
               $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
               $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
               $this->addElement($element);
           }

           $element = new ZendT_Form_Element_Select('hidden');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Deixar Invisível:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('multiple');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Múltiplo:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'));
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $element->setAttrib('selected', '1');
           $this->addElement($element);

           if ($this->_columnType == 'Date') {
               $element = new ZendT_Form_Element_Text('max_periodo');
               $element->setAttrib('onKeyUp', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Período máximo (dias):'));
               $this->addElement($element);
           }
       }

       public function loadElementsDColsLines() {
           $this->loadElementsPColsDetail();

           if ($this->_columnType == 'Number') {
               $element = new ZendT_Form_Element_Select('subtotal');
               $element->setAttrib('onChange', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Subtotal:'));
               $element->addMultiOption('', ZendT_Lib::translate('Não se aplica'))->setAttrib('selected', 'selected');
               $element->addMultiOption('count', ZendT_Lib::translate('Contagem'));
               $element->addMultiOption('sum', ZendT_Lib::translate('Soma'));
               $element->addMultiOption('avg', ZendT_Lib::translate('Média'));
               $this->addElement($element);
           } else {
               $element = new ZendT_Form_Element_Select('break');
               $element->setAttrib('onChange', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Aplicar Subtotal:'));
               $element->addMultiOption(0, ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
               $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
               $this->addElement($element);

               /* $element = new ZendT_Form_Element_Select('break_count');
                 $element->setAttrib('onChange', "setConfig(event,this);");
                 $element->setLabel(ZendT_Lib::translate('Aplicar Contagem:'));
                 $element->addMultiOption(0, ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
                 $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
                 $this->addElement($element); */
           }
           $element = new ZendT_Form_Element_Select('first_record');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Somente primeiro registro na quebra:'));
           $element->addMultiOption(0, ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('jump_record');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Pula linha na quebra:'));
           $element->addMultiOption(0, ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
           $this->addElement($element);
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsDColsValues() {
           $this->loadElementsPColsDetail();

           #$this->getElement('align')->setValue('right');
           #$this->removeElement('url');

           $element = new ZendT_Form_Element_Select('tipo');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Tipo de Cálculo:'));
           $element->addMultiOption('', ZendT_Lib::translate(''))->setAttrib('selected', 'selected');
           $element->addMultiOption('count', ZendT_Lib::translate('Contagem'));
           $element->addMultiOption('count_distinct', ZendT_Lib::translate('Contagem com Distinção'));
           $element->addMultiOption('sum', ZendT_Lib::translate('Soma'));
           $element->addMultiOption('avg', ZendT_Lib::translate('Média'));
           $element->addMultiOption('max', ZendT_Lib::translate('Máximo'));
           $element->addMultiOption('min', ZendT_Lib::translate('Mínimo'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('subtotal');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Subtotal:'));
           $element->addMultiOption('', ZendT_Lib::translate('Não se aplica'))->setAttrib('selected', 'selected');
           $element->addMultiOption('count', ZendT_Lib::translate('Contagem'));
           $element->addMultiOption('sum', ZendT_Lib::translate('Soma'));
           $element->addMultiOption('avg', ZendT_Lib::translate('Média'));
           $this->addElement($element);
       }

       /**
        * 
        */
       public function loadElementsDColsFilter() {
           $this->loadElementsCColsFilter();
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsPColsBreak() {
           $this->loadElementsPColsDetail();
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsCColsMeasures() {
           $element = new ZendT_Form_Element_Text('label');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Descrição:'));
           $this->addElement($element);


           $this->loadElementsPBreakMeasure();

           $element = new ZendT_Form_Element_Select('tp_chart');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Tipo de Gráfico:'));
           $element->addMultiOption('column', ZendT_Lib::translate('Coluna'))->setAttrib('selected', 'selected');
           $element->addMultiOption('line', ZendT_Lib::translate('Linha'));
           $element->addMultiOption('pie', ZendT_Lib::translate('Pizza'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Numeric('font-size');
           $element->setAttrib('numDecimal', 0);
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setValue(7);
           $element->setLabel(ZendT_Lib::translate('Tamanho da Fonte:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Color('color');
           $element->setLabel(ZendT_Lib::translate('Cor da Coluna:'));
           $element->setAttrib('onChange', "setConfig(event,this);");
           $this->addElement($element);

           $element = new ZendT_Form_Element_Color('font-color');
           $element->setLabel(ZendT_Lib::translate('Cor da Fonte:'));
           $element->setAttrib('onChange', "setConfig(event,this);");
           #$element->setValue("#000000");
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('show-total');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Exibe Total:'));
           $element->addMultiOption('', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('S', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('show-percent');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Exibe Porcentagem:'));
           $element->addMultiOption('', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('S', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('position');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Posição do Texto:'));
           $element->addMultiOption('top', ZendT_Lib::translate('Topo'))->setAttrib('selected', 'selected');
           $element->addMultiOption('bottom', ZendT_Lib::translate('Inferior'));
           $element->addMultiOption('right', ZendT_Lib::translate('Direita'));
           $element->addMultiOption('left', ZendT_Lib::translate('Esquerda'));
           $element->addMultiOption('inside', ZendT_Lib::translate('Dentro'));
           $element->addMultiOption('middle', ZendT_Lib::translate('Meio'));
           $this->addElement($element);
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsBreakHeader() {
           $this->loadElementsPColsDetail();
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsPBreakMeasure() {
           $element = new ZendT_Form_Element_Text('label');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Descrição:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('tipo');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Tipo de Cálculo:'));
           $element->addMultiOption('count', ZendT_Lib::translate('Contagem'))->setAttrib('selected', 'selected');
           $element->addMultiOption('count_distinct', ZendT_Lib::translate('Contagem com Distinção'));
           $element->addMultiOption('sum', ZendT_Lib::translate('Soma'));
           $element->addMultiOption('avg', ZendT_Lib::translate('Média'));
           $this->addElement($element);
       }

       public function loadElementsCIniExp() {
           $element = new ZendT_Form_Element_Select('tipo_coluna');
           $element->setAttrib('onChange', "setConfig(event, this);");
           $element->setLabel(ZendT_Lib::translate('Tipo de Dados:'));
           $element->addMultiOption('number', ZendT_Lib::translate('Numérico'))->setAttrib('selected', 'selected');
           $element->addMultiOption('string', ZendT_Lib::translate('Texto'));
           $element->addMultiOption('date', ZendT_Lib::translate('Data'));
           $this->addElement($element);
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElementsXBreakMeasure() {
           $this->loadElementsPBreakMeasure();
       }

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements() {
           $this->loadElementsPColsDetail();
       }

       public function loadElementsGColsDetail() {
           $this->loadElements();

           $element = new ZendT_Form_Element_Text('value');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Filtro Padrão:'));
           $this->addElement($element);
           
           $element = new ZendT_Form_Element_Textarea('listOptions');
           $element->setAttrib('cols', 20);
           $element->setAttrib('rows', 5);
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Lista de Valores:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('hidden');
           $element->setAttrib('onChange', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Deixar Invisível:'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'))->setAttrib('selected', 'selected');
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           if ($this->_columnType == 'Number') {
               $element = new ZendT_Form_Element_Select('subtotal');
               $element->setAttrib('onChange', "setConfig(event,this);");
               $element->setLabel(ZendT_Lib::translate('Subtotal:'));
               $element->addMultiOption('', ZendT_Lib::translate('Não se aplica'))->setAttrib('selected', 'selected');
               $element->addMultiOption('count', ZendT_Lib::translate('Contagem'));
               $element->addMultiOption('sum', ZendT_Lib::translate('Soma'));
               $element->addMultiOption('avg', ZendT_Lib::translate('Média'));
               $this->addElement($element);
           }
       }

       /**
        * @return void
        */
       public function loadElementsDashbord() {
           $element = new ZendT_Form_Element_Text('label');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Descrição:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Numeric('width');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Largura:'));
           $element->setValue(400);
           $this->addElement($element);

           $element = new ZendT_Form_Element_Numeric('height');
           $element->setAttrib('onKeyUp', "setConfig(event,this);");
           $element->setLabel(ZendT_Lib::translate('Altura:'));
           $element->setValue(300);
           $this->addElement($element);
       }

   }

?>