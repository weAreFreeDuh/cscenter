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
    .member th:nth-child(1),
    .member th:nth-child(2) {
        width: 1%;
        /* 첫 번째 th의 너비를 20%로 설정 */
    }

    .member th:nth-child(3),
    .member th:nth-child(4),
    .member th:nth-child(5) {
        width: 10%;
        /* 첫 번째 th의 너비를 20%로 설정 */
    }

    .member th:nth-child(6),
    .member th:nth-child(7) {
        width: 20%;
        /* 첫 번째 th의 너비를 20%로 설정 */
    }

    .member th:nth-child(8) {
        width: 10%;
        /* 첫 번째 th의 너비를 20%로 설정 */
    }

    td {
        height: 50px !important;
        text-align: center;
    }
</style>


<input type="hidden" id="mb_level" value="<?= $mb_level ?>">
<input type="hidden" id="mb_id" value="<?= $mb_id ?>">



<div class="nowrap">
    <!-- <select id="slot_option">
        <?php if ($mb_level == '관리자') { ?>
            <option value="mb_id">회원아이디</option>
        <?php } ?>

        <option value="keyword">키워드</option>
        <option value="item_key">아이템키</option>
        <option value="slot_name">슬롯명</option>
    </select> -->

    <!-- <input class="input" type='text' id='slot_search' style="width:30%;"> -->

    <!-- <button onclick="slot_search()" class="button">검색</button>
    <label class="table_label">남은 슬롯 <span id="availableSlotCount"></span> 개 가능합니다</label> -->

</div>
<div class="nowrap">
    <select id="cust_keyword" class="fs">
        <option value="mb_id">아이디</option>
        <option value="mb_name">이름</option>
        <option value="mb_email">이메일</option>
        <option value="mb_tel">전화번호</option>
    </select>

    <input class="input" type='text' id='cust_search' style="width:30%;">

    <button onclick="member_list()" class="button fs_w">검색&적용</button>
    <!-- <label class="table_label">남은 슬롯 <span id="availableSlotCount"></span> 개 가능합니다</label> -->
</div>

<div class="just_between">
    <!-- <div style="display:inline">
        <select id="grade" onchange="change()">
            <option value="all">전체등급</option>
            <option value="최고관리자">최고관리자</option>
            <option value="중간관리자">중간관리자</option>
            <option value="팀원">팀원</option>
        </select>

        <select id="group" onchange="change()">
            <option value="all">모든소속</option>
            <option value="팀1">팀1</option>
            <option value="팀2">팀2</option>
            <option value="팀3">팀3</option>
        </select>
    </div> -->

    <div style="display:inline">
        <select id="grade" class="fs">
            <option value="">모든소속</option>
            <option value="팀1">팀1</option>
            <option value="팀2">팀2</option>
            <option value="팀3">팀3</option>
        </select>
        <select id="group" class="fs">
            <option value="">모든소속</option>
            <option value="팀1">팀1</option>
            <option value="팀2">팀2</option>
            <option value="팀3">팀3</option>
        </select>

    </div>

    <div style="display:inline">

        <!-- <button class="button_option fs" onclick="getSelectedDates()">엑셀 다운로드</button> -->

        <!-- <select id="list" onchange="updateListValue()">
            <option value="20">기본</option>
            <option value="20">20</option>
            <option value="5">5</option>
            <option value="3">5</option>
        </select> -->
        <select id="list" class="fs">
            <option value="20">기본</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="2">2</option>
        </select>
    </div>
