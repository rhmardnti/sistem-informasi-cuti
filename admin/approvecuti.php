 <?php 
 include "session.php";
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <?php include "head.php"; ?>
 <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden" bgcolor="ffffff">
 <?php include "header.php"; ?>
 <div class="app-body">
   <?php include "menu.php"; ?>
   <!-- Main content -->
   <main class="main">
     <!-- Breadcrumb -->
     <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item"><a href="cuti.php">Cuti</a>
      </li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
       <?php
       if(isset($_GET['aksi']) == 'delete'){
        $id = $_GET['id'];
        $cek = mysqli_query($koneksi, "SELECT * FROM cuti WHERE id='$id'");
        if(mysqli_num_rows($cek) == 0){
         echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
       }else{
         $delete = mysqli_query($koneksi, "DELETE FROM cuti WHERE id='$id'");
         if($delete){
          echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
        }else{
          echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
        }
      }
    }
    ?>

    <?php
    if(isset($_GET['true']) == 'true'){
      $id = $_GET['id'];
      $cek = mysqli_query($koneksi, "SELECT * FROM cuti WHERE id='$id'");
      $data = mysqli_fetch_array($cek);
      $no = $data['nik'];
      $moq = $data['jumlah_cuti'];
      $status = "Approved";
      if(mysqli_num_rows($cek) == 0){
       echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
     }else{
       $cuti = mysqli_query($koneksi, "UPDATE cuti SET status='$status' WHERE nik='$no' AND id='$id'");
       if($cuti){
         $approve = mysqli_query($koneksi, "UPDATE karyawan SET sisa_cuti=(sisa_cuti-'$moq') WHERE nik='$no'");
         echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil di Approve.</div>';
       }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
      }
    }
  }

  ?>

  <?php
  if(isset($_GET['false']) == 'false'){
    $id1 = $_GET['id'];
    $cek1 = mysqli_query($koneksi, "SELECT * FROM cuti WHERE id='$id1'");
    $data1 = mysqli_fetch_array($cek1);
    $no1 = $data1['nik'];
    $status1 = "Rejected";
    if(mysqli_num_rows($cek1) == 0){
     echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
   }else{
     $cuti1 = mysqli_query($koneksi, "UPDATE cuti SET status='$status1' WHERE nik='$no1' AND id='$id1'");
     if($cuti1){
       echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil di Reject.</div>';
     }else{
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
    }
  }
}
?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <strong>Data</strong> Cuti
      </div>
      <div class="card-body">	
       <div class="text-left"></div>
       <a href="input-cuti.php" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Input Data</a><br /><br />    
       <div class="table">
        <table id="lookup" class="table table-hover table-responsive table-bordered">    
         <thead bgcolor="white" align="center">
          <tr>
            <th><center>ID</center></th>
            <th><center>NIK</center></th>
            <th><center>Nama</center></th>
            <th width="60px"><center>Tanggal Ajuan</center></th>
            <th width="60px"><center>Mulai Cuti</center></th>
            <th width="60px"><center>Selesai Cuti</center></th>
            <th width="10px"><center>Jumlah Cuti</center></th>
            <th><center>Jenis Cuti</center></th>
            <th width="80px"><center>Keperluan</center></th>
            <th width="80px"><center>Pesan</center></th>
            <th><center>Status</center></th>
            <th class="text-center" width="200px"> Aksi </th> 
          </tr>
        </thead>
        <tbody bgcolor="ffffff">


        </tbody>
      </table>


    </div>

  </div>
</div>


</div>
</section>
</div>
<!-- /.conainer-fluid -->
</main>
</div>

</div>

<?php  include "footer.php"; ?>

<!-- Bootstrap and necessary plugins -->
<script src="../js/jquery.min.js"></script>
<script src="../js/tether.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/pace.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!-- GenesisUI main scripts -->

<script src="../js/app.js"></script>
<script>
  $(document).ready(function() {
    var dataTable = $('#lookup').DataTable( {
     "processing": true,
     "serverSide": true,
     "ajax":{
						url :"ajax-data-cuti2.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
  } );
</script>
</body>

</html>