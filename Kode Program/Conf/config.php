<?php
$userdb='root';
$password='';
$database='pwebtest';
try{
    $koneksi = new mysqli('localhost', $userdb, $password, $database);
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);  
    }
}catch(Exception $e){
    die($e->getMessage());
}
?>
