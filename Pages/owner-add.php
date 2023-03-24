<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $ret = pg_query($db, "INSERT INTO property VALUES('$_POST[pid]', '$_POST[name]', '$_POST[addr]', '$_POST[room_type]', '$_POST[age]', '$_POST[phone]', '$_POST[email]','$_POST[rent]','$_POST[furn]','$_POST[about]')");
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        echo "<script>alert('Record added successfully');
                window.location.href='../Pages/owner.php';</script>";
    }
}
pg_close();
?>

<html eng="en">

<head>
    <title>Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs.jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("../Img/Login-Page/owner-add.jpg");
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
            height: 40px;
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
            margin-left: 12px;
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
        <form action="" method="post">
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-sm-4">
                    <table style="display: flex;justify-content: center;">
                        <h1 style="margin-bottom: 25px;">Property Upload</h1><br>
                        <tr>
                            <th>Property ID Number </th>
                            <td><input class="txt" type="text" name="pid" required></td>
                        </tr>
                        <tr>
                            <th>Property Name </th>
                            <td><input class="txt" type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <th>Property Address</th>
                            <td><input class="txt" type="text" name="addr"></td>
                        </tr>
                        <tr>
                            <th style="line-height: 2rem;">BHK Type </th>
                            <td>
                                <select class="txt" name="room_type">
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
                            <td><input class="txt" type="text" name="age"></td>
                        </tr>
                        <!--<tr>
                                <th>Upload Images </th>
                                <td><input class="txt" type="file" name="photo" multiple="multiple" accept="image/*">
                                </td>
                            <tr>-->
                        <th>Phone Number</th>
                        <td><input class="txt" type="tel" name="phone"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input class="txt" type="text" name="email"></td>
                        </tr>
                        <tr>
                            <th>Rent Per Month</th>
                            <td><input class="txt" type="text" name="rent"></td>
                        </tr>
                        <tr>
                            <th style="line-height: 2rem;">Furnished </th>
                            <td>
                                <select class="txt" name="furn">
                                    <option>Furnished</option>
                                    <option>Unfurnished</option>
                                    <option>Semi-furnished</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>About Property</th>
                            <td>
                                <textarea style="resize: none;margin-left: 12px;border: none;outline: none; border-radius: 10px;" rows="4" cols="31" name="about">
                                    </textarea>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" name="submit" class="ab" value="upload">
                </div>
            </div>
        </form>
    </div>
</body>

</html>