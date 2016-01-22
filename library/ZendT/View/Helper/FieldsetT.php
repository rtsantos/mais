<?php

    class ZendT_View_Helper_FieldsetT extends Zend_View_Helper_FormElement {

        /**
         * Render HTML form
         *
         * @param  string $name Form name
         * @param  string $content Form content
         * @param  array $attribs HTML form attributes
         * @return string
         */
        public function fieldsett($name, $content, $attribs = null) {
            $info = $this->_getInfo($name, $content, $attribs);
            extract($info);

            // get legend
            $legend = '';
            if (isset($attribs['legend'])) {
                $legendString = trim($attribs['legend']);
                if (!empty($legendString)) {
                    $legend = '<div class="form-group-title">'
                            . (($escape) ? $this->view->escape($legendString) : $legendString)
                            . '</div>' . PHP_EOL;
                }
                unset($attribs['legend']);
            }

            $style = '';
            if (isset($attribs['style'])) {
                $style = ' style="' . $attribs['style'] . '"';
            }

            // get id
            //$id = $attribs['id'];
            if (!empty($id)) {
                $id = ' id="' . $this->view->escape($id) . '"';
            } else {
                $id = '';
            }

            // render fieldset
            $xhtml = '<div '
                    . $id
                    . $this->_htmlAttribs($attribs)
                    . ($legendString?' class="form-group-field"':'')
                    . $style
                    . '>'
                    . $legend
                    . '<div class="form-group-content">'
                    . $content
                    . '<div style="clear:both;"></div></div></div>';

            return $xhtml;
        }

    }

    