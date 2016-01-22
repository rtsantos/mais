<?php
/**
 *
 * @author ksantoja
 */
interface ZendT_Workflow_Process_Interface {
    /**
     * @return \ZendT_Workflow_Process_Row[]
     */
    public function getProcess($mapperName);
}
?>
