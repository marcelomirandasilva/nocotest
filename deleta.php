<?php
// URLs da API
$urls = array(
    'http://localhost:8080/api/v1/db/data/bulk/v1/p7yp4fkra1v8r6t/Cidades/all',
    'http://localhost:8080/api/v1/db/data/bulk/v1/p7yp4fkra1v8r6t/Paises/all',
    'http://localhost:8080/api/v1/db/data/bulk/v1/p7yp4fkra1v8r6t/Instituicoes/all',
    'http://localhost:8080/api/v1/db/data/bulk/v1/p7yp4fkra1v8r6t/Pesquisadores/all',
    'http://localhost:8080/api/v1/db/data/bulk/v1/p7yp4fkra1v8r6t/Obras/all'
);

// Dados do cabeçalho
$headers = array(
    'Accept: application/json',
    'xc-auth: CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn',
    'xc-token: CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn'
);

// Inicializa a sessão cURL
$ch = curl_init();

// Loop através das URLs
foreach ($urls as $url) {
    // Configura as opções da requisição cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a requisição cURL e obtém a resposta
    $response = curl_exec($ch);

    // Verifica por erros
    if (curl_errno($ch)) {
        echo 'Erro ao realizar a requisição cURL: ' . curl_error($ch);
    }

    // Exibe a resposta
    echo $response . PHP_EOL;
}

// Fecha a sessão cURL
curl_close($ch);
?>
