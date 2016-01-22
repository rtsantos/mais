<?php
/**
 *
 * @author ksantoja
 */
interface ZendT_Workflow_Fase_Interface {
    /**
     * @param int $processId
     * @param string $value
     * @return \ZendT_Workflow_Fase_Row[]
     */
    public function getFase($processId,$value);
}
?>
