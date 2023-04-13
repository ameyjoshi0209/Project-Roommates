<?php session_start();

if (!empty($_SESSION["aname"])) {
    $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
?>
    <html>

    <head>
        <title>User Deatils Side</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/tenant_profile.css" />
    </head>

    <body>
        <div class="sem-bag">
            <div class="container-fluid position-absolute" id="nav-contain">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark pb-2 pt-2" style="border-radius: 20px;">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand text-primary" href="../../Pages/Admin/admin_home.php">ROOMMATES</a>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        </div>
                    </div>
                    <div class="btn-group dropstart">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="top: 6px;right: 5px;border: none;">
                            <img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" class="rounded-circle nav-prof">
                        </button>
                        <ul class="dropdown-menu">
                            <h6 class="dropdown-header"><?php echo $_SESSION["aname"] ?></h6>
                            <li><a class="dropdown-item" href="../Tenant/admin_logout.php">Logout</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <?php
        $username = $_GET['username'];
        $records = pg_query($dbconn, "select * from owner_login where username='$username'");
        $data = pg_fetch_assoc($records);
        ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="rounded-circle mt-5" width="250px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">
                        <h4><?php echo $data["name"] ?></h4>
                    </span>
                    <span class="text-black-50">
                        <h6><?php echo $data["email"] ?></h6>
                    </span>
                </div>
            </div>
            <div class="row d-flex flex-column align-items-center">
                <div class="col-md-8 mt-4">
                    <div class="p-3 py-5">
                        <div class="d-flex" style="justify-content: center;margin-bottom: 25px;">
                            <h4>Profile Details</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" value="<?php echo $data["name"] ?>" readonly></div>
                            <div class="col-md-12"><label class="labels">Username</label><input type="text" class="form-control" value="<?php echo $data["username"] ?>" readonly></div>
                            <!--<div class="col-md-12"><label class="labels">Previous Password</label><input type="password" class="form-control" value=""></div>
                            <div class="col-md-12"><label class="labels">New Password</label><input type="password" class="form-control" value=""></div>
                            <div class="col-md-12"><label class="labels">Confirm New Password</label><input type="password" class="form-control" value=""></div>-->

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label><input type="tel" class="form-control" value="<?php echo $data["ph_no"] ?>" readonly></div>
                            <div class="col-md-12"><label class="labels">Date of Birth</label><input type="date" class="form-control" value="<?php echo $data["dob"] ?>" readonly></div>
                            <div class="col-md-12"><label class="labels">Gender</label><input type="text" class="form-control" value="<?php echo $data["gender"] ?>" readonly></div>
                        </div>
                        <?php
                        if ($_GET['role'] == 'owner') { ?>
                            <div class="mt-5 text-center">
                                <a href="../Admin/admin_add_prop.php?name=<?php echo $data["username"] ?>&resp=0"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                <a href="../Admin/admin_add_prop.php?name=<?php echo $data["username"] ?>&resp=1"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                <a href="../Admin/admin_home.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Back</button></a>
                                <div class="mt-2 text-center">
                                </div>
                            </div>
                        <?php
                        } else { ?>
                            <div class="mt-5 text-center">
                                <a href="../Admin/admin_add_prop.php?name=<?php echo $data["username"] ?>&resp=3"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                <a href="../Admin/admin_add_prop.php?name=<?php echo $data["username"] ?>&resp=4"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                <a href="../Admin/admin_home.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Back</button></a>
                                <div class="mt-2 text-center">
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Tenant/admin_login.php';</script>";
} ?>