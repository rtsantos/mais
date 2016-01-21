<?php
    /**
    * Classe de visão da tabela profile_job_dest
    */
    class Profile_DataView_JobDest_Crud_MapperView extends Profile_Model_JobDest_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_Job_Mapper
         */
        protected $_job;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_papel;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_Job_Mapper
         */
        protected function _getJob(){
            if (!is_object($this->_job)){
                $this->_job = new Profile_Model_Job_Mapper();
            }
            return $this->_job;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getPapel(){
            if (!is_object($this->_papel)){
                $this->_papel = new Auth_Model_Conta_Mapper();
            }
            return $this->_papel;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_profile_job','descricao_profile_job','id_papel','nome_papel');
           $profile['width'] = array('id'=>100,'id_profile_job'=>120,'descricao_profile_job'=>200,'id_papel'=>120,'nome_papel'=>200);
           $profile['align'] = array('id'=>'left','id_profile_job'=>'left','descricao_profile_job'=>'left','id_papel'=>'left','nome_papel'=>'left');
           $profile['hidden'] = array('id_profile_job','id_papel');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Profile_Model_JobDest_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'profile_job_dest', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job_dest.id'),'String','%?%');
            $this->_columns->add('id_profile_job', 'profile_job_dest', 'id_profile_job', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job_dest.id_profile_job'), null, '?%');
            $this->_columns->add('descricao_profile_job', 'profile_job', 'descricao', $this->_getJob()->getModel()->getMapperName(), ZendT_Lib::translate('profile_job_dest.id_profile_job.profile_job.descricao'),null,'?%');
            $this->_columns->add('id_papel', 'profile_job_dest', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job_dest.id_papel'), null, '?%');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('profile_job_dest.id_papel.papel.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getJob()->getModel()->getTableName()." profile_job ON ( profile_job_dest.id_profile_job = profile_job.id ) 
                    JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( profile_job_dest.id_papel = papel.id )  "; 
            return $sql;
        }
    }
?>