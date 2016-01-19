<?php

class Ged_Form_PropDocto_Edit extends Ged_Form_PropDocto_Crud_Edit {

    /**
     * Carrega os elementos no formulário para serem renderizado
     * @return void
     */
    public function loadElements($action = 'insert') {
        parent::loadElements();
        $this->removeElement('config');
        $config = new Ged_Form_PropDocto_FormConfig();
        $config->loadElements();
        $this->addElements($config->getElements());
    }

}

?>