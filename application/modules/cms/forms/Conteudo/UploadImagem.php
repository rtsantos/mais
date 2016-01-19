<?php

    class Cms_Form_Conteudo_UploadImagem extends ZendT_Form {

        /**
         * Carrega os elementos no formulário para serem renderizados
         * @return void
         */
        public function loadElements() {
            $this->setName('form_upload_imagem');
            $_conteudo = new Cms_Form_Conteudo_Elements();

            $_element = new ZendT_Form_Element_Select('tamanho');
            $_element->setLabel('Tamanho da Imagem:');
            $_element->addMultiOption('PEQ', 'Pequeno');
            $_element->addMultiOption('MED', 'Médio');
            $_element->addMultiOption('GRA', 'Grande');
            $this->addElement($_element);

            $element = $_conteudo->getBanner();
            $element->setName('imagem');
            $element->setLabel('Selecionar a imagem:');
            $element->setRequired(true);
            $element->enableMultiple(true);
            $this->addElement($element);
        }

    }

?>
