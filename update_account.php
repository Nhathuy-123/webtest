<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu người dùng chưa đăng nhập thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: dangnhap.html');
    exit();
}

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy user_id từ session
    $user_id = $_SESSION['user_id'];

    // Lấy dữ liệu từ form và kiểm tra đầu vào
    $new_name = trim($_POST['name']);
    $new_password = trim($_POST['password']);

    // Kiểm tra tên và mật khẩu có hợp lệ không
    if (strlen($new_name) >= 5 && strlen($new_name) <= 20 && strlen($new_password) >= 8 && strlen($new_password) <= 20) {
        // Mã hóa mật khẩu mới
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Sử dụng Prepared Statements để cập nhật dữ liệu
        // Giả sử cột trong bảng là 'id' thay vì 'user_id'
        $stmt = $conn->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");

        $stmt->bind_param("ssi", $new_name, $hashed_password, $user_id);

        if ($stmt->execute()) {
            // Cập nhật lại session để lưu tên mới
            $_SESSION['name'] = $new_name;
            echo "Cập nhật thành công!";
            // Chuyển hướng về trang tài khoản sau khi cập nhật
            header('Location: tk.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }

        // Đóng prepared statement
        $stmt->close();
    } else {
        echo "Dữ liệu không hợp lệ.";
    }
}

// Đóng kết nối
$conn->close();
?>
