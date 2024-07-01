<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $permission_id = $_POST['permission_id'];
    $action = $_POST['action'];

    if ($action == 'delete') {
        $sql = "DELETE FROM permissions WHERE id='$permission_id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Permission deleted!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $status = ($action == 'approve') ? 'approved' : 'rejected';
        $sql = "UPDATE permissions SET status='$status' WHERE id='$permission_id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Permission updated!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$sql = "SELECT p.id, p.reason, p.status, u.username, u.student_id, u.kelas FROM permissions p JOIN users u ON p.user_id=u.id";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style_dashboard_admin.css">
</head>
<body>
    <div class="container">
        <h2>Selamat Datang Mohon Melihat Permiantaan Izin</h2>
        <?php if (isset($message)) { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>
        <h3>Semua Permintaan Izin:</h3>
        <ul class="permission-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li>
                    <div class="permission-info">
                        <p class="info-label">Nama Siswa:</p>
                        <p class="info-value"><?php echo htmlspecialchars($row['username']); ?></p>
                        <br> 
                        <p class="info-label">ID Siswa:</p>
                        <p class="info-value"><?php echo htmlspecialchars($row['student_id']); ?></p>
                        <br> 
                        <p class="info-label">Kelas:</p>
                        <p class="info-value"><?php echo htmlspecialchars($row['kelas']); ?></p>
                        <br> 
                        <p class="info-label">Alasan Izin:</p>
                        <p class="info-value"><?php echo htmlspecialchars($row['reason']); ?></p>
                        <br> 
                        <p class="info-label">Status:</p>
                        <p class="info-value"><?php echo htmlspecialchars($row['status']); ?></p>
                    </div>
                    <form method="post" action="">
                        <input type="hidden" name="permission_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" name="action" value="approve">Terima</button>
                        <button type="submit" name="action" value="reject">Tolak</button>
                        <button type="submit" name="action" value="delete">Hapus</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
        <form method="post" action="logout.php">
            <button type="submit" class="logout">Logout</button>
        </form>
    </div>
</body>
</html>


<?php
$conn->close();
?>
