<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['date'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$uname = $_POST['user'];
$pass = $_POST['pass'];
$repass = $_POST['repass'];

if (isset($_POST['submit']) && !empty($_POST['submit'])) {

    if ($pass != $repass) {
        echo "<script>alert('please confirm your password');
        window.location.href='../Tenant/Register.php';</script>";
        exit();
    }

    $dup = pg_query($db, "select * from logindata");
    while ($data = pg_fetch_array($dup)) {
        if ($name == $data['name'] && $gender == $data['gender'] && $dob == $data['dob'] && $phone == $data['ph_no'] && $email == $data['email']) {
            echo "<script>alert('User already exists');
                window.location.href='../Tenant/login.php';</script>";
            exit();
        }
    }
    $sql = "insert into logindata(name, gender, dob, ph_no, email, username, password) values('$name','$gender','$dob', $phone, '$email', '$uname','$pass')";
    $ret = pg_query($db, $sql);
    echo "<script>alert('Records added successfully');
                window.location.href='../Tenant/login.php';</script>";
    pg_close();
}
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
            background-image: url("../../Img/Login-Page/register.jpg");
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
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            border: none;
            border-radius: 2cm;
            backdrop-filter: blur(43px);
            filter: brightness(90%);
            width: 70rem;
            height: auto;
            justify-content: center;
            text-align: center;
            font-size: 2rem;
        }

        tr {
            height: 39px;
        }

        th {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color: black;
            font-size: 19px;
        }

        .ab {
            background-color: rgb(230, 88, 6);
            margin-top: auto;
            margin-bottom: 20px;
            border-radius: 20px;
            position: absolute;
            width: 130px;
            height: 45px;
            line-height: 0;
            font-size: 20px;
            font-family: sans-serif;
            text-decoration: none;
            color: #333;
            border: none;
            text-align: center;
            justify-content: center;
            position: relative;
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
            margin-left: 20px;
            outline: none;
            border: none;
            border-radius: 10px;
            height: 28px;
            width: 19em;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 3em;">
        <form action="" method="post">
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-sm-4">
                    <table style="display: flex;justify-content: center;">
                        <h1 style="margin-bottom: 25px;">Sign Up for Tenant</h1><br>
                        <tr>
                            <th>Full Name </th>
                            <td><input class="txt" type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <th style="line-height: 2rem;">Gender </th>
                            <td>
                                <select class="txt" name="gender" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Birth </th>
                            <td><input class="txt" type="date" name="date" required></td>
                        <tr>
                            <th>Phone Number</th>
                            <td><input class="txt" type="tel" name="phone" required></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input class="txt" type="text" name="email" required></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><input class="txt" type="text" name="user" required></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input class="txt" type="password" name="pass" required></td>
                        </tr>
                        <tr>
                            <th>Confirm Password</th>
                            <td><input class="txt" type="password" name="repass" required></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" class="ab" name="submit" value="Sign Up">
                </div>
            </div>
        </form>
    </div>
</body>

</html>