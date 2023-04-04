<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");

if (isset($_GET['submit']) && !empty($_GET['submit'])) {
    $ret = pg_query($db, "SELECT * FROM admin_login WHERE username='" . $_GET["user"] . "' and password = '" . $_GET["pass"] . "'");

    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $data = pg_fetch_array($ret);
        if (is_array($data)) {
            $_SESSION["aname"] = $_GET['user'];
            $_SESSION["apass"] = $_GET['pass'];
            header("Location: ../Admin/admin_home.php");
        } else {
            echo "<script>alert('Invalid Credentials');
                window.location.href='../Admin/admin_login.php';</script>";
        }
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
            background-image: url("../../Img/Login-Page/admin_login.jpg");
            text-align: center;
            background-size: cover;
            background-position: center;
        }

        h1 {
            font-weight: bold;
            color: #fff;
            font-size: 5rem;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .col-sm-4 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            border: none;
            border-radius: 2cm;
            backdrop-filter: blur(38px);
            filter: brightness(90%);
            width: 55rem;
            height: 45rem;
            justify-content: center;
            text-align: center;
            font-size: 2rem;
        }


        a {
            color: rgb(16, 16, 189);
            font-size: smaller;
            padding: 3rem;
        }

        .ab {
            background-color: rgb(230, 88, 6);
            margin-top: 30px;
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
            border: none;
            outline: none;
            border-radius: 10px;
            width: 16em;
        }
    </style>
</head>

<body>
    <form method="get">
        <div class="container" style="margin-top: 5em;">
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-sm-4">
                    <h1>Admin Login</h1><br>
                    <label style="color: black;">Username</label><br>
                    <input class="txt" type="text" name="user" required><br><br>
                    <label style="color: black;">Password</label><br>
                    <input class="txt" type="password" name="pass" required><br><br>
                    <input type="submit" class="ab" name="submit" value="login">
                </div>
            </div>
        </div>
    </form>
</body>

</html>