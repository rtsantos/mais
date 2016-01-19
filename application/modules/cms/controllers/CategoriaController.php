<?php

   class Cms_CategoriaController extends ZendT_Controller_ActionCrud {

       public function init() {
           $this->_init();
           $this->_startupAcl();
           $this->_serviceName = 'Cms_Service_Categoria';
           $this->_formName = 'Cms_Form_Categoria_Edit';
           $this->_formSearchName = 'Cms_Form_Categoria_Search';
           $this->_mapper = new Cms_DataView_Categoria_MapperView();
           /**
            * ConfiguraÃ§Ã£o do Grid
            */
           $name = $this->getRequest()->getParam('name');
           if (!$name)
               $name = 'categoria';
           $this->setGrid(new ZendT_Grid('grid_' . $name));
           $this->setLayout(ZendT_Controller_Action::LAYOUT_INTRANET);
           
           $_menu = new Cms_DataView_Menu_MapperView();
           $_menu->load(false);
       }

       public function configGrid() {
           parent::configGrid();

           $this->getGrid()->setOnSelectRow("function(){ selectedRowCategoria(); }");
       }

       public function widgetAction() {
           $parent = $this->getRequest()->getParam('parent');
           $noLayout = $this->getRequest()->getParam('no_layout');
           $fileSystem = new Ged_Model_Arquivo_FileSystem();

           $this->getMapper()->setIdcategoriaPai($parent)->setStatus('A')->findAll(null,'*',array('ordem','id'));
           $categorias = array();
           while ($this->getMapper()->fetch()) {
               $categoria['url'] = ZendT_Url::formatUrl($this->getMapper()->getUrl()->get());
               $categoria['descricao'] = $this->getMapper()->getDescricao()->get();
               $categoria['observacao'] = $this->getMapper()->getObservacao()->get();

               $thumbnail = $this->getMapper()->getThumbnail()->toPhp();
               $categoria['thumbnail'] = $fileSystem->getUrl($thumbnail);
               $categorias[] = $categoria;
           }

           $this->view->categorias = $categorias;
           
           if ($noLayout){
               $this->_disableRender(true, false);
           }
       }

   }

?>
