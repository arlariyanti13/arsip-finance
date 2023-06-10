<?php

    @$halaman = $_GET['halaman'];

    if($halaman == "departemen")
    {
        //tampilkan halaman departemen 
        //echo "Tampil Halaman Modul Departemen";
        include "modul/departemen/departemen.php";
    }
    elseif ($halaman == "pengirim_surat"){
        //tampilkan halaman pengirim surat
        include "modul/pengirim_surat/pengirim_surat.php";
    }
    elseif($halaman == "arsip_surat")
    {
        if(@$_GET['hal'] == "tambahdata" ||  @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
            include "modul/arsip/form.php";
        }else{
            include "modul/arsip/data.php";
        }
    }
    elseif($halaman == "user")
    {
        if(@$_GET['hal'] == "edit"){
            include "modul/user/form.php";
        }else{
            include "modul/user/data.php";
        }
    }
    else
    {
        //echo "tampil halaman home";
         include "modul/home.php";
    }

?>