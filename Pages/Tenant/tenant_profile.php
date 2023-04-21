<?php session_start();

if (!empty($_SESSION["uname"])) {
    $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        if ($_FILES["ten_prof"]["error"] != 4) {
            $target_file = $_SESSION["uname"] . '.jpg';
            move_uploaded_file($_FILES['ten_prof']['tmp_name'], '../../Uploaded_Images/User/Tenant/Temp/' . $target_file);
        }
        header("Location: ../Admin/admin_action.php?Uname=$_POST[Uname]&Name=$_POST[Name]&dob=$_POST[dob]&phone=$_POST[phone]&gender=$_POST[gender]&resp=15");
    }
?>
    <html>

    <head>
        <title>Owner Side</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/tenant_profile.css" />
    </head>

    <body>
        <form method="post" enctype="multipart/form-data">
            <div class="sem-bag">
                <div class="container-fluid position-absolute" id="nav-contain">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pb-2 pt-2" style="border-radius: 20px;">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand text-primary" href="../../Pages/Tenant/home.php">ROOMMATES</a>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a id="navlink" class="nav-item nav-link active" href="../Tenant/home.php">Home</a>
                                <a id="navlink" class="nav-item nav-link" href="../about.html">About</a>
                                <a id="navlink" class="nav-item nav-link" href="../../Pages/Tenant/sorted.php">Pricing</a>
                            </div>
                        </div>
                        <div class="btn-group dropstart">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="top: 6px;right: 5px;border: none;">
                                <img src="<?php echo $_SESSION["uimage"]; ?>" class="rounded-circle nav-prof">
                            </button>
                            <ul class="dropdown-menu">
                                <h6 class="dropdown-header"><?php echo $_SESSION["uname"] ?></h6>
                                <li><a class="dropdown-item" href="../Tenant/tenant_profile.php"><img src="../../Img/Admin-Home/profile.svg" height="20" width="25" style="margin-right: 4px;"> My Profile</a></li>
                                <li><a class="dropdown-item" href="../Tenant/tenant_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="18" width="22" style="margin-right: 8px;"> Logout</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <?php
            $records = pg_query($dbconn, "select * from logindata where username='{$_SESSION['uname']}'");
            $data = pg_fetch_assoc($records);
            ?>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="rounded-circle mt-5" width="250px" src="<?php echo $_SESSION["uimage"]; ?>">
                        <span class="font-weight-bold mt-4">
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
                                <h4>Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">Upload New Photo</label><input type="file" class="form-control" name="ten_prof" accept="image/*"></div>
                                <div class="col-md-12"><label class="labels">Name</label><input type="text" name="Name" class="form-control" value="<?php echo $data["name"] ?>"></div>
                                <div class="col-md-12"><label class="labels">Username</label><input type="text" name="Uname" class="form-control" value="<?php echo $_SESSION["uname"] ?>" readonly></div>
                                <!--
                                    <div class="col-md-12"><label class="labels">Previous Password</label><input type="password" class="form-control" value=""></div>
                                <div class="col-md-12"><label class="labels">New Password</label><input type="password" class="form-control" value=""></div>
                                <div class="col-md-12"><label class="labels">Confirm New Password</label><input type="password" class="form-control" value=""></div>
                                -->

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="tel" name="phone" class="form-control" value="<?php echo $data["ph_no"] ?>"></div>
                                <div class="col-md-12"><label class="labels">Date of Birth</label><input type="date" name="dob" class="form-control" value="<?php echo $data["dob"] ?>"></div>
                                <div class="col-md-12"><label class="labels">Gender</label><input type="text" name="gender" class="form-control" value="<?php echo $data["gender"] ?>"></div>
                            </div>
                            <div class="mt-5 text-center">
                                <input class="btn text-white btn-primary profile-button" type="submit" name="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        </form>
    </body>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Tenant/login.php';</script>";
} ?>