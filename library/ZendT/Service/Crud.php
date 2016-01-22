<?php
/**
 * @see ZendT_Acl
 */
require_once('ZendT/Acl.php');
/**
 * Essa classe tem como finalidade padronizar 
 * os serviços de CRUD
 *
 * @package ZendT
 * @subpackage Service
 * @author rsantos
 */
class ZendT_Service_Crud {
    /**
     * Classe de modelo
     * 
     * @var ZendT_Db_Table_Abstract
     */
    protected $_model;
    /**
     * Busca o role do usuário
     * @todo codificar
     */
    private function isAllowed($token,$action){
        $userRow = ZendT_Acl::getInstance()->getUserRow($token);

        $module = Zend_Controller_Front::getInstance()->getParam('module');
        $controller = Zend_Controller_Front::getInstance()->getParam('controller');
        if (!ZendT_Acl::getInstance()->isAllowed($action,$module.'.'.$controller,$userRow->getRole())){
            throw new ZendT_Exception_Alert('Usuário não tem permissão de acesso');
        }
        return true;
    }
    /**
     * Retorna qual função será utilizada para retornar os dados de uma consulta
     * 
     * @param ZendT_Service_Param $param
     * @return string
     * @throws ZendT_Exception_Alert 
     */
    private function _getTypeRetrieve($param) {
        
        if (!$param->typeRetrive) {
            $param->typeRetrive = 'user';
        }
        if ($param->typeRetrieve == '' && $param->typeRetrive){
            $param->typeRetrieve = $param->typeRetrive;
        }
        $instruction = ($param->typeRetrieve == 'user') ? 'get' : 'toPhp';
        return $instruction;
    }
    /**
     *
     * @param type $mapper
     * @param type $id
     * @param type $filter
     * @param type $filters
     * @param type $filterOp
     * @return \ZendT_Db_Where 
     */
    private function _getWhere(&$mapper,$id,$filter,$filters,$filterOp){
        $where = '';
        if ($id != ''){
            $mapper->setId($id);
            $where = $mapper->getWhere();
        }else{
            if (count($filters) > 0){
                $where = new ZendT_Db_Where($filterOp);
                foreach ($filters as $filter){
                    $where->addFilter($filter->field, $filter->value, $filter->operation, $filter->mapperName);
                }
            }elseif($filter->field && $filter->value){
                $where = new ZendT_Db_Where($filterOp);
                $where->addFilter($filter->field, $filter->value, $filter->operation, $filter->mapperName);
            }
        }
        return $where;
    }
    
    private function _resultId($data){
        if (is_array($data)){
            if (isset($data['id'])){
                $value = $data['id'];
                if ($value instanceof ZendT_Type){
                    $value = $value->getValueToDb();
                }
                return $value;
            }else{
                $id = "";
                foreach ($data as $value){
                    if ($value instanceof ZendT_Type){
                        $id.= '-'.$value->get();
                    }else{
                        $id.= '-'.$value;
                    }
                }
            }
            return substr($id,1);
        }else{
            return $data;
        }
    }
    /**
     * Insere um registro no modelo de dados
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result
     */
    public function insert($param){
        $result = new ZendT_Service_Result();
        $result->service = __METHOD__;        
        try {
            #$this->isAllowed($token,'insert');
            /**
            * @var ZendT_Db_Mapper 
            */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $data = array();
            foreach ($param->data as $_data){
                $data[$_data->field] = $_data->value;
            }
            
            $_mapper = new $param->mapperView();            
            $_mapper->populate($data);
            $result->id = $this->_resultId($_mapper->insert());
            $result->success = 1;
        } catch (ZendT_Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
        } catch (Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
        }
        return $result;        
    }
    /**
     * Atualiza um registro no modelo de dados
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result
     */
    public function update($param){
        $result = new ZendT_Service_Result();
        $result->service = __METHOD__;        
        try {
            #$this->isAllowed($token,'insert');
            /**
            * @var ZendT_Db_Mapper 
            */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
                
            $data = array();
            foreach ($param->data as $_data){
                $data[$_data->field] = $_data->value;
            }
            $_mapper = new $param->mapperView();
            $_mapper->populate($data);
            $where = $this->_getWhere($_mapper,$param->id,$param->filter,$param->filters,$param->filterOp);
            $result->id = $this->_resultId($_mapper->update($where));
            $result->success = 1;
        } catch (ZendT_Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
        } catch (Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
        }
        return $result;        
    }
    /**
     * Apaga um registro no modelo de dados
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result
     */
    public function delete($param){
        $result = new ZendT_Service_Result();
        $result->service = __METHOD__;        
        try {
            #$this->isAllowed($token,'insert');
            /**
            * @var ZendT_Db_Mapper 
            */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $data = array();
            foreach ($param->data as $_data){
                $data[$_data->field] = $_data->value;
            }
            $_mapper = new $param->mapperView();
            $where = $this->_getWhere($_mapper,$param->id,$param->filter,$param->filters,$param->filterOp);
            $result->id = $_mapper->delete($where);
            $result->success = 1;
        } catch (ZendT_Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
        } catch (Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
        }
        return $result;        
    }
    
