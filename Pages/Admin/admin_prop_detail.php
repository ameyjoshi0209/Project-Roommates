<?php session_start();
if (!empty($_SESSION["aname"])) {
    $conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
?>

    <html>

    <head>
        <title>Property Detail Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <style>
            #myCarousel {
                border: 3px black solid;
                left: 20%;
                width: 700px;
                height: 490px;
            }

            .carousel-inner {

                height: 490px;
                max-width: 700px;
            }

            .prop {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: medium;
            }

            table {
                padding-left: 50px;
                line-height: 30px;

                width: 100%;
            }

            h1 {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            }
        </style>
    </head>

    <?php
    $prop_id = $_GET["pid"];
    $records = pg_query($conn, "select * from property where p_id='$prop_id'");
    $data = pg_fetch_assoc($records);
    ?>


    <body style="background-color: rgb(210, 241, 241);">
        <div class="container">
            <div class="row">
                <h1 style="padding-left: 40%;"><?php echo $data['p_name']; ?></h1>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="../Img/hm.webp" style="width:700px; height: 500px;">
                            <div class="carousel-caption" style="padding: 5px;">
                                <br>
                                <h3>Ousides</h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="../Img/hall.webp">
                            <div class="carousel-caption" style="padding: 5px;">
                                <br>
                                <h3>Hall</h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="../Img/Bath.webp">
                            <div class="carousel-caption" style="padding: 5px;">
                                <br>
                                <h3>Bathroom</h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="../Img/kitchen.webp">
                            <div class="carousel-caption" style="padding: 5px;">
                                <br>
                                <h3>kitchen</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <h2>Property Details</h2>
                <table>
                    <tr>
                        <th>Property name</th>
                        <td><?php echo $data['p_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Rent per month</th>
                        <td><?php echo $data['p_rent']; ?></td>
                    </tr>
                    <tr>
                        <th>BHK Type</th>
                        <td><?php echo $data['p_bhk']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $data['p_addr']; ?></td>
                    </tr>
                    <tr>
                        <th>Furnishing Status</th>
                        <td><?php echo $data['p_furnish']; ?></td>
                    </tr>
                    <tr>
                        <th>Age of Property</th>
                        <td><?php echo $data['p_age']; ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo $data['p_ph_no']; ?></td>
                    </tr>
                </table>
                <div class="prop">
                    <h2>About this Property</h2>
                    <p><?php echo $data['p_about']; ?></p>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <a href="../Admin/admin_action.php?pid=<?php echo $data["p_id"] ?>&resp=6"><button class="btn btn-success"><img src="../../Img/Admin-Home/accept.svg" height="20" width="25">Accept</button></a>
            <a href="../Admin/admin_action.php?pid=<?php echo $data["p_id"] ?>&resp=7"><button class=" btn btn-danger"><img src="../../Img/Admin-Home/reject.svg" height="24" width="26">Reject</button></a>
            <a href="../Admin/admin_property.php"><button class=" btn btn-primary"><img src="../../Img/Admin-Home/details.svg" height="22" width="30">Back</button></a>
            <div class="mt-2 text-center">
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Tenant/admin_login.php';</script>";
} ?>