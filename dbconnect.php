<?php

    try{
        $server_name = "localhost";
        $dbname = "myblog";
        $dbuser = "root";
        $dbpassword = "";

        // data source name
        $dsn = "mysql:host=$server_name;dbname=$dbname";
        $conn = new PDO($dsn,$dbuser,$dbpassword);

        // OR

        // $conn = new PDO("mysql:host=localhost;dbname=myblog","root","");

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // echo "Connection Success";

    }catch(PDOException $e){
        die("Connection fail:". $e->getMessage());
    }




?>