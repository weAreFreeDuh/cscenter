<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button id="popupButton">팝업 열기</button>

<!-- 견적서 요청 팝업 -->
<div id="popup" class="popup">
    <p class="fs">신규입력</p>
    <div class="PopUp_input_wrap">
        <div class="input-box">
            <p class="input-title">고객명</p>
            <input id="company_name" type="text" class="input" placeholder="고객명">
        </div>
        <div class="input-box">
            <p class="input-title">생년월일</p>
            <input id="company_name" type="text" class="input" placeholder="생년월일">
        </div>
        <div class="input-box">
            <p class="input-title">연락처</p>
            <input id="company_name" type="text" class="input" placeholder="연락처">
        </div>
        <div class="input-box">
            <p class="input-title">디비종류</p>
            <input id="name_estimate" type="text" class="input" placeholder="디비종류">
        </div>
        <div class="input-box">
            <p class="input-title">진행상황</p>
            <input id="phone" type="text"  placeholder="진행상황">
        </div>
        <div class="input-box re-po">
            <p class="input-title">병력</p>
            <textarea class="textarea" placeholder="병력"></textarea>
        </div>

    </div>
    <div class="PopUp_btn_wrap">
        <button class="button" id="close" onclick="closeEstimatePopup()">닫기</button>
        <button class="button" onclick="registrationEstimate()">확인</button>
    </div>
</div>
</body>
<script>
    // 팝업 js
    console.log(123);
    const popupButton = document.getElementById('popupButton');
    const popup = document.getElementById('popup');
    const close = document.getElementById('close');

    console.log(popupButton);
    console.log(popup);
    console.log(close);

    popupButton.addEventListener('click', () => {
        popup.style.display = 'block';
    });

    close.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });

    function popupButton1(){
        popupButton.addEventListener('click', () => {
        popup.style.display = 'block';
    });
    }

</script>
</html>