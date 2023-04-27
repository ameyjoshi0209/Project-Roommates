<?php session_start();
if (!empty($_SESSION["aname"])) {
    $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");

    $pid = $_GET['pid'];
    $records = pg_query($dbconn, "select * from property where p_id='$pid'");
    $data = pg_fetch_assoc($records);
    $imgs = explode(",", $data['images']);
    $img_count = count($imgs);

    $imgs1 = explode(",", $_SESSION["img_arr"]);
    $img1_count = count($imgs1);
?>

    <html>

    <head>
        <title>
            Property comapre for admin
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/tenant_profile.css" />
        <style>
            .carousel {
                margin-top: 30px;
                position: relative;
                height: 400px;
                border-radius: 5px;
                border: none;
            }

            .carousel-indicators [data-bs-target] {
                background: saddlebrown;
                position: relative;
                top: 36px;
                width: 11px;
                height: 11px;
                border: none;
                border-radius: 100%;
            }
        </style>
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
                            <img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" width="40" height="40" class="rounded-circle nav-prof">
                        </button>
                        <ul class="dropdown-menu">
                            <h6 class="dropdown-header"><?php echo $_SESSION["aname"] ?></h6>
                            <li><a class="dropdown-item" href="../Admin/admin_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="17" width="25"> Logout</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-indicators">
                                <?php
                                if ($img_count == 1) { ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <?php
                                } elseif ($img_count > 1) { ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <?php for ($i = 1; $i < $img_count; $i++) { ?>
                                        <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="<?php echo $i; ?>"></button>
                                <?php
                                    }
                                } ?>
                            </div>
                            <div class="carousel-inner">
                                <?php
                                foreach ($imgs as $value => $key) {
                                    if ($value == 0) { ?>
                                        <div class="carousel-item active">
                                            <img src="../../Uploaded_Images/Property/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="400px" width="545.990px">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="carousel-item">
                                            <img src="../../Uploaded_Images/Property/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="400px" width="545.990px">
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row d-flex flex-column align-items-center">
                            <div class="col-md-11 mt-4">
                                <div class="p-3 py-5">
                                    <div class="d-flex" style="justify-content: center;margin-bottom: 25px;">
                                        <h4>Original Property Details</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Property ID</label><input type="text" class="form-control" value="<?php echo $data["p_id"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Property Name</label><input type="text" class="form-control" value="<?php echo $data["p_name"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Deposit Amount</label><input type="text" class="form-control" value="<?php echo $data["p_deposit"] ?>" readonly></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" value="<?php echo $data["p_addr"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" value="<?php echo $data["p_city"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">BHK</label><input type="text" class="form-control" value="<?php echo $data["p_bhk"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Age</label><input type="text" class="form-control" value="<?php echo $data["p_age"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Gender Preffered</label><input type="text" class="form-control" value="<?php echo $data["p_gender"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Type of Property</label><input type="text" class="form-control" value="<?php echo $data["p_type"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Rent</label><input type="text" class="form-control" value="<?php echo $data["p_rent"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Furnish Status</label><input type="text" class="form-control" value="<?php echo $data["p_furnish"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">About</label><input type="text" class="form-control" value="<?php echo $data["p_about"] ?>" readonly></div>
                                        <div class="col-md-12"><label class="labels">Rules</label><input type="text" class="form-control" value="<?php echo $data["p_rules"] ?>" readonly></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-indicators">
                                <?php
                                if ($img1_count == 1) { ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true"></button>
                                <?php
                                } elseif ($img1_count > 1) { ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true"></button>
                                    <?php for ($i = 1; $i < $img1_count; $i++) { ?>
                                        <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="<?php echo $i; ?>"></button>
                                <?php
                                    }
                                } ?>
                            </div>
                            <div class="carousel-inner">
                                <?php
                                foreach ($imgs1 as $value => $key) {
                                    if ($value == 0) { ?>
                                        <div class="carousel-item active">
                                            <img src="../../Uploaded_Images/Property/Temp/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="400px" width="545.990px">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="carousel-item">
                                            <img src="../../Uploaded_Images/Property/Temp/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="400px" width="545.990px">
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex flex-column align-items-center">
                        <div class="col-md-11 mt-4">
                            <div class="p-3 py-5">
                                <div class="d-flex" style="justify-content: center;margin-bottom: 25px;">
                                    <h4>Updated Property Details</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12"><label class="labels">Property ID</label><input type="text" class="form-control" value="<?php echo $_SESSION["Ppid"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Property Name</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pname"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Deposit Amount</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pdeposit"] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" value="<?php echo $_SESSION["Paddr"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pcity"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">BHK</label><input type="text" class="form-control" value="<?php echo $_SESSION["Proom_type"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Age</label><input type="text" class="form-control" value="<?php echo $_SESSION["Page"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Gender Preffered</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pgender_pref"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Type of Property</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pprop_type"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Rent</label><input type="text" class="form-control" value="<?php echo $_SESSION["Prent"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Furnish Status</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pfurn"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">About</label><input type="text" class="form-control" value="<?php echo $_SESSION["Pabout"] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Rules</label><input type="text" class="form-control" value="<?php echo $_SESSION["Prules"] ?>" readonly></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 mb-4 text-center">
                    <a href="../Admin/admin_action.php?resp=20"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="21" width="25">Accept</button></a>
                    <a href="../Admin/admin_action.php?resp=21"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="23" width="26">Reject</button></a>
                    <a href="../Admin/admin_property.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/back.svg" height="21" width="32"> Back</button></a>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
} ?>