<?php
session_start();
unset($_SESSION["aname"]);
echo "<script>alert('Logged out successfully');
                window.location.href='../Admin/admin_login.php';</script>";
