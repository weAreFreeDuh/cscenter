<?php
include_once("../DB/db_connection.php"); // DB 연결
include_once("../common.php"); // gg


session_start(); // 세션을 쓰기 위해 설정해줘야하는 session.

$current_datetime = date("Y-m-d H:i:s");

// 소속 정보 
if (isset($_POST['action']) && $_POST['action'] == "mb_group_load") {
    $sql = "SELECT gp_no,gp_name FROM mb_group";

    echo json_encode(putData($sql));
}

// 소속 정보 
if (isset($_POST['action']) && $_POST['action'] == "grade_load") {
    $sql = "SELECT gd_no,gd_name FROM grade";
    echo json_encode(putData($sql));
}


if (isset($_POST['action']) && $_POST['action'] == "member_list") {
    // 검색 분류
    $cust_keyword = isset($_POST['cust_keyword']) ? $_POST['cust_keyword'] : null;
    // 검색어
    $cust_search = isset($_POST['cust_search']) ? $_POST['cust_search'] : null;
    // 소속
    $gp_no = isset($_POST['gp_no']) ? $_POST['gp_no'] : null;
    // 등급
    $gd_no = isset($_POST['gd_no']) ? $_POST['gd_no'] : null;
    // 한번에 보여줄 개수
    $list = $_POST['list'] ? $_POST['list'] : 20;
    
    // 페이지
    $page = $_POST['page'];


    // 조인문
    $join = "LEFT JOIN grade ON member.mb_level = grade.gd_no
    LEFT JOIN mb_group ON member.mb_group = mb_group.gp_no";

    $order = " ORDER BY mb_reg_dt DESC";
    $limit = " LIMIT " . $list;
    $offset = " OFFSET " . ($page - 1) * $list;
    
    $option = "where 1 = 1";

    //echo "gd_no ".$gd_no;
    if ($cust_keyword && $cust_search) {
        $option .= " And $cust_keyword LIKE '%$cust_search%'";
    }
    if ($gp_no) {
        $option .= " And mb_group.gp_no = $gp_no";
    }
    if ($gd_no) {
        $option .= " And grade.gd_no = $gd_no";
    }
    
    $sql_page = "select * from member $join $option $order $limit $offset";
    //echo "sql_page ".$sql_page;
    $sql = "select * from member $join $option $order";
    "sql_page ".$sql;

    $pageingDate = pageing2($sql, $page, $list, 10);

    //echo "sql <br/> ".$sql."<br/>";
    //echo "sql_page <br/>".$sql_page;

    $data = [
        'paging' => [
        ],
    ];

    $result = mysqli_query($conn, $sql_page);

    while ($row = mysqli_fetch_array($result)) {
        // echo print_r($row);
        array_push($data, $row);
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
        'page' => $page,
    );

    echo json_encode(($data));

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


function pageing2($sql, $page = 1, $list, $block_cnt)
{

    $sql = mq($sql);
    $total = mysqli_num_rows($sql); // 회원 총 레코드 수

    // $list = 5; // 한 페이지에 보여줄 개수
    // $block_cnt = 5; // 블록당 보여줄 페이지 개수
    $block_num = ceil($page / $block_cnt); // 현재 페이지 블록 구하기
    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


    $total_page = ceil($total / $list); // 페이징한 페이지 수
    if ($block_end > $total_page) { // 블록의 마지막 번호가 페이지 수 보다 많다면
        $block_end = $total_page; // 마지막 번호는 페이지 수
    }
    $total_block = ceil($total_page / $block_cnt); // 블럭 총 개수
    $page_start = ($page - 1) * $list; // 페이지 시작

    $pageingDate = array();

    return $pageingDate = array(
        'list' => $list,
        'block_cnt' => $block_cnt,
        'block_num' => $block_num,
        'block_start' => $block_start,
        'block_end' => $block_end,
        'total_page' => $total_page,
        'total_block' => $total_block,
        'page_start' => $page_start,
        'total' => $total,
    );
}


?>