    /**
     * Retorna um registro no modelo de dados
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result_Data
     */
    public function retrieve($param){
        $result = new ZendT_Service_Result_Data();
        $result->service = __METHOD__;        
        
        try {
            #$this->isAllowed($token,'insert');
            /**
            * @var ZendT_Db_Mapper 
            */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $_mapper = new $param->mapperView();
            $where = $this->_getWhere($_mapper,$param->id,$param->filter,$param->filters,$param->filterOp);

            $postData['noPage'] = true;
            $dataGrid = $_mapper->getDataGrid($where, $postData);
            $columns = $_mapper->getColumns()->getColumnsGrid(true);
            $row = $dataGrid->getRow();
            
            $result->data = array();
            
            $retrieve = $this->_getTypeRetrieve($param);
            
            if ($row) {
                
                foreach ($columns as $column){
                                       
                    $key = strtolower($column->getName());

                    $_data = new ZendT_Service_Data();
                    $_data->field = $key;
                    
                    if ($row[$key] instanceof ZendT_Type_Blob){                        
                        if (isset($row[$key . '_name'])) {
                            $name = $row[$key . '_name'];
                        } else {
                            $name = 'Arquivo-' . date('dmyhis') . '.txt';
                        }
                        if (isset($row[$key . '_type'])) {
                            $type = $row[$key . '_type'];
                        } else {
                            $type = 'application/txt';
                        }                        
                        $_file = new ZendT_File($name,$row[$key]->get(),$type);
                        $row[$key . '_name'] = $name;
                        $row[$key . '_type'] = $type;
                        $_data->value = $_file->toFilenameCrypt(true);
                    } else {
                        $_data->value = $row[$key]->$retrieve();
                    }
                    
                    $result->data[] = $_data;
                }
            }

            $result->success = 1;
            
        } catch (ZendT_Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
        } catch (Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
        }
        return $result;
    }    
    
    /**
     * Retorna um registro no modelo de dados
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result_Data
     * @deprecated since 1.1 number
     */
    public function retrive($param){
        return $this->retrieve($param);
    }
    /**
     * Retorna um recordSet para consultas personalizadas
     * 
     * @param string $method
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result_Recordset
     * @throws ZendT_Exception 
     */
    public function retrieveCall($method, $param) {
        
        $result = new ZendT_Service_Result_Recordset();
        $result->service = __METHOD__;        
        
        try {
            /**
             * @var ZendT_Db_Mapper 
             */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $data = array();
            foreach ($param->data as $_data){
                $data[] = $_data->value;
            }
            
            $_mapper = new $param->mapperView();
            
            $resultData = call_user_func_array(array($_mapper, $method), $data);
            
            $rows = array();
            
            foreach ($resultData as $dados) {
                foreach ($dados as $key => $val){
                    $chave = strtolower($key);
                    $rows[$chave][] = array('value' => utf8_encode($val));
                }
            }
            
            $result->rows = array();
            
            foreach ($rows as $field => $value){
                $_row = new ZendT_Service_Result_Recordset_Row();
                $_row->field = $field;                
                $_row->values = $value;
                $result->rows[] = $_row;
            }
            
            $result->success = 1;
            
        } catch (ZendT_Exception $Ex) {
            
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
            
        } catch (Exception $Ex) {
            
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
            
        }
        
        return $result;
        
    }
    
