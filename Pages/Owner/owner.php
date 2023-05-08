<?php session_start();
if (!empty($_SESSION["oname"])) { ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Owner Side</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="../../Styles/owner.css" />
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-1 pb-1">
			<a class="navbar-brand text-primary" href="../Owner/owner.php" style="margin-left: 20px;">ROOMMATES</a>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a href="../Owner/owner-add.php"><button class="btn mt-1" id="owner-btn" style="margin-left: 25px; width:auto">
							Add Property</button></a>
				</div>
			</div>
			<div class="align">
				<div class="btn-group dropstart">
					<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
						<img src="<?php echo $_SESSION["oimage"]; ?>" width="43" height="43" class="rounded-circle">
					</button>
					<ul class="dropdown-menu">
						<h3 class="dropdown-header"><?php echo $_SESSION["oname"] ?></h3>
						<li><a class="dropdown-item" href="../Owner/owner_profile.php"><img src="../../Img/Admin-Home/profile.svg" height="20" width="25" style="margin-right: 4px;"> My Profile</a></li>
						<li><a class=" dropdown-item" href="../Owner/owner_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="18" width="22" style="margin-right: 8px;"> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- 
			<div class="container-fluid">
			<div class="row h-100">
				<div class="col-2 bg-warning text-white text-center">
					<a href="owner-add.html"><button class="btn mt-3" id="owner-btn">
							Add</button></a><br>
				</div>
			</div>
		-->

		<div class="container-fluid">
			<h1 class="mt-4 mb-5 d-flex justify-content-center">Uploded Properties</h1>
			<div class="row mt-3 g-3 mb-4">
				<?php
				$dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
				$records = pg_query($dbconn, "select * from property where username='{$_SESSION['oname']}'");
				while ($data = pg_fetch_array($records)) {
					if ($data['status'] == 'pending') { ?>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $data['p_name']; ?></h5>
									<h6><?php echo $data['p_id']; ?></h6>
									<i>Deposit: <?php echo $data['p_deposit']; ?></i><br>
									<b>Rent: <?php echo $data['p_rent']; ?>
										<p class="card-text">Type: <?php echo $data['p_bhk']; ?><br>Furnished: <?php echo $data['p_furnish']; ?><br>Address:<?php echo $data['p_addr']; ?></p>
									</b>
								</div>
							</div>
						</div>
						<?php
					} elseif ($data['status'] == 'accepted') {
						if (empty($data['t_name'])) { ?>
							<div class="col-sm-4">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">
											<?php echo $data['p_name']; ?></h5>
										<h6><?php echo $data['p_id']; ?></h6>
										<b>Address: <?php echo $data['p_addr']; ?></b><br>
										<b>Rent: <?php echo $data['p_rent']; ?>
											<p class="card-text">Type: <?php echo $data['p_bhk']; ?><br>Furnished: <?php echo $data['p_furnish']; ?></p>
										</b>
										<a href="../Owner/update.php?id=<?php echo $data['p_id']; ?>"><button class="btn mt-3 edit-btn">
												<img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
										<a href="../Admin/admin_action.php?pid=<?php echo $data['p_id']; ?>&resp=7"><button class="btn mt-3 edit-btn">
												<img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
										<a href="../Owner/owner_prop_detail.php?pid=<?php echo $data["p_id"] ?>"><button class=" btn mt-3 edit-btn">
												<img src="../../Img/Admin-Home/details.svg" height="20" width="30">Details</button></a>
									</div>
								</div>
							</div>
						<?php
						} else { ?>
							<div class="col-sm-4">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">
											<?php echo $data['p_name']; ?><i style="font-size: 14px;color: peru;"> (RENTED)</i>
										</h5>
										<h6><?php echo $data['p_id']; ?></h6>
										<b>Address: <?php echo $data['p_addr']; ?></b><br>
										<b>Rent: <?php echo $data['p_rent']; ?>
											<p class="card-text">Type: <?php echo $data['p_bhk']; ?><br>Furnished: <?php echo $data['p_furnish']; ?></p>
										</b>
										<a href="../Owner/update.php?id=<?php echo $data['p_id']; ?>"><button class="btn mt-3 edit-btn">
												<img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
										<a href="../Admin/admin_action.php?pid=<?php echo $data['p_id']; ?>&resp=7"><button class="btn mt-3 edit-btn">
												<img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
										<a href="../Owner/owner_prop_detail.php?pid=<?php echo $data["p_id"] ?>"><button class=" btn mt-3 edit-btn">
												<img src="../../Img/Admin-Home/details.svg" height="20" width="30">Details</button></a>
									</div>
								</div>
							</div>
				<?php
						}
					}
				}
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	</body>

	</html>
<?php } else {
	echo "<script>window.location.href='../Owner/owner_login.php';</script>";
} ?>