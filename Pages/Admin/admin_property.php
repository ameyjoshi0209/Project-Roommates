<?php session_start();
if (!empty($_SESSION["aname"])) { ?>
    <html>

    <head>
        <title>Property Management Side</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/admin_home.css" />
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-1 pb-1">
            <a class="navbar-brand text-primary" href="../Admin/admin_property.php" style="margin-left: 20px;">ROOMMATES</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a id="owner-btn" class="nav-item nav-link" type="button" href="../Admin/admin_home.php">Manage Users</a>
                </div>
            </div>
            <div class="align">
                <div class="btn-group dropstart">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
                        <img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" width="40" height="40" class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu">
                        <h6 class="dropdown-header"><?php echo $_SESSION["aname"] ?></h6>
                        <li><a class="dropdown-item" href="../Admin/admin_logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <h1 style="display: flex;justify-content: center;font-family: Google Sans;">Property Management</h1>


        <div class="container-fluid">
            <div class="row mt-3 g-3">
                <?php
                $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
                $records = pg_query($dbconn, "select * from property where status='accepted'");
                while ($data = pg_fetch_array($records)) {
                ?>
                    <div class="col-sm-4">
                        <div class="card" id="usr-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $data['p_name']; ?></h5>
                                <h6><i>Owner Name: <?php echo $data['username']; ?></i></h6>
                                E-mail: <?php echo $data['p_email']; ?>
                                <p class="card-text">Mob. No.: <?php echo $data['p_ph_no']; ?><br>Rent: <?php echo $data['p_rent']; ?><br>City: <?php echo $data['p_city']; ?></p>
                                <a href="update_property.php?pid=<?php echo $data['p_id']; ?>"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/update.svg" class="img-fluid" height="20px" width="20px"> Update</button></a>
                                <a href="admin_action.php?pid=<?php echo $data['p_id']; ?>&resp=7"><button class="btn mt-3 edit-btn">
                                        <img src="../../Img/trash.svg" class="img-fluid" height="20px" width="20px"> Delete</button></a>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        </div>


        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Property Related Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="container-fluid">
                    <div class="row g-3">
                        <?php
                        $rec = pg_query($dbconn, "select * from property where status='pending'");
                        while ($data = pg_fetch_array($rec)) {
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Verify <?php echo $data['username']; ?> Property?</h6>
                                    <a href="../Admin/admin_action.php?pid=<?php echo $data["p_id"] ?>&resp=6"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                    <a href="../Admin/admin_action.php?pid=<?php echo $data["p_id"] ?>&resp=7"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                    <a href="../Admin/admin_action.php?pid=<?php echo $data["p_id"] ?>&resp=8"><button class=" btn btn-warning"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Details</button></a>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="position: fixed;bottom: 15px;right: 25px;">
            <img src=" ../../Img/Admin-Home/verify_property.svg" height="37" width="27">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo pg_num_rows($rec); ?></span>
        </button>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
} ?>