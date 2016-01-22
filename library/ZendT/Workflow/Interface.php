<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rsantos
 */
interface ZendT_Workflow_Interface {
    /**
     * 
     */
    public function nextFase($columns=array());
    /**
     * 
     */
    public function nextUser($columns=array());
    /**
     * 
     */
    public function sendNotification($columns=array());
    /**
     * Retorna o processo que será trabalhado
     * 
     * @return numeric
     */
    public function getProcess($columns=array());
    /**
     * Pega os dados da fase do processo
     * 
     * @return array 
     */
    public function getFase($column);
    /**
     * Define os dados da fase atual do processo
     * 
     * @param string $value
     * @return \ZendT_Workflow 
     */
    public function setFase($value);
}
?>
