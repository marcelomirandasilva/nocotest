<?php

$curl = curl_init();

require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('pt_BR');

$log_file = 'log.txt';

$apiToken       = "CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn";
$apiEndpoint1   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Instituicoes"; 


$curl = curl_init();

echo "\nINSTITUIÇÃO\n";

for ($i = 0; $i < 30; $i++) {

    $data = array(
        "Nome_fantasia"     => $faker->lastName,
        "Razao_social"      => $faker->company, 
        "cnpj"              => $faker->cnpj, 
        "Tipo"              => $faker->randomElement(["tipo 1", "tipo 2", "tipo 3", "tipo 4", "tipo 5"]), 
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
        // Processar a resposta da API
/*         $obj = ($response);
        print_r( $obj );
        echo "<br />";
        echo "-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
        echo "<br />";
        */        
        echo ".";
    }

    // Fechar a conexão cURL
    curl_close($ch);

}

file_put_contents($log_file, "\nAdicionada 30 instituições", FILE_APPEND);


?>
