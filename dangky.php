<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration"; // Cơ sở dữ liệu user_registration

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $gioi_tinh = mysqli_real_escape_string($conn, $_POST['Gt']);

    // Kiểm tra email đã tồn tại hay chưa
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Nếu email đã tồn tại, thông báo lỗi
        echo "Email này đã được sử dụng, vui lòng chọn email khác!";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thêm dữ liệu vào cơ sở dữ liệu (bảng users)
        $sql = "INSERT INTO users (name, email, password, gioi_tinh) VALUES ('$name', '$email', '$hashed_password', '$gioi_tinh')";

        if ($conn->query($sql) === TRUE) {
            // Đăng ký thành công, chuyển hướng sang trang dangnhap.html
            header('Location: dangnhap.html');
            exit(); // Thêm exit() để đảm bảo không có mã nào được thực thi sau khi chuyển hướng
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Đóng kết nối
$conn->close();
?>
