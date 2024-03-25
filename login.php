<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>

    <?php
    session_start();
    // Kiểm tra xem có request POST từ form đăng nhập không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kết nối đến cơ sở dữ liệu
        $dsn = "mysql:host=localhost:3306;dbname=ql_nhansu;charset=utf8mb4";
        $username_db = "root";
        $password_db = "Mwg@0849446439";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $username_db, $password_db, $options);
        } catch (PDOException $e) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage());
        }


        $username = $_POST['username'];
        $password = $_POST['password'];

        // Truy vấn để kiểm tra thông tin đăng nhập
        $sql = "SELECT * FROM User WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            // Đăng nhập thành công, chuyển hướng đến trang dashboard hoặc trang chính của ứng dụng
            header("Location: list_nhanvien.php");
            exit;
        } else {
            // Đăng nhập không thành công, hiển thị thông báo lỗi
            echo "<p>Username hoặc password không chính xác.</p>";
        }
    }
    ?>
</body>

</html>