<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
// Using database connection file here
$username = $_GET['username'];
$del = pg_query($db, "delete from owner_login where username = '$username'"); // delete query

if ($del) {
    echo "<script>alert('Record Deleted Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
    exit();
} else {
    echo "Error deleting record"; // display error message if not delete
}
