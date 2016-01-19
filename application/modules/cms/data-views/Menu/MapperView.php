<?php

   class Cms_DataView_Menu_MapperView extends Cms_DataView_Categoria_MapperView {

       public function load($reload = false) {
           $sql = "SELECT nvl(url,'menu-' || trim(to_char(cms_categoria.id,'99999999999'))) as recurso,
                          descricao,
                          'menu-' || nvl(trim(to_char(cms_categoria.id_categoria_pai,'99999999999')),'root') as recurso_pai,
                          level as nivel,
                          ordem,
                          CASE WHEN id_categoria_pai IS NOT NULL AND url IS NULL THEN
                               'S'
                          ELSE
                               'N'
                          END as grupo,
                          level as nivel
                     FROM cms_categoria
                    WHERE menu = 'S' 
                      AND status = 'A'
                      AND ( publico = 'S' OR EXISTS (". $this->_restritionSql() .") )
                    START WITH id_categoria_pai IS NULL
                  CONNECT BY PRIOR id = id_categoria_pai
                    ORDER BY level, ordem, descricao";

           $moduleName = 'cms';
           $_session = Zend_Auth::getInstance()->getStorage()->read();
           if (!isset($_session->dataMenu[$moduleName]) || $reload) {
               $baseUrl = ZendT_Url::getBaseUrl();
               $_session->dataMenu = array();

               $rows = $this->getModel()->getAdapter()->fetchAll($sql);
               foreach ($rows as $row) {

                   $data = array();
                   $data['url'] = str_replace('{baseUrl}', $baseUrl, $row['recurso']);
                   $data['level'] = $row['nivel'];
                   $data['desc'] = utf8_encode($row['descricao']);
                   $data['group'] = ($row['grupo'] == 'S');

                   $_session->dataMenu[$moduleName][$row['recurso_pai']][] = $data;
               }
               $_session->dataMenuEncode[$moduleName] = 'UTF8';

               /* echo '<pre>';
                 print_r($_session->dataMenu);
                 echo '</pre>';
                 exit; */

               $storage = Zend_Auth::getInstance()->getStorage();
               $storage->write($_session);
               Zend_Auth::getInstance()->setStorage($storage);
           }

           return true;
       }

   }
   