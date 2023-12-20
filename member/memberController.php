<?php
include('../DB/db_connection.php');
include('../common.php');


function count_member()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT count(*) FROM member");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $countnum = $row["count(*)"];

            // 여기서 $id 값을 사용할 수 있습니다.
        }
    } else {
        echo "No results found";
    }

    return $countnum;
}

function memberList()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM member");
    $array = mysqli_fetch_array($result); // DB에서 받은 값을 배열에 넣는다.

    return $array;
}

if (isset($_POST['action']) && $_POST['action'] == "member_search") {

    // 아아디인지 이름인지
    $member_option = $_POST['member_option'];
    // 검색명
    $member_search = $_POST['member_search'];

    // echo $member_option;
    // echo $member_search;

    // $conn 전역변수 사용
    global $conn;

    // $sql= "select * from member where ".$member_option." Like '%".$member_search."%' ";
    // $result = mysqli_query($conn, $sql); 

    // $data = array();
    // while ($row = mysqli_fetch_array($result)) {
    //     array_push($data, $row);
    // }

    // echo json_encode($data);

    $sql = "select * from member where " . $member_option . " Like '%" . $member_search . "%' ";

    $result = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($data, $row);
    }
    echo json_encode($data);

}


if (isset($_POST['action']) && $_POST['action'] == "member_view") {
    $mb_no = $_POST['mb_no'];

    $join = "LEFT JOIN  grade as gr ON mem.mb_level = gr.gd_no
    LEFT JOIN mb_group as gp ON mem.mb_group = gp.gp_no ";

    $sql = ("select * from member as mem $join where mb_no = '$mb_no'");

    $sql2 = ("select * from grade");
    $sql3 = ("select * from mb_group");
    $data = ["grade" => [],"mb_group" => []];
   

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);

    while ($row = mysqli_fetch_array($result)) {
        // echo print_r($row);
        array_push($data, $row);
    }
    while ($row = mysqli_fetch_array($result2)) {
        // echo print_r($row);
        array_push($data["grade"], $row);
    }
    while ($row = mysqli_fetch_array($result3)) {
        // echo print_r($row);
        array_push($data["mb_group"], $row);
    }
    echo json_encode($data);
}


