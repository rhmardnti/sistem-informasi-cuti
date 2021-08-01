<?php
 
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
 
//Menggabungkan dengan file koneksi yang telah kita buat
include 'koneksi.php';
 
$nama_dokumen='Data Cuti';
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Cuti Karyawan | PT. Cahaya Fajar Kaltim</title>
    <style>
        *
        {
            margin:0;
            padding:0;
            font-family: calibri;
            font-size:10pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family: calibri;
            font-size:8pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
            margin-left: 200px;
        }
         
        #wrapper
        {
            width:200mm;
            margin:0 5mm;
        }
         
        .page
        {
            height:297mm;
            width:210mm;
            page-break-after:always;
        }
 
        table
        {
            border-left: 1px solid #fff;
            border-top: 1px solid #fff;
            font-family: calibri; 
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
            border-right: 1px solid #fff;
            border-bottom: 1px solid #fff;
            padding: 2mm;
            
        }
         
        table.heading
        {
            height:50mm;
        }
         
        h1.heading
        {
            font-size:10pt;
            color:#000;
            font-weight:normal;
            font-style: italic;
        }
         
        h2.heading
        {
            font-size:10pt;
            color:#000;
            font-weight:normal;
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body
        {
            height: auto;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:5mm;
        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:8pt;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            padding:2mm 0;
        }
         
        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            text-align:left;
            padding-right:3mm;
            font-size:8pt;
        }
         
        #footer
        {   
            width:200mm;
            margin:0 5mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <?php
     include "session.php";
     ?>
   
    <table class="heading" style="width:100%;">
        <tr>
        <td> <center><p style="text-align:center; font-size: 18px; font-weight:bold;">DATA CUTI KARYAWAN</p></center></td>
        </tr>
        <tr>
        <td> <center><p style="text-align:center; font-size: 14px; font-weight:bold;">Informasi Cuti Karyawan</p></center></td>
        </tr>
    </table><br />
		
		 <table>
         <tr>
        <td><td><p style="text-align:left; font-size: 12px; font-weight:bold;">Tanggal : <?php $timezone = time() + (60 * 60 * 8);
         echo gmdate('Y/m/d H:i:s', $timezone); ?> </p></td></td>
        </tr>
         </table>
         
    <div id="content">
         
        <div id="invoice_body">
        <?php
            $kd = $_GET['kd'];
            $kode = $_GET['kode'];
            $query1="SELECT * FROM  cuti 
	               where (tanggal_mulai_cuti between '$kd'
	               and '$kode')";
        
            $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
            ?>
            <table border="1">
            
            <tr>
                <td style="width:5%;"><b>No</b></td>
                <td style="width:10%;"><b>NIK</b></td>
                <td style="width:25%;"><b>Nama</b></td>
                <td style="width:15%;"><b>Tanggal Mulai Cuti</b></td>
                <td style="width:15%;"><b>Tanggal Selesai Cuti</b></td>
				<td style="width:15%;"><b>Jumlah Cuti</b></td>
				<td style="width:15%;"><b>Jenis Cuti</b></td>
				<td style="width:15%;"><b>Keperluan</b></td>
                <td style="width:10%;"><b>Status</b></td>
            </tr>
            <?php
            $no=0;
                     while($data1=mysqli_fetch_array($tampil))
                    { $no++; ?>
            <tr>
                <td style="width:5%;" class="mono"><b><center><?php echo $no; ?></center></b></td>
                <td style="width:10%;" class="mono"><b><center><?php echo $data1['nik']; ?></center></b></td>
                <td style="width:25%;" class="mono"><b><center><?php echo $data1['nama']; ?></center></b></td>
                <td style="width:15%;" class="mono"><b><center><?php echo $data1['tanggal_mulai_cuti']; ?></center></b></td>
                <td style="width:15%;" class="mono"><b><center><?php echo $data1['tanggal_selesai_cuti']; ?></center></b></td>
				<td style="width:15%;" class="mono"><b><center><?php echo $data1['jumlah_cuti']; ?></center></b></td>
				<td style="width:25%;" class="mono"><b><center><?php echo $data1['jenis_cuti']; ?></center></b></td>
				<td style="width:25%;" class="mono"><b><center><?php echo $data1['keperluan']; ?></center></b></td>
				<td style="width:10%;" class="mono"><b><center><?php echo $data1['status']; ?></center></b></td>
            </tr>         
             <?php   
              } 
              ?>
        </table>
        </div>
        
    </div>
    <br />
    </div>
     
    
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
 
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
$db1->close();
?>