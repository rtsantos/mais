<?php

   class Cms_DataView_Sidebar_MapperView extends Cms_DataView_Categoria_MapperView{

       public function getSidebar($idCategoria) {
           $sql = "SELECT 'menu-' || trim(to_char(nvl(cms_categoria.id,0),'99999999999')) as recurso,
                          url,
                          descricao,
                          'menu-' || decode($idCategoria,cms_categoria.id_categoria_pai,'root',trim(to_char(nvl(cms_categoria.id_categoria_pai,0),'99999999999'))) as recurso_pai
                     FROM cms_categoria
                    WHERE status = 'A'
                      AND level <= 2
                      AND ( publico = 'S' OR EXISTS (" . $this->_restritionSql() . ") )
                    START WITH id_categoria_pai = " . $idCategoria . "
                  CONNECT BY PRIOR id = id_categoria_pai
                    ORDER BY level, ordem, descricao";
           //print $sql;
           $rows = $this->getModel()->getAdapter()->fetchAll($sql);
           $result = array();
           foreach ($rows as $row) {

               $data = array();
               $data['id'] = $row['recurso'];
               $data['url'] = ZendT_Url::formatUrl($row['url']);
               $data['desc'] = utf8_encode($row['descricao']);
               $result[$row['recurso_pai']][] = $data;
           }
           
           return $result;
       }

   }
   