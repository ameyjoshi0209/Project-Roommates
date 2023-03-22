<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
if (!$db) {
    echo "Error: Unable to connect";
} else {
    echo "Opened database successfully";
}

$pid = $_GET['pid'];
$pname = $_GET['name'];
$addr = $_GET['addr'];
$room_type = $_GET['room_type'];
$age = $_GET['age'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$rent = $_GET['rent'];
$furn = $_GET['furn'];
$about = $_GET['about'];

$ret = pg_query($db, "INSERT INTO property VALUES('$pid', '$pname', '$addr', '$room_type', $age, $phone, '$email',$rent,'$furn','$about');");

if (!$ret) {
    echo pg_last_error($db);
} else {
    echo "Records added successfully";
}
pg_close();
