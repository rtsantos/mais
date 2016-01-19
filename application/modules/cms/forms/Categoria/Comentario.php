<?php

   class Cms_Form_Categoria_Comentario extends ZendT_Form {

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements($action = 'insert') {
           $model = new Cms_Form_Conteudo_Elements();

           $element = $model->getElement('id');
           $element->setRequired(true);
           $element->addDecorator(new ZendT_Form_Decorator_Hidden());
           $element->setRequired(false);

           $this->addElement($element);


           $element = $model->getElement('id_categoria');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('id_conteudo_pai');
           $this->addElement($element);


           $element = $model->getElement('titulo');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('sub_titulo');
           $this->addElement($element);


           $element = $model->getElement('dh_ini_pub');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('dh_fim_pub');
           $this->addElement($element);


           $element = $model->getElement('corpo');
           $this->addElement($element);


           $element = $model->getElement('arquivo');
           $this->addElement($element);


           $element = $model->getElement('thumbnail');
           $this->addElement($element);


           $element = $model->getElement('id_usuario_inc');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('id_status');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('publico');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('banner');
           $this->addElement($element);


           $element = $model->getElement('corpo_url');
           $this->addElement($element);
       }

   }

?>