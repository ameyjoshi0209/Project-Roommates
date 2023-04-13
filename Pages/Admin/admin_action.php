<?php
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
// Using database connection file here

$name = $_GET['name']; // get name through query string
$pid = $_GET['pid'];
$resp = $_GET['resp'];


switch ($resp) {
    case 0:
        $add = pg_query($db, "update owner_login set status = 'accepted' where username='$name'");
        if ($add) {
            echo "<script>alert('Owner verified Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 1:
        $rej = pg_query($db, "delete from owner_login where username='$name'");
        if ($rej) {
            echo "<script>alert('Owner verification rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 2:
        $det = header("Location: ../Admin/admin_user_prof.php?username=$name&role='owner'");
        break;
    case 3:
        $add1 = pg_query($db, "update logindata set status = 'accepted' where username='$name'");
        if ($add1) {
            echo "<script>alert('Tenant verified Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 4:
        $rej1 = pg_query($db, "delete from logindata where username='$name'");
        if ($rej1) {
            echo "<script>alert('Tenant verification rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 5:
        $det1 = header("Location: ../Admin/admin_user_prof.php?username=$name");
        break;
    case 6:
        $add2 = pg_query($db, "update property set status = 'accepted' where p_id='$pid'");
        if ($add2) {
            echo "<script>alert('Property verified Successfully');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 7:
        $rej2 = pg_query($db, "delete from property where p_id='$pid'");
        if ($rej2) {
            echo "<script>alert('Property verification Rejected');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 8:
        header("Location: ../Admin/admin_prop_detail.php?pid=$pid");
        break;
    case 9:
        $del = pg_query($db, "delete from owner_login where username = '$name'"); // delete query
        if ($del) {
            echo "<script>alert('Owner Deleted Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error deleting record"; // display error message if not delete
        }
        break;
    case 10:
        $del = pg_query($db, "delete from logindata where username = '$name'"); // delete query
        if ($del) {
            echo "<script>alert('Tenant Deleted Successfully');
                window.location.href='../Admin/admin_tenant.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error deleting record"; // display error message if not delete
        }
        break;
}
