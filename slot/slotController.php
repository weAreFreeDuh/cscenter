<?php
include_once("../DB/db_connection.php"); // DB 연결
include_once("../common.php"); // gg
include_once("slotfunction.php");

session_start(); // 세션을 쓰기 위해 설정해줘야하는 session.

$arr = array(); // 배열 변수 생성
$arr = $_POST; // POST 형식으로 받은 변수 배열화
// echo print_r($_POST) . "<br/><br/><br/>"; // 받은 총 변수 설정


$allowedExtensions = array("xlsx", "csv", "txt"); // 허용된 파일 확장자
$current_datetime = date("Y-m-d H:i:s");

if (isset($_POST['action']) && $_POST['action'] == "delete_customer") {
    //echo print_r(json_decode($_POST['tdArr_cust'],true));
    $tdArr_cust = json_decode($_POST['tdArr_cust'], true);

    $option = " WHERE 1 = 1 AND cust_no IN (";
    for ($i = 0; $i < count($tdArr_cust); $i++) {
        
        if( $i == count($tdArr_cust) -1){
            $option .= " $tdArr_cust[$i] ";
        }else{
            $option .= " $tdArr_cust[$i], ";
        }
    }
    $option .= " ) ";
    $sql = "DELETE FROM  customer $option";
    // echo ($sql);
    mq($sql);
}

if (isset($_POST['action']) && $_POST['action'] == "ch_customer") {
    $cust_no = $_POST['cust_no'];
    $join = "JOIN mb_group ON mb_group.gp_no = customer.cust_mbgroup";
    $sql = "SELECT * FROM customer where cust_no = $cust_no";
    echo json_encode(putData($sql));
}
if (isset($_POST["action"]) && $_POST["action"] == "customer_modify") {
    $cust_mbname = $_POST['cust_mbname'];
    $cust_mbgroup = $_POST['cust_mbgroup'];

    $cust_no = $_POST['cust_no'];
    $cust_name = $_POST['cust_name'];
    $cust_birth = $_POST['cust_birth'];
    $cust_tel = $_POST['cust_tel'];
    $cust_db = $_POST['cust_db'];

    $cust_ct1 = $_POST['cust_ct1'] ? 1 : 0;
    $cust_ct2 = $_POST['cust_ct2'] ? 1 : 0;
    $cust_ct3 = $_POST['cust_ct3'] ? 1 : 0;
    $cust_ct4 = $_POST['cust_ct4'] ? 1 : 0;
    $cust_ct5 = $_POST['cust_ct5'] ? 1 : 0;

    $cust_detail = $_POST['cust_detail'];


    $sql = "UPDATE customer 
        SET 
            cust_name = '$cust_name', 
            cust_birth = '$cust_birth', 
            cust_tel = '$cust_tel', 
            cust_db = '$cust_db', 
            cust_ct1 = '$cust_ct1', 
            cust_ct2 = '$cust_ct2', 
            cust_ct3 = '$cust_ct3', 
            cust_ct4 = '$cust_ct4', 
            cust_ct5 = '$cust_ct5', 
            cust_detail = '$cust_detail',  
            cust_upd_dt = '$current_datetime' 
        WHERE 
            cust_no = $cust_no";
    echo $sql;

    $result = mq($sql);
    $conn->error;
    mysqli_error($conn);

    if ($result) {
        alert_URL("수정되었습니다");
    } else {
        alert_URL("오류가 발생하였습니다");
    }
}
// 체크처리 tdArr_cust
if (isset($_POST['action']) && $_POST['action'] == "ch_member") {
    $tdArr_cust = $_POST['tdArr_cust'];
    //echo print_r($tdArr_cust);

    // JSON 문자열을 배열로 변환
    $decodedArray = json_decode($tdArr_cust, true);

    // 변환된 배열 확인
    //print_r($decodedArray);
    //echo (count($decodedArray));
    for ($i = 0; $i < count($decodedArray); $i++) {
        for ($j = 0; $j < count($decodedArray[$i]); $j++) {
            echo $decodedArray[$i][$j]['cust_no'] . "<br/>";
            echo $decodedArray[$i][$j]['column'] . "<br/>";
            echo $decodedArray[$i][$j]['check'] . "<br/>";
            $cust_no = $decodedArray[$i][$j]['cust_no'];
            $column = $decodedArray[$i][$j]['column'];
            $check = $decodedArray[$i][$j]['check'];

            $sql = "UPDATE customer SET $column = $check WHERE cust_no= $cust_no";
            mq($sql);
            echo "Error updating record: " . $conn->error;
        }
    }
    //echo 11;

}

