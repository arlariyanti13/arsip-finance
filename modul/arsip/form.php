<?php 
    //panggil function.php untuk upload file
    include "config/function.php";
    
    //cek apakah user sudah login dengan username admin
    if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin"){
        header("Location: admin.php");
    }

//uji jika klik tombol edit / hapus
if(isset($_GET['hal']))
{
    if($_GET['hal'] == "edit")
    {
         //tampilkan data yang akan diedit
    $tampil = mysqli_query($koneksi, "SELECT
                                            tbl_arsip.*,
                                            tbl_departemen.nama_departemen,
                                            tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat.no_telpon
                                        FROM
                                            tbl_arsip, tbl_departemen, tbl_pengirim_surat
                                        WHERE 
                                            tbl_arsip.id_departemen = tbl_departemen.id_departemen
                                        and tbl_arsip.id_pengirim_surat = tbl_pengirim_surat.id_pengirim_surat
                                      and tbl_arsip.id_arsip='$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if($data)
    {
        //jika data ditemukan maka data di tampung ke dalam variabel
        $vno_purchase_order = $data['no_purchase_order'];
        $vno_purchase_request = $data['no_purchase_request'];
        $vnama_vendor = $data['nama_vendor'];
        $vketerangan_pembelian = $data['keterangan_pembelian'];
        $vtanggal_invoice = $data['tanggal_invoice'];
        $vtanggal_dikirim = $data['tanggal_dikirim'];
        $vid_departemen = $data['id_departemen'];
        $vnama_departemen = $data['nama_departemen'];
        $vid_pengirim_surat = $data['id_pengirim_surat'];
        $vnama_pengirim = $data['nama_pengirim'];
        $vfile = $data['file']; 
        $vstatus = $data['status'];
        $vketerangan = $data['keterangan'];
    }
    }
    elseif($_GET['hal'] == 'hapus')
    {
      $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
      if($hapus){
          echo "<script>
          alert('Hapus Data Sukses');
          document.location='?halaman=arsip_surat';
        </script>";
      }
    }
    {
      
    }
   
}

    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
{

    //pengujian apakah data akan diedit / simpan baru
    if(@$_GET['hal'] == "edit"){
        //perintah edit data
        //ubah data

        //cek apakah user pilih file/gambar atau tidak
        if($_FILES['file']['error'] === 4){
          @$file = $vfile;
        }else{
          @$file = upload();
        }
        $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
                                              no_purchase_order = '$_POST[no_purchase_order]',
                                              no_purchase_request = '$_POST[no_purchase_request]',
                                              nama_vendor = '$_POST[nama_vendor]',
                                              keterangan_pembelian = '$_POST[keterangan_pembelian]',
                                              tanggal_invoice = '$_POST[tanggal_invoice]',
                                              tanggal_dikirim = '$_POST[tanggal_dikirim]',
                                              id_departemen = '$_POST[id_departemen]',
                                              id_pengirim_surat = '$_POST[id_pengirim_surat]',
                                              file = '$file',
                                              status = '$_POST[status]',
                                              keterangan = '$_POST[keterangan]'
                                         where id_arsip = '$_GET[id]' ");
        if($ubah)
        {
                echo "<script>
            alert('Ubah Data Sukses');
            document.location='?halaman=arsip_surat';
          </script>";
       }
       
    }
    else
    {
        //perintah simpan data baru
        //simpan data
        $file = upload();
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip VALUES (   '', 
                                                                                    '$_POST[no_purchase_order]',
                                                                                    '$_POST[no_purchase_request]',
                                                                                    '$_POST[nama_vendor]',
                                                                                    '$_POST[keterangan_pembelian]',
                                                                                    '$_POST[tanggal_invoice]',
                                                                                    '$_POST[tanggal_dikirim]',
                                                                                    '$_POST[id_departemen]',
                                                                                    '$_POST[id_pengirim_surat]',
                                                                                    '$file',
                                                                                    '$_POST[status]',
                                                                                    '$_POST[keterangan]'
                                                                                     ) ");
        if($simpan)
    {
          echo "<script>
          alert('Simpan Data Sukses');
          document.location='?halaman=user';
        </script>";
    }
  }
  {
  
  }
      
    
}

?>


<div class="card ">
  <div class="card-header  text-white bg-dark mt-3"> 
    Form Data Arsip Surat
  </div>
  <div class="card-body">
  <form method="post" action="" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="no_purchase_order">No Purchase Order / Memo</label>
    <input type="text" class="form-control" id="no_purchase_order" name="no_purchase_order" value="<?=@$vno_purchase_order?>">
</div>
<div class="form-group">
    <label for="no_purchase_request">No Purchase Request / Memo</label>
    <input type="text" class="form-control" id="no_purchase_request" name="no_purchase_request" value="<?=@$vno_purchase_request?>">
</div>
<div class="form-group">
    <label for="nama_vendor">Nama Vendor  </label>
    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?=@$vnama_vendor?>">
</div>
<div class="form-group">
    <label for="keterangan_pembelian">Keterangan Pembelian  </label>
    <input type="text" class="form-control" id="keterangan_pembelian" name="keterangan_pembelian" value="<?=@$vketerangan_pembelian?>">
</div>
<div class="form-group">
    <label for="tanggal_invoice">Tanggal Invoice</label>
    <input type="date" class="form-control" id="tanggal_invoice" name="tanggal_invoice" value="<?=@$vtanggal_invoice?>">
</div>
<div class="form-group">
    <label for="tanggal_dikirim">Tanggal Dikirim</label>
    <input value="<?= date('Y-m-d')?>" type="date" class="form-control" id="tanggal_dikirim" name="tanggal_dikirim" value="<?=@$vtanggal_dikirim?>"readonly>
</div>
<div class="form-group">
    <label for="id_departemen"> Tujuan</label>
    <select class="form-control" name="id_departemen">
      <option value="<?=@$vid_departemen?>"><?=@$vnama_departemen?></option>
      <?php
        $tampil = mysqli_query($koneksi, "SELECT * from tbl_departemen order by nama_departemen asc");
        while($data = mysqli_fetch_array($tampil)){
          echo "<option value = '$data[id_departemen]'> $data[nama_departemen] </option>  ";
        }
      
      ?>
    </select>
</div>
<div class="form-group">
    <label for="id_pengirim_surat">Pengirim Surat</label>
    <select class="form-control" name="id_pengirim_surat">
      <option value="<?=@$vid_pengirim_surat?>"><?=@$vnama_pengirim?></option>
      <?php
        $tampil = mysqli_query($koneksi, "SELECT * from tbl_pengirim_surat order by nama_pengirim asc");
        while($data = mysqli_fetch_array($tampil)){
          echo "<option value = '$data[id_pengirim_surat]'> $data[nama_pengirim] </option>  ";
        }
      
      ?>
    </select>
</div>
<div class="form-group">
    <label for="file">Pilih File </label>
    <input type="file" class="form-control" id="file" name="file" value="<?=@$vfile?>">
  </div>
  <div class="form-group">
      <label for="status">Status </label readonly>
      <input type="text" class="form-control" id="status" name="status" value="<?=@$vstatus?>" readonly>
</div>
<div class="form-group">
    <label for="keterangan">Keterangan </label readonly>
    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?=@$vketerangan?>"  readonly>
</div>
  <button type="submit" name="bsimpan" class="btn btn-dark">Simpan</button>
  <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
</form>
  </div>
</div>