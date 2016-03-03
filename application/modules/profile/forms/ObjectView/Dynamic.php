<?php

   class Profile_Form_ObjectView_Dynamic extends ZendT_Form {

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements($action = '') {
           $this->setName('form-advanced');

           /* $element = new ZendT_Form_Element_AutoComplete('owner');
             $element->setLabel('Responsáveis pela visão:');
             $url = ZendT_Url::getBaseUrl().'/auth/conta/auto-complete/suggest/1/column/nome';
             $element->setDataSource($url);
             $element->setJQueryParam('limit', 100);
             $element->setJQueryParam('showButtonSearch', true);
             $element->setJQueryParam('multiple', true);
             $element->setJQueryParam('multipleSeparator', ';');
             $element->setJQueryParam('mustMatch', true);
             $element->setJQueryParam('autoFill', true);
             $element->addStyle('width', '750px');
             $this->addElement($element);

             $element = new ZendT_Form_Element_AutoComplete('share');
             $element->setLabel('Compartilhar com:');
             $url = ZendT_Url::getBaseUrl().'/auth/conta/auto-complete/suggest/1/column/nome';
             $element->setDataSource($url);
             $element->setJQueryParam('limit', 100);
             $element->setJQueryParam('showButtonSearch', true);
             $element->setJQueryParam('multiple', true);
             $element->setJQueryParam('multipleSeparator', ';');
             $element->setJQueryParam('mustMatch', true);
             $element->setJQueryParam('autoFill', true);
             $element->addStyle('width', '750px');
             $this->addElement($element); */

           $element = new ZendT_Form_Element_Select('output');
           $element->setLabel(ZendT_Lib::translate('Saída:'));
           $element->addMultiOption('PDF', ZendT_Lib::translate('PDF'));
           $element->addMultiOption('XLS', ZendT_Lib::translate('XLS'));
           $element->addMultiOption('HTML', ZendT_Lib::translate('HTML'));
           #$element->addMultiOption('ZendT_Report_Pdf_Form', ZendT_Lib::translate('Formulário PDF'));
           #$element->addMultiOption('CSV', ZendT_Lib::translate('CSV'));
           $this->addElement($element);


           $element = new ZendT_Form_Element_Select('printTitle');
           $element->setLabel(ZendT_Lib::translate('Imprime Título:'));
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('printFooter');
           $element->setLabel(ZendT_Lib::translate('Imprime Rodapé:'));
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('printParams');
           $element->setLabel(ZendT_Lib::translate('Imprime Parâmetros:'));
           $element->addMultiOption('1', ZendT_Lib::translate('Sim'));
           $element->addMultiOption('0', ZendT_Lib::translate('Não'));
           $this->addElement($element);


           $element = new ZendT_Form_Element_Select('orientation');
           $element->setLabel(ZendT_Lib::translate('Página em:'));
           $element->addMultiOption('L', ZendT_Lib::translate('Paisagem'));
           $element->addMultiOption('P', ZendT_Lib::translate('Retrato'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('empresa');
           $element->setLabel(ZendT_Lib::translate('Logo do Relatório:'));
           $element->addMultiOption('MAIS', ZendT_Lib::translate('MAIS'));
           $element->addMultiOption('CLIENTE', ZendT_Lib::translate('CLIENTE'));
           $element->addMultiOption('NENHUM', ZendT_Lib::translate('NENHUM'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('zebra');
           $element->setLabel(ZendT_Lib::translate('Zebrar Linhas:'));
           $element->addMultiOption(0, ZendT_Lib::translate('Não'));
           $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
           $this->addElement($element);

           /* $element = new ZendT_Form_Element_Hidden('order_column_aux');
             $this->addElement($element); */

           $element = new ZendT_Form_Element_Select('order_column');
           $element->setLabel(ZendT_Lib::translate('Aplicar ordenação na coluna: <i>Importante, se aplicar ordenação, os subtotais deixam de funcionar.</i>'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('order_type');
           $element->setLabel(ZendT_Lib::translate('Ordenar de forma:'));
           $element->addMultiOption('ASC', ZendT_Lib::translate('Crescente'));
           $element->addMultiOption('DESC', ZendT_Lib::translate('Decrescente'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('y_title');
           $element->setLabel(ZendT_Lib::translate('Titulo do eixo Y:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('x_title');
           $element->setLabel(ZendT_Lib::translate('Titulo do eixo X:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Textarea('colors');
           $element->setLabel(ZendT_Lib::translate('Lista de Cores "Valor=Cor": Exemplo: TA=#FF6600'));
           $element->setAttrib("rows", 3);
           $this->addElement($element);

           $element = new ZendT_Form_Element_Select('zoom');
           $element->setLabel(ZendT_Lib::translate('Aplicar Zoom:'));
           $element->addMultiOption(0, ZendT_Lib::translate('Não'));
           $element->addMultiOption(1, ZendT_Lib::translate('Sim'));
           $this->addElement($element);


           /* $this->addDisplayGroup(
             array(
             'owner'
             )
             , 'responsavel-visao'
             , array(
             'id' => 'responsavel-visao',
             'legend' => 'Responsável'
             )
             );

             $this->addDisplayGroup(
             array(
             'share'
             )
             , 'compartilhamento-visao'
             , array(
             'id' => 'compartilhamento-visao',
             'legend' => 'Compartilhamento'
             )
             ); */

           $this->addDisplayGroup(
                 array(
              'output',
              'pageAdd',
              'printTitle',
              'printColumnsTitle',
              'printFooter',
              'printParams',
              'orientation',
              'empresa',
              'zebra',
                 )
                 , 'dados-impressao'
                 , array(
              'id' => 'dados-impressao',
              'legend' => 'Dados para Impressão'
                 )
           );

           $this->addDisplayGroup(
                 array(
              'order_column',
              'order_type'
                 )
                 , 'dados-order'
                 , array(
              'id' => 'dados-order',
              'legend' => 'Ordenação de Colunas'
                 )
           );

           /**
            * Organização dos grupos
            */
           $element = new ZendT_Form_Element_Text('group_name');
           $element->setLabel(ZendT_Lib::translate('Nome:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Text('group_title');
           $element->setLabel(ZendT_Lib::translate('Título:'));
           $this->addElement($element);

           $element = new ZendT_Form_Element_Numeric('group_order');
           $element->setJQueryParam('numDecimal', 0);
           $element->setJQueryParam('numInteger', 5);
           $element->setLabel(ZendT_Lib::translate('Ordem:'));
           $this->addElement($element);

           $this->addDisplayGroup(
                 array(
              'group_name',
              'group_title',
              'group_order'
                 )
                 , 'dados-grupo'
                 , array(
              'id' => 'dados-grupo',
              'legend' => 'Organização'
                 )
           );

           $this->addDisplayGroup(
                 array(
              'y_title',
              'x_title',
              'zoom',
              'colors'
                 )
                 , 'dados-grafico'
                 , array(
              'id' => 'dados-grafico',
              'legend' => 'Dados para o Gráfico'
                 )
           );

           $element = new ZendT_Form_Element_Numeric('refresh');
           $element->setJQueryParam('numDecimal', 0);
           $element->setJQueryParam('numInteger', '10');
           $element->setLabel(ZendT_Lib::translate('Tempo (segundos):'));
           $this->addElement($element);

           $this->addDisplayGroup(
                 array(
              'refresh'
                 )
                 , 'dados-atualizacao'
                 , array(
              'id' => 'dados-atualizacao',
              'legend' => 'Atualizar página (refresh)'
                 )
           );
       }

   }

?>