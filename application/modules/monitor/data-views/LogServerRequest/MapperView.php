<?php
    /**
     * Classe de visão da tabela log_server_request
     */
    class Monitor_DataView_LogServerRequest_MapperView extends Monitor_DataView_LogServerRequest_Crud_MapperView
    {
        /**
         * 
         */
        protected function _getSettingsDefault() {
            $profile = parent::_getSettingsDefault();
            
            $profile['order'][] = 'ano_requesicao';
            $profile['order'][] = 'mes_requesicao';
            $profile['order'][] = 'dia_requesicao';
            $profile['order'][] = 'hora_requesicao';
            $profile['order'][] = 'minuto_requesicao';
            $profile['order'][] = 'total_requests';
            $profile['order'][] = 'dia_semana_requesicao';
            
            $profile['width']['pid'] = 40;
            $profile['width']['cpu'] = 40;
            $profile['width']['ss'] = 40;
            $profile['width']['req'] = 40;
            $profile['width']['conn'] = 40;
            $profile['width']['child'] = 50;
            $profile['width']['child'] = 50;
            $profile['width']['slot'] = 40;
            $profile['width']['perc_cpu'] = 50;
            $profile['width']['perc_mem'] = 50;
            $profile['width']['time'] = 60;
            $profile['width']['ano_requesicao'] = 40;
            $profile['width']['mes_requesicao'] = 40;
            $profile['width']['dia_requesicao'] = 40;
            $profile['width']['hora_requesicao'] = 40;
            $profile['width']['minuto_requesicao'] = 40;
            $profile['width']['total_requests'] = 40;
            $profile['width']['dia_semana_requesicao'] = 40;
            
            $profile['align']['ano_requesicao'] = 'center';
            $profile['align']['mes_requesicao'] = 'center';
            $profile['align']['dia_requesicao'] = 'center';
            $profile['align']['hora_requesicao'] = 'center';
            $profile['align']['minuto_requesicao'] = 'center';
            $profile['align']['total_requests'] = 'center';
            $profile['align']['dia_semana_requesicao'] = 'center';
            
            return $profile;
        }
        
        
        protected function _loadColumns() {
            parent::_loadColumns();
            
            $this->_columns->addExpression('ano_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'yyyy')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Ano da Requisição'));
            
            $this->_columns->addExpression('mes_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'mm')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Mês da Requisição'));
            
            $this->_columns->addExpression('dia_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'dd')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Dia da Requisição'));
            
            $this->_columns->addExpression('hora_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'hh24')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Hora da Requisição'));
            
            $this->_columns->addExpression('minuto_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'mi')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Minuto da Requisição'));
            
            $this->_columns->addExpression('dia_semana_requesicao'
                                          ,"TO_CHAR(log_server.dh_log, 'DAY', 'NLS_DATE_LANGUAGE=Portuguese')"
                                          ,new ZendT_Type_String()
                                          ,ZendT_Lib::translate('Dia da Semana da Requisição'));
            
            $this->_columns->add('total_requests', 'log_server', 'total_requests',  $this->_getLogServer()->getModel()->getMapperName(), ZendT_Lib::translate('log_server.total_requests'),'Numeric','=');

            $this->_columns->addExpression('contagem_sistema'
                                          ,"DECODE(log_server_request.system, NULL, 'NÃO IDENTIFICADO', log_server_request.system)"
                                          ,$this->getModel()->getMapperName()
                                          ,ZendT_Lib::translate('Contagem Sistema'));
        }
    }
?>