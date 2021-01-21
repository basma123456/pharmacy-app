<?php

$dsn = "mysql:host=localhost;dbname=pharmacy"; //data source name

$user = "root";

$pass = "";

$options = array(

    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);

try{

    $con = new PDO($dsn, $user, $pass, $options);  //start new connection with pdo class
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "you are cconnected now";
}

catch(PDOException $e){

    echo "sorry now you are not connetcted" . $e->getMessage();

}


?>