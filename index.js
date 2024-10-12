// Hàm để hiển thị ngày tháng
function displayDate() {
  const today = new Date();
  const day = today.getDate();
  const month = today.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng 1
  const year = today.getFullYear();
  const formattedDate = `${day}/${month}/${year}`;

  const ngayThangElement = document.getElementById("ngayThang");
  if (ngayThangElement) {
    ngayThangElement.textContent = `Ngày hôm nay: ${formattedDate}`;
  } else {
    console.error("Không tìm thấy phần tử với ID 'ngayThang'");
  }
}

// Hàm điểm danh
function diemDanh() {
  const userId = "<?php echo $_SESSION['user_id']; ?>"; // Lấy userId từ PHP
  const today = new Date();

  const lastCheckIn = localStorage.getItem(`lastCheckIn_${userId}`);
  let scoreCount = Number(localStorage.getItem(`scoreCount_${userId}`)) || 0;

  if (lastCheckIn) {
    const lastDate = new Date(lastCheckIn);

    // So sánh ngày hiện tại với ngày điểm danh cuối cùng
    if (today.toDateString() === lastDate.toDateString()) {
      alert("Bạn đã điểm danh hôm nay rồi!");
      return; // Ngăn điểm danh nhiều lần trong cùng 1 ngày
    }

    const dayDiff = Math.floor((today - lastDate) / (1000 * 60 * 60 * 24));

    if (dayDiff > 1) {
      // Nếu đã không điểm danh trong một ngày, reset điểm
      scoreCount = 0;
    }
  }

  // Tăng số lần tích điểm
  scoreCount++;

  // Lưu ngày hiện tại và số lần tích điểm vào localStorage
  localStorage.setItem(`lastCheckIn_${userId}`, today.toISOString());
  localStorage.setItem(`scoreCount_${userId}`, scoreCount);

  // Hiển thị số lần tích điểm
  const soNgayLienTiepElement = document.getElementById("soNgayLienTiep");
  if (soNgayLienTiepElement) {
    soNgayLienTiepElement.textContent = `Số lần tích điểm: ${scoreCount}`;
  } else {
    console.error("Không tìm thấy phần tử với ID 'soNgayLienTiep'");
  }
}

// Hiển thị ngày tháng và số lần tích điểm khi tải trang
window.onload = function () {
  displayDate();

  const userId = "<?php echo $_SESSION['user_id']; ?>"; // Lấy userId từ PHP
  const scoreCount = Number(localStorage.getItem(`scoreCount_${userId}`)) || 0;

  // Hiển thị số lần tích điểm
  const soNgayLienTiepElement = document.getElementById("soNgayLienTiep");
  if (soNgayLienTiepElement) {
    soNgayLienTiepElement.textContent = `Số lần tích điểm: ${scoreCount}`;
  } else {
    console.error("Không tìm thấy phần tử với ID 'soNgayLienTiep'");
  }
};

// Thêm sự kiện cho nút "Điểm danh"
document.getElementById("diemDanhBtn").addEventListener("click", diemDanh);