// 고객 정보 불러오기
if (isset($_POST['action']) && $_POST['action'] == "customer_list") {

    

    // 회원정보
    $mb_level = isset($_POST['mb_level']) ? $_POST['mb_level'] : null;
    $mb_group = isset($_POST['mb_group']) ? $_POST['mb_group'] : null;
    $mb_no = isset($_POST['mb_no']) ? $_POST['mb_no'] : null;

    // 검색 분류
    $cust_keyword = isset($_POST['cust_keyword']) ? $_POST['cust_keyword'] : null;
    // 검색어
    $cust_search = isset($_POST['cust_search']) ? $_POST['cust_search'] : null;
    // 소속
    $gp_no = isset($_POST['gp_no']) ? $_POST['gp_no'] : null;
    // 시작일
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    // 마감일
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
    // 한번에 보여줄 개수
    $list = $_POST['list'] ? $_POST['list'] : 20;
    // 페이지
    $page = $_POST['page'];

    // $bool1 = true;
    // $bool2 = true;
    if ($mb_level != 1 && $mb_level != 2) {
        $gp_no = $mb_group;
        $tmp = true;
    }
    if ($mb_level == 2) {
        if ($gp_no) {
        } else {
            //echo "중간중간";
            $bool = true;
            // echo $bool;
            //echo $mb_no;

            $sql_wr2 = "SELECT mb_wr2,mb_group FROM member WHERE mb_no = '$mb_no'";
            $result_wr2 = mysqli_query($conn, $sql_wr2);
            // 결과가 있는 경우에만 값을 가져옴
            if ($row_wr2 = mysqli_fetch_assoc($result_wr2)) {
                $mb_wr2 = $row_wr2['mb_wr2'];
                $mb_level_group = $row_wr2['mb_group'];
            } else {
                // 결과가 없을 경우의 처리
                $mb_wr2 = null; // 또는 다른 기본값 설정
            }
            //echo $mb_wr2;

        }
    }

    $join = " JOIN mb_group ON mb_group.gp_no = customer.cust_mbgroup ";
    $order = " ORDER BY cust_reg_dt DESC";
    $limit = " LIMIT " . $list;
    $offset = " OFFSET " . ($page - 1) * $list;


    $option = "where 1 = 1";

    if($tmp){
        $option .= " AND cust_wr1 = $mb_no ";
    }


    // echo "cust_keyword = ".$cust_keyword;
    // echo "cust_search = ". $cust_search;

    if (isset($cust_keyword) && isset($cust_search)) {
        $option .= " And $cust_keyword LIKE '%$cust_search%'";
        $bool1 = true;
    }

    if ($bool) {
        $option .= " And cust_mbgroup IN($mb_level_group,$mb_wr2)";
        $bool2 = true;}
    if ($gp_no) {
        $option .= " And cust_mbgroup = $gp_no";
        $bool2 = true;
        
    }
    if ($start_date && $end_date) {
        if ($bool2 || $bool1) {
            $option .= " And cust_reg_dt BETWEEN '$start_date' AND '$end_date' ";
        } else {
            $option .= " And cust_reg_dt BETWEEN '$start_date' AND '$end_date' ";
        }
    }

    

    //echo "<br/> option == ".$option;

    $sql_page = "select * from customer $join $option $order $limit $offset";
    "sql_page ".$sql_page;
    $sql = "select * from customer $join $option $order ";

    //echo "<br/>".$sql."<br/>";

    // function pageing2($sql, $page = 1, $list, $block_cnt)
    $pageingDate = pageing2($sql, $page, $list, 10);
    //echo "pageing2 ".print_r(pageing2($sql,$page,$list,10));

    // $total = mysqli_num_rows($sql); // 회원 총 레코드 수
    $data = [
        'paging' => [
        ],
    ];

    $result = mysqli_query($conn, $sql_page);

    while ($row = mysqli_fetch_array($result)) {
        // echo print_r($row);
        array_push($data, $row);
    }
    //echo print_r($data);

    // 총 컬럼 개수 구하기
    $columnCount_sql = "SELECT COUNT(*) AS num FROM ( $sql_page ) AS subquery";
    $result = mq($columnCount_sql);
    $columnCount_row = $result->fetch_assoc();

    $columnCount = (is_numeric((int) ($columnCount_row['num']))) ? (int) $columnCount_row['num'] : 1;
    //echo 'columnCount'. $columnCount ;


    // 카테고리 비율
    $ct1_num = 0;
    $ct2_num = 0;
    $ct3_num = 0;
    $ct4_num = 0;
    $ct5_num = 0;

    //echo print_r($data);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['cust_ct1'] == 1) {
            $ct1_num++;
        }
        if ($data[$i]['cust_ct2'] == 1) {
            $ct2_num++;
        }
        if ($data[$i]['cust_ct3'] == 1) {
            $ct3_num++;
        }
        if ($data[$i]['cust_ct4'] == 1) {
            $ct4_num++;
        }
        if ($data[$i]['cust_ct5'] == 1) {
            $ct5_num++;
        }
    }
    $total_ct_num = $ct1_num + $ct2_num + $ct3_num + $ct4_num + $ct5_num;

    $ct1_pct = $columnCount != 0 ? ($ct1_num / $columnCount) : 0;
    $ct2_pct = $columnCount != 0 ? ($ct2_num / $columnCount) : 0;
    $ct3_pct = $columnCount != 0 ? ($ct3_num / $columnCount) : 0;
    $ct4_pct = $columnCount != 0 ? ($ct4_num / $columnCount) : 0;
    $ct5_pct = $columnCount != 0 ? ($ct5_num / $columnCount) : 0;

    $ct_arr = array(
        "ct1_num" => $ct1_num,
        "ct2_num" => $ct2_num,
        "ct3_num" => $ct3_num,
        "ct4_num" => $ct4_num,
        "ct5_num" => $ct5_num,
        "ct1_pct" => 100 * $ct1_pct,
        "ct2_pct" => 100 * $ct2_pct,
        "ct3_pct" => 100 * $ct3_pct,
        "ct4_pct" => 100 * $ct4_pct,
        "ct5_pct" => 100 * $ct5_pct,
    );
    for ($i = 0; $i < 5; $i++) {

    }

    // echo $ct1_num;
    // echo $ct2_num;

    // DB 비율 
    $sql_page_db = "SELECT * FROM ( $sql_page ) AS subquery GROUP by subquery.cust_db";
    $db_arr = putData($sql_page_db);

    $db_input = []; // cust_db 의 컬럼 
    for ($i = 0; $i < count($db_arr); $i++) {
        array_push($db_input, $db_arr[$i]['cust_db']);
    }


    $db_num = []; // cust_db 의 개수
    for ($i = 0; $i < count($db_input); $i++) {
        $sql_page_db = "SELECT COUNT(*) AS num FROM ( $sql_page ) AS subquery WHERE subquery.cust_db = '$db_input[$i]'";
        //echo $sql_page_db."<br>";
        //echo  $db_input[$i];
        $result = mq($sql_page_db);
        $row = $result->fetch_assoc();
        $result_data = (int) $row['num'];
        array_push($db_num, $result_data);
    }
    //echo print_r($db_num);


    // cust_db의 비율 넣기

    $db_num['total_db_category'] = count($db_input); // cust_db 종류의 개수\

    // $db_num['total_db_num'] = 
    for ($i = 0; $i < count($db_input); $i++) {
        array_push($db_num, 100 * ($db_num[$i] / $columnCount));
    }



    $data['paging'] = array(
        'list' => $pageingDate['list'],
        'block_cnt' => $pageingDate['block_cnt'],
        'block_num' => $pageingDate['block_num'],
        'block_start' => $pageingDate['block_start'],
        'block_end' => $pageingDate['block_end'],
        'total_page' => $pageingDate['total_page'],
        'total_block' => $pageingDate['total_block'],
        'page_start' => $pageingDate['page_start'],
        'total' => $pageingDate['total'],
        'db_input' => $db_input,
        'db_num' => $db_num,
        'ct_arr' => $ct_arr,
    );
    //echo print_r($data['paging']);

    echo json_encode($data);
    //echo print_r($data);

}

