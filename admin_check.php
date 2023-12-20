<?php
if($_SESSION['user_level']!='관리자'){
echo "<!DOCTYPE html>
<html>
<head>
    <title>확인 다이얼로그 예시</title>
    <style>
        /* 모달 스타일 */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        /* 모달 내용 스타일 */
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- 모달 다이얼로그 -->
<div id='myModal' class='modal'>
    <div class='modal-content'>
        <p>페이지를 이동하시겠습니까?</p>
        <button id='confirmButton'>확인</button>
    </div>
</div>

<script>
var modal = document.getElementById('myModal');
var confirmButton = document.getElementById('confirmButton');

// 모달 열기
modal.style.display = 'block';

// 확인 버튼 클릭 시 페이지 이동
confirmButton.onclick = function() {
    window.location.href = ".URL."; // 이동하려는 페이지의 URL을 지정
};
</script>

</body>
</html>";
}
?>