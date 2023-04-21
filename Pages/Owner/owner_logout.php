<?php
session_start();
unset($_SESSION["oname"]);
unset($_SESSION["oimage"]);
echo "<script>alert('Logged out successfully');
                window.location.href='../Owner/owner_login.php';</script>";
