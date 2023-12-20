<!DOCTYPE html>
<html>
<head>
  <title>메인 페이지</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- PHP 코드로 동적으로 생성된 팝업 -->
  <?php
  if(isset($_COOKIE['popup_shown']) && $_COOKIE['popup_shown'] == 'true') {
      // 팝업을 이미 본 경우
      echo '<p>팝업을 이미 본 경우</p>';
  } else {
      // 팝업을 처음 본 경우
      setcookie('popup_shown', 'true', time() + (86400 * 30), '/'); // 쿠키 설정
      echo '<div class="popup-overlay">
              <div class="popup-content">
                <h2>팝업 내용</h2>
                <p>이곳에 팝업에 보여줄 내용을 작성하세요.</p>
                <button id="close-popup">닫기</button>
              </div>
            </div>';
  }
  ?>

  <script>
    $(document).ready(function() {
      // 팝업 닫기 버튼 클릭 시
      $("#close-popup").click(function() {
        $(".popup-overlay").fadeOut();
      });
    });
  </script>
</body>
</html>