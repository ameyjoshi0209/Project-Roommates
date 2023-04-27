<?php session_start();
if (!empty($_SESSION["aname"])) {
    $conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
    $prop_id = $_GET["pid"];
    $result = pg_query($conn, "SELECT * FROM property WHERE p_id='$prop_id'") or die("Query Failed");
    $data = pg_fetch_assoc($result);
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {

        if ($_FILES["photo"]["error"] != 4) {
            $img_array = array();
            foreach ($_FILES['photo']['name'] as $key => $val) {
                $target_file = $_POST['name'] . '-' . $key . '.jpg';
                array_push($img_array, $target_file);
                if (!file_exists('../../Uploaded_Images/Property/' . $prop_id)) {
                    mkdir('../../Uploaded_Images/Property/' . $prop_id, 0777, true);
                    move_uploaded_file($_FILES['photo']['tmp_name'][$key], '../../Uploaded_Images/Property/' . $prop_id . '/' . $target_file);
                } else {
                    move_uploaded_file($_FILES['photo']['tmp_name'][$key], '../../Uploaded_Images/Property/' . $prop_id . '/' . $target_file);
                }
            }
            $img_array = implode(",", $img_array);
        }
        $result = pg_query($conn, "UPDATE property SET p_name = '$_POST[name]',p_addr='$_POST[addr]',p_bhk='$_POST[room_type]',p_age='$_POST[age]',p_ph_no='$_POST[phone]',p_email='$_POST[email]',p_rent='$_POST[rent]',p_furnish='$_POST[furn]',p_about='$_POST[about],p_deposit=$_POST[deposit]',images=$img_array
where p_id='$prop_id'");
        if (!$result) {
            echo "<script>alert('Update unsuccessfull')</script>";
        } else {
            echo "<script>alert('Property Updated Successfully');
                window.location.href='../Owner/owner.php';</script>";
        }
    }
?>
    <html>

    <head>
        <title>Adimn Direct Property Update</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs.jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            body {
                background-image: url("../../Img/Login-Page/owner-add.jpg");
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                text-align: center;
                background-size: cover;
            }

            h1 {
                color: black;
                justify-content: center;
                font-weight: bold;
                font-size: 5rem;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            }

            .col-sm-4 {
                width: 35em;
                border-radius: 2cm;
                border: none;
                font-family: Arial, Helvetica, sans-serif;
                backdrop-filter: blur(40px);
                filter: brightness(90%);
                height: auto;
                justify-content: center;
                text-align: center;
                font-size: 2rem;
                line-height: 1rem;
            }

            tr {
                height: 37px;
            }

            th {
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                color: black;
                font-size: 19px;
            }

            .wrapper {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                position: absolute;
                top: 90%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .ab {
                background-color: cornflowerblue;
                border-radius: 40px;
                display: block;
                width: 120px;
                height: 45px;
                line-height: 1.5;
                font-size: 20px;
                font-family: sans-serif;
                text-decoration: none;
                color: #333;
                border: none;
                margin-top: 25px;
                text-align: center;
                justify-content: center;
                position: relative;
                left: 45%;
                bottom: 2%;
                transition: all 0.5s;
            }

            .ab:hover {
                color: #fff;
            }

            .ab:active {
                background-color: #333;
                transform: translateY(4px);
            }

            .txt {
                margin-left: 40px;
                outline: none;
                border: none;
                border-radius: 10px;
                height: 27px;
                width: 17em;
            }
        </style>
    </head>

    <body>
        <div class="container" style="margin-top: 3em;">
            <form name=update1 method="post" enctype="multipart/form-data">
                <div class="row" style="display: flex;justify-content: center;">
                    <div class="col-sm-4">
                        <table style="display: flex;justify-content: center;">
                            <h1 style="margin-bottom: 25px;">Update Property</h1><br>
                            <tr>
                                <th>Property ID Number </th>
                                <td>
                                    <h4 class="txt"><?php echo $data['p_id']; ?></h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Property Name </th>
                                <td><input class="txt" type="text" name="name" value="<?php echo $data['p_name']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Property Images </th>
                                <td><input class="upl" type="file" name="photo[]" accept="image/*" multiple value="upload" required /></td>
                            </tr>
                            <tr>
                                <th>Property Address</th>
                                <td><input class="txt" type="text" name="addr" value="<?php echo $data['p_addr']; ?>"></td>
                            </tr>
                            <tr>
                                <th style="line-height: 2rem;">City </th>
                                <td>
                                    <select class="txt" name="city">
                                        <option><?php echo $data['p_city']; ?></option>
                                        <option>Pune</option>
                                        <option>Banglore</option>
                                        <option>Kolkata</option>
                                        <option>Mumbai</option>
                                        <option>Delhi</option>
                                        <option>Gujarat</option>
                                        <option>Kerala</option>
                                        <option>Hyderabad</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="line-height: 2rem;">BHK Type </th>
                                <td>
                                    <select class="txt" name="room_type">
                                        <option><?php echo $data['p_bhk']; ?></option>
                                        <option>1 RK</option>
                                        <option>1 BHK</option>
                                        <option>2 BHK</option>
                                        <option>3 BHK</option>
                                        <option>3 BHK+</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Property Age (in years)</th>
                                <td><input class="txt" type="text" name="age" value="<?php echo $data['p_age']; ?>"></td>
                            </tr>
                            <th>Tenant Preference</th>
                            <td>
                                <select class="txt" name="gender_pref">
                                    <option><?php echo $data['p_gender']; ?></option>
                                    <option>Only Male Bachelors</option>
                                    <option>Only Female Bachelors</option>
                                    <option>Male or Female Bachleors</option>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <th>Property Type</th>
                                <td>
                                    <select class="txt" name="prop_type">
                                        <option><?php echo $data['p_type'] ?></option>
                                        <option>PG</option>
                                        <option>Flat</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Deposit Amount</th>
                                <td><input class="txt" type="text" name="deposit" value="<?php echo $data['p_deposit']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Rent Per Month</th>
                                <td><input class="txt" type="text" name="rent" value="<?php echo $data['p_rent']; ?>"></td>
                            </tr>
                            <tr>
                                <th style="line-height: 2rem;">Furnished </th>
                                <td>
                                    <select class="txt" name="furn">
                                        <option><?php echo $data['p_furnish']; ?></option>
                                        <option>Furnished</option>
                                        <option>Unfurnished</option>
                                        <option>Semi-furnished</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>About Property</th>
                                <td><textarea style="resize: none;margin-left: 40px;margin-top: 4px;border: none;outline: none; border-radius: 10px;" rows="4" cols="31" name="about"><?php echo $data['p_about']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Rules regarding Property</th>
                                <td>
                                    <textarea style="resize:none;height: 80px;margin-top:8px" class="txt" name="rules" rows="4" cols="50"><?php echo $data['p_rules']; ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <input type=submit name=submit value=update class="ab">
                    </div>
                </div>
            </form>
        </div>
    </body>

    </html>
<?php
} else {
    echo "<script>window.location.href='../Admin/admin_login.php';</script>";
}