if (isset($_POST['action']) && $_POST['action'] == "member_conditionalList") {

    global $conn;
    $data = array();
    $page = $_POST['page'];
    $grade = $_POST['grade'];
    $mb_group = $_POST['mb_group'];
    $list_num = $_POST['list'];

    $join = "INNER JOIN grade as gr ON mem.mb_level = gr.gd_no
    INNER JOIN mb_group as gp ON mem.mb_group = gp.gp_no ";
    //echo $list_num;

    //echo "grade" . $grade . "mb_group" . $mb_group;

    $pageingDate = pageing('member', $page, $list_num, 10);

    $sql = mq("select * from member");
    $total_record = mysqli_num_rows($sql); // 회원 총 레코드 수

    $list = $pageingDate['list'];
    $block_cnt = $pageingDate['block_cnt'];
    $block_num = $pageingDate['block_num'];
    $block_start = $pageingDate['block_start'];
    $block_end = $pageingDate['block_end'];
    $total_page = $pageingDate['total_page'];
    $total_block = $pageingDate['total_block'];
    $page_start = $pageingDate['page_start'];

    /* 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
    if ($grade == 'all' && $mb_group == 'all') {
        //echo "all all";
        $sql2 = ("select * 
        FROM member as mem
        $join
        order by mb_no desc limit $page_start, $list");
    } else if ($grade != 'all' && $mb_group == 'all') {
        //echo "grade not all";
        $gradeSql = ("select gd_no from grade where gd_name = '$grade'");

        // 쿼리 실행
        $result = mysqli_query($conn, $gradeSql);

        // 쿼리 결과 확인
        if ($result) {
            // 결과에서 데이터 추출
            $row = mysqli_fetch_assoc($result);

            // 추출한 데이터를 변수에 할당
            $grade_no = $row['gd_no'];

            // 메모리 해제
            mysqli_free_result($result);
        }

        //echo "grade_no" . $grade_no;
        $sql2 = ("select * 
        from member as mem
        $join
        where mem.mb_level = $grade_no 
        order by mb_no desc limit $page_start, $list");
    } else if ($grade == 'all' && $mb_group != 'all') {
        //echo "mb_group not all";
        $mb_groupSql = ("select gp_no from mb_group where gp_name = '$mb_group'");

        // 쿼리 실행
        $result = mysqli_query($conn, $mb_groupSql);

        // 쿼리 결과 확인
        if ($result) {
            // 결과에서 데이터 추출
            $row = mysqli_fetch_assoc($result);

            // 추출한 데이터를 변수에 할당
            $grade_no = $row['gp_no'];

            // 메모리 해제
            mysqli_free_result($result);
        }

        //echo "mb_group_no" . $mb_group_no;
        $sql2 = ("select * from member as mem
        $join
        where mem.mb_group = $grade_no 
        order by mb_no desc limit $page_start, $list");
    } else {
        $gradeSql = ("select gd_no from grade where gd_name = '$grade'");

        // 쿼리 실행
        $result = mysqli_query($conn, $gradeSql);

        // 쿼리 결과 확인
        if ($result) {
            // 결과에서 데이터 추출
            $row = mysqli_fetch_assoc($result);

            // 추출한 데이터를 변수에 할당
            $grade_no = $row['gd_no'];

            // 메모리 해제
            mysqli_free_result($result);
        }

        //echo "grade_no" . $grade_no;

        $mb_groupSql = ("select gp_no from mb_group where gp_name = '$mb_group'");

        // 쿼리 실행
        $result2 = mysqli_query($conn, $mb_groupSql);

        // 쿼리 결과 확인
        if ($result2) {
            // 결과에서 데이터 추출
            $row = mysqli_fetch_assoc($result2);

            // 추출한 데이터를 변수에 할당
            $mb_group_no = $row['gp_no'];

            // 메모리 해제
            mysqli_free_result($result2);
        }

        //echo "mb_group_no" . $mb_group_no . "123";
        $sql2 = ("select * 
        from member as mem
        $join
        where mem.mb_level = $grade_no and 
        mem.mb_group = $mb_group_no 
        order by mb_no desc limit $page_start, $list");
    }


    $data = array();
    // $data['paging'] = array(); // 빈 배열로 초기화



    //array_push($data['paging'], $pageingDate);

    $result3 = mysqli_query($conn, $sql2);

    while ($row = mysqli_fetch_array($result3)) {
        // echo print_r($row);
        array_push($data, $row);
    }

    $data['paging'] = array(
        'list' => $list,
        'block_cnt' => $block_cnt,
        'block_num' => $block_num,
        'block_start' => $block_start,
        'block_end' => $block_end,
        'total_page' => $total_page,
        'total_block' => $total_block,
        'page_start' => $page_start,
        'total' => $total_record,
    );

    // for($i=0;$i<count($data);$i++){
    //     $data[$i]['group'] = $mb_group;
    //     $data[$i]['level'] = $grade;
    // }

    //echo print_r($data);


    echo json_encode($data);

}


if (isset($_POST['action']) && $_POST['action'] == "member_delete") {

    global $conn;
    $mb_no = $_POST['mb_no'];

    mq("delete from member where mb_no = '$mb_no'");

   
}

if (isset($_POST['action']) && $_POST['action'] == "member_active") {

    global $conn;
    $mb_no = $_POST['mb_no'];
   
    mq("update member set mb_approval=1 where mb_no = '$mb_no'");

}

if (isset($_POST['action']) && $_POST['action'] == "member_group_list") {

    global $conn;
    $mb_no = $_POST['mb_no'];
   
    $sql = "SELECT * FROM member where mb_no = '$mb_no'";

    $data = [];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        // echo print_r($row);
        array_push($data, $row);
    }

    $sql2 = "SELECT * FROM mb_group";

    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_array($result2)) {
        // echo print_r($row);
        array_push($data, $row2);
    }

    echo json_encode($data);
}


if (isset($_POST['member_import']) && $_POST['member_import'] == "member_add") {
    echo 123;
    global $conn;

    $mb_no = $_POST['mb_no_add'];
    $checkboxValues = $_POST['checkboxValues'];
    //echo print_r($_POST);
    $sql = "UPDATE member 
    SET mb_wr2 ='$checkboxValues'  
    WHERE mb_no='$mb_no'";
    //echo $sql;
    mq($sql);
    alert_memberList('그룹수정 성공');
    
}


if (isset($_POST['action']) && $_POST['action'] == "member_modify") {

    global $conn;

    $mb_no = $_POST['mb_no'];
    $mb_name = $_POST['mb_name'];
    $mb_email= $_POST['mb_email'];
    $mb_tel= $_POST['mb_tel'];
    $mb_wr1= $_POST['mb_wr1'];
    $gp_no= $_POST['gp_no'];
    $gd_no= $_POST['gd_no'];

    mq("UPDATE member 
    SET mb_name='$mb_name', 
    mb_email='$mb_email',
    mb_tel='$mb_tel',
    mb_level='$gd_no', 
    mb_group='$gp_no',
    mb_wr1='$mb_wr1' 
    WHERE mb_no='$mb_no'");
    

}


function pageing($table_name, $page = 1, $list, $block_cnt)
{

    $sql = mq("select * from $table_name");
    $total_record = mysqli_num_rows($sql); // 회원 총 레코드 수

    // $list = 5; // 한 페이지에 보여줄 개수
    // $block_cnt = 5; // 블록당 보여줄 페이지 개수
    $block_num = ceil($page / $block_cnt); // 현재 페이지 블록 구하기
    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


    $total_page = ceil($total_record / $list); // 페이징한 페이지 수
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
    );
}
?>