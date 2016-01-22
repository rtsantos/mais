<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 * Todo objeto que precisa de um JavaScript na view para
 * ser renderizado precisa extender a esta interface e implementar seus métodos
 * obrigatóriamente, mantendo assim um padrão de projeto
 * 
 */
interface ZendT_JS_Interface {

    /**
     * Implementado para criar o JS exigido pela classe que
     * o implementar 
     */
    public function createJS();

    /**
     * Criado para retornar a view ou controlador todo JS com suas devidas configurações
     * pronto para ser inserido no HTML
     */
    public function render();
}
?>
