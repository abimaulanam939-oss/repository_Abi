<?php

$host      ="localhost";
$database  ="db_portofolioabi";
$user      ="root";
$password  ="";
$port      ="3306";


$conn = mysqli_connect($host,  $user, $password,$database);

if(!$conn){
    die('gagal terhubung ke database bestie');

}
//echo"Terhubung ke database bestie";

$nama_lengkap = mysqli_real_escape_string ($conn,$_POST['nama_lengkap']);
$email = mysqli_real_escape_string ($conn,$_POST['email']);
$pesan = mysqli_real_escape_string ($conn,$_POST['pesan']);

$simpan = mysqli_query($conn,"INSERT INTO contact (nama_lengkap,email,pesan) VALUES('$nama_lengkap','$email','$pesan')");

if ($simpan){
  header("location:contact.php");
}else{
    echo "data gagal disimpan bestie";
}


?>
