<?php
function createdb(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";

    // create connection
    $con = mysqli_connect($servername,$username,$password);

    //test connection

    if(!$con){
        die("Error..database connection".mysqli_connection_error());
    }else{
        
        //create database
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if(mysqli_query($con,$sql)){

            $con = mysqli_connect($servername,$username,$password, $dbname);

            $sql = "
                CREATE TABLE IF NOT EXISTS books(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    book_name VARCHAR(25) NOT NULL,
                    book_publisher VARCHAR(20),
                    book_price FLOAT    
                );
            ";

            if(mysqli_query($con,$sql)){
                return $con;
            }else{
                echo "Error! table not created";
            }

        }else{
            echo "Error! database not created";
        }
    }
}