<!-- CSS -->

<style type="text/css">
.well:hover {
    box-shadow: 0px 2px 10px rgb(190, 190, 190) !important;
}
a {
    color: #666;
}
</style>

<!-- CSS/ -->

<?php
include "config.php";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
echo "<script>alert('Kembalilah Kejalan yg benar!!!'); window.location = '../../index.php';</script>";
}
    else{

?>

<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM jurusan WHERE kd_jurusan='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE jurusan SET nama_jurusan='$_POST[nama]' WHERE kd_jurusan='$_GET[key]'";
	} else {
		$sql = "INSERT INTO jurusan VALUES ('$_POST[kd]', '$_POST[nama]')";
	}
  if ($connection->query($sql)) {
    echo "<script>alert('Berhasil'); window.location = 'media.php?module=akun'</script>";
  } else {
		echo "<script>alert('Gagal'); window.location = 'media.php?module=akun'</script>";
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM jurusan WHERE kd_jurusan='$_GET[key]'");
	echo "<script>alert('Berhasil'); window.location = 'media.php?module=akun'</script>";
}
?>


<div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">SELAMAT DATANG DI DASHBOARD ADMINISTRATOR</h4>
                
                            </div>

        </div>
	   <div class="row">
                 <div class="col-md-4 col-sm-4 col-xs-12">
 <div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
                        <div class="panel-heading">
                           <?= ($update) ? "EDIT" : "TAMBAH" ?> JURUSAN
                        </div>
                        <div class="panel-body text-center recent-users-sec">
						<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" role="form">
										 <div class="form-group">
                                            <label>Kode </label>
                                            <input class="form-control" placeholder="Masukkan Kode Jurusan"  name="kd" type="text" <?= (!$update) ?: 'value="'.$row["kd_jurusan"].'"' ?>/>
                                        </div>
                                        <div class="form-group">
                                            <label>Jurusan </label>
                                            <input class="form-control" placeholder="Masukkan Jurusan"  name="nama" type="text" <?= (!$update) ?: 'value="'.$row["nama_jurusan"].'"' ?>/>
                                        </div>
                                        
                                      
                                       
                                       <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="?module=akun" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>

                                    </form>
                        </div>
     </div>
             </div>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                           Tabel Jurusan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
											<th>Kode Jurusan</th>
											 <th>Jurusan</th>
											
											 <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM jurusan")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
                                        <tr>
										<td></td>
                                            <td><?=$no++?></td>
											 <td><?=$row['kd_jurusan']?></td>
                                            <td><?=$row['nama_jurusan']?></td>
                                           <td class="hidden-print">
	                                <div class="btn-group">
	                                    <a href="?module=akun&action=update&key=<?=$row['kd_jurusan']?>" class="btn btn-warning btn-xs">Edit</a>
	                                    <a href="?module=akun&action=delete&key=<?=$row['kd_jurusan']?>" class="btn btn-danger btn-xs">Hapus</a>
	                                </div>
	                            </td>
											  
                                           
                                        </tr>
                                         <?php endwhile ?>
	                    <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
             </div>
             
             </div>
 </div>
             
             </div>       

        <?php } ?>