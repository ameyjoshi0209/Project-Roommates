<?php
session_start();
session_destroy();
echo "<script>alert('Logged out successfully');
                window.location.href='../Admin/admin_login.php';</script>";
