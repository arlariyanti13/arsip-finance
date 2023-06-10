<?php
     //cek apakah user sudah login
   
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }
  echo '
<div class="jumbotron mt-3">
  <h1 class="display-4">Selamat Datang ' . $_SESSION['username'] .'</h1>
  <p class="lead">E-Arsip adalah program yang akan memudahkan anda dalam mengarsip surat masuk, dan program ini akan berkembang lagi.</p>
  <hr class="my-4">
  <p>Anda dapat menggunakan menu-menu yang ada di atas ,terimakasih.</p>
  <a class="btn btn-dark btn-lg" href="logout.php" role="button">Logout </a>
</div>';

?>