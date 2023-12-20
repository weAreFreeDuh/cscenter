<?php include_once('header.php') ?>

<?php
if (($_SESSION['mb_level'] == 1)) {
} else {
    alert_URL('관리자 전용입니다');
    exit;
}
include_once('backStyle.php')
?>
<style>
    table tbody tr {
    height: 50px; /* 적절한 높이로 설정 */
    }
    .table{
        height: 50%;
        margin: 0px 20px;
    }
    
    
</style>

<input type="hidden" id="user_level" value="<?= $user_level ?>">
<input type="hidden" id="user_id" value="<?= $user_id ?>">



<div class="nowrap">
    <!-- <select id="slot_option">
        <?php if ($user_level == '관리자') { ?>
            <option value="user_id">회원아이디</option>
        <?php } ?>

        <option value="keyword">키워드</option>
        <option value="item_key">아이템키</option>
        <option value="slot_name">슬롯명</option>
    </select>

    <input class="input" type='text' id='slot_search' style="width:30%;">

    <button onclick="slot_search()" class="button">검색</button>
    <label class="table_label">남은 슬롯 <span id="availableSlotCount"></span> 개 가능합니다</label> -->

</div>

<div class="just_between">
    <div style="display:inline">
        <!-- <select>
            <option></option>
            <option></option>
        </select> -->
        <!-- <input type="date" class="date fs" id="start-date" name="start-date">
        <input type="date" class="date fs" id="end-date" name="end-date"> -->
    </div>

    <div style="display:inline">

        <!-- <button class="button_option fs" onclick="getSelectedDates()">엑셀 다운로드</button>
        <select>
            <option></option>
            <option></option>
        </select> -->
    </div>
</div>
<!-- 테이블 묶음 -->
<div class="main">
    <div class="table-container" style="display:flex; justify-content: space-between; height:50%">
        <table class="table" style=" width:20%;">
            <thead>
                <tr>
                    <th scope="col" class="suject">선택</th>
                    <th scope="col">등급</th>
                </tr>
            </thead>
            <tbody id="table_body_grade">
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_grade" id=chk_0><input type="hidden"
                            name="ck_no" class="number" value=1></td>
                    <td scope="col"><input type="text" class="input" value="test"></td>
                </tr>
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_grade" id=chk_1><input type="hidden"
                            name="ck_no" class="number" value=2></td>
                    <td scope="col"><input type="text" class="input" value="test22"></td>
                </tr>

            </tbody>
        </table>

        <table class="table" style=" width:20%;">
            <thead>
                <tr>
                    <th scope="col" class="suject">선택</th>
                    <th scope="col">진행사항</th>
                </tr>
            </thead>
            <tbody id="table_body_category">
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_group" id=chk_0></td>
                    <td scope="col"><input type="text" class="input" value="group"></td>
                </tr>
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_group" id=chk_1></td>
                    <td scope="col"><input type="text" class="input" value="group"></td>
                </tr>


            </tbody>
        </table>

        <table class="table" style=" width:20%;">
            <thead>
                <tr>
                    <th scope="col" class="suject">선택</th>
                    <th scope="col">소속</th>
                </tr>
            </thead>
            <tbody id="table_body_group">
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_category" id=chk_0></td>
                    <td scope="col"><input type="text" class="input" value="cate"></td>
                </tr>
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_category" id=chk_1></td>
                    <td scope="col"><input type="text" class="input" value="cate2"></td>
                </tr>


            </tbody>
        </table>

        <table class="table" style=" width:20%;">
            <thead>
                <tr>
                    <th scope="col" class="suject">선택</th>
                    <th scope="col">DB 유형</th>
                </tr>
            </thead>
            <tbody id="table_body_db">
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_category" id=chk_0></td>
                    <td scope="col"><input type="text" class="input" value="cate"></td>
                </tr>
                <tr class="fixed-height">
                    <td scope="col" class="suject"><input type="checkbox" name="chk_category" id=chk_1></td>
                    <td scope="col"><input type="text" class="input" value="cate2"></td>
                </tr>


            </tbody>
        </table>

        <div>
            <!-- 페이지 -->
        </div>
    </div>
</div>
<div class="just_right cloumn" style="margin:15px;">
    <input type="button" value="체크삭제" class="button fs" style="background-color: white;" id="deleteBtn">
    <input type="button" value="체크수정" class="button fs_w" id="selectBtn">
    <input type="button" value="소속입력" class="button fs_w" id="popupButton">
    <input type="button" value="디비유형입력" class="button fs_w" id="popupButton2">
</div>



