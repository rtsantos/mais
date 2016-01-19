<?php

   class Sync_Form_Table extends ZendT_Form {

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements() {

           $this->setName('frm_mirror');
           $this->setAction(ZendT_Url::getUri(true) . '/mirror');

           $_element = new ZendT_Form_Element_Text('adapter');
           $_element->setName('adapter');
           $_element->setLabel('Adaptador de Origem:');
           $_element->setValue('prouser');
           $_element->setRequired(true);
           $this->addElement($_element);

           $_element = new ZendT_Form_Element_Text('table');
           $_element->setName('table');
           $_element->setLabel('Tabela de Origem:');
           $_element->setValue('profile_object_view');
           $_element->setRequired(true);
           $this->addElement($_element);

           $_element = new ZendT_Form_Element_Text('adapter_mirror');
           $_element->setName('adapter_mirror');
           $_element->setLabel('Adaptador de Espelhamento:');
           $_element->setValue('prouser-mirror');
           $_element->setRequired(true);
           $this->addElement($_element);
           
           $_element = new ZendT_Form_Element_Text('where');
           $_element->setName('where');
           $_element->setLabel('Filtro do Registro:');
           $_element->setValue('1 = 1');
           $_element->setRequired(true);
           $this->addElement($_element);

           //$_element = new ZendT_Form_Element_SubmitAjax('bt_submit');
           //$_element->setValue('Espelhar');
           $_element = new ZendT_Form_Element_Button('btn_mirror');
           $_element->setIcon('ui-icon-copy');
           $_element->setAttrib('onClick',"jQuery.AjaxT.submitJson({selector:'#".$this->getId()."'});");
           $_element->setValue('Espelhar');

           $this->addElement($_element);
       }

   }

?>