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
                <li class="breadcrumb-item"><a href="cuti.php">Cuti</a>
                </li>
            </ol>


            <div class="container-fluid">
                <div class="animated fadeIn">
            
                <div class="row">
                    
              <div class="col-lg-4">
              <form action='cuti.php' method="POST">
          
	       <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan Tanggal' required /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='cuti.php' class="btn btn-sm btn-success" >Refresh</i></a>
          	</div>
              </div>
                <br />
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Data</strong> Cuti
                                </div>
                                <div class="card-body">
                   <div class="text-left">
                  <a href="input-cuti.php" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Input Data </a><br /><br />
              
                </div>             
                                      <?php
                    $query1="select * from cuti where nik='$_SESSION[user_id]'";
                    
                    if(isset($_POST['qcari'])){
	               $qcari=$_POST['qcari'];
	               $query1="SELECT * FROM cuti 
				   where nik='$_SESSION[user_id]'
	               and tanggal_ajuan like '%$qcari%'";
                    }
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No </center></th>
                        <th><center>Tanggal Ajuan</center></th>
						<th><center>Tanggal Mulai Cuti</center></th>
						<th><center>Tanggal Selesai Cuti</center></th>
						<th width="10px"><center>Jumlah Cuti</center></th>
						<th><center>Jenis Cuti</center></th>
						<th><center>Keperluan</center></th>
						<th><center>Pesan</center></th>
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
                    <td><center><?php echo $data['tanggal_ajuan'];?></center></td>
                    <td><center><?php echo $data['tanggal_mulai_cuti'];?></center></td>
                    <td><center><?php echo $data['tanggal_selesai_cuti'];?></center></td>
                    <td><center><?php echo $data['jumlah_cuti'] ?></center></td>
                    <td><center><?php echo $data['jenis_cuti'] ?></center></td>
                    <td><center><?php echo $data['keperluan'] ?></center></td>
                    <td><center><?php echo $data['pesan'] ?></center></td>
                    <td><center><?php echo $data['status'] ?></center></td>
					<?php   
              } 
              ?>
                   </tbody>
                   </table>
                  <!-- </div>-->
                                    
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