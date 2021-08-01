<!doctype html>
<html lang="en">        
<header class="app-header navbar">
<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button"><span class="fa fa-bars"></span></button>
<a class="navbar-brand" href="#">APLIKASI CUTI</a>
<button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button"><span class="fa fa-bars"></span></button>
<ul class="nav navbar-nav d-md-down-none">
<li class="nav-item px-3">
</li>	
</ul>
<ul class="nav navbar-nav ml-auto">
<li class="nav-item d-md-down-none">                
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<img src="<?php echo $_SESSION['gambar']; ?>" class="img-avatar">
<span class="d-md-down-none"><?php echo $_SESSION['fullname']; ?></span>
</a>
<?php
$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_SESSION[user_id]'");
$data  = mysqli_fetch_array($query);
?>
<div class="dropdown-menu dropdown-menu-right">
 
<a class="dropdown-item" href="detail-karyawan.php?id=$data['id'];?>"><i class="fa fa-user"></i> Profile</a>
<a class="dropdown-item" href="../logout.php"><i class="fa fa-lock"></i> Logout</a>
</div>
</li>
</ul>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
    </header>