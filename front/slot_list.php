<?php include_once('header.php') ?>

<?php

include_once('backStyle.php');
if (!isset($_SESSION['mb_id'])) {
    alert_loginForm("로그인하세요");
}

?>

<style>
    <?php if ($mb_level == 1 || $mb_level == 2) { ?>

        /* 테이블 비율 */
        .slot th:nth-child(1),
        .slot th:nth-child(2) {
            width: 1%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

        .slot th:nth-child(3),
        .slot th:nth-child(4),
        .slot th:nth-child(6) {
            width: 5%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

        .slot th:nth-child(5),
        .slot th:nth-child(7),
        .slot th:nth-child(8) {
            width: 10%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

        .slot th:nth-child(10) {
            width: 20%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

    <?php } else { ?>

        /* 테이블 비율 */
        .slot th:nth-child(1),
        .slot th:nth-child(2) {
            width: 1%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

        .slot th:nth-child(4) {
            width: 5%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

        .slot th:nth-child(3),
        .slot th:nth-child(5),
        .slot th:nth-child(6) {
            width: 10%;
            /* 첫 번째 th의 너비를 20%로 설정 */
        }

    <?php } ?>
    .blue {
        background-color: #7dc2d0 !important;

        /* 원하는 배경색으로 변경하세요 */
    }

    .yellow {
        background-color: yellow !important;
        /* 원하는 배경색으로 변경하세요 */
    }

    /* .ch_color_bl,
    .ch_color_yl {
        transform: scale(2.5);
        margin: 0 auto !important;
        cursor: pointer;
        opacity: 0;
        display: block;
    } */

    .col input[type="text"] {
        width: auto;
        /* 입력된 텍스트 길이에 따라 크기 조절 */
        min-width: 50%;
        /* 최소 크기 지정 (선택적) */
        box-sizing: content-box;
        /* 입력된 텍스트 길이만큼 크기 조절 */
    }

    .ck input[type="checkbox"] {
        transform: scale(0.1);
        display: none;
    }

    .col {
        width: 100px;
    }

    .cursor {
        cursor: pointer;
        /* 마우스 오버시 포인터 모양으로 변경 */
    }
</style>
<input type="hidden" id="mb_level" value="<?= $mb_level ?>">
<input type="hidden" id="mb_group" value="<?= $mb_group ?>">
<input type="hidden" id="mb_no" value="<?= $mb_no ?>">
<input type="hidden" id="mb_id" value="<?= $mb_id ?>">

<div class="nowrap">
    <select id="cust_keyword" class="fs">
        <?php if ($mb_level == 1 || $mb_level == 2) { ?>
            <!-- <option value="user_id">소속</option> -->
            <option value="cust_mbname">작성자</option>
        <?php } ?>

        <option value="cust_name">고객명</option>
        <option value="cust_birth">생년월일</option>
        <option value="cust_tel">연락처</option>
        <option value="cust_db">디비종류</option>
        <option value="cust_detail">병력</option>
    </select>

    <input class="input" type='text' id='cust_search' style="width:30%;">

    <button onclick="customer_list()" class="button fs_w">검색</button>
    <!-- <label class="table_label">남은 슬롯 <span id="availableSlotCount"></span> 개 가능합니다</label> -->

</div>

<div class="just_between">
    <div style="display:inline">
        <?php if ($mb_level == 1 || $mb_level == 2) { ?>
            <select id="group" class="fs">
                <option value="">모든소속</option>
                <option value="팀1">팀1</option>
                <option value="팀2">팀2</option>
                <option value="팀3">팀3</option>
            </select>
        <?php } ?>
        <input type="date" class="date fs" id="start_date">
        <input type="date" class="date fs" id="end_date">
    </div>

    <div style="display:inline">

        <button class="button_option fs" onclick="getExecl()">엑셀 다운로드</button>
        <select id="list" class="fs">
            <option value="20">기본</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="9999">9999</option>
        </select>
    </div>
</div>
<!-- 테이블 묶음 -->
<div class="main">
    <label class="fs" style="margin:20px 10px; display: block;"> 총 <span id="total"></span>개 조회</label>
    <div class="table-container" style="display:flex; justify-content: space-between; height:50%">
        <table class="table slot" style='width:76%;'>
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="selectAll"></th>
                    <th scope="col">no</th>
                    <?php if ($mb_level == 1 || $mb_level == 2) { ?>
                        <th scope="col">소속</th>
                        <th scope="col">이름</th>
                    <?php } ?>
                    <th scope="col">작성일시</th>
                    <th scope="col">고객명</th>
                    <th scope="col">생년월일</th>
                    <th scope="col">연락처</th>
                    <th scope="col">디비종류</th>
                    <th scope="col">병력</th>
                    <th scope="col" class="ct0">설계심사</th>
                    <th scope="col" class="ct1">자료준비</th>
                    <th scope="col" class="ct2">전화예약</th>
                    <th scope="col" class="ct3">대면예약</th>
                    <th scope="col" class="ct4">계약완료</th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>
        </table>

        <table class="table" style='width:13%; height:50%'>
            <thead>
                <tr>
                    <th scope="col">DB종류</th>
                    <th scope="col">수량</th>
                    <th scope="col">비율</th>
                </tr>
            </thead>
            <tbody id="tableDb">
                <tr>
                    <td scope="col">POM</td>
                    <td scope="col">20</td>
                    <td scope="col">49%</td>
                </tr>
                <tr>
                    <td scope="col">유병자재가입</td>
                    <td scope="col">10</td>
                    <td scope="col">24%</td>
                </tr>
                <tr>
                    <td scope="col">미채결</td>
                    <td scope="col">16</td>
                    <td scope="col">39%</td>
                </tr>
            </tbody>
        </table>
        <table class="table" style='width:13%; height:50%'>
            <thead>
                <tr>
                    <th scope="col">진행</th>
                    <th scope="col">고객수</th>
                    <th scope="col">비율</th>
                </tr>
            </thead>
            <tbody id="tableCt">
                <tr>
                    <td scope="col" class="ct0">설계심사</td>
                    <td scope="col">20</td>
                    <td scope="col">49%</td>
                </tr>
                <tr>
                    <td scope="col" class="ct1">자료준비</td>
                    <td scope="col">10</td>
                    <td scope="col">24%</td>
                </tr>
                <tr>
                    <td scope="col" class="ct2">전화예약</td>
                    <td scope="col">16</td>
                    <td scope="col">39%</td>
                </tr>
                <tr>
                    <td scope="col" class="ct3">대면예약</td>
                    <td scope="col">16</td>
                    <td scope="col">39%</td>
                </tr>
                <tr>
                    <td scope="col" class="ct4">계약완료</td>
                    <td scope="col">16</td>
                    <td scope="col">39%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div id="pageNum" style="text-align: center;">
        <!-- 페이지 -->
    </div>
</div>

<div class="just_right" style="margin:15px;">
    <?php if ($mb_level == 1 || $mb_level == 2) { ?>
        <input type="button" value="체크삭제" class="button fs" style="background-color: white;" onclick="delete_customer()">
    <?php } ?>
    <input type="button" value="체크수정" class="button fs_w" onclick="ch_member()">
    <input type="button" value="신규입력" class="button fs_w regPopUp" id="popupButton">
</div>


<!-- 신규 추가 -->
<?php include_once('customer_upload_ver1.php') ?>

</div>


<div id="result"></div>
<?php include_once('footer.php') ?>
<script>
    let url = "../slot/slotController.php";
    var tableBody = $("#table_body");

    var tableDb = $("#tableDb");

    var tableCt = $("#tableCt");

    var pageNum = $("#pageNum");

    let cust_ct = [];

    let mb_level = $('#mb_level').val();

    let mb_group = $('#mb_group').val();

    let mb_no = $('#mb_no').val();

    $(document).ready(function () {
        category_load();
        mb_group_load();
        db_load()
        customer_list();


    });

    // function ch_color() {

    //     let ch_color_bl = $('.ch_color_bl');
    //     let ch_color_yl = $('.ch_color_yl');

    //     //console.log(ch_color_bl);

    //     clickEvent(ch_color_bl, 'blue');
    //     clickEvent(ch_color_yl, 'yellow');

    // }

    function clickEvent(ct_chb, className) {
        ct_chb.click(function () {
            let td = $(this).parent();
            //console.log(td);

            if (this.checked) {
                //console.log(123);
                td.addClass(className)
            } else {
                //console.log(222);
                td.removeClass(className);
            }
        });
    }

    function getExecl() {
        // let cust_arr = new Array();
        let checkbox_cust = $("input[name=chk_cust]");
        let cust_no = "";

        console.log(checkbox_cust);

        if (checkbox_cust.length >= 1) {
            checkbox_cust.each(function (i) {

                cust_no += $(this).val();
                if (i >= 0 && (i !== checkbox_cust.length - 1)) cust_no += ",";
            });
        }
        console.log(cust_no);

        ///////////////// 결과 정리값
        let cust_db_info = [];
        let cust_ct_info = [];

        let db_tr = $('#tableDb tr');
        let ct_tr = $('#tableCt tr');


        db_tr.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value1 = td.eq(0).text();
            var value2 = td.eq(1).text();
            var value3 = td.eq(2).text();

            value_all = {
                value1: value1,
                value2: value2,
                value3: value3,
            };
            cust_db_info.push(value_all);
        });
        //console.log(cust_db_info);

        ct_tr.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value1 = td.eq(0).text();
            var value2 = td.eq(1).text();
            var value3 = td.eq(2).text();

            value_all = {
                value1: value1,
                value2: value2,
                value3: value3,
            };
            cust_ct_info.push(value_all);
        });

        location.href = "getExecl.php?cust_no=" + cust_no + "&cust_db_info=" + JSON.stringify(cust_db_info) + "&cust_ct_info=" + JSON.stringify(cust_ct_info);

    }

    function customer_list_paging(cust_keyword, cust_search, gp_no, start_date, end_date, list, page) {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "customer_list",
                cust_keyword,
                cust_keyword,
                cust_search,
                cust_search,
                gp_no,
                gp_no,
                start_date,
                start_date,
                end_date,
                end_date,
                list,
                list,
                page,
                page,
                mb_level: mb_level,
                mb_group: mb_group,
                mb_no : mb_no,
            },
            dataType: "json",
            success: function (data) {
                console.log("customer_list_paging");
                $('.total').text(data['paging']['total']);

                tableBody.empty();
                tableBody.append(BodyTableHTML(data));

                let db_input = data['paging']['db_input'];
                let db_num = data['paging']['db_num'];

                tableDb.empty();
                tableDb.append(DbHTML(data['paging']['db_input'], data['paging']['db_num']));

                tableCt.empty();
                tableCt.append(CtHTML(data['paging']['ct_arr']));

                var pagingDiv = generatePagination(cust_keyword, cust_search, gp_no, start_date, end_date, list, page, data['paging']['block_start'], data['paging']['block_end'], data['paging']['total_page']);
                //console.log(pagingDiv);
                pageNum.empty();
                pageNum.append(pagingDiv);

                $('td').on('click', function (e) {
                    // 클릭한 td 안에 있는 체크박스를 찾음
                    var checkbox = $(this).find('input[type="checkbox"]');
                    // 체크박스의 상태를 변경 (체크된 것은 해제, 해제된 것은 체크)
                    checkbox.prop('checked', !checkbox.prop('checked'));
                });
                // setTimeout(ch_color, 1000);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }


    function customer_list(page = 1) {
        let cust_keyword = $('#cust_keyword').val();
        let cust_search = $('#cust_search').val();
        let gp_no = $('#group').val();
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();
        let list = $('#list').val();

        console.log(cust_keyword);
        console.log(cust_search);
        // console.log(list);
        // console.log(page);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "customer_list",
                cust_keyword : cust_keyword,
                cust_search : cust_search,
                gp_no : gp_no,
                start_date : start_date,
                end_date : end_date,
                list,
                list,
                page,
                page,
                mb_level: mb_level,
                mb_group: mb_group,
                mb_no: mb_no,
            },
            dataType: "json",
            success: function (data) {
                console.log('customer_list success');
                $('#total').text(data['paging']['total']);

                tableBody.empty();
                tableBody.append(BodyTableHTML(data));

                tableDb.empty();
                tableDb.append(DbHTML(data['paging']['db_input'], data['paging']['db_num']));

                tableCt.empty();
                tableCt.append(CtHTML(data['paging']['ct_arr']));

                var pagingDiv = generatePagination(cust_keyword, cust_search, gp_no, start_date, end_date, list, page, data['paging']['block_start'], data['paging']['block_end'], data['paging']['total_page']);
                // console.log(pagingDiv);
                pageNum.empty();
                pageNum.append(pagingDiv);

                // setTimeout(ch_color, 1000);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function generatePageLink(cust_keyword, cust_search, gp_no, start_date, end_date, list, page) {

        return `customer_list_paging('${cust_keyword}', '${cust_search}', '${gp_no}', '${start_date}', '${end_date}', '${list}', '${page}');`;
    }

    function generatePagination(cust_keyword, cust_search, gp_no, start_date, end_date, list, page, block_start, block_end, total_page) {

        let option = "";

        // if (page <= 1) {
        //     // 빈 값
        // } else {

        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, start_date, end_date, list, 1)}">처음</a>`;
        // }

        // if (page <= 1) {
        //     // 빈 값
        // } else {
        //     let pre = page - 1;
        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, start_date, end_date, list, pre)}">◀ </a>`
        // }

        for (let i = block_start; i <= block_end; i++) {
            console.log("page" + page);
            if (page == i) {
                option += `<b class="page on">${i}</b>`;

            } else {
                option += `<a href="#" class="page" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, start_date, end_date, list, i)}">${i}</a>`;
            }
        }

        // if (page >= total_page) {
        //     // 빈 값
        // } else {
        //     let next = parseInt(page, 10) + 1;
        //     option += `<a href="#" onclick="${generatePageLink(cust_keyword, cust_search, gp_no, start_date, end_date, list, next)}"> ▶</a>`;
        // }

        if (page >= total_page) {
            // 빈 값
        } else {
            // option += `<a href="${generatePageLink(grade, mb_group, total_page, list)}">마지막</a>`;
        }
        return option;
    }



    function mb_group_load() { 
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "mb_group_load",
                mb_level : mb_level ,
                mb_no : mb_no ,
            },
            dataType: "json",
            success: function (data) {
                var mb_group = $('#group')
                mb_group.empty();
                optionHTML = "<option value=''>모든소속</option>";;
                for (i = 0; i < data.length; i++) {
                    optionHTML += "<option value='" + data[i]['gp_no'] + "'>" + data[i]['gp_name'] + "</option>";
                }
                mb_group.append(optionHTML);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    function db_load() {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "db_load",
            },
            dataType: "json",
            success: function (data) {
                var db_ct = $('#cust_db');
                console.log($('#test'));
                db_ct.empty();
                optionHTML = "";
                for (i = 0; i < data.length; i++) {
                    optionHTML += "<option value='" + data[i]['db_name'] + "'>" + data[i]['db_name'] + "</option>";
                }
                db_ct.append(optionHTML);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    // category 불러오기 함수
    function category_load() {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "category_load",
            },
            dataType: "json",
            success: function (data) {
                // console.log('category_load success');

                //console.log(data);
                for (i = 0; i < data.length; i++) {
                    cust_ct.push(data[i]["ct_name"]);
                }
                //console.log("cust_ct"+cust_ct[0]);
                var ct0 = $(".ct0");
                var ct1 = $(".ct1");
                var ct2 = $(".ct2");
                var ct3 = $(".ct3");
                var ct4 = $(".ct4");

                ct0.text(data[0]["ct_name"]);
                ct1.text(data[1]["ct_name"]);
                ct2.text(data[2]["ct_name"]);
                ct3.text(data[3]["ct_name"]);
                ct4.text(data[4]["ct_name"]);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // 오류 발생 시 동작
                console.error('AJAX Error:', textStatus, errorThrown);

                // 여기서 필요에 따라 다양한 오류 처리를 할 수 있습니다.
                // 예를 들어, 오류 메시지를 사용자에게 보여줄 수 있습니다.
            }
        });
    }
    $('input[type="submit"]').on('click', function () {
        $("#member_import").submit();
    });


    $("#selectAll").change(function () {
        $(".checkbox").prop('checked', $(this).prop("checked"));
    });

    $(".checkbox").change(function () {
        if (!$(this).prop("checked")) {
            $("#selectAll").prop('checked', false);
        }
    });

    function ch_member() {
        var tdArr_cust = new Array();
        var checkbox_cust = $("input[name=chk_cust]:checked");

        tdArr_cust = chb_check(checkbox_cust);
        console.log(tdArr_cust);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                tdArr_cust: JSON.stringify(tdArr_cust),
                action: "ch_member",
            },
            success: function () {
                customer_list();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function delete_customer() {
        var tdArr_cust = new Array();

        var checkbox_cust = $("input[name=chk_cust]:checked");

        if (checkbox_cust.length >= 1) {
            checkbox_cust.each(function (i) {
                let cust_no = "";
                cust_no += $(this).val();
                tdArr_cust.push(cust_no);
                //if (i >= 0 && (i !== checkbox_cust.length - 1)) {cust_no += ",";}
            });
        }
        console.log(cust_no);
        console.log(tdArr_cust);

        //tdArr_cust = chb_check(checkbox_cust);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                tdArr_cust: JSON.stringify(tdArr_cust),
                action: "delete_customer",
            },
            success: function () {
                customer_list();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }


    const popupButton = document.getElementById('popupButton');
    const popup = document.getElementById('popup');
    const close = document.getElementById('close');

    popupButton.addEventListener('click', () => {
        // popup 안의 모든 input 요소들을 선택
        $('#popup input[type="checkbox"]').prop('checked', false);
        $('#popup input[type="text"]').val(null);
        $('#popup input[type="textarea"]').val(null);

        popup.style.display = 'flex';
        document.body.style.overflow = "hidden"; // 스크롤 잠금
        popup.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
    });

    close.addEventListener('click', () => {
        popup.style.display = 'none';
        document.body.style.overflow = "auto"; // 스크롤 잠금 해제
        popup.classList.remove('open'); // 팝업이 닫힐 때 'open' 클래스 제거
    });

    function updateListValue() {
        // 현재 페이지 URL에서 search 부분을 가져옴
        let urlParams = new URLSearchParams(window.location.search);

        // "list" 매개변수의 값을 변경
        urlParams.set('list', document.getElementById('list').value);

        // 변경된 search 부분으로 URL을 업데이트
        window.location.href = window.location.pathname + '?' + urlParams.toString();
    }

    function CtHTML(ct_arr) {


        let CtHTML = "";
        CtHTML += "<tr>";
        CtHTML += "<td scope='col' class='ct1'>" + cust_ct[0] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct1_num"] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct1_pct"].toFixed(0) + "%</td>";
        CtHTML += "</tr>";
        CtHTML += "<tr>";
        CtHTML += "<td scope='col' class='ct1'>" + cust_ct[1] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct2_num"] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct2_pct"].toFixed(0) + "%</td>";
        CtHTML += "</tr>";
        CtHTML += "<tr>";
        CtHTML += "<td scope='col' class='ct1'>" + cust_ct[2] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct3_num"] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct3_pct"].toFixed(0) + "%</td>";
        CtHTML += "</tr>";
        CtHTML += "<tr>";
        CtHTML += "<td scope='col' class='ct1'>" + cust_ct[3] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct4_num"] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct4_pct"].toFixed(0) + "%</td>";
        CtHTML += "</tr>";
        CtHTML += "<tr>";
        CtHTML += "<td scope='col' class='ct1'>" + cust_ct[4] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct5_num"] + "</td>";
        CtHTML += "<td scope='col'>" + ct_arr["ct5_pct"].toFixed(0) + "%</td>";
        CtHTML += "</tr>";

        return CtHTML;
    }

    function DbHTML(db_input, db_num) {
        // console.log("HbHTML");
        let DbHTML = "";
        let db_num_total = 0;

        for (let i = 0; i < db_num['total_db_category']; i++) {
            db_num_total += db_num[i];
            DbHTML += "<tr>";
            DbHTML += "<td scope='col'>" + db_input[i] + "</td>";
            DbHTML += "<td scope='col'>" + db_num[i] + "</td>";
            DbHTML += "<td scope='col'>" + db_num[i + db_num['total_db_category']].toFixed(0) + "%</td>";
            DbHTML += "</tr>";
        }
        DbHTML += "<tr>";
        DbHTML += "<td scope='col'>총합계</td>";
        DbHTML += "<td scope='col'>" + db_num_total + "</td>";
        DbHTML += "<td scope='col'>" + 100 + "</td>";
        DbHTML += "</tr>";
        return DbHTML;
    }

    function BodyTableHTML(data) {
        let dataAsArray = Object.values(data);
        var messageDiv = ""
        for (var i = 0; i < dataAsArray.length - 1; i++) {

            messageDiv += "<tr>";
            messageDiv += "<td class='col'>" + "<input class='checkbox' type='checkbox' name='chk_cust' id='chk_" + data[i].cust_no + "' value='" + data[i].cust_no + "'></td>";
            messageDiv += "<td class='col'>" + data[i].cust_no + "</td>";
            //messageDiv += "<td class='col'>" + (i + 1) + "</td>";
            <?php if ($mb_level == 1 || $mb_level == 2) { ?>
                messageDiv += "<td class='col'>" + data[i].gp_name + "</td>";
                messageDiv += "<td class='col'>" + data[i].cust_mbname + "</td>";
            <?php } ?>
            messageDiv += "<td class='col'>" + data[i].cust_reg_dt + "</td>";
            messageDiv += "<td class='col cursor' onclick='ch_customer(" + data[i].cust_no + ")'>" + data[i].cust_name + "</td>";
            messageDiv += "<td class='col cursor' onclick='ch_customer(" + data[i].cust_no + ")'>" + data[i].cust_birth + "</td>";
            messageDiv += "<td class='col cursor' onclick='ch_customer(" + data[i].cust_no + ")'>" + data[i].cust_tel + "</td>";
            messageDiv += "<td class='col cursor' onclick='ch_customer(" + data[i].cust_no + ")'>" + data[i].cust_db + "</td>";
            messageDiv += "<td class='col cursor' onclick='ch_customer(" + data[i].cust_no + ")'>" + truncateText(data[i].cust_detail,20) + "</td>";

            if (data[i].cust_ct1 == 1) {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col blue'>" + "<input checked type='checkbox' disabled name='member_rd' id='chk_cust_ct1' value='cust_ct1'></td>";
            } else {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col'>" + "<input type='checkbox' disabled name='member_rd' id='chk_cust' value='cust_ct1'></td>";
            }
            if (data[i].cust_ct2 == 1) {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col blue'>" + "<input checked type='checkbox' disabled name='member_rd' id='chk_cust_ct2' value='cust_ct2'></td>";
            } else {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col'>" + "<input type='checkbox' disabled name='member_rd' id='chk_cust_ct2' value='cust_ct2'></td>";
            }
            if (data[i].cust_ct3 == 1) {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col blue'>" + "<input checked type='checkbox' disabled name='member_rd' id='chk_cust_ct3' value='cust_ct3'></td>";
            } else {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col'>" + "<input type='checkbox'  disabledname='member_rd' id='chk_cust_ct3' value='cust_ct3'></td>";
            }
            if (data[i].cust_ct4 == 1) {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col blue'>" + "<input checked type='checkbox' disabled name='member_rd' id='chk_cust_ct4' value='cust_ct4'></td>";
            } else {
                messageDiv += "<td onclick='highlightBlu(this)' class='ck col'>" + "<input type='checkbox' disabled name='member_rd' id='chk_cust_ct4' value='cust_ct4'></td>";
            }
            if (data[i].cust_ct5 == 1) {
                messageDiv += "<td onclick='highlightYel(this)' class='ck col yellow'>" + "<input checked type='checkbox' disabled name='member_rd' id='chk_cust_ct5' value='cust_ct5'></td>";
            } else {
                messageDiv += "<td onclick='highlightYel(this)' class='ck col'>" + "<input type='checkbox' disabled name='member_rd' id='chk_cust_ct5' value='cust_ct5'></td>";
            }

            messageDiv += "</tr>";

        }
        return messageDiv;
    }

    function chb_check(checkbox_cust) {
        let tdArr_cust = [];
        let tdArr_cust_ch = [];
        if (checkbox_cust.length >= 1) {
            checkbox_cust.each(function (i) {
                var tr = $(this).closest('tr');
                var td = tr.children();
                let arr = [];
                <?php if ($mb_level == 1 || $mb_level == 2) { ?>
                    for (i = 10; i <= 14; i++) {
                        var cust_no = $(this).val();
                        var column = td.eq(i).find('input[type="checkbox"]').val();
                        // 열 번호가 10인 열의 체크 여부 확인
                        var isChecked = td.eq(i).find('input[type="checkbox"]').prop('checked');
                        // 체크된 경우
                        if (isChecked) {
                            // console.log('체크되어 있습니다.');
                            check = 1;
                        } else {
                            // console.log('체크되어 있지 않습니다.');
                            check = 0;
                        }
                        let item1 = {
                            cust_no: cust_no,
                            column: column,
                            check: check,
                        }
                        arr.push(item1);
                    } // for

                    tdArr_cust.push(arr);
                    let arr2 = [];
                    var cust_no = $(this).val();
                    var column = td.eq(5).text();
                    td.empty();
                    td.append("input type='text' value='" + column + "'");



                    //arr2.push(column);

                    //tdArr_cust_ch.push(arr2);
                    //console.log(tdArr_cust_ch);

                <?php } else { ?>
                    for (i = 8; i <= 12; i++) {
                        var cust_no = $(this).val();
                        var column = td.eq(i).find('input[type="checkbox"]').val();
                        // 열 번호가 10인 열의 체크 여부 확인
                        var isChecked = td.eq(i).find('input[type="checkbox"]').prop('checked');
                        // 체크된 경우
                        if (isChecked) {
                            // console.log('체크되어 있습니다.');
                            check = 1;
                        } else {
                            // console.log('체크되어 있지 않습니다.');
                            check = 0;
                        }

                        let item1 = {
                            cust_no: cust_no,
                            column: column,
                            check: check,
                        }

                        arr.push(item1);
                    }
                    tdArr_cust.push(arr);
                <?php } ?>
            });
        }
        return tdArr_cust;
    }

    function ch_customer(cust_no) {
        console.log(cust_no);
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "ch_customer",
                cust_no: cust_no,
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);

                $('#cust_no').val(data[0]['cust_no']);
                $('#cust_name').val(data[0]['cust_name']);
                $('#cust_birth').val(data[0]['cust_birth']);
                $('#cust_tel').val(data[0]['cust_tel']);
                $('#cust_db').val(data[0]['cust_db']);
                $('#cust_detail').val(data[0]['cust_detail']);

                if (data[0]['cust_ct1'] == 1) {
                    $("#cust_ct1").prop("checked", true);
                }
                if (data[0]['cust_ct2'] == 1) {
                    $("#cust_ct2").prop("checked", true);
                }
                if (data[0]['cust_ct3'] == 1) {
                    $("#cust_ct3").prop("checked", true);
                }
                if (data[0]['cust_ct4'] == 1) {
                    $("#cust_ct4").prop("checked", true);
                }
                if (data[0]['cust_ct5'] == 1) {
                    $("#cust_ct5").prop("checked", true);
                }


                $('#popupSubmitBtn').val("수정");
                $('#action').val("customer_modify");

                popup.style.display = 'flex';
                document.body.style.overflow = "hidden"; // 스크롤 잠금
                popup.classList.add('open'); // 팝업이 열릴 때 'open' 클래스 추가
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    //highlight
    function highlightBlu(td) {
        let checkbox = $(td).find('input[type="checkbox"]');

        if (checkbox.prop('checked', !checkbox.prop('checked'))) {
            $(td).toggleClass("blue");
        } else {
            $(td).removeClass("blue");
        }

    }

    function highlightYel(td) {
        let checkbox = $(td).find('input[type="checkbox"]');

        if (checkbox.prop('checked', !checkbox.prop('checked'))) {
            $(td).toggleClass("yellow");
        } else {
            $(td).removeClass("yellow");
        }
    }

    function truncateText(text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + "...";
    } else {
        return text;
    }
}
</script>

</script>

</html>