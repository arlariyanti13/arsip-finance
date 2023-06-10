<?php
 //cek apakah user sudah login dengan username admin
 if(!isset($_SESSION['username']) || $_SESSION['username'] != "salim"){
     header("Location: admin.php");
 }

?>



<div class="container-fluid">
<div class="card-header  text-white bg-dark mt-3"> 
     Data Arsip Surat
  </div>
  <div class="card-body">
  <table class="container-fluid table table-borderd table-hovered table-striped">
          <tr>
        <th>No</th>
        <th>No Purchase Order / Memo</th>
        <th>No Purchase Request / Memo</th>
        <th>Nama Vendor </th>
        <th>Keterangan Pembelian</th>
        <th>Tanggal Invoice</th>
        <th>Tanggal Dikirim</th>
        <th>Tujuan</th>
        <th>Pengirim</th>
        <th>File</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
    <?php
        $tampil = mysqli_query($koneksi, "
                  SELECT
                    tbl_arsip.*,
                    tbl_departemen.nama_departemen,
                    tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat.no_telpon
                  FROM
                    tbl_arsip, tbl_departemen, tbl_pengirim_surat
                  WHERE 
                    tbl_arsip.id_departemen = tbl_departemen.id_departemen
                  and tbl_arsip.id_pengirim_surat = tbl_pengirim_surat.id_pengirim_surat
                  ");
        $no = 1;
        while($data = mysqli_fetch_array($tampil)) :
        
    ?>
    <tr>
        <td><?=$no++?></td>
        <td><?=$data['no_purchase_order']?></td>
        <td><?=$data['no_purchase_request']?></td>
        <td><?=$data['nama_vendor']?></td>
        <td><?=$data['keterangan_pembelian']?></td>
        <td><?=$data['tanggal_invoice']?></td>
        <td><?=$data['tanggal_dikirim']?></td>
        <td><?=$data['nama_departemen']?></td>
        <td><?=$data['nama_pengirim']?></td>
        <td>
        <?php
                //uji apakah file nya ada atau tidak ada
                if(empty($data['file'])){
                    echo " - ";
                }else
            ?>
                <a href="file/<?=$data['file']?>" target="$_blank">lihat file</a>
            
            <td style="<?=$data['status'] == 'Rejected' ?  'color : red' : 'color : green'?>">
            <b><?=$data['status']?></b>
              </td>
            <td><?=$data['keterangan']?></td>
        <td>
            <a href="?halaman=user&hal=edit&id=<?=$data['id_arsip']?>" class="btn btn-success">Edit </a>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
  </div>
</div>