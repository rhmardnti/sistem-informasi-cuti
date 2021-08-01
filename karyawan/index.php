      <!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <?php 
 session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
     } ?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   
   <?php include "header.php"; ?>

    <div class="app-body">
   <?php include "menu.php"; ?>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Dashboard</li>

                <!---Breadcrumb Menu-->
               <li class="breadcrumb-menu d-md-down-none">
                    <div class="btn-group" role="group" aria-label="Button group">
                       
                       
                    </div>
                </li>
            </ol>


            <div class="container-fluid">





                <div class="animated fadeIn">
                    <div class="row">
					<div class="col-6 col-lg-3">
							<div class="card">
							<?php
							$query2 = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
							$data2  = mysqli_fetch_array($query2);
							?>
								<div class="card-body p-3 clearfix">
                                    <i class="fa fa-book bg-info p-3 font-2xl mr-3 float-left"></i>
								     <div class="h5 text-info mb-0 mt-2"><?php echo $data2['hak_cuti'] ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Total Hak Cuti</div>
                                </div>
								<div class="card-footer px-3 py-2">
                                   
                                </div>
							</div>
						</div>				 
                        <!--/.col-->
						<div class="col-6 col-lg-3">
							<div class="card">
							<?php
							$query4 = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
							$data4  = mysqli_fetch_array($query4);
							?>
								<div class="card-body p-3 clearfix">
                                    <i class="fa fa-book bg-info p-3 font-2xl mr-3 float-left"></i>
								     <div class="h5 text-info mb-0 mt-2"><?php echo $data4['sisa_cuti'] ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Total Sisa Cuti</div>
                                </div>
								<div class="card-footer px-3 py-2">
                                   
                                </div>
							</div>
						</div>				 
                        <!--/.col-->
                        <div class="col-6 col-lg-3">
                            <div class="card">
					
                            <?php 
							$tampil = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
							$r = mysqli_fetch_array($tampil);
							$hak_cuti = $r['hak_cuti'];
							$sisa_cuti = $r['sisa_cuti'];
							$total = $hak_cuti-$sisa_cuti
							?>
							
                                <div class="card-body p-3 clearfix">
                                    <i class="fa fa-book bg-primary p-3 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-primary mb-0 mt-2"><?php echo $total ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Cuti yang Digunakan</div>
                                </div>
								
							
                                <div class="card-footer px-3 py-2">
                                    <a class="font-weight-bold font-xs btn-block text-muted" href="cuti.php">Detail Cuti <i class="fa fa-angle-right float-right font-lg"></i></a>
                                </div>
                            </div>
                        </div>
						
                        <!--/.col-->
						<div class="col-6 col-lg-3">
                            <div class="card">
							<?php
							$query5 = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
							$data5  = mysqli_fetch_array($query5);
							?>
							
                                <div class="card-body p-3 clearfix">
                                    <i class="fa fa-user bg-primary p-3 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-primary mb-0 mt-2"><?php echo $_SESSION['fullname'] ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs"> Jabatan : <?php echo $data5['jabatan']; ?></div>
                                </div>
                                <div class="card-footer px-3 py-2">
                                    <a class="font-weight-bold font-xs btn-block text-muted" href="detail-karyawan.php">Detail Karyawan<i class="fa fa-angle-right float-right font-lg"></i></a>
                                </div>
                            </div>
                        </div>
						<!--/.col-->


                        <div class="col-6 col-lg-3">
                            <div class="card">
                             <?php $tampil1=mysqli_query($koneksi, "select * from cuti where status='Approved' and nik='$_SESSION[user_id]'");
                        $total1=mysqli_num_rows($tampil1);
                    ?>
                                <div class="card-body p-3 clearfix">
                                    <i class="fa fa-calendar-check-o bg-success p-3 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-success mb-0 mt-2"><?php echo $total1; ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Approved</div>
                                </div>
                                <div class="card-footer px-3 py-2">
                                    <a class="font-weight-bold font-xs btn-block text-muted" href="approvecuti.php">Detail Approved <i class="fa fa-angle-right float-right font-lg"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
						<div class="col-6 col-lg-3">
                            <div class="card">
                            <?php $tampil2=mysqli_query($koneksi, "select * from cuti where status='On-Process' and nik='$_SESSION[user_id]'");
                        $total2=mysqli_num_rows($tampil2);
                    ?>
                                <div class="card-body p-3 clearfix">
                                    <i class="fa fa-calendar-minus-o bg-warning p-3 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-warning mb-0 mt-2"><?php echo $total2 ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">On-Process</div>
                                </div>
                                <div class="card-footer px-3 py-2">
                                    <a class="font-weight-bold font-xs btn-block text-muted" href="prosescuti.php">Detail On-Process <i class="fa fa-angle-right float-right font-lg"></i></a>
                                </div>
                            </div>
                        </div>
						<!--/.col-->
                        <div class="col-6 col-lg-3">
                            <div class="card">
                            <?php $tampil2=mysqli_query($koneksi, "select * from cuti where status='Rejected' and nik='$_SESSION[user_id]'");
                        $total2=mysqli_num_rows($tampil2);
                    ?>
                                <div class="card-body p-3 clearfix">
                                    <i class="fa fa-calendar-minus-o bg-danger p-3 font-2xl mr-3 float-left"></i>
                                    <div class="h5 text-danger mb-0 mt-2"><?php echo $total2 ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs">Rejected</div>
                                </div>
                                <div class="card-footer px-3 py-2">
                                    <a class="font-weight-bold font-xs btn-block text-muted" href="rejectedcuti.php">Detail Rejected<i class="fa fa-angle-right float-right font-lg"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                       
						
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>History</strong> Cuti
                                </div>
                                <div class="card-body">
                                                        <?php
                    $query1="select * from cuti where nik='$_SESSION[user_id]'";

                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No </center></th>
                        <th><center>Mulai Cuti </center></th>
                        <th><center>Selesai Cuti</center></th>
                        <th><center>Jumlah </center></th>
                        <th><center>Jenis Cuti </center></th>
                        <th><center>Status</center></th>
                      </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>
                    <tbody>
                    <tr>
                    <td><center><?php echo $no; ?></center></td>
                    <td><center><?php echo $data['tanggal_mulai_cuti'];?></center></td>
                    <td><center><?php echo $data['tanggal_selesai_cuti'];?></center></td>
                    <td><center><?php echo $data['jumlah_cuti'] ?></center></td>
                    <td><center><?php echo $data['jenis_cuti'] ?></center></td>
                    <td><center>
                    <?php 
                            if($data['status'] == 'Approved'){
								echo '<span class="badge badge-success">APPROVED</span>';
							}
                            else if ($data['status'] == 'Rejected' ){
								echo '<span class="badge badge-danger">REJECTED</span>';
							}
                            else if ($data['status'] == 'On-Process' ){
								echo '<span class="badge badge-info">PROCESS</span>';
							}
                             ?>
                    </center></td>
                       <?php   
              } 
              ?>
                   </tbody>
                   </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Biodata</strong> Karyawan
                                </div>
                                <div class="card-body">
                                 <?php
            $query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
            $data  = mysqli_fetch_array($query);
            ?>
                   <table id="example" class="table table-hover table-bordered">
                      <tr>
                      <td>ID</td>
                      <td><?php echo $data['id']; ?></td>
                      </tr>
                      <tr>
                      <td>NIK</td>
                      <td><?php echo $data['nik']; ?></td>
                      </tr>
                      <tr>
                      <td>Awal Masuk Kerja</td>
                      <td><?php echo $data['masuk_kerja']; ?></td>
                      </tr>
                      <tr>
                      <td>Nama</td>
                      <td><?php echo $data['nama']; ?></td>
                      </tr>
                      <tr>
                      <td>Jabatan</td>
                      <td><?php echo $data['jabatan']; ?></td>
                      </tr>
                      <tr>
                      <td>Departemen</td></td>
                      <td><?php echo $data['departemen']; ?></td>
                      </tr>
                      
                      </table>   
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    </div>

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


    <!-- GenesisUI main scripts -->

    <script src="../js/app.js"></script>





    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
  <script src="../amcharts/amcharts.js"></script>
  <script src="../amcharts/serial.js"></script>
  <script src="../amcharts/dataloader.min.js"></script>
        <script>
  var chart = AmCharts.makeChart( "chartdiv", {
    "type": "serial",
    "dataLoader": {
      "url": "data.php"
    },
    "pathToImages": "http://www.amcharts.com/lib/images/",
    "categoryField": "category",
    "dataDateFormat": "YYYY-MM-DD",
    "startDuration": 1,
    "categoryAxis": {
      "parseDates": true
    },
    "graphs": [ {
      "valueField": "value1",
      "bullet": "round",
      "bulletBorderColor": "#FFFFFF",
      "bulletBorderThickness": 2,
      "lineThickness ": 2,
      "lineAlpha": 0.5
    }, {
      "valueField": "value2",
      "bullet": "round",
      "bulletBorderColor": "#FFFFFF",
      "bulletBorderThickness": 2,
      "lineThickness ": 2,
      "lineAlpha": 0.5
    } ]
  } );
  </script>

</body>

</html>