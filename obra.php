<?php

$curl = curl_init();

require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('pt_BR');

$log_file = 'log.txt';

$apiToken       = "CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn";
$apiEndpoint1   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Paises?limit=1&offset=0&where=&r=1"; 
$apiEndpoint2   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Cidades?limit=1&offset=0&where=&r=1"; 
$apiEndpoint3   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Pesquisadores?limit=1&offset=0&where=&r=1"; 

$apiEndpoint4   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Obras"; 

$counter = 0;
$log_interval = 1000;

echo "\nObra\n";
for ($i = 0; $i < 200000; $i++) {

    /*=============================================================================== busca pais */
        $ch = curl_init($apiEndpoint1);
        // Configurar as opções da solicitação
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("xc-token:  " . $apiToken,"Content-Type: application/json",));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $obj = json_decode($response);
        $id_pais = $obj->list[0]->Id;

    /*=============================================================================== busca cidade */
        $ch = curl_init($apiEndpoint2);
        // Configurar as opções da solicitação
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("xc-token:  " . $apiToken,"Content-Type: application/json",));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $obj = json_decode($response);
        $id_cidade = $obj->list[0]->Id;

    /*=============================================================================== busca pesquisador */
        $ch = curl_init($apiEndpoint3);
        // Configurar as opções da solicitação
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("xc-token:  " . $apiToken,"Content-Type: application/json",));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $obj = json_decode($response);
        $id_pesquisador = $obj->list[0]->Id;


    /*=============================================================================== insere obra */
        $data = array(
            "Usuario"                       => $faker->firstName,
            "Titulo"                        => $faker->sentence($nbWords = 3, $variableNbWords = true),
            "Dt_publicacao"                 => $faker->date,
            "nc_wkjb__Paises_id"            => $id_pais, 
            "nc_wkjb__Cidades_id"           => $id_cidade, 
            "nc_wkjb___nc_m2m_eymefr7417s"  => [$id_pesquisador], 

        );


        $ch = curl_init($apiEndpoint4);

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
            $obj = json_decode($response);
            $id_obra = $obj->Id;
        }


    /*=============================================================================== insere link */
    

    $apiEndpoint5   = "http://localhost:8080/api/v2/tables/Obras/links/Pesquisadores/records/$id_obra"; 

    $data = array(
        "Id"    => $id_pesquisador,
    );


    $ch = curl_init($apiEndpoint5);

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
     //   echo "*";
    }

    // Fechar a conexão cURL
    curl_close($ch);

    $counter++;
    
    // Verifica se é hora de escrever no log (a cada 1000 registros)
    if ($counter % $log_interval === 0) {
        echo "\n*";
        // Obtém a data e hora atual
        $current_datetime = date('d/m/Y H:i:s');

        // Adiciona a mensagem ao log
        $log_message = "\nProcessados $counter registros em $current_datetime";

        // Escreve no log
        file_put_contents($log_file,  $log_message, FILE_APPEND);
    }else{
        echo "*";
    }
}


file_put_contents($log_file, "\nTotal adicionado 200.000 Obras", FILE_APPEND);

?>
