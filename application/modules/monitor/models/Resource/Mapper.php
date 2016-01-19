<?php

   class Monitor_Model_Resource_Mapper {

       public function getProcess() {
           //$content = file_get_contents('ps-aux.txt');
           $content = shell_exec('ps aux');
           $process = array();
           if ($content) {
               $lines = explode("\n", $content);
               $first = true;
               foreach ($lines as $line) {
                   if ($line && !$first) {
                       $data = preg_split("/[\s]+/", $line, 11);

                       list($hour, $min) = explode(':', $data[9]);
                       $timeMin = ($hour * 60) + $min;

                       $process[] = array(
                          'user' => $data[0],
                          'pid' => $data[1],
                          'cpu' => str_replace('.', ',', $data[2]),
                          'mem' => str_replace('.', ',', $data[3]),
                          'men_vsz' => $data[4],
                          'men_rss' => $data[5],
                          'time_min' => $timeMin,
                          'program' => trim(substr($data[10], 0, 29))
                       );
                   } else {
                       $first = false;
                   }
               }
           }

           return $process;
       }

       /**
        *
        */
       public function getMemoryTotal() {
           //$content = file_get_contents('free.txt');
           $content = shell_exec('free');
           if ($content) {
               $lines = explode("\n", $content);
               $memory = array();
               foreach ($lines as $index => $line) {
                   if ($line) {
                       $data = preg_split("/[\s]+/", $line, 11);
                       if ($index == 1) {
                           $memory['mem_total'] = $data[1];
                           $memory['mem_used'] = $data[2];
                           $memory['mem_cached'] = $data[6];
                       } else if ($index == 3) {
                           $memory['swap_total'] = $data[1];
                           $memory['swap_used'] = $data[2];
                       }
                   }
               }
           }
           return $memory;
       }

   }

?>