<?php

$log_file = 'log.txt';

date_default_timezone_set('America/Sao_Paulo');

$start_time     = microtime(true);

$start_datetime = date('d/m/Y H:i:s');
file_put_contents($log_file, "Início da execução: $start_datetime\n");

/* ******************************************************************************************************************************* */

file_put_contents($log_file, "\n\n====================  Começando PAÍS ====================", FILE_APPEND);
include 'pais.php';

$checkpoint1        = microtime(true);
$time_elapsed_step1 = $checkpoint1 - $start_time;
file_put_contents($log_file, "\nTempo da Etapa PAIS: ". round($time_elapsed_step1,2) ." segundos", FILE_APPEND);

/* ******************************************************************************************************************************* */

file_put_contents($log_file, "\n\n====================  Começando CIDADE ====================", FILE_APPEND);
include 'cidade.php';

$checkpoint2        = microtime(true);
$time_elapsed_step2 = $checkpoint2 - $checkpoint1;
file_put_contents($log_file, "\nTempo da Etapa CIDADE: ". round($time_elapsed_step2,2) ." segundos", FILE_APPEND);

/* ******************************************************************************************************************************* */

file_put_contents($log_file, "\n\n====================  Começando INSTITUIÇÃO ====================", FILE_APPEND);
include 'instituicao.php';

$checkpoint3        = microtime(true);
$time_elapsed_step3 = $checkpoint3 - $checkpoint2;
file_put_contents($log_file, "\nTempo da Etapa INSTITUIÇÃO: ". round($time_elapsed_step3,2) ." segundos", FILE_APPEND);

/* ******************************************************************************************************************************* */

file_put_contents($log_file, "\n\n====================  Começando PESQUISADOR ====================", FILE_APPEND);
include 'pesquisador.php';

$checkpoint4        = microtime(true);
$time_elapsed_step4 = $checkpoint4 - $checkpoint3;
file_put_contents($log_file, "\nTempo da Etapa PESQUISADOR: ". round($time_elapsed_step4,2) ." segundos", FILE_APPEND);

/* ******************************************************************************************************************************* */

file_put_contents($log_file, "\n\n====================  Começando OBRA ====================", FILE_APPEND);
include 'obra.php';

$end_time           = microtime(true);
$time_elapsed_step5 = $end_time - $checkpoint4;
file_put_contents($log_file, "\nTempo da Etapa OBRA: ". round($time_elapsed_step5,2) ." segundos", FILE_APPEND);

$end_datetime = date('d/m/Y H:i:s');

// Calcula o tempo decorrido em cada etapa
$total_execution_time = $end_time - $start_time;

file_put_contents($log_file, "\nTempo de execução de todas as etapas: ". round($total_execution_time,2) ." segundos", FILE_APPEND);


file_put_contents($log_file, "\n\nTérmino da execução de Término: $end_datetime\n", FILE_APPEND);


// Exibe os tempos de execução
echo "Os tempos foram registrados no arquivo de log: $log_file";

?>
