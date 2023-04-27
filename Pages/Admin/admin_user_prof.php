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
        <?php
        $username = $_GET['username'];
        if ($_GET['role'] == 'owner') {
            $records1 = pg_query($dbconn, "select * from owner_login where username='$username'");
            $data = pg_fetch_assoc($records1);
        } else {
            $records = pg_query($dbconn, "select * from logindata where username='$username'");
            $data = pg_fetch_assoc($records);
        } ?>
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
                            <img src="../../Uploaded_Images/User/<?php if ($_GET['role'] == 'owner') echo "Owner";
                                                                    else echo "Tenant"; ?>/<?php echo $data['image'] ?>" class="rounded-circle nav-prof">
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
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="rounded-circle mt-5 mb-4" width="250px" src="../../Uploaded_Images/User/<?php if ($_GET['role'] == 'owner') echo "Owner";
                                                                                                        else echo "Tenant"; ?>/<?php echo $data['image'] ?>">
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
                        <?php if ($data['status'] == 'pending') {
                            if ($_GET['role'] == 'owner') { ?>
                                <div class="mt-5 text-center">
                                    <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=0"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                    <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=1"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                    <a href="../Admin/admin_home.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Back</button></a>
                                </div>
                            <?php
                            } else { ?>
                                <div class="mt-5 text-center">
                                    <a href="../Admin/admin_action.php?name=<?php echo $data["username"] ?>&resp=3"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
                                    <a href="../Admin/admin_action.php?name=<?php echo $data[" username"] ?>&resp=4"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="26" width="26">Reject</button></a>
                                    <a href="../Admin/admin_home.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Back</button></a>
                                </div>
                        <?php
                            }
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
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
} ?>