    /**
     * Retorna um registro no modelo de dados
     *
     * @param string Nome do método que será chamado
     * @param ZendT_Service_Param $param     
     * @return ZendT_Service_Result_Data
     */
    public function call($method, $param) {
        
        $result = new ZendT_Service_Result_Data();
        $result->service = __METHOD__;        
        
        try {
            /**
             * @var ZendT_Db_Mapper 
             */
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $data = array();
            foreach ($param->data as $_data){
                $data[] = $_data->value;
            }
            
            $_mapper = new $param->mapperView();
            
            $resultData = call_user_func_array(array($_mapper, $method), $data);
            $this->data = array();
            
            if (is_array($resultData)) {
                
                foreach($resultData as $field => $value) {
                    $_data = new ZendT_Service_Data();
                    $_data->field = $field;
                    $_data->value = $value;
                    $this->data[] = $_data;
                }
                
            } else {
                
                $_data = new ZendT_Service_Data();
                $_data->field = 'result';
                $_data->value = $resultData;
                $this->data[] = $_data;
            }
            
            $result->success = 1;
            $result->data = $this->data;
            
        } catch (ZendT_Exception $Ex) {
            
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
            
        } catch (Exception $Ex) {
            
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
            
        }
        
        return $result;
    }
    
    private function _loadTranslate($mapperName) {
        
        $moduleName = explode('_', $mapperName);
        $moduleName = strtolower($moduleName[0]);
        
        $translate = new Zend_Translate(
                'array',
                APPLICATION_PATH . '/modules/' . $moduleName . '/languages/pt_BR.php',
                'pt_BR'
        );

        Zend_Registry::set('translate_default', $translate);
    }
    
    /**
     * Lista todos os registros de um modelo
     *
     * @param ZendT_Service_Param $param
     * @return ZendT_Service_Result_Recordset 
     */
    public function fetchAll($param) {
        $result = new ZendT_Service_Result_Recordset();
        $result->service = __METHOD__;
        
        try {
            if ($param->mapperView == ''){
                throw new ZendT_Exception('MapperView não informada.');
            } else {
                $this->_loadTranslate($param->mapperView);
            }
            
            $_mapper = new $param->mapperView();            
            $where = $this->_getWhere($_mapper,$param->id,$param->filter,$param->filters,$param->filterOp);            
            $postData['noPage'] = true;
            $postData['sord'] = '';
            $postData['sidx'] = $param->orderBy;
            $dataGrid = $_mapper->getDataGrid($where, $postData);
            $columns = $_mapper->getColumns()->getColumnsGrid(true);
            $rows = array();
            
            $retrieve = $this->_getTypeRetrieve($param);
            
            while ($row = $dataGrid->getRow()) {
                foreach ($columns as $column){
                    $key = strtolower($column->getName());
                    $rows[$key][] = array('value' => utf8_encode($row[$key]->$retrieve()));
                }
            }
            
            $result->rows = array();
            foreach ($rows as $field=>$value){
                $_row = new ZendT_Service_Result_Recordset_Row();
                $_row->field = $field;                
                $_row->values = $value;
                $result->rows[] = $_row;
            }
            
            if (! $result->rows) {
                $result->rows[] = new ZendT_Service_Result_Recordset_Row();
            }
            
            $result->success = 1;            
        } catch (ZendT_Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = $Ex->getShow();
            $result->message->notification = $Ex->getNotification();
        } catch (Exception $Ex) {
            $result->success = 0;
            $result->message->code = $Ex->getCode();
            $result->message->message = $Ex->getMessage();
            $result->message->show = 1;
            $result->message->notification = 'Error';
        }
        return $result;
    }
}