</div>
<!-- 테이블 묶음 -->
<div class="main">
    <label class="fs" style="margin:20px 10px; display: block;"> 총 <span id="total">8</span>개 조회</label>
    <div class="table-container" style="display:flex; justify-content: space-between; height:50%">
        <table class="table member" style='width:70%;'>
            <thead>
                <tr>
                    <th scope="col">선택</th>
                    <th scope="col">no</th>
                    <th scope="col">등급</th>
                    <th scope="col">소속</th>
                    <th scope="col">이름</th>
                    <th scope="col">이메일</th>
                    <th scope="col">연락처</th>
                    <th scope="col">기능</th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>
        </table>

        <table class="table" style=" width:29%; height:50%;">
            <thead>
                <tr>
                    <th scope="col" class="suject">등급</th>
                    <th scope="col">설명</th>
                </tr>
            </thead>
            <tbody id="table_body_member">
                <tr>
                    <th scope="col" class="suject">이름</th>
                    <td scope="col"><input type="text" class="input"></td>
                </tr>
                <tr>
                    <th scope="col" class="suject">소속</th>
                    <td scope="col"><input type="text" class="input"></td>
                </tr>
                <tr>
                    <th scope="col" class="suject">등급</th>
                    <td scope="col"><input type="text" class="input"></td>
                </tr>
                <tr>
                    <th scope="col" class="suject">연락처</th>
                    <td scope="col"><input type="text" class="input"></td>
                </tr>
                <tr>
                    <th scope="col" class="suject">이메일</th>
                    <td scope="col"><input type="text" class="input"></td>
                </tr>
                <tr colspan="3">
                    <th scope="col" class="suject">메모</th>
                    <td><textarea class="input"></textarea></td>
                </tr>

            </tbody>
        </table>
    </div>
    <div id="pageNum" style="text-align: center; ">
        <!-- 페이지 -->
    </div>
</div>
<div class="just_right" style="margin:15px;">
    <!-- <input type="button" value="체크삭제" class="button fs" style="background-color: white;"> -->
    <input type="button" value="체크수정" class="button fs_w" onclick="member_modify()">
    <!-- <input type="button" value="신규입력" class="button fs_w" id="popupButton"> -->
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
    <p class="fs flex_center">비밀번호 변경</p>
    <form action="../login/login.php" method="post">

        <input type="hidden" name="member_import" value="member_changePw">
        <input type="hidden" id="mb_no_pw" name="mb_no_pw" value="">

        <div class="PopUp_input_wrap">
            <div class="input-box">
                <p class="input-title">비밀번호</p>
                <input id="company_name" type="password" class="input" name="mb_pwd" id="mb_pwd" placeholder="비밀번호">
            </div>

        </div>
        <div class="PopUp_btn_wrap just_right">
            <input type="button" id="close" class="button fs_w" value="닫기">
            <input type="button" class="button fs_w" onclick="member_changePw()" id="member_change_btn" value="확인">
        </div>
    </form>
</div>

<!-- 견적서 요청 팝업 -->
<div id="popup2" class="popup">
    <p class="fs flex_center">그룹 추가</p>
    <form action="../member/memberController.php" method="post">

        <input type="hidden" name="member_import" value="member_add">
        <input type="hidden" id="mb_no_add" name="mb_no_add" value="">
        <input type="hidden" id="checkboxValues" name="checkboxValues" value="">

        <div class="PopUp_input_wrap">
            <div class="input-box">
                <div style="margin-left: 30px" class="category_check" id="chkGroupMiddle">
                    
                </div>
            </div>
        </div>
        <div class="PopUp_btn_wrap just_right">
            <input type="button" id="close2" class="button fs_w" value="닫기">
            <input type="button" class="button fs_w" onclick="member_add()" id="member_add_btn" value="확인">
        </div>
    </form>
</div>

<?php include_once('footer.php') ?>

