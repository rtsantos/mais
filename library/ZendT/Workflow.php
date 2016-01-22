<?php
    class ZendT_Workflow {
        /**
         * Guarda a instancia atual
         * 
         * @var \ZendT_Workflow
         */
        protected static $_instance = null;
        /**
         * Guarda o processo atual
         * 
         * @var \ZendT_Workflow_Process
         */
        protected $_process;
        /**
         *
         * @var ZendT_Workflow_Process_Row[]
         */
        protected $_dataProcess;
        /**
         * Guarda a transação atual
         * 
         * @var \ZendT_WorkflowTransaction
         */
        protected $_transaction;
        /**
         * Guarda a fase atual
         * 
         * @var \ZendT_Workflow_Fase
         */
        protected $_fase;
        /**
         *
         */
        public function __construct() {
            $this->_fase = 'Wf_Model_WfFase_Table';
            $this->_process = 'Wf_Model_WfProcesso_Table';
        }
        /**
         *
         * @return ZendT_Workflow 
         */
        public static function getInstance() {
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
        /**
         * Retorna o processo que será trabalhado
         * 
         * @return ZendT_Workflow_Process_Interface
         */
        private function _getProcess() {
            if (!is_object($this->_process)) {
                $this->_process = ZendT_Workflow_Process::factory($this->_process);
            }
            return $this->_process;
        }
        /**
         * Pega os dados da fase do processo
         * 
         * @return ZendT_Workflow_Fase_Interface 
         */
        private function _getFase() {
            if (!is_object($this->_fase)) {
                $this->_fase = ZendT_Workflow_Fase::factory($this->_fase);
            }
            return $this->_fase;
        }
        /**
         *
         * @param ZendT_Mapper $mapper
         * @return \ZendT_Workflow 
         */
        public function setProcess($mapper) {
            $mapperName = get_class($mapper);        
            $this->_dataProcess = $this->_getProcess()->getProcess($mapperName);
            return $this;
        }
        /**
         * 
         * @param ZendT_Mapper $mapper
         */
        public function afterSave($mapper){
            if (is_array($this->_dataProcess)){
                foreach ($this->_dataProcess as $process){
                    $value = $mapper->getData($process->getColumn());
                    $fase = $this->_getFase()->getFase($process->getId(),$value->get());
                    if (is_object($fase)){
                        $notification = $fase->getNotification();
                        if ($notification){
                            $client = new Zend_Http_Client();
                            $client->setUri($fase->getNotification());
                            $client->setParameterPost('id', $this->getId());
                            $client->request('POST');
                        }
                    }
                }
            }
        }
    }
?>
