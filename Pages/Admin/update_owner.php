<?php
session_start();
$conn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres") or die("<script>alert('Error Not Connected');</script>");
$name = $_GET['id'];
$result = pg_query($conn, "SELECT * FROM owner_login WHERE login_id='$name'");
$data = pg_fetch_assoc($result);
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $result = pg_query($conn, "UPDATE owner_login SET name = '$_POST[name]',gender='$_POST[gender]',dob='$_POST[dob]',ph_no='$_POST[ph_no]',email='$_POST[email]',username='$_POST[username]',password='$_post[password]' where login_id='$name' ") or die("<H1>Error</h1>");

    if (!$result) {
        echo "<script>alert('Error');
                window.location.href='../Admin/update_owner.php';</script>";
    } else {
        echo "<script>alert('Record Updated Successfully');
                window.location.href='../Admin/admin_home.php';</script>";
    }
}
pg_close();
?>

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
        <form action="#" method="post">
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-sm-4">
                    <table style="display: flex;justify-content: center;">
                        <h1 style="margin-bottom: 25px;">Update Owner <?php echo $data["username"]; ?></h1><br>
                        <tr>
                            <th>Full Name </th>
                            <td><input class="txt" type="text" name="name" value="<?php echo $data['name']; ?>"></td>
                        </tr>
                        <tr>
                            <th style="line-height: 2rem;">Gender </th>
                            <td>
                                <select class="txt" name="gender">
                                    <option><?php echo $data['gender'] ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of Birth </th>
                            <td><input class="txt" type="date" name="dob" value="<?php echo $data['dob'] ?>"></td>
                        <tr>
                            <th>Phone Number</th>
                            <td><input class="txt" type="tel" name="ph_no" value="<?php echo $data['ph_no'] ?>"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input class="txt" type="text" name="email" value="<?php echo $data['email'] ?>"></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><input class="txt" type="text" name="username" value="<?php echo $data['username'] ?>"></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input class="txt" type="text" name="password" value="<?php echo $data['password'] ?>"></td>
                        </tr>

                    </table>
                    <br>
                    <input type="submit" class="ab" name="submit">
                </div>
            </div>
        </form>
    </div>
</body>

</html>