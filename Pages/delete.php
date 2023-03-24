<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
// Using database connection file here

$id = $_GET['id']; // get id through query string

$del = pg_query($db, "delete from property where p_id = '$id'"); // delete query

if ($del) {
    echo "<script>alert('Record Deleted Successfully');
                window.location.href='../Pages/owner.php';</script>"; // redirects to all records page
    exit();
} else {
    echo "Error deleting record"; // display error message if not delete
}
