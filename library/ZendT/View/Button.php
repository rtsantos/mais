<?php
    /**
     * Cria um objeto do tipo Botão
     * 
     * @package ZendT
     * @subpackage Button
     * @category View
     *  
     */
    class ZendT_View_Button extends ZendT_View_Html {

        /**
        * É o ícone da UI provido do theme da UI setado.
        * Se esta opção estiver com 'none', somente o texto será exibido
        * 
        * @var string string
        */
        private $_icon;

        /**
        *
        * @param string $id
        * @param string $caption
        * @param string $onClick 
        */
        public function __construct($id, $caption='', $onClick=null) {
            parent::__construct('button', array('class'=>'ui-button-icon ui-state-default',
                                                'type'=>'button'));
            $this->setId($id);
            $this->setCaption($caption);
            if ($onClick !== null){
                $this->setOnClick($onClick);
            }
        }

        /**
        * Retorna a descrição do botão
        * 
        * @return string
        */
        public function getCaption() {
            return $this->getAttr('caption');
        }

        /**
        * Configura a descrição do botão
        * 
        * @param string $caption
        * @return \ZendT_View_Button 
        */
        public function setCaption($caption) {
            $this->setAttr('caption', $caption);
            return $this;
        }

        /**
        * Retorn o Ícone do Botão
        * 
        * @return string
        */
        public function getIcon() {
            return $this->_icon;
        }

        /**
        * Configura o ícone do botão
        * 
        * @param string $buttonicon
        * @return \ZendT_View_Button 
        */
        public function setIcon($buttonicon) {
            $this->_icon = $buttonicon;
            return $this;
        }

        /**
        * Retorna o título do botão, mostra quando 
        * 
        * @return type 
        */
        public function getTitle() {
            return $this->getAttr('title');
        }

        /**
        * Configura a título do botão, mostra quando 
        * 
        * @param string $title
        * @return \ZendT_View_Button 
        */
        public function setTitle($value) {
            $this->setAttr('title', $value);
            return $this;
        }

        /**
        * Retorna o conteúdo do evento click
        * 
        * @return string
        */
        public function getOnClick() {
            if ($this->_onClick){
                return $this->_onClick;
            }
            return $this->getAttr('onClick');
        }

        /**
        * Configura o conteúdo do evento click
        *
        * @param string $value
        * @return \ZendT_View_Button 
        */
        public function setOnClick($value) {
            if ($value instanceof ZendT_JS_Command){
                $this->_onClick = $value;
            }else{
                $this->setAttr('onClick', $value);
            }
            return $this;
        }

        /**
        * Retorna a função javascript
        * 
        * @return string 
        */
        public function createJS() {
            $onClick = $this->getOnClick();
            $param = array();
            if ($onClick instanceof ZendT_JS_Command){
                $param['onClick'] = $onClick;
            }
            $js = " jQuery('#{$this->getId()}').TButton(".ZendT_JS_Json::encode($param)."); ";
            $this->addOnLoad($this->getId(), $js);
            $this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic().'/scripts/jquery/widget/TButton.js');
            return $js;
        }
        /**
        * Renderiza o botão da Toolbar
        * 
        * @return string
        */
        public function render() {
            $this->createJS();
            $value = $this->getCaption();
            if ($this->getIcon()){
                //$this->addClass('ui-button-text-icon-primary');
                $value = '
                    <span class="ui-icon '.$this->getIcon().'"></span>
                    <span class="ui-text">'.$value.'</span>
                ';
            }else{
                //$this->addClass('ui-button-text-only');
                $value = '<span class="ui-text">'.$value.'</span>';
            }
            $this->setAttr('value', $value);
            return parent::render();
        }
    }

?>
