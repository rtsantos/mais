<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela arquivo
 */
class Tools_Model_Arquivo_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('arquivo.id') . ':');
        $element->setAttribs(array('css-width'=>'87.5','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('arquivo.tipo') . ':');
        $element->addMultiOption('1', 'Texto');
        $element->addMultiOption('2', 'XML');
        $element->addMultiOption('3', 'FDF');
        $element->addMultiOption('4', 'EMAIL');
        $element->addMultiOption('5', 'PDF');        
                
        return $element;
    }
            
    public function getTempoVida(){

        $element = new ZendT_Form_Element_Numeric('tempo_vida');
        $element->setLabel($this->_translate->_('arquivo.tempo_vida') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getDhInc(){

        $element = new ZendT_Form_Element_DateTime('dh_inc');
        $element->setLabel($this->_translate->_('arquivo.dh_inc') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getHashcode(){

        $element = new ZendT_Form_Element_Text('hashcode');
        $element->setLabel($this->_translate->_('arquivo.hashcode') . ':');
        $element->setAttribs(array('maxlength'=>'32','css-width'=>'37'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('arquivo.nome') . ':');
        $element->setAttribs(array('maxlength'=>'75','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getArqClob(){

        $element = new ZendT_Form_Element_Textare('arq_clob');
        $element->setLabel($this->_translate->_('arquivo.arq_clob') . ':');
        $element->setAttribs(array('cols'=>'50','rows'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getChaveAcesso(){

        $element = new ZendT_Form_Element_Text('chave_acesso');
        $element->setLabel($this->_translate->_('arquivo.chave_acesso') . ':');
        $element->setAttribs(array('maxlength'=>'44','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getArqBlob(){

        $element = new ZendT_Form_Element_FileCustom('arq_blob');
        $element->setLabel($this->_translate->_('arquivo.arq_blob') . ':');
        $element->setAttribs(array());
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>