<?php

    class Ged_Form_PropDocto_FormConfig extends ZendT_Form {

        protected $_extensoes = array("jpg", "jpeg", "gif", "bmp", "png", "tiff", "psd", "odr", "pdf", "xls", "xlsx", "ods", "doc", "docx", "odt", "ppt", "pptx", "odp");
        public static $configKey = "config";

        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action = 'insert') {
            sort($this->_extensoes);

            $element = new ZendT_Form_Element_Checkbox('extension');
            foreach ($this->_extensoes as $ext) {
                $element->addMultiOption($ext, $ext);
            }
            $element->setLabel('Extensões de Origem:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Select('extReplace');
            $element->addMultiOption("", "");
            foreach ($this->_extensoes as $ext) {
                $element->addMultiOption($ext, $ext);
            }
            $element->setLabel('Converter para:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('maxSize');
            $element->setLabel('Tamanho Máximo:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Select('maxSizeUnit');
            $element->addMultiOption("B", "B");
            $element->addMultiOption("Kb", "Kb");
            $element->addMultiOption("Mb", "Mb");
            $element->addMultiOption("Gb", "Gb");
            $element->setLabel('Unidade')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('horizontal');
            $element->setLabel('Resolução - Horizontal:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('vertical');
            $element->setLabel('Resolução - Vertical:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('height');
            $element->setLabel('Tamanho - Altura:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('width');
            $element->setLabel('Tamanho - Largura:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Checkbox('resize_ratio');
            $element->addMultiOption("1", "");
            $element->setLabel('Manter proporção:')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Numeric('lifeTime');
            $element->setLabel('Tempo de Vida (dias):')->setBelongsTo($this::$configKey);
            $this->addElement($element);

            /* $element = new ZendT_Form_Element_Text('local_armazenamento');
              $element->setLabel('Local de Armazenamento')->setBelongsTo("config");
              $this->addElement($element); */

            $element = new ZendT_Form_Element_Select('bkpProp');
            $element->setLabel('Tipo do Aramazenamento:')->setBelongsTo($this::$configKey);
            $element->addMultiOption('1', 'Temporário');
            $element->addMultiOption('2', 'Backup');
            $element->addMultiOption('3', 'Incremental');
            $this->addElement($element);

            /* $propProcesso = array('processo' => 'Veiculo', 'maxSize' => 5000,
              'extension' => array('PNG', 'JPG', 'TIFF', 'GIF'),
              'extreplace' => 'PNG', 'resolution' => '150x150', 'bkpProp' => 'C:\Windows\Temp'); */
        }

    }
    