// 카테고리 정보 넣기
if (isset($_POST['action']) && $_POST['action'] == "category_load") {
    $sql = "SELECT ct_name FROM category";

    echo json_encode(putData($sql));
}

// 소속 정보 
if (isset($_POST['action']) && $_POST['action'] == "mb_group_load") {
    $mb_level = isset($_POST['mb_level']) ? $_POST['mb_level'] : null;
    $mb_no = isset($_POST['mb_no']) ? $_POST['mb_no'] : null;

    if($mb_level == 2){
        // cust_mbgroup IN($mb_wr2)
        $sql_wr2 = "SELECT mb_wr2,mb_group FROM member WHERE mb_no = '$mb_no'";
        $result_wr2 = mysqli_query($conn, $sql_wr2);
        // 결과가 있는 경우에만 값을 가져옴
        if ($row_wr2 = mysqli_fetch_assoc($result_wr2)) {
            $mb_wr2 = $row_wr2['mb_wr2'];
            $mb_group = $row_wr2['mb_group'];
        } else {
            // 결과가 없을 경우의 처리
            $mb_wr2 = null; // 또는 다른 기본값 설정
        }

        $sql = "SELECT gp_no,gp_name FROM mb_group WHERE gp_no IN($mb_group,$mb_wr2)";
        //echo $sql;

    }else{
        $sql = "SELECT gp_no,gp_name FROM mb_group";
    }
    

    echo json_encode(putData($sql));
}

