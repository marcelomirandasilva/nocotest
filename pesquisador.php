<?php

$curl = curl_init();

require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('pt_BR');

$log_file = 'log.txt';

$apiToken       = "CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn";
$apiEndpoint1   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Instituicoes?limit=1&offset=0&where=&r=1"; 
$apiEndpoint2   = "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Pesquisadores/views/Pesquisadores"; 

echo "\nPESQUISADOR\n";

$counter = 0;
$log_interval = 1000;

for ($i = 0; $i < 20000; $i++) {

    /*=============================================================================== busca instituição */
    $ch = curl_init($apiEndpoint1);
    // Configurar as opções da solicitação
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "xc-token:  " . $apiToken,
        "Content-Type: application/json",
    ));
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    //$responseData = json_decode($response, true);
    $obj = json_decode($response);

    $id = $obj->list[0]->Id;
    //print_r( $obj->list[0]->Id );
    

    /*=============================================================================== insere pesquisador */
    $data = array(
        "Nome"              => $faker->name . " - " . $id,
        "Usuario"           => $faker->firstName,
        "CPF"               => $faker->cpf, 
        "Sexo"              => $faker->randomElement(["Masculino", "Feminino", "Outros", "Prefiro não informar"]), 
        "Tipo"              => $faker->randomElement(["tipo 1", "tipo 2", "tipo 3", "tipo 4", "tipo 5"]), 
        "dt_nascimento"     => $faker->date,
        "nc_wkjb___Instituicoes_id"      => $id, 

    );

    

    $ch = curl_init($apiEndpoint2);

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
        $obj = ($response);
        /*print_r( $obj );
        echo "<br />";
        echo "<br />"; */
    }

    // Fechar a conexão cURL
    curl_close($ch);

    $counter++;
    
    // Verifica se é hora de escrever no log (a cada 1000 registros)
    if ($counter % $log_interval === 0) {
        echo "\n-";
        // Obtém a data e hora atual
        $current_datetime = date('d/m/Y H:i:s');

        // Adiciona a mensagem ao log
        $log_message = "\nProcessados $counter registros em $current_datetime";

        // Escreve no log
        file_put_contents($log_file,  $log_message, FILE_APPEND);
    }else{
        echo "-";
    }

}

file_put_contents($log_file, "\nTotal adicionado 20.000 Pesquisadores", FILE_APPEND);


?>
