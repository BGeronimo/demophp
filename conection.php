<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'pruebaLogin';



    try{

        $pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     
    }catch(Exception $ex ){
        echo $ex->getMessage();
    }

?>