<style>
    .PopUp_input_wrap .input-title {
        position: absolute;
        top: 18%;
        transform: translateY(-50%);
        left: 40px;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: -0.45px;
        color: #303030;
    }

    .PopUp_input_wrap .input-box {
        position: relative;
        width: 720px;
        margin-bottom: 16px;
    }

    .PopUp_input_wrap .input-box .company_name {
        width: 100%;
        height: 60px;
        border-radius: 36px;
        border: unset;
        padding: 0 24px 0 165px;
        font-weight: 500;
        color: #303030;
        border-radius: 24px;
        border: solid 1px #e4e4e4;
        background-color: #fff;
    }

    #company_name {
        width: 100%;
        height: 60px;
        border-radius: 36px;
        border: unset;
        padding: 0 24px 0 165px;
        font-weight: 500;
        color: #303030;
        border-radius: 24px;
        border: solid 1px #e4e4e4;
        background-color: #fff;
    }

    .input-box textarea {
        width: 100%;
        height: 257px;
        padding: 70px 40px 10px;
        outline: unset;
        border: unset;
        border-radius: 36px;
        font-weight: 500;
        border: solid 0.5px #e4e4e4;
        background-color: #fff;
    }

    .repo .input-title {
        top: 26px;
        left: 40px;
    }
</style>

<!-- 견적서 요청 팝업 -->
<div id="popup" class="popup">
    <p class="fs flex_center">소속추가</p>
    <form action="../controller/otherController.php" method="post">

        <input type="hidden" name="group_import" value="group_import">
        <input type="hidden" name="gp_value" value="mb_group">

        <div class="PopUp_input_wrap">
            <div class="input-box">
                <p class="input-title">소속명</p>
                <input id="company_name" type="text" class="input" name="gp_name" placeholder="소속명">
            </div>

        </div>
        <div class="PopUp_btn_wrap just_right">

            <input type="button" id="close" class="button fs_w" value="닫기">
            <input type="button" class="button fs_w" onclick="groupImport()" id="group_import_btn" value="확인">

        </div>
    </form>
</div>

<!-- 견적서 요청 팝업 -->
<div id="popup2" class="popup">
    <p class="fs flex_center">디비유형추가</p>
    <form action="../controller/otherController.php" method="post">

        <input type="hidden" name="db_import" value="db_import">
        <input type="hidden" name="db_value" value="db_ct">

        <div class="PopUp_input_wrap">
            <div class="input-box">
                <p class="input-title">디비유형</p>
                <input id="company_name" type="text" class="input" name="db_name" placeholder="디비유형">
            </div>

        </div>
        <div class="PopUp_btn_wrap just_right">
            <input type="button" id="close2" class="button fs_w" value="닫기">
            <input type="button" class="button fs_w" onclick="dbImport()" id="db_import_btn" value="확인">
        </div>
    </form>
</div>


</div>



<!-- 신규 추가 -->


</div>
<script>
    function groupImport() {
        console.log(12312123);
        // 버튼 요소 가져오기
        var importButton = $('#group_import_btn');

        // 해당 버튼 요소를 사용하여 submit() 함수 호출
        if (importButton) {
            importButton.get(0).form.submit();
        }

        // 페이지 리로드
    }
    function dbImport() {
        // console.log(12312123);
        // 버튼 요소 가져오기
        var importButton = $('#db_import_btn');

        // 해당 버튼 요소를 사용하여 submit() 함수 호출
        if (importButton) {
            importButton.get(0).form.submit();
        }

        // 페이지 리로드
    }
</script>

<script>
    // 팝업 js
    console.log(123);
    const popupButton = document.getElementById('popupButton');
    const popup = document.getElementById('popup');
    const close = document.getElementById('close');

    const popupButton2 = document.getElementById('popupButton2');
    const popup2 = document.getElementById('popup2');
    const close2 = document.getElementById('close2');

    // console.log(popupButton);
    // console.log(popup);
    // console.log(close);

    popupButton.addEventListener('click', () => {
        popup.style.display = 'flex';
        document.body.style.overflow = "hidden"; // 스크롤 잠금
        popup.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
    });

    close.addEventListener('click', () => {
        popup.style.display = 'none';
        document.body.style.overflow = "auto"; // 스크롤 잠금 해제
        popup.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    });

    popupButton2.addEventListener('click', () => {
        popup2.style.display = 'flex';
        document.body.style.overflow = "hidden"; // 스크롤 잠금
        popup2.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
    });

    close2.addEventListener('click', () => {
        popup2.style.display = 'none';
        document.body.style.overflow = "auto"; // 스크롤 잠금 해제
        popup2.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    });


</script>

<script src="<?= FRONT_JS_URL ?>/category.js"></script>
<?php include_once('footer.php') ?>