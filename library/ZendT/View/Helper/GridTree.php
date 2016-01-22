<?php

    /**
     * 
     */
    class ZendT_View_Helper_GridTree extends ZendX_JQuery_View_Helper_UiWidget {

        protected function _normalizeId($value) {
            //$value = parent::_normalizeId($value);
            $value = strtolower(trim($value));
            $value = str_replace(array(' ', '/', '[', ']', '{', '}'), '-', $value);
            return $value;
        }

        /**
         *
         * @param ZendT_Grid $grid
         * @return string 
         */
        public function gridTree(ZendT_Grid $grid) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TGridTree.js?date=180113');
            $firstColumn = '';
            /**
             * Linha de Título 
             */
            $rowTitle = '<tr>';
            $numCols = 0;
            foreach ($grid->getColModel()->getColumns() as $column) {
                $style = '';
                if ($column->getHidden()) {
                    $style = 'display:none;';
                } elseif ($firstColumn == '') {
                    $firstColumn = $column->getName();
                    $numCols++;
                } else {
                    $numCols++;
                }
                $style.= 'text-align:' . $column->getAlign() . ';';

                $class = 't-ui-border-trb';
                if ($firstColumn == $column->getName()) {
                    $class = 't-ui-border-trbl';
                }

                $rowTitle.= '<th class="ui-state-default ' . $class . '" style="' . $style . '">';
                $rowTitle.= $column->getHeaderTitle();
                $rowTitle.= '</th>';
            }
            $rowTitle.= '</tr>';
            /**
             * Linhas do Detalhe 
             */
            $rows = '';
            $stylesRow = $grid->getStyles();
            foreach ($grid->getRows() as $index => $row) {
                $class = '';
                $style = '';
                if ($grid->getTreeGrid() == 'true') {
                    if (trim($row['tree_parent']) != '') {
                        $class.= 'parent-' . $this->_normalizeId($row['tree_parent']);
                        $style.= 'display:none';
                    }
                }
                $rowId = $this->_normalizeId($row['id']);
                $rows.= '<tr id="' . $rowId . '" class="' . $class . '" style="' . $style . '">';

                foreach ($grid->getColModel()->getColumns() as $column) {
                    $options = $column->getOptions();
                    $key = $column->getName();
                    if (in_array($key, array('tree_child', 'tree_level'))) {
                        continue;
                    }

                    $style = '';
                    $attr = '';
                    if ($key == $firstColumn) {
                        $attr = 'level="' . $row['tree_level'] . '" child="' . $row['tree_child'] . '" ';
                    }
                    if ($column->getHidden()) {
                        $style = 'display:none;';
                    }
                    $style.= 'text-align:' . $column->getAlign() . ';';
                    $style.= 'min-width:' . $column->getWidth() . 'px;';

                    if (isset($stylesRow[$index][$key])) {
                        foreach ($stylesRow[$index][$key] as $styleName => $styleValue) {
                            $style.= $styleName . ':' . $styleValue . ';';
                        }
                    }

                    $class = 't-ui-border-rb';
                    if ($firstColumn == $column->getName()) {
                        $class = 't-ui-border-rbl';
                    }

                    $rows.= '<td ' . $attr . 'class="ui-widget-content ' . $key . ' ' . $class . '" style="' . $style . '">';
                    $rows.= $row[$key];
                    $rows.= '</td>';
                }
                $rows.= '</tr>';
            }
            /**
             * Botões de Navegação
             */
            $buttonsToolbar = $grid->getObjToolbar()->getButtons();
            if ($buttonsToolbar) {
                $toolbar = '';
                foreach ($buttonsToolbar as $button) {
                    if ($button) {
                        foreach ($button as $oneButton) {
                            $toolbar.= $oneButton->renderHtml();
                        }
                    }
                }
                $toolbar = '<tr> <th colspan="' . $numCols . '" class="ui-state-default" style="border-bottom:0px;text-align:left;"> ' . $toolbar . ' </th> </tr>';
            }
            /**
             * Parâmetros do jQuery para criar a árvore 
             */
            $params = array(
                'columns' => array(
                    'group' => $firstColumn,
                    'parent' => 'tree_parent',
                    'level' => 'tree_level'
                )
            );
            $params = ZendT_JS_Json::encode($params);
            $this->jquery->addOnLoad('jQuery("#' . $grid->getID() . '").TGridTree(' . $params . ');');

            return '<table width="100%" class="ui-jqgrid-htable" cellspacing="0" cellpadding="3" border="0" id="' . $grid->getID() . '">
                ' . $toolbar . '
                ' . $rowTitle . '
                ' . $rows . '
            </table>';
        }

    }

?>
