<?php

$curl = curl_init();

require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('pt_BR');

$log_file = 'log.txt';

$apiToken       = "CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn";
$apiEndpoint1   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Cidades"; 

$curl = curl_init();

echo "\nCIDADE\n";
for ($i = 0; $i < 30; $i++) {

    $data = array(
        "Estado"     => $faker->stateAbbr,
        "Cidade"     => $faker->city, 
    );


    $ch = curl_init($apiEndpoint1);

    // Configurar as opções da solicitação
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "xc-token:  " . $apiToken,
        "Content-Type: application/json",
    ));

    // Fazer a solicitação POST e enviar os dados
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Executar a solicitação e obter a resposta
    $response = curl_exec($ch);

    // Verificar se ocorreu algum erro
    if (curl_errno($ch)) {
        echo 'Erro na solicitação: ' . curl_error($ch);
    } else {
        echo "*";
    }

    // Fechar a conexão cURL
    curl_close($ch);

    
}

file_put_contents($log_file, "\nAdicionada 30 Cidades", FILE_APPEND);



?>