</body>
<script>
    let pageNum = $("#pageNum");
    let tableBody = $("#table_body");
    var tableBodyMem = $("#table_body_member");
    let common_url = "../controller/commonController.php";
    //console.log(common_url);

    let url = "../member/memberController.php";

    $(document).ready(function () {
        //category_load();
        mb_group_load();
        grade_load();
        member_list();

    });

    function member_list(page = 1) {
        let cust_keyword = $('#cust_keyword').val();
        let cust_search = $('#cust_search').val();
        let gp_no = $('#group').val();
        let gd_no = $('#grade').val();
        let list = $('#list').val();
        $.ajax({
            type: "POST",
            url: common_url,
            data: {
                action: "member_list",
                cust_keyword: cust_keyword,
                cust_search: cust_search,
                gd_no: gd_no,
                gp_no: gp_no,
                list: list,
                page: page,
            },
            dataType: "json",
            success: function (data) {

                console.log('member_list success');
                console.log(data);

                tableBody.empty();
                tableBody.append(BodyTableHTML(data));

                var pagingDiv = generatePagination(cust_keyword, cust_search, gp_no, gd_no, list, page, data['paging']['block_start'], data['paging']['block_end'], data['paging']['total_page']);
                console.log(pagingDiv);
                pageNum.empty();
                pageNum.append(pagingDiv);

                console.log(data['paging']['total']);
                $('#total').text(data['paging']['total']);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    //'${cust_keyword}', '${cust_search}', '${gp_no}', '${gd_no}', '${list}', '${page}'
    function member_list_paging(cust_keyword, cust_search, gp_no, gd_no, list, page) {
        console.log(cust_keyword);
        console.log(cust_search);
        console.log(gp_no);
        console.log(gd_no);
        console.log(list);
        console.log(page);
        $.ajax({
            type: "POST",
            url: common_url,
            data: {
                action: "member_list",
                cust_keyword: cust_keyword,
                cust_search: cust_search,
                gd_no: gd_no,
                gp_no: gp_no,
                list: list,
                page: page,
            },
            dataType: "json",
            success: function (data) {

                console.log('member_list success');
                //console.log(data);

                tableBody.empty();
                tableBody.append(BodyTableHTML(data));

                var pagingDiv = generatePagination(cust_keyword, cust_search, gp_no, gd_no, list, page, data['paging']['block_start'], data['paging']['block_end'], data['paging']['total_page']);
                // console.log(pagingDiv);
                pageNum.empty();
                pageNum.append(pagingDiv);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function member_view() {
        var member_rd = $("input[name=member_rd]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
        if (member_rd.length >= 1) {
            var tr = member_rd.closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            var num = td.eq(0).find('.number').val();
            console.log(num);
        }

        $.ajax({
            type: "POST",
            url: url,
            data: {
                mb_no: num,
                action: "member_view",
            },
            dataType: "json",
            success: function (data) {

                var option_grade = "";
                var option_group = "";
                var tmp = "";
                var tmp2 = "";

                console.log("view_success");
                //console.log(data);

                tableBodyMem.empty();
                var messageDiv = ""


                messageDiv += '<tr><th scope="col" class="suject">이름</th>';
                messageDiv += '<input type="hidden" id="mb_no" value="' + data[0].mb_no + '" >';
                messageDiv += '<td scope="col" ><input type="text" class="input" id="mb_name" value="' + data[0].mb_name + '"></tr>';
                messageDiv += '<tr><th scope="col" class="suject">등급</th> <td scope="col" >';

                messageDiv += '<select id="gd_no">'
                for (var i = data['grade'].length-1; i >= 0; i--) {
                    if (data['grade'][i].gd_name == data[0].gd_name) { tmp = "selected" }
                    else { tmp = "" }
                    option_grade += '<option value="' + data['grade'][i].gd_no + '" ' + tmp + '>' + data['grade'][i].gd_name + '</option>';
                }
                messageDiv += option_grade;
                messageDiv += '</select></tr>';
                messageDiv += '<tr><th scope="col" class="suject">소속</th> <td scope="col" >';

                messageDiv += '<select id="gp_no">'
                for (var i = 0; i < data['mb_group'].length; i++) {
                    if (data['mb_group'][i].gp_name == data[0].gp_name) { tmp2 = "selected" }
                    else { tmp2 = "" }
                    option_group += '<option value="' + data['mb_group'][i].gp_no + '" ' + tmp2 + '>' + data['mb_group'][i].gp_name + '</option>';
                }
                messageDiv += option_group;
                messageDiv += '</select></tr>';

                messageDiv += '<tr><th scope="col" class="suject">연락처</th>';
                messageDiv += '<td scope="col" ><input type="text" class="input" id="mb_tel" value="' + data[0].mb_tel + '"></tr>';

                messageDiv += '<tr><th scope="col" class="suject">이메일</th>';
                messageDiv += '<td scope="col" ><input type="text" class="input" id="mb_email" value="' + data[0].mb_email + '"></tr>';

                messageDiv += '<tr colspan="3" ><th scope="col" class="suject" >메모</th>';
                messageDiv += '<td scope="col" ><textarea class="input" value="' + data[0].mb_wr1 + '" id="mb_wr1"></textarea  ></tr>';

                tableBodyMem.append(messageDiv);
                //console.log(messageDiv);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    $("#selectBtn").click(function () {

        var tdArr_grade = new Array();
        var checkbox_grade = $("input[name=chk_grade]:checked"); // 수정된 부분: 클래스로 체크박스를 선택

        // 체크된 체크 박스 i갯수만큼 반복 
        console.log(checkbox_grade);

        if (checkbox_grade.length >= 1) {
            checkbox_grade.each(function (i) {
                var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
                var td = tr.children();

                // 체크된 tr 내 순서내 값 가져오기
                var value1 = td.eq(1).find('.input').val();
                var num = td.eq(0).find('.number').val();
                var item1 = {
                    name: value1,
                    no: num,
                    category: "grade",
                };
                tdArr_grade.push(item1);
            });
        }
        console.table(tdArr_grade);
        var data = {
            category: "modify",
            tdArr_grade: tdArr_grade,
        };
        $.ajax({
            type: "POST",
            url: "../member/memberContoller.php",
            data: data,
            success: function () {
                // 새로고침
                location.reload();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

    });
    function mb_group_load() {
        $.ajax({
            type: "POST",
            url: common_url,
            data: {
                action: "mb_group_load",
            },
            dataType: "json",
            success: function (data) {
                console.log("mb_group_load");
                // console.log('mb_group_load success');
                var mb_group = $('#group')

                mb_group.empty();
                optionHTML = "<option value=''>모든소속</option>";;
                for (i = 0; i < data.length; i++) {
                    optionHTML += "<option value='" + data[i]['gp_no'] + "'>" + data[i]['gp_name'] + "</option>";
                }
                mb_group.append(optionHTML);
                //console.log(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                // 오류 발생 시 동작
                console.error('AJAX Error:', textStatus, errorThrown);

                // 여기서 필요에 따라 다양한 오류 처리를 할 수 있습니다.
                // 예를 들어, 오류 메시지를 사용자에게 보여줄 수 있습니다.
            }
        });
    }
    function grade_load() {
        $.ajax({
            type: "POST",
            url: common_url,
            data: {
                action: "grade_load",
            },
            dataType: "json",
            success: function (data) {
                console.log("grade_load");
                // console.log('mb_group_load success');
                var grade = $('#grade')

                grade.empty();
                optionHTML = "<option value=''>전체등급</option>";;
                for (i = 0; i < data.length; i++) {
                    optionHTML += "<option value='" + data[i]['gd_no'] + "'>" + data[i]['gd_name'] + "</option>";
                }
                grade.append(optionHTML);
                //console.log(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                // 오류 발생 시 동작
                console.error('AJAX Error:', textStatus, errorThrown);

                // 여기서 필요에 따라 다양한 오류 처리를 할 수 있습니다.
                // 예를 들어, 오류 메시지를 사용자에게 보여줄 수 있습니다.
            }
        });
    }


    function generatePagination(cust_keyword, cust_search, gp_no, gd_no, list, page, block_start, block_end, total_page) {
        let option = "";
        // if (page <= 1) {
        //     // 빈 값
        // } else {

        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, gd_no, list, 1)}">처음</a>`;
        // }

        // if (page <= 1) {
        //     // 빈 값
        // } else {
        //     let pre = page - 1;
        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, gd_no, list, pre)}">◀ </a>`
        // }

        for (let i = block_start; i <= block_end; i++) {
            if (page == i) {
                option += `<b class='on' >${i}</b>`;
            } else {
                option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, gd_no, list, i)}">${i}</a>`;
            }
        }

        // if (page >= total_page) {
        //     // 빈 값
        // } else {
        //     let next = parseInt(page, 10) + 1;
        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, gd_no, list, next)}"> ▶</a>`;
        // }

        // if (page >= total_page) {
        //     // 빈 값
        // } else {
        //     // option += `<a href="${generatePageLink(grade, mb_group, total_page, list)}">마지막</a>`;
        // }
        return option;
    }

    function generatePageLink(cust_keyword, cust_search, gp_no, gd_no, list, page) {
        return `member_list_paging('${cust_keyword}', '${cust_search}', '${gp_no}', '${gd_no}', '${list}', '${page}');`;
    }


    // 선택수정 함수
    function member_modify() {
        var mb_no = $("#mb_no").val();
        var mb_name = $("#mb_name").val();
        var mb_email = $("#mb_email").val();
        var mb_tel = $("#mb_tel").val();
        var mb_wr1 = $("#mb_wr1").val();

        var gp_no = $("#gp_no").val();
        var gd_no = $("#gd_no").val();

        var data = {
            action: "member_modify",
            mb_no: mb_no,
            mb_name: mb_name,
            mb_email: mb_email,
            mb_tel: mb_tel,
            mb_wr1: mb_wr1,
            gp_no: gp_no,
            gd_no: gd_no,
        }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function () {
                console.log('member_modify success');
                member_list();
            }, error: function (jqXHR, textStatus, errorThrown) {
                // 오류 발생 시 동작
                console.error('AJAX Error:', textStatus, errorThrown);

                // 여기서 필요에 따라 다양한 오류 처리를 할 수 있습니다.
                // 예를 들어, 오류 메시지를 사용자에게 보여줄 수 있습니다.
            }

        });

        console.log(data);

    }
    // 회원 삭제
    function member_delete(mb_no) {

        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "member_delete",
                mb_no: mb_no,
            },
            success: function (data) {
                console.log('success');
                member_list();
            }, error: function (jqXHR, textStatus, errorThrown) {
                // 오류 발생 시 동작
                console.error('AJAX Error:', textStatus, errorThrown);

                // 여기서 필요에 따라 다양한 오류 처리를 할 수 있습니다.
                // 예를 들어, 오류 메시지를 사용자에게 보여줄 수 있습니다.
            }

        });
    }
    function member_changePw() {
        var importButton = $('#member_change_btn');
        // 해당 버튼 요소를 사용하여 submit() 함수 호출
        if (importButton) {
            importButton.get(0).form.submit();
        }
    }

    function member_changePw() {
        var importButton = $('#member_change_btn');
        // 해당 버튼 요소를 사용하여 submit() 함수 호출
        if (importButton) {
            importButton.get(0).form.submit();
        }
    }

    // 회원 승인
    function member_active(mb_no) {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "member_active",
                mb_no: mb_no,
            },
            success: function (data) {
                console.log('member_active success');
                member_list();
            }
        });
    }

    function BodyTableHTML(data) {
        let tmp = "";
        let tmp2 = "";
        let tmp3 = ""
        let tmp4 = ""
        let BodyHTML = "";
        let dataAsArray = Object.values(data);
        // console.log("dataAsArray" + dataAsArray);
        // console.log(dataAsArray.length);


        for (var i = 0; i < dataAsArray.length - 1; i++) {
            let page = parseInt(data['paging']['page'] - 1);
            let list = parseInt(data['paging']['list']);

            let noPlus = page * list;


            if (parseInt(data[i].mb_approval, 10) == 0) { tmp = "<input type='button' value='승인' style='padding: 5px 10px;' class='button fs_w'  onclick='member_active(" + data[i].mb_no + ")'>"; }
            else { tmp = "" }
            if (parseInt(data[i].mb_no, 10) != 1) { tmp2 = "<input type='button' style='padding: 5px 10px;' value='삭제' class='button fs_w' onclick='member_delete(" + data[i].mb_no + ")'>"; }
            else { tmp2 = "" }
            if (parseInt(data[i].mb_level, 10) == 2) { tmp4 = "<input type='button' style='padding: 5px 10px;' value='그룹추가' class='button fs_w' onclick='member_add_popUpBtn(" + data[i].mb_no + ")'>"; }
            else { tmp4 = "" }
            tmp3 = "<input type='button' style='padding: 5px 10px;' value='비밀번호변경' class='button fs_w' onclick='member_popUpBtn(" + data[i].mb_no + ")'>";


            BodyHTML += "<tr>"
            BodyHTML += "<td class='noBorder'>" + "<input type='radio' name='member_rd' onclick='member_view()' id='chk_" + data[i].mb_no + "'><input type='hidden' name='ck_no' class='number' value='" + data[i].mb_no + "'>" + "</td>";
            if (data['paging']['page'] > 1) {
                BodyHTML += "<td class='noBorder'>" + (i + 1 + noPlus) + "</td>";
            } else {
                BodyHTML += "<td class='noBorder'>" + (i + 1) + "</td>";
            }
            BodyHTML += "<td class='noBorder'>" + data[i].gd_name + "</td>";
            BodyHTML += "<td class='noBorder'>" + data[i].gp_name + "</td>";
            BodyHTML += "<td class='noBorder'>" + data[i].mb_name + "</td>";
            BodyHTML += "<td class='noBorder'>" + data[i].mb_email + "</td>";
            BodyHTML += "<td class='noBorder'>" + data[i].mb_tel + "</td>";
            BodyHTML += "<td class='noBorder'> " + tmp + tmp2 + tmp3 + tmp4 + "</td>";
            BodyHTML += "</tr>"

        }

        console.log(BodyHTML);
        return BodyHTML;
    }

    // const popupButton = document.getElementById('popupButton');


    // popupButton.addEventListener('click', () => {
    //     popup.style.display = 'flex';
    //     document.body.style.overflow = "hidden"; // 스크롤 잠금
    //     popup.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
    // });

    // close.addEventListener('click', () => {
    //     popup.style.display = 'none';
    //     document.body.style.overflow = "auto"; // 스크롤 잠금 해제
    //     popup.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    // });

    // window.addEventListener('click', (event) => {
    //     if (event.target === popup) {
    //         popup.style.display = 'none';
    //         document.body.style.overflow = "auto"; // 스크롤 잠금 해제
    //     }
    // });

    const popup = document.getElementById('popup');
    const close = document.getElementById('close');

    function member_popUpBtn(mb_no) {
        $('#mb_no_pw').val(mb_no);
        popup.style.display = 'flex';
        document.body.style.overflow = "hidden"; // 스크롤 잠금
        popup.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
    }

    close.addEventListener('click', () => {
        popup.style.display = 'none';
        document.body.style.overflow = "auto"; // 스크롤 잠금 해제
        popup.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    });

    function popupButton1() {
        popupButton.addEventListener('click', () => {
            popup.style.display = 'flex';
            document.body.style.overflow = "hidden"; // 스크롤 잠금
        });
    }

    const popup2 = document.getElementById('popup2');
    const close2 = document.getElementById('close2');

    function member_add_popUpBtn(mb_no) {
        $('#mb_no_add').val(mb_no);
        popup2.style.display = 'flex';
        document.body.style.overflow = "hidden"; // 스크롤 잠금
        popup2.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가

        // 가진 그룹 찾기
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "member_group_list",
                mb_no: mb_no,
            },
            dataType: "json",
            success: function (data) {
                console.log('member_group_list success');
                console.log(data);
                console.log(data[0]['mb_wr2']);
                let chkGroup = [];
                if(data[0]['mb_wr2'] != null ){
                    chkGroup = data[0]['mb_wr2'].split(',');
                }
                
                let tmp = "";
                let chkHTML = "";
                for (let i = 1; i < data.length; i++) {
                    console.log(i);
                    if (chkGroup.includes(data[i]['gp_no'])) { tmp = "checked" }
                    else { tmp = ""; }
                    chkHTML += '<span class="ct0">' + data[i]['gp_name'] + '</span>';
                    chkHTML += "<input type='checkbox' " + tmp + " value='" + data[i]['gp_no'] + "' >";
                }
                $('#chkGroupMiddle').empty();
                $('#chkGroupMiddle').append(chkHTML);
                console.log(chkGroup);
            }
        });

    }

    function member_add() {
        let checkboxContainer = document.getElementById('chkGroupMiddle');
        let checkboxes = checkboxContainer.querySelectorAll('input[type="checkbox"]:checked');

        // 체크된 체크박스의 값을 쉼표로 구분된 문자열로 만듦
        let checkboxValues = Array.from(checkboxes).map(function (checkbox) {
            return checkbox.value;
        }).join(',');

        console.log(checkboxValues);
        $('#checkboxValues').val(checkboxValues);

        // 여기서는 예시로 폼 전송
        let importButton = $('#member_add_btn');
        // 해당 버튼 요소를 사용하여 submit() 함수 호출
        if (importButton) {
            importButton.get(0).form.submit();
        }
    }


    close2.addEventListener('click', () => {
        popup2.style.display = 'none';
        document.body.style.overflow = "auto"; // 스크롤 잠금 해제
        popup2.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    });

    function popupButton2() {
        popupButton.addEventListener('click', () => {
            popup2.style.display = 'flex';
            document.body.style.overflow = "hidden"; // 스크롤 잠금
        });
    }




    // function updateListValue() {
    //     // 현재 페이지 URL에서 search 부분을 가져옴
    //     let urlParams = new URLSearchParams(window.location.search);

    //     // "list" 매개변수의 값을 변경
    //     urlParams.set('list', document.getElementById('list').value);

    //     // 변경된 search 부분으로 URL을 업데이트
    //     window.location.href = window.location.pathname + '?' + urlParams.toString();
    // }


</script>

</script>

</html>