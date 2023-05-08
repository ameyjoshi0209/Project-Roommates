<?php session_start();
if (!empty($_SESSION["aname"])) { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Owner Side</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/admin_home.css" />
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-1 pb-1">
            <a class="navbar-brand text-primary" href="../Admin/admin_home.php" style="margin-left: 20px;">ROOMMATES</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a id="owner-btn" class="nav-item nav-link" type="button" href="../Admin/admin_property.php">Manage Property</a>
                </div>
            </div>
            <a href="../Admin/dash.php"><button class="btn btn-warning">info</button></a>
            <div class="align">
                <div class="btn-group dropstart">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
                        <img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" width="40" height="40" class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu">
                        <h6 class="dropdown-header"><?php echo $_SESSION["aname"] ?></h6>
                        <li><a class="dropdown-item" href="../Admin/admin_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="17" width="25"> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <h1 style="display: flex;justify-content: center;font-family: Google Sans;">User Management</h1><br>
        <h2 style="display: flex;justify-content: center;font-family: Google Sans;">Owner Management</h2>
        <div class="container-fluid">
            <div class="row mt-3 g-3">
                <?php
                $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
                $records = pg_query($dbconn, "select * from owner_login where status='accepted'");
                while ($data = pg_fetch_array($records)) {
                ?>
                    <div class="col-sm-4">
                        <div class="card" id="usr-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $data['name']; ?></h5>
                                <h6><i>Username:<?php echo $data['username']; ?></i></h6>
                                Email: <?php echo $data['email']; ?>
                                <p class="card-text">Mob. No.: <?php echo $data['ph_no']; ?><br>Gender: <?php echo $data['gender']; ?><br>DOB: <?php echo $data['dob']; ?></p>
                                <a href="update_owner.php?name=<?php echo $data['username']; ?>"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
                                <a href="admin_action.php?name=<?php echo $data['username']; ?>&resp=9"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
                                <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=2"><button class=" btn mt-3 edit-btn">
                                        <img src="../../Img/Admin-Home/details.svg" height="20" width="30">Details</button></a>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        </div>

        <br><br>
        <h2 style="display: flex;justify-content: center;font-family: Google Sans;">Tenant Management</h2>
        <div class="container-fluid">
            <div class="row mt-3 g-3">
                <?php
                $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
                $records = pg_query($dbconn, "select * from logindata where status='accepted'");
                while ($data = pg_fetch_array($records)) {
                ?>
                    <div class="col-sm-4">
                        <div class="card" id="usr-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $data['name']; ?></h5>
                                <h6><i>Username:<?php echo $data['username']; ?></i></h6>
                                Email: <?php echo $data['email']; ?>
                                <p class="card-text">Mob. No.: <?php echo $data['ph_no']; ?><br>Gender: <?php echo $data['gender']; ?><br>DOB: <?php echo $data['dob']; ?></p>
                                <a href="update_tenant.php?name=<?php echo $data['username']; ?>"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
                                <a href="admin_action.php?name=<?php echo $data['username']; ?>&resp=10"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
                                <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=5"><button class=" btn mt-3 edit-btn">
                                        <img src="../../Img/Admin-Home/details.svg" height="20" width="30">Details</button></a>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        </div>


        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions1" aria-labelledby="offcanvasWithBothOptionsLabel1" style="width: 30em;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel1">Owner Related Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="container-fluid">
                    <div class="row g-3">
                        <?php if (isset($_SESSION["Ouname"]) && !empty($_SESSION["Ouname"])) {
                            $rec1 = pg_query($dbconn, "select * from owner_login where status='updating'");
                            while ($data = pg_fetch_array($rec1)) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $data['username']; ?> requested Profile updation?</h6>
                                        <a href="../Admin/admin_action.php?resp=12"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                        <a href="../Admin/admin_action.php?resp=13"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=14"><button class=" btn btn-warning"><img src="../../Img/Admin-Home/compare.svg" height="27" width="29"> View Changes</button></a>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            $rec1 = pg_query($dbconn, "select * from owner_login where status='pending'");
                            while ($data = pg_fetch_array($rec1)) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Verify <?php echo $data['username']; ?> Profile?</h6>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=0"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=1"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=2"><button class=" btn btn-warning"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Details</button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel2">Tenant Related Notifications</h5>
            </div>
            <div class="offcanvas-body">
                <div class="container-fluid">
                    <div class="row g-3">
                        <?php if (isset($_SESSION["Tuname"]) && !empty($_SESSION["Tuname"])) {
                            $rec2 = pg_query($dbconn, "select * from logindata where status='updating'");
                            while ($data = pg_fetch_array($rec2)) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $data['username']; ?> requested for Profile update?</h6>
                                        <a href="../Admin/admin_action.php?resp=16"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                        <a href="../Admin/admin_action.php?resp=17"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=18"><button class=" btn btn-warning"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Details</button></a>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            $rec2 = pg_query($dbconn, "select * from logindata where status='pending'");
                            while ($data = pg_fetch_array($rec2)) {  ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Verify <?php echo $data['username']; ?> Profile?</h6>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=3"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=4"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                        <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=5"><button class=" btn btn-warning"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Details</button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions1" aria-controls="offcanvasWithBothOptions" style="position: fixed;bottom: 15px;right: 25px;">
            <img src=" ../../Img/Admin-Home/verify_profile.svg" height="37" width="27">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo pg_num_rows($rec1) + pg_num_rows($rec2); ?></span>
        </button>
        <br>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
} ?>