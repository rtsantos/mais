<?php

    set_time_limit(0);
    /*
    $argv[1] = "Dfe_Interface_DistribuicaoDfe::run";  
    $argv[2] = "C:/AppWeb/htdocs";
    $argv[3] = "production";
     */
	if (!isset($argv[3])){
	    $argv[3] = 'production';
	}
    $documentRoot = realpath('.');
	echo 'Document Root: ' . $documentRoot;
    /**
     * Define o PATH da Aplicação
     */
    define('APPLICATION_PATH', $documentRoot . '/application');
    /**
     * Define o ambiente
     */
    define('APPLICATION_ENV', $argv[3]);
    /**
     * Atribui os paths
     */
    set_include_path(get_include_path() .
            PATH_SEPARATOR . $documentRoot .
            PATH_SEPARATOR . $documentRoot . '/library' .
            PATH_SEPARATOR . $documentRoot . '/application' .
            PATH_SEPARATOR . $documentRoot . '/application/modules');
    
    /**
     * Include de bibliotecas
     */
    require 'core.php';
    require 'ZendT/Cron/Bootstrap.php';

    $options = array();
    $options['documentRoot'] = $documentRoot;
    $data = explode('::', $argv[1]);
    $options['object']['name'] = $data[0];
    $options['object']['method'] = $data[1];
    $_bootstrap = new ZendT_Cron_Bootstrap($options);
    $_bootstrap->run();
?>