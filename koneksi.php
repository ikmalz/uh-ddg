<?php
    $serve = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pengelola_buku";

    $conn = new  mysqli($serve,$username,$password,$dbname);

    if ($conn->connect_error) {
        die("koneksi ke database gagal:" . $conn->connect_error);
    }
?>