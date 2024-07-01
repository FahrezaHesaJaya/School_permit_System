<?php
include('db.php');
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['student_id'] = $row['student_id']; 
            $_SESSION['kelas'] = $row['kelas']; 

            
            if ($row['role'] == 'admin') {
                header("location: admin_dashboard.php");
            } else {
                header("location: dashboard.php");
            }
            exit;
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username and role.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Login as:</label>
                <select id="role" name="role" required>
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <input type="submit" value="Login">
        </form>
        <a href="register.php">Register</a>
    </div>
</body>
</html>
