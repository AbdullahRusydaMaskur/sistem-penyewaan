<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>RentalMobil | Admin Kelola User</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">car owner</h2>
						<div><a href="tambah.php"><li style="width: 51px; height: 20px; right: 21px; top: 3px; position: absolute; background: #64E844;border-radius: 5px;">tambah</a></div>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar User</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Telp</th>
											<th>Alamat</th>
											<th>KTP</th>
											<th>KK</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$no=0;
									$sql = "SELECT * from  users ";
									$query = mysqli_query($koneksidb,$sql);
									while($result=mysqli_fetch_array($query))
									{
										$no++;
									?>	
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo htmlentities($result['nama_user']);?></td>
											<td><?php echo htmlentities($result['email']);?></td>
											<td><?php echo htmlentities($result['telp']);?></td>
											<td><?php echo htmlentities($result['alamat']);?></td>
											<td><a href="../image/id/<?php echo htmlentities($result['ktp']);?>" target="blank"><img src="../image/id/<?php echo htmlentities($result['ktp']);?>" width="40" height="30"></a></td>
											<td><a href="../image/id/<?php echo htmlentities($result['kk']);?>" target="blank"><img src="../image/id/<?php echo htmlentities($result['kk']);?>" width="40" height="30"></a></td>
											<td>
												<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;
												<a href="userdel.php?email=<?php echo $result['email'];?>" onclick="return confirm('Apakah anda yakin akan mereset password untuk email <?php echo $result['email'];?>?');"><i class="fa fa-refresh"></i></a>
												<a href="delete.php?delete=<?php echo $result['delete'];?>" onclick="return confirm('apakah anda yakin menghapus akun? <?php echo $result['delete'];?>?');"><img src="img/Group 112.png" style="width: 20px; height: 20px; top: 0px; position: relative; left: 5px;">
											</td>
										</tr>
										<?php } ?>
										
									</tbody>
								</table>
	<!-- Large modal -->
	<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<p>One fine body…</p>
				</div>
			</div>
		</div>
	</div>    
	<!-- Large modal --> 

						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
    <script>
		var app = {
			code: '0'
		};
		$('[data-load-code]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-code');
					if(code) {
						$($this.data('remote-target')).load('userview.php?code='+code);
						app.code = code;
						
					}
		});
    </script>

</body>
</html>
<?php } ?>
