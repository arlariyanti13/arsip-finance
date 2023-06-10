<?php

//buat koneksi database

//persiapan identitas server
$server = "localhost"; //nama server
$user = "root"; //username database server
$pass = ""; //passsword database server
$database = "dbarsip3"; //nama database

//koneksi dataabase
$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

?>