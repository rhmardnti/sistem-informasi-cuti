<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <?php 
 include "session.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   
   <?php include "header.php"; ?>

    <div class="app-body">
   <?php include "menu.php"; ?>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="laporan-cuti.php">Laporan Cuti</a>
                </li>
            </ol>


            <div class="container-fluid">

                <div class="animated fadeIn">
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
                                    <strong>Input</strong> Karyawan
                                </div>
                                <div class="card-body">
                                <div class="col-lg-12">
              <form action='approvecuti.php' method="POST">
              <div class="form-group row">
              <div class="col-md-2">
              <label>Nama Karyawan :</label>
              </div>
                <div class="col-md-4">
                    <div class="input-group">
            <select name="nama" id="nama" class="form-control select2" required>
                              <option value=""> -- Pilih Nama Karyawan -- </option>
                              <?php 
                    $query1="select * from karyawan order by nik ";
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    while($data=mysqli_fetch_array($tampil))
                    {
                    ?>
                              
                                  
							
							<option value="<?php echo $data['nik'];?>"> <?php echo $data['nama'];?></option>
						    <?php } ?>
                              
                              </select>
                    </div>
                 </div>
               </div>
          <div class="form-group row">
              <div class="col-md-2">
              <label>Dari Tanggal:</label>
              </div>
                <div class="col-md-4">
                    <div class="input-group">
           <input type='text'  class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" autocomplete="off" style="margin-bottom: 4px;" name='tglawal' placeholder='Cari dari tanggal' required />
           
                  </div>
                </div>
          </div>
            <div class="form-group row">
              <div class="col-md-2">
              <label>Sampai Tanggal:</label>
              </div>
                <div class="col-md-4">
                    <div class="input-group">
           <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" autocomplete="off" style="margin-bottom: 4px;" name='tglakhir' placeholder='Sampai Tanggal' required /> </div>
           
                  </div>
                </div>
          </div>
          <div class="col-lg-3">
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='approvecuti.php' class="btn btn-sm btn-success" > Refresh</a>
          </div>
          </div>
           </form>
          	</div>
                 <div class="print-area table-responsif" id="print-area-2">
                
                    <?php
                    $query1="select * from cuti ";
                    
                   if(isset($_POST['tglawal']) && isset($_POST['tglakhir']) && isset($_POST['nama'])){
	               $tglawal=$_POST['tglawal'];
                   $tglakhir=$_POST['tglakhir'];
                   $nama= $_POST['nama'];
	               $query1="SELECT * FROM  cuti 
	               where (tanggal_mulai_cuti between '$tglawal'
	               and '$tglakhir') and nik='$nama'";
                  
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table style="margin-top: 20px;" id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                      <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
						<th>Tanggal Ajuan</th>
                        <th>Tanggal Mulai Cuti</th>
                        <th>Tanggal Selesai Cuti</th>
                        <th>Jumlah Cuti</th>
                        <th>Jenis Cuti</th>
                        <th>Keperluan</th>
                        <th>Aksi</th>
                        
                      </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++;
                     ?>
                    <tbody>
                    <tr>
                    <td><center><?php echo $no; ?></center></td>
                    <td><?php echo $data['nik']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['tanggal_ajuan']; ?></td>
					<td><?php echo $data['tanggal_mulai_cuti']; ?></td>
                    <td><?php echo $data['tanggal_selesai_cuti']; ?></td>
                    <td><?php echo $data['jumlah_cuti']; ?></td>
                    <td><?php echo $data['jenis_cuti']; ?></td>
                    <td><?php echo $data['keperluan']; ?></td>
                    <td><center><a href="approvecuti.php?true=true&id='.$row['id'].'"  data-toggle="tooltip" title="Approve Cuti" onclick="return confirm(\'Anda yakin approve cuti '.$row['nama'].'?\')" class="btn btn-sm btn-info"> <i class="fa fa-check"> </i></a>
	                 <a href="approvecuti.php?false=false&id='.$row['id'].'"  data-toggle="tooltip" title="Reject Cuti" onclick="return confirm(\'Anda yakin reject cuti '.$row['nama'].'?\')" class="btn btn-sm btn-warning"> <i class="fa fa-close"> </i> </a></center></td>;</tr>
                     
                 
                 <?php   
              } 
              ?>
                   </tbody>
                   </table>
  </div>
   <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
   
    <div class="text-right">
                  <a href="approvecuti.php?kd=<?php echo $_POST['tglawal'];?>&&kode=<?php echo $_POST['tglakhir'];?>&&nama=<?php echo $_POST['nama'];?>" target="_blank" class="btn btn-sm btn-info">Export PDF  <i class="fa fa-download"></i></a>
                 
                </div> <?php  } else { echo "";} ?><br />
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
     <script src="../datepicker/bootstrap-datepicker.js"></script>
     <script src="../select2/select2.full.min.js"></script>
    <script>
     $(function () {
    $(".select2").select2();
    });
    </script>


    <!-- GenesisUI main scripts -->

    <script src="../js/app.js"></script>
    
    
         <script>
        function printDiv(elementId) {
    var a = document.getElementById('print-area-2').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
        </script>

<script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
    </script>



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