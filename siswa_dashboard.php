<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reason'])) {
    $reason = $_POST['reason'];

    $sql = "INSERT INTO permissions (user_id, reason) VALUES ('$user_id', '$reason')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Permission request submitted!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM permissions WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Siswa Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style_dashboard_siswa.css">
</head>
<body>
    <div class="user-info">
        <p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <p>ID Siswa: <?php echo htmlspecialchars($_SESSION['student_id']); ?></p>
        <p>Kelas: <?php echo htmlspecialchars($_SESSION['kelas']); ?></p>
    </div>
    <div class="container">
        <h2>Silahkan Mengisi formulir Permintaan Izin di Bawah</h2>
        <?php if (isset($success_message)) { ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php } elseif (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="reason">Mohon Menuliskan Surat Izin Anda Di Form Ini:</label>
                <textarea id="reason" name="reason" required></textarea>
            </div>
            <input type="submit" value="Ajukan Izin">
        </form>

        <h3>Status Izin Anda:</h3>
        <ul class="permission-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li>
                    <div class="permission-info">
                        <span class="reason"><?php echo htmlspecialchars($row['reason']); ?></span>
                        <span class="status <?php echo strtolower($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></span>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <form method="post" action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
