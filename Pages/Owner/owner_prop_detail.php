<?php session_start();
if (!empty($_SESSION["oname"])) {
    $conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");

    $prop_id = $_GET["pid"];
    $records = pg_query($conn, "select * from property where p_id='$prop_id'");
    $data = pg_fetch_assoc($records);
    $imgs = explode(",", $data['images']);
    $img_count = count($imgs);
?>

    <html>

    <head>
        <title>Property Detail Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

            .carousel-indicators [data-bs-target] {
                background: saddlebrown;
                position: relative;
                top: 36px;
                width: 11px;
                height: 11px;
                border: none;
                border-radius: 100%;
            }

            .prop {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: medium;
            }

            table {
                font-size: 19px;
                margin-left: 25px;
                line-height: 40px;
                width: 100%;
            }

            h1 {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                display: flex;
                justify-content: center;
                font-size: 80px;
            }

            .act-btn {
                border-radius: 40px;
                margin-top: 50px;
                width: 120px;
                margin-bottom: 30px;
                margin-left: 8px;
                padding: 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
        </style>
    </head>

    <body style="background-color: rgb(210, 241, 241);">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <h1><?php echo $data['p_name']; ?></h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true" style="display: flex;justify-content: center;padding: 0;margin-top: 40px;">
                    <div class="carousel-indicators">
                        <?php
                        if ($img_count == 1) { ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <?php
                        } elseif ($img_count > 1) { ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <?php for ($i = 1; $i < $img_count; $i++) { ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>"></button>
                        <?php
                            }
                        } ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        foreach ($imgs as $value => $key) {
                            if ($value == 0) { ?>
                                <div class="carousel-item active">
                                    <img src="../../Uploaded_Images/Property/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="484.79px" width="694.91px">
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="carousel-item">
                                    <img src="../../Uploaded_Images/Property/<?php echo $data['p_id']; ?>/<?php echo $key; ?>" height="484.79px" width="694.91px">
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row d-flex justify-content-center">
                <h2 class="mt-4 mb-5">Property Details</h2>
                <table>
                    <tr>
                        <th>Property name</th>
                        <td><?php echo $data['p_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Property Type</th>
                        <td><?php echo $data['p_type']; ?></td>
                    </tr>
                    <tr>
                        <th>Deposit Amount</th>
                        <td><?php echo $data['p_deposit']; ?></td>
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
                        <th>Prefered Tenant</th>
                        <td><?php echo $data['p_gender']; ?></td>
                    </tr>
                </table>
                <div class="prop mt-4 mb-3">
                    <h2>About this Property</h2>
                    <p><?php echo $data['p_about']; ?></p>
                </div>
                <div class="prop">
                    <h2>Rules regarding this Property</h2>
                    <p><?php echo $data['p_rules']; ?></p>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
} ?>