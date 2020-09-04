<?php

function createdb() {

    $servername = "localhost";
    $username = "root";
    $password = ""; // Enter The Password If You Have Set Any In Your Localhost
    $dbname = "bookstore";

    // Create A Connection
    $connect = mysqli_connect($servername, $username, $password);

    // Check Whether Connection Was Successful or Not
    if(!$connect){
        die("Connection Failed ! ".mysqli_connect_error());
    }

    // Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($connect, $sql)) {
        $connect = mysqli_connect($servername, $username, $password, $dbname);

        // Create books Table
        $sql = "
                CREATE TABLE IF NOT EXISTS books(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                book_name varchar (25) NOT NULL,
                book_publisher varchar (20),
                book_price float 
            );
        ";

        if(mysqli_query($connect, $sql)){
            return $connect;
        }
        else {
            echo "Unable To Create Table !";
        }
    }
    else {
        echo "Error While Creating The Database ! ".mysqli_error($connect);
    }
}

?>