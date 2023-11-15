<?php

$curl = curl_init();

require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('pt_BR');

$log_file = 'log.txt';

$id = $faker->numberBetween($min = 34, $max = 63);
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_PORT => "8080",
    CURLOPT_URL => "http://localhost:8080/api/v1/db/data/noco/p7yp4fkra1v8r6t/Instituicoes?limit=1&offset=0&where=&r=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "xc-auth: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im1hcmNlbG8ubWlyYW5kYS5wcEBnbWFpbC5jb20iLCJpZCI6InVzd2gyMnNiOXFlOW4ydXoiLCJyb2xlcyI6Im9yZy1sZXZlbC1jcmVhdG9yLHN1cGVyIiwidG9rZW5fdmVyc2lvbiI6IjkzZTUyMjZkMTk1ZmQ5MDhmZjk2ZTlkZDc0NjJkYTEzN2VlMjhlMTk5MWEzMTIzMGQ3N2RlNmFjZTZiZjA3NTNkNTA4NzQ3MWJkMWNkZjRlIiwiaWF0IjoxNjk5NjE2MTMxLCJleHAiOjE2OTk2NTIxMzF9.kqQWPSckaF3R89Y8nWbuvaVKu06hKi3_ejOHsGJq2P8"
    ],
]);



// CAz36OySg66u8MYCAhUkMv_8hIK5rYO4N4IxB0wn
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Insert Error #:" . $err;
} else {
    

    $obj= json_decode($response);

    print_r( $obj->list[0]->Id );
    
    
    
}


?>