// 소속 정보 
if (isset($_POST['action']) && $_POST['action'] == "db_load") {
    $sql = "SELECT db_no,db_name FROM db_ct";
    echo json_encode(putData($sql));
}

// 고객 신규 입력
if (isset($_POST['action']) && $_POST['action'] == "customer_import") {

    $mb_no = $_POST['cust_mb_no'];
    echo $mb_no;
    $cust_mbname = $_POST['cust_mbname'];
    $cust_mbgroup = $_POST['cust_mbgroup'];

    $cust_name = $_POST['cust_name'];
    $cust_birth = $_POST['cust_birth'];
    $cust_tel = $_POST['cust_tel'];
    $cust_db = $_POST['cust_db'];

    $cust_ct1 = $_POST['cust_ct1'] ? 1 : 0;
    $cust_ct2 = $_POST['cust_ct2'] ? 1 : 0;
    $cust_ct3 = $_POST['cust_ct3'] ? 1 : 0;
    $cust_ct4 = $_POST['cust_ct4'] ? 1 : 0;
    $cust_ct5 = $_POST['cust_ct5'] ? 1 : 0;

    $cust_detail = $_POST['cust_detail'];


    $sql = "insert into customer 
    (cust_name, cust_birth, cust_tel, cust_db, cust_ct1, cust_ct2, cust_ct3, cust_ct4, cust_ct5, cust_detail, cust_mbname, cust_mbgroup, cust_reg_dt, cust_upd_dt,cust_wr1) 
    values('$cust_name', '$cust_birth', '$cust_tel', '$cust_db', '$cust_ct1', '$cust_ct2', '$cust_ct3', '$cust_ct4', '$cust_ct5', '$cust_detail', '$cust_mbname', '$cust_mbgroup', '$current_datetime', '$current_datetime','$mb_no')";

    

    echo print_r($arr);

    $result = mq($sql);
    $conn->error;
    mysqli_error($conn);

    if ($result) {
        alert_URL("입력되었습니다");
    } else {
        alert_URL("오류가 발생하였습니다");
    }

}

function putData($sql)
{
    global $conn;
    $data = array();

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        array_push($data, $row);
    }

    return $data;
}


?>