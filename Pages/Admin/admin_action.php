<?php session_start();
$db = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
// Using database connection file here

$name = $_GET['name']; // get name through query string
$pid = $_GET['pid'];
$resp = $_GET['resp'];


switch ($resp) {
    case 0:
        // ACCEPTED OWNER VERIFICATION

        $add = pg_query($db, "update owner_login set status = 'accepted' where username='$name'");
        if ($add) {
            echo "<script>alert('Owner verified Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 1:
        // REJECTED OWNER VERIFICATION

        $rej = pg_query($db, "delete from owner_login where username='$name'");
        if ($rej) {
            unlink("../../Uploaded_Images/User/Owner/$name.jpg");
            echo "<script>alert('Owner verification rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 2:
        // REDIRECTED TO THE DETAIL PAGE OF OWNER

        $det = header("Location: ../Admin/admin_user_prof.php?username=$name&role=owner");
        break;
    case 3:
        // ACCEPTED TENANT VERIFICATION

        $add1 = pg_query($db, "update logindata set status = 'accepted' where username='$name'");
        if ($add1) {
            echo "<script>alert('Tenant verified Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 4:
        // REJECTED TENANT VERIFICATION

        $rej1 = pg_query($db, "delete from logindata where username='$name'");
        if ($rej1) {
            unlink("../../Uploaded_Images/User/Tenant/$name.jpg");
            echo "<script>alert('Tenant verification rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 5:
        // REDIRECTED TO DETAIL PAGE OF TENANT

        $det1 = header("Location: ../Admin/admin_user_prof.php?username=$name");
        break;
    case 6:
        // ACCEPTED PROPERTY VERIFICATION REQUEST

        $add2 = pg_query($db, "update property set status = 'accepted' where p_id='$pid'");
        if ($add2) {
            echo "<script>alert('Property verified Successfully');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 7:
        // DELETE PROPERTY THROUGH ADMIN DASHBORD
        // REJECT (DELETE) PROPERTY VERIFICATON

        $rej2 = pg_query($db, "delete from property where p_id='$pid'");
        if ($rej2) {
            rmdir("../../Uploaded_Images/Property/$pid");
            echo "<script>alert('Property verification Rejected');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 8:
        // REDIRECTED TO DETAIL PAGE OF PROPERTY

        header("Location: ../Admin/admin_prop_detail.php?pid=$pid");
        break;
    case 9:
        // OWNER DELETED

        $del = pg_query($db, "delete from owner_login where username = '$name'"); // delete query
        if ($del) {
            unlink("../../Uploaded_Images/User/Owner/$name.jpg");
            echo "<script>alert('Owner Deleted Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error deleting record"; // display error message if not delete
        }
        break;
    case 10:
        // TENANT DELETED

        $del = pg_query($db, "delete from logindata where username = '$name'"); // delete query
        if ($del) {
            unlink("../../Uploaded_Images/User/Tenant/$name.jpg");
            echo "<script>alert('Tenant Deleted Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error deleting record"; // display error message if not delete
        }
        break;
    case 11:
        // INITIALIZING SESSIONS AFTER SUBMITTING OWNER UPDATE REQUEST

        $Uname = $_GET['Uname'];
        $upd = pg_query($db, "update owner_login set status='updating' where username='$Uname'");
        if ($upd) {
            $_SESSION["Ouname"] = $_GET['Uname'];
            $_SESSION["Oname"] = $_GET['Name'];
            $_SESSION["Odob"] = $_GET['dob'];
            $_SESSION["Ophone"] = $_GET['phone'];
            $_SESSION["Ogender"] = $_GET['gender'];
            echo "<script>alert('Update Requested Successfully');
                window.location.href='../Owner/owner_profile.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error updating record"; // display error message if not delete
        }
        break;
    case 12:
        // OWNER UPDATE REQUEST ACCEPTED

        rename("../../Uploaded_Images/User/Owner/Temp/$_SESSION[Ouname].jpg", "../../Uploaded_Images/User/Owner/$_SESSION[Ouname].jpg");
        $upd1 = pg_query($db, "update owner_login set name='{$_SESSION['Oname']}',gender='{$_SESSION['Ogender']}',dob='{$_SESSION['Odob']}',ph_no='{$_SESSION['Ophone']}',status='accepted' where username='{$_SESSION['Ouname']}'");
        if ($upd1) {
            echo "<script>alert('Owner updated Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 13:
        // OWNER UPDATE REQUEST REJECTED

        unlink("../../Uploaded_Images/User/Owner/Temp/$_SESSION[Ouname].jpg");
        $upd1 = pg_query($db, "update owner_login set status='accepted' where username='{$_SESSION['Ouname']}'");
        if ($upd1) {
            echo "<script>alert('Owner updation rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 14:
        // REDIRECTED TO OWNER UPDATE DATA COMPARISON PAGE

        header("Location: ../Admin/admin_upd_prof.php?Uname=$name&role=owner");
        break;
    case 15:
        // INITIALIZING SESSIONS AFTER SUBMITTING TENANT UPDATE REQUEST

        $Uname = $_GET['Uname'];
        $upd = pg_query($db, "update logindata set status='updating' where username='$Uname'");
        if ($upd) {
            $_SESSION["Tuname"] = $_GET['Uname'];
            $_SESSION["Tname"] = $_GET['Name'];
            $_SESSION["Tdob"] = $_GET['dob'];
            $_SESSION["Tphone"] = $_GET['phone'];
            $_SESSION["Tgender"] = $_GET['gender'];
            echo "<script>alert('Update Requested Successfully');
                window.location.href='../Tenant/tenant_profile.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error updating record"; // display error message if not delete
        }
        break;
    case 16:
        // TENANT UPDATE REQUEST ACCEPTED

        rename("../../Uploaded_Images/User/Tenant/Temp/$_SESSION[Tuname].jpg", "../../Uploaded_Images/User/Tenant/$_SESSION[Tuname].jpg");
        $upd1 = pg_query($db, "update logindata set name='{$_SESSION['Tname']}',gender='{$_SESSION['Tgender']}',dob='{$_SESSION['Tdob']}',ph_no='{$_SESSION['Tphone']}',status='accepted' where username='{$_SESSION['Tuname']}'");
        if ($upd1) {
            echo "<script>alert('Tenant updated Successfully');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 17:
        // TENANT UPDATE REQUEST REJECTED

        unlink("../../Uploaded_Images/User/Tenant/Temp/$_SESSION[Tuname].jpg");
        $upd1 = pg_query($db, "update logindata set status='accepted' where username='{$_SESSION['Tuname']}'");
        if ($upd1) {
            echo "<script>alert('Tenant updation rejected');
                window.location.href='../Admin/admin_home.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 18:
        // REDIRECTED TO TENANT UPDATE DATA COMPARISON PAGE

        header("Location: ../Admin/admin_upd_prof.php?Uname=$name");
        break;
    case 19:
        // INITIALIZING SESSIONS AFTER SUBMITTING PROPERTY UPDATE REQUEST

        $pid = $_GET['Ppid'];
        $upd = pg_query($db, "update property set status='updating' where p_id='$pid'");
        if ($upd) {
            $_SESSION["Ppid"] = $pid;
            $_SESSION["Pname"] = $_GET["Pname"];
            $_SESSION["Paddr"] = $_GET["Paddr"];
            $_SESSION["Pcity"] = $_GET["Pcity"];
            $_SESSION["Proom_type"] = $_GET["Proom_type"];
            $_SESSION["Page"] = $_GET["Page"];
            $_SESSION["Pgender_pref"] = $_GET["Pgender_pref"];
            $_SESSION["Pprop_type"] = $_GET["Pprop_type"];
            $_SESSION["Prent"] = $_GET["Prent"];
            $_SESSION["Pfurn"] = $_GET["Pfurn"];
            $_SESSION["Pabout"] = $_GET["Pabout"];
            $_SESSION["Prules"] = $_GET["Prules"];
            $_SESSION["Pdeposit"] = $_GET["Pdeposit"];
            $_SESSION["img_arr"] = $_GET['img_arr'];
            echo "<script>alert('Update Requested Successfully');
                window.location.href='../Owner/update.php';</script>"; // redirects to all records page
            exit();
        } else {
            echo "Error updating record"; // display error message if not delete
        }
        break;
    case 20:
        // PROPERTY UPDATE REQUEST ACCEPTED

        $img_array = explode(",", $_SESSION["img_arr"]);
        foreach ($img_array as $value => $key) {
            $target_file = $_SESSION["Pname"] . '-' . $value . '.jpg';
            rename("../../Uploaded_Images/Property/Temp/$_SESSION[Ppid]/$target_file", "../../Uploaded_Images/Property/$_SESSION[Ppid]/$target_file");
        }
        rmdir("../../Uploaded_Images/Property/Temp/$_SESSION[Ppid]");
        $upd1 = pg_query($db, "update property set p_name='{$_SESSION['Pname']}',p_addr='{$_SESSION['Paddr']}',p_city='{$_SESSION['Pcity']}',p_bhk='{$_SESSION['Proom_type']}',p_age='{$_SESSION['Page']}',p_gender='{$_SESSION['Pgender_pref']}',p_type='{$_SESSION['Pprop_type']}',p_rent='{$_SESSION['Prent']}',p_furnish='{$_SESSION['Pfurn']}',p_about='{$_SESSION['Pabout']}',p_rules='{$_SESSION['Prules']}',p_deposit='{$_SESSION['Pdeposit']}',images='{$_SESSION['img_arr']}',status='accepted' where p_id='{$_SESSION['Ppid']}'");
        if ($upd1) {
            echo "<script>alert('Property updated Successfully');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 21:
        // PROPERTY UPDATE REQUEST REJECTED

        rmdir("../../Uploaded_Images/Property/Temp/$_SESSION[Ppid]");
        $del = pg_query($db, "update property set status='accepted' where p_id='{$_SESSION['Ppid']}'");
        if ($del) {
            echo "<script>alert('Property updation rejected');
                window.location.href='../Admin/admin_property.php';</script>"; // redirects to all records page
            exit();
        }
        break;
    case 22:
        // REDIRECTED TO PROPERTY UPDATE DATA COMPARISON PAGE

        $pid = $_GET["pid"];
        header("Location: ../Admin/admin_prop_upd.php?pid=$pid");
        break;
}
