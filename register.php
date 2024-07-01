<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style_register.css">
</head>
<body>
    <div class="container">
        <?php
        include('db.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];
            $student_id = $_POST['student_id'];
            $kelas = $_POST['kelas']; 
            $wali_kelas = $_POST['wali_kelas']; 
        
            $sql = "INSERT INTO users (username, password, role, student_id, kelas, wali_kelas) VALUES ('$username', '$password', '$role', '$student_id', '$kelas', '$wali_kelas')";
        
            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-message'>Registration successful!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        
        ?>
        <h2>Register</h2>
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
                <label for="student_id">ID Siswa:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" required>
            </div>
            <div class="form-group">
                <label for="wali_kelas">Nama Wali Kelas:</label>
                <input type="text" id="wali_kelas" name="wali_kelas" required>
            </div>
            <div class="form-group">
                <label for="role">Daftar Sebagai:</label>
                <select name="role">
                    <option value="siswa">Siswa</option>
                </select>
            </div>
            <input type="submit" value="Register">
        </form>
        <a href="index.php">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>



