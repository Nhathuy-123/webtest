<?php
session_start(); // Bắt đầu session để lưu trữ thông tin người dùng

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration"; // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Truy vấn để kiểm tra email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Nếu email tồn tại, lấy thông tin mật khẩu được lưu trữ
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Kiểm tra mật khẩu nhập vào có khớp với mật khẩu đã mã hóa trong cơ sở dữ liệu không
        if (password_verify($password, $hashed_password)) {
            // Đăng nhập thành công, lưu trữ thông tin vào session
            $_SESSION['user_id'] = $row['id']; // Lưu ID người dùng vào session
            $_SESSION['name'] = $row['name']; // Lưu tên người dùng vào session

            // Chuyển hướng tới trang chính sau khi đăng nhập thành công
            header('Location: trangchu.php');
            exit();
        } else {
            // Mật khẩu không đúng
            echo "Mật khẩu không đúng. Vui lòng thử lại!";
        }
    } else {
        // Email không tồn tại
        echo "Email không tồn tại. Vui lòng đăng ký trước!";
    }
}

// Đóng kết nối
$conn->close();
?>
