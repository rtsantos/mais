<?php

   class Auth_Form_Usuario_Edit extends Auth_Form_Usuario_Crud_Edit {

       /**
        * Configura se uma coluna é multipla
        * @var array
        */
       protected $_multiple;

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements($action = 'insert') {
           $model = new Auth_Model_Usuario_Table();

           $element = $model->getElement('id');
           $element->setRequired(true);
           $element->addDecorator(new ZendT_Form_Decorator_Hidden());
           $element->setRequired(false);

           $this->addElement($element);


           $element = $model->getElement('idtipousuario');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('login');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('senha');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('nome');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('validadesenha');
           $this->addElement($element);


           $element = $model->getElement('trocasenha');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('dhtrocasenha');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('expiracaosenha');
           $this->addElement($element);


           $element = $model->getElement('status');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('nerroslogin');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('usuarioadmin');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('cgccpf');
           $this->addElement($element);


           $element = $model->getElement('endereco');
           $this->addElement($element);


           $element = $model->getElement('telefone');
           $this->addElement($element);


           $element = $model->getElement('email');
           $this->addElement($element);


           $element = $model->getElement('usuario');
           $this->addElement($element);


           $element = $model->getElement('datahora');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('fax');
           $this->addElement($element);


           $element = $model->getElement('idpessoal');
           $this->addElement($element);


           $element = $model->getElement('chapa');
           $this->addElement($element);


           $element = $model->getElement('codccustodef');
           $this->addElement($element);


           $element = $model->getElement('codeof');
           $this->addElement($element);


           $element = $model->getElement('idempresa');
           $this->addElement($element);


           $element = $model->getElement('idempresadef');
           $this->addElement($element);


           $element = $model->getElement('idfilial');
           $this->addElement($element);


           $element = $model->getElement('idusuarioresp');
           $this->addElement($element);


           $element = $model->getElement('id_papel');
           $this->addElement($element);


           $element = $model->getElement('solic_info_adic');
           $element->setRequired(true);
           $this->addElement($element);


           $element = $model->getElement('observacao');
           $this->addElement($element);


           $element = $model->getElement('avatar');
           $this->addElement($element);

           /* $element = new ZendT_Form_Element_SubmitAjax('Salvar');
             $this->addElement($element); */

           $id = Zend_Controller_Front::getInstance()->getRequest()->getParam('id');
           if ($id) {
               $_mapper = new Auth_DataView_Usuario_MapperView();
               $data = $_mapper->setId($id)->retrieveRow();
               /*foreach($data as $key=>$value){
                   echo $key.": ".$value->get()."<br />";
               }
               exit;*/
               $data['idtipousuario'] = $data['id_tipousuario'];
               $data['idempresa'] = $data['id_empresa'];
               $data['idfilial'] = $data['id_filial'];
               $data['idempresadef'] = $data['id_empresadef'];
               $data['idusuarioresp'] = $data['id_usuarioresp'];
               $this->populate($data);
           }
       }

       /**
        * Configura uma coluna para ser multipla, ou seja,
        * transformar um dado em array
        *
        * @return void
        */
       public function setMultiple($column, $numRepeat) {
           $this->_multiple[$column] = $numRepeat;
       }

   }

?>