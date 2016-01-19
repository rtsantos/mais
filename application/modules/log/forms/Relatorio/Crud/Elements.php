<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_web_relat
 */
class Log_Form_Relatorio_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_log');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Form_Relatorio_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('log_web_relat.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdUsuario(){

        $element = new ZendT_Form_Element_Seeker('id_usuario');
        $element->setSufix('usuario');
        $element->setLabel($this->_translate->_('log_web_relat.id_usuario') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrive('/auth/usuario/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    public function getSessao(){

        $element = new ZendT_Form_Element_Text('sessao');
        $element->setLabel($this->_translate->_('log_web_relat.sessao') . ':');
        $element->setAttribs(array('maxlength'=>'40','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    public function getArquivo(){

        $element = new ZendT_Form_Element_Text('arquivo');
        $element->setLabel($this->_translate->_('log_web_relat.arquivo') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    public function getTitulo(){

        $element = new ZendT_Form_Element_Text('titulo');
        $element->setLabel($this->_translate->_('log_web_relat.titulo') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    public function getDhIniExec(){

        $element = new ZendT_Form_Element_DateTime('dh_ini_exec');
        $element->setLabel($this->_translate->_('log_web_relat.dh_ini_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getDhFimExec(){

        $element = new ZendT_Form_Element_DateTime('dh_fim_exec');
        $element->setLabel($this->_translate->_('log_web_relat.dh_fim_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getDhFimRelat(){

        $element = new ZendT_Form_Element_DateTime('dh_fim_relat');
        $element->setLabel($this->_translate->_('log_web_relat.dh_fim_relat') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getQtdReg(){

        $element = new ZendT_Form_Element_Numeric('qtd_reg');
        $element->setLabel($this->_translate->_('log_web_relat.qtd_reg') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','6');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getImpresso(){

        $element = new ZendT_Form_Element_Text('impresso');
        $element->setLabel($this->_translate->_('log_web_relat.impresso') . ':');
        $element->setAttribs(array('maxlength'=>'1','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
}
?>