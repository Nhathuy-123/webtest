<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu người dùng chưa đăng nhập thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
  header('Location: dangnhap.html');
  exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="tro_choi.css">
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <body>
    <!--Header-->
    <script src="script.js"></script>
    <!--home-->
    <div id="head">
      <div id="quick" title="Trang chủ">
        <a href="index.html">
            <img src="logoq.png" alt="trang chu">
        </a>
    </div>
      <div class="muc_1">
        <a class="demuc" href="index.html">
          <img id="game1" src="home.png" alt="game" />
          <br />
          <span class="title"> Trở về </span>
        </a>
      </div>
      <div class="mid">
        <!--search-->
        <div class="search">
          <form id="search-form">
            <input type="text" id="nhap_vao" placeholder="Tìm Kiếm" />
          </form>
          <!--Game-->
          <div class="main">
            <div class="muc_1" class="main" style="background-color: gold;">
              <a class="demuc" href="tro_choi.html">
                <img id="game1" src="Game.png" alt="game" />
                <br />
                <span class="title"> Trò chơi </span>
              </a>
            </div>
          </div>
          <!--community-->
          <div class="muc_1">
            <a class="demuc" href="cong_dong.html">
              <img id="game1" src="community.png" alt="game" />
              <br />
              <span class="title"> Cộng đồng </span>
            </a>
          </div>
          <!--timetable-->
          <div class="muc_1">
            <a class="demuc" href="lich_trinh.html">
              <img id="game1" src="timetable.png" alt="game" />
              <br />
              <span class="title"> Lịch trình </span>
            </a>
          </div>
          <!--Liên hệ-->
          <div class="muc_1">
            <a class="demuc" href="lienhe.html">
              <img id="game1" src="phone.png" alt="game" />
              <br />
              <span class="title"> Liên hệ </span>
            </a>
          </div>
          <!--thong báo-->
          <div class="muc_2" title="Thông báo">
            <a class="demuc0" href="#" onclick="toggleNotification()">
              <img id="game1" src="chuong.png" alt="Thông báo" />
            </a>
            <div id="notification-box" class="hidden">
              <p>Thông báo 1</p>
              <p>Thông báo 2</p>
              <p>Thông báo 3</p>
            </div>
          </div>
          <div><!-- <div id="search-results"></div> --></div>
        </div>
        <!--sign up -->
        <a href="./dangnhap.html" class="dang_nhap">Đăng nhập</a>
      </div>
      <br />
      </div>
        <!--sign up -->
        <a href="./dangky.html" class="dang_ky">Đăng ký</a>
      </div>
    </div>
    <hr />
    <h1>Trò Chơi</h1>
    <div class="container">
      <div class="muc_3" title="Toán">
        <a class="demuc3" href="./game/toan.html">
          <img id="game3" src="Toan.png" alt="game" />
          <br />
          <span class="title3"> <b class="lien">Môn Toán </span>
        </a>
      </div>
      <div class="muc_3" title="Tiếng Anh">
        <a class="demuc3" href="./game/Tieng_anh.html">
          <img id="game3" src="tienganh.png" alt="game" />
          <br />
          <span class="title3"> <b class="lien">Môn Tiếng Anh </span>
        </a>
      </div>
      <div class="muc_3" title="Khoa Học Tự Nhiên">
        <a class="demuc3" href="./game/Ngu_van.html">
          <img id="game3" src="KHTN.png" alt="game" />
          <br />
          <span class="title3"> <b class="lien">Môn Khoa Học Tự Nhiên </span>
        </a>
      </div>
  </div>
  
    <script src="script.js"></script>
    <script src="thong_bao.js"></script>
  </body>
</html>
