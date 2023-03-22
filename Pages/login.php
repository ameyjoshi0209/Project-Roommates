<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
$uname = $_POST['user'];
$pass = md5($_POST['pass']);

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $data = pg_query($db, $sql);

    if (!$ret) {
        echo pg_last_error($db);
    } else {
        echo "<script>alert('Records added successfully');</script>";
    }
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
            background-image: url("../Img/Login-Page/login.jpg");
            text-align: center;
            background-size: cover;
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
            filter: brightness(87%);
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
            margin-top: 10px;
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
    <form method="post">
        <div class="container" style="margin-top: 5em;">
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-sm-4">
                    <h1>Login</h1><br>
                    <label style="color: black;">Username</label><br>
                    <input class="txt" type="text" name="user" required><br><br>
                    <label style="color: black;">Password</label><br>
                    <input class="txt" type="password" name="pass" required><br>
                    <a href="forget.html" style="padding: 0;">Forget Password</a><br><br>
                    <button class="ab" href="#"><span>login</span></button>
                    <p style="font-size: large; text-align: center; margin-left: 25px; margin-top: 30px; color: grey;">
                        Dont have
                        an account? <a href="Register.html" style="padding: 0;">SignUp</a>
                    </p>
                </div>
            </div>
        </div>
    </form>
</body>

</html>