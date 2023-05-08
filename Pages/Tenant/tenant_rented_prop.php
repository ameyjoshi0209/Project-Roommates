<?php session_start();

if (!empty($_SESSION["uname"])) {
    $db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Styles/home.css" />
    </head>

    <body style="background-color: lavender;">
        <!-- NAVIGATION BAR -->
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
                        <img src="<?php echo $_SESSION["uimage"]; ?>" class="rounded-circle-1">
                    </button>
                    <ul class="dropdown-menu">
                        <h6 class="dropdown-header"><?php echo $_SESSION["uname"] ?></h6>
                        <li><a class="dropdown-item" href="../Tenant/tenant_profile.php"><img src="../../Img/Admin-Home/profile.svg" height="20" width="25" style="margin-right: 4px;"> My Profile</a></li>
                        <li><a class="dropdown-item" href="../Tenant/tenant_rented_prop.php"><img src="../../Img/Admin-Home/houses.svg" height="20" width="25" style="margin-right: 4px;"> My Property</a></li>
                        <li><a class="dropdown-item" href="../Tenant/tenant_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="18" width="22" style="margin-right: 8px;"> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            <h2 style="position: relative;top: 140;display: flex;justify-content: center;font-size: 50px;color:purple">Rented Properties</h2>
            <div class="row g-3" style="position: relative;top: 200px;display: flex;justify-content: center;;">
                <?php
                $rec = pg_query($db, "select * from property where t_name='{$_SESSION['uname']}'");
                if (pg_num_rows($rec) > 0) {
                    while ($data = pg_fetch_array($rec)) { ?>
                        <div class="card mb-4" style="max-width: 790px;height: 280px;background-color: palegoldenrod;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="row g-2">
                                <div class="col-md-5" style="display: flex;justify-content: center;">
                                    <img src="../../Uploaded_Images/Property/<?php echo $data['p_id']; ?>/<?php echo $data['p_name']; ?>-0.jpg" height="235.974px" width="301.974px" style="border-radius: 10px;margin-top: 21px;">
                                </div>
                                <div class="col-md-7">
                                    <?php $qry = pg_query($db, "select name from owner_login where username='$data[username]';");
                                    $cont = pg_fetch_assoc($qry);
                                    echo $cont['ph_no'] ?>
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $data['p_name']; ?></h3>
                                        <p class="card-text"><b>Owner: <?php echo $cont['name']; ?></b><br>
                                            Address: <?php echo $data['p_addr']; ?><br>
                                            City: <?php echo $data['p_city']; ?><br>
                                            Rent: <?php echo $data['p_rent']; ?><br>
                                            Deposit: <?php echo $data['p_deposit']; ?><br>
                                        </p><br>
                                        <a href="detail.php?pid=<?php echo $data['p_id']; ?>">
                                            <button class="btn btn-dark" style="border-radius: 20px;padding: 8px 22px;">Details</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<i><h2 style='display:flex;justify-content:center;color:purple;'>No Properties Rented</h2></i>";
                }
                ?>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Tenant/login.php';</script>";
} ?>