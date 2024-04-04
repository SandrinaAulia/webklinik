<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Check Patient Appointment</title>
</head>
<body>

<?php 
	include("../include/header.php");
	include("../include/connection.php");
 ?>

<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2" style="margin-left: -30px;">
			<?php include("sidenav.php"); ?>	
			</div>
			<div class="col-md-10">
				<h5 class="text-center">Total Janji Temu </h5>
				<?php 
					if (isset($_GET['id'])) {
						$id = $_GET['id'];

						$query = "SELECT * FROM appointment WHERE id='$id'";
						$res = mysqli_query($connect,$query);
						$row = mysqli_fetch_array($res);
					}

				 ?>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tr>
									<td colspan="2" class="text-center">Detail Janji Temu</td>
								</tr>
								<tr>
									<td>Nama Depan</td>
									<td><?php echo $row['firstname']; ?></td>
								</tr>
								<tr>
									<td>Nama Belakang</td>
									<td><?php echo $row['surname']; ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td><?php echo $row['gender']; ?></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td><?php echo $row['phone']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Janji Temu</td>
									<td><?php echo $row['appointment_date']; ?></td>
								</tr>
								<tr>
									<td>Gejala</td>
									<td><?php echo $row['symptoms']; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<h5 class="text-center">Invoice</h5>
							<?php 
								if (isset($_POST['send'])) {
									
									$fee = $_POST['fee'];
									$des = $_POST['des'];

									if (empty($fee)) {
										
									}else if(empty($des)){

									}else{

										$doc = $_SESSION['doctor'];
										$fname = $row['firstname'];

										$query = "INSERT INTO income(doctor,patient,date_discharge,amount_paid,description) VALUES('$doc','$fname',NOW(),'$fee','$des')";

										$res = mysqli_query($connect,$query);

										if($res){
											echo "<script>alert('You have sent Invoice')</script>";
											mysqli_query($connect,"UPDATE appointment SET status='Discharge' WHERE id='$id'");
										}
									}
								}

							 ?>
							<form method="post">
								<label>Fee</label>
								<input type="number" name="fee" class="form-control" autocomplete="off" placeholder="Masukkan Fee Untuk Pasien">
								<label>Deskripsi</label>
								<input type="text" name="des" class="form-control" autocomplete="off" placeholder="Masukkan Deskripsi Untuk Pasien">
								<input type="submit" name="send" class="btn btn-info my-2" value="Send">
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


</body>
</html>