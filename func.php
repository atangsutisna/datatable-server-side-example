<?php

function connect_db($host, $dbname, $username, $password) 
{
    $charset = 'utf8mb4';
    $collate = 'utf8mb4_unicode_ci';
    try 
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
        ];    
        
        return new PDO("mysql:host=$host;dbname={$dbname}", $username, $password, $options);
    } 
    catch (PDOException $ex) 
    {
        throw new Exception("Connection failed: ". $ex->getMessage());
    }
    
}