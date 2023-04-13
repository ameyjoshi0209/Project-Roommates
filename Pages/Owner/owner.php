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
						<img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" width="40" height="40" class="rounded-circle">
					</button>
					<ul class="dropdown-menu">
						<h3 class="dropdown-header"><?php echo $_SESSION["oname"] ?></h3>
						<li><a class="dropdown-item" href="../Owner/owner_logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<!--<div class="container-fluid">
			<div class="row h-100">
				<div class="col-2 bg-warning text-white text-center">
					<a href="owner-add.html"><button class="btn mt-3" id="owner-btn">
							Add</button></a><br>

				</div>
			</div>-->
		<div class="container-fluid">
			<div class="row mt-3 g-3">
				<?php
				$dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
				$records = pg_query($dbconn, "select * from property where username='{$_SESSION['oname']}'");
				while ($data = pg_fetch_array($records)) {
					if ($data['status'] == 'pending') { ?>
						<div class="col-sm-4" style="background: black;padding: 0;border-radius: 2rem;">
							<div class="card" style="opacity: 0.4;height: 14em;">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $data['name']; ?></h5>
									<i>Address:<?php echo $data['p_addr']; ?></i><br>
									<b>Rent:<?php echo $data['p_rent']; ?>
										<p class="card-text">Type:<?php echo $data['p_bhk']; ?><br>Furnished:<?php echo $data['p_furnish']; ?><br>Address:<?php echo $data['p_addr']; ?></p>
									</b>
								</div>
							</div>
						</div>
					<?php
					} elseif ($data['status'] == 'accept') { ?>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $data['name']; ?></h5>
									<i>Address:<?php echo $data['p_addr']; ?></i><br>
									<b>Rent:<?php echo $data['p_rent']; ?>
										<p class="card-text">Type:<?php echo $data['p_bhk']; ?><br>Furnished:<?php echo $data['p_furnish']; ?><br>Address:<?php echo $data['p_addr']; ?></p>
									</b>
									<a href="../Owner/update.php?id=<?php echo $data['p_id']; ?>"><button class="btn mt-3 edit-btn">
											<img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
									<a href="../Owner/delete.php?id=<?php echo $data['p_id']; ?>"><button class="btn mt-3 edit-btn">
											<img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
								</div>
							</div>
						</div>
				<?php }
				} ?>
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