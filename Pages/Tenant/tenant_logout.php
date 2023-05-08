<?php
session_start();
unset($_SESSION["uname"]);
unset($_SESSION["uimage"]);
echo "<script>alert('Logged out successfully');
                window.location.href='../Tenant/login.php';</script>";
