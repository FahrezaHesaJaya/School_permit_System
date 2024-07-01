<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include('db.php');
$role = $_SESSION['role'];

if ($role == 'siswa') {
    include('siswa_dashboard.php');
} elseif ($role == 'guru') {
    include('guru_dashboard.php');
} else {
    include('admin_dashboard.php');
}


?>
