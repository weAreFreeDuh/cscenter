<?php
include_once("../DB/db_connection.php"); // DB 연결
include_once("../common.php"); // gg
include_once("otherfunction.php");

session_start(); // 세션을 쓰기 위해 설정해줘야하는 session.

$arr = array(); // 배열 변수 생성
$arr = $_POST; // POST 형식으로 받은 변수 배열화
// echo print_r($_POST) . "<br/><br/><br/>"; // 받은 총 변수 설정


$allowedExtensions = array("xlsx", "csv", "txt"); // 허용된 파일 확장자
$current_datetime = date("Y-m-d H:i:s");


// ajax slot list
if ($_POST['category'] == "load") {

    global $conn;
    $sql = "select gp_no,gp_name,gp_value from mb_group";
    $sql2 = "select ct_no,ct_name,ct_value from category";
    $sql3 = "select gd_no,gd_name,gd_value from grade";
    $sql4 = "select db_no,db_name,db_value from db_ct";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);

    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($data, $row);
    }
    while ($row2 = mysqli_fetch_array($result2)) {
        array_push($data, $row2);
    }
    while ($row3 = mysqli_fetch_array($result3)) {
        array_push($data, $row3);
    }
    while ($row4 = mysqli_fetch_array($result4)) {
        array_push($data, $row4);
    }

    //echo print_r($data);
    echo json_encode($data);
}


// ajax slot modify
if ($_POST['category'] == "modify") {

    global $conn;

    $tdArr_grade = $_POST['tdArr_grade'];
    $tdArr_group = $_POST['tdArr_group'];
    $tdArr_category = $_POST['tdArr_category'];
    $tdArr_db = $_POST['tdArr_db'];
    // echo print_r($_POST['tdArr_grade']);
    // echo print_r($_POST['tdArr_group']);
    // echo print_r($_POST['tdArr_category']);
    
    for ($i = 0; $i < count($tdArr_grade); $i++) {
        mysqli_query($conn, "Update grade set gd_name = '{$tdArr_grade[$i]['name']}' where gd_no = '{$tdArr_grade[$i]['no']}'");    
    }
    for ($i = 0; $i < count($tdArr_group); $i++) {
        mysqli_query($conn, "Update mb_group set gp_name = '{$tdArr_group[$i]['name']}' where gp_no = '{$tdArr_group[$i]['no']}'");    
    }
    for ($i = 0; $i < count($tdArr_category); $i++) {
        mysqli_query($conn, "Update category set ct_name = '{$tdArr_category[$i]['name']}' where ct_no = '{$tdArr_category[$i]['no']}'");    
    }
    for ($i = 0; $i < count($tdArr_db); $i++) {
        mysqli_query($conn, "Update db_ct set db_name = '{$tdArr_db[$i]['name']}' where db_no = '{$tdArr_db[$i]['no']}'");    
    }

}

// ajax slot modify
if ($_POST['category'] == "delete") {

    //echo 123;
    global $conn;

    $tdArr_grade = $_POST['tdArr_grade'];
    $tdArr_group = $_POST['tdArr_group'];
    $tdArr_category = $_POST['tdArr_category'];
    $tdArr_db = $_POST['tdArr_db'];
    
    echo print_r($_POST);
    $option ="";
    for ($i = 0; $i < count($tdArr_grade); $i++) {
        mysqli_query($conn, "DELETE FROM grade where gd_no = '{$tdArr_grade[$i]['no']}'");    
    }
    $option2 ="";
    for ($i = 0; $i < count($tdArr_group); $i++) {
        mysqli_query($conn, "DELETE FROM mb_group where gp_no = '{$tdArr_group[$i]['no']}'");    
    }
    $option3 ="";
    for ($i = 0; $i < count($tdArr_category); $i++) {
        mysqli_query($conn, "DELETE FROM category where ct_no = '{$tdArr_category[$i]['no']}'");    
    }
    $option4 ="";
    for ($i = 0; $i < count($tdArr_db); $i++) {
        mysqli_query($conn, "DELETE FROM db_ct where db_no = '{$tdArr_db[$i]['no']}'");    
    }

}

// ajax slot modify
if ($_POST['group_import'] == "group_import") {

    global $conn;

    $gp_name = $_POST['gp_name'] ;
    $gp_value = $_POST['gp_value'] ;

    if($gp_name != ""){
        mysqli_query($conn, "INSERT INTO mb_group (gp_name,gp_value) VALUES ('$gp_name','$gp_value')");    
    }
    
    $previous_page = $_SERVER['HTTP_REFERER'];
    echo "<meta http-equiv='refresh' content='0;url=$previous_page'>";
    exit;
}

// ajax slot modify
if ($_POST['db_import'] == "db_import") {
    
    global $conn;

    $db_name = $_POST['db_name'] ;
    $db_value = $_POST['db_value'] ;
    
    $sql ="INSERT INTO db_ct (db_name,db_value) VALUES ('$db_name','$db_value')";
    echo $sql;
    if($db_value != ""){
        mysqli_query($conn, $sql);    
    }
    
    $previous_page = $_SERVER['HTTP_REFERER'];
    echo "<meta http-equiv='refresh' content='0;url=$previous_page'>";
    exit;
}



if (isset($_POST["slot"])) {
    $targetDir = SERVER . "/uploads/"; // 파일을 저장할 디렉토리 경로

    // 현재 회원의 정보 가져오기
    $sql_slot_confirm = "select * from member where user_id = \"{$arr['user_id']}\"";
    $sql_slot_confirm_result = mysqli_query($conn, $sql_slot_confirm); //쿼리문으로 받은 데이터를 $result에 넣어준다.


    // member 정보 담기
    $member = array();
    while ($member_row = mysqli_fetch_assoc($sql_slot_confirm_result)) {
        $member['user_id'] = $member_row['user_id'];
        // $member['user_pwd'] = $member_row['user_pwd'];
        $member['user_name'] = $member_row['user_name'];
        $member['slot_cnt'] = $member_row['slot_cnt'];
        $member['user_level'] = $member_row['user_level'];
        $member['reg_dt'] = $member_row['reg_dt'];
        $member['upd_dt'] = $member_row['upd_dt'];
    }
    // echo "<br/> print_r(member)" . print_r($member); // 받은 총 변수 설정

    // 슬롯 넣은 갯수 가져오기
    $sql_slot_count = "select count(*) from slot where user_id = '" . $arr['user_id'] . "' ";
    $sql_slot_count_result = mysqli_query($conn, $sql_slot_count);

    while ($count_row = $sql_slot_count_result->fetch_assoc()) {
        $member_slot_num = $count_row["count(*)"];
    }

    // echo "countnum = " . intval($member_slot_num) . "<br/>";
    // echo "member = " . intval($member['slot_cnt']) . "<br/>";

    // 슬롯을 넣을 수 있을 시
    if (intval($member['slot_cnt']) > intval($member_slot_num)) {
        // echo "슬롯가능" . "<br/>";
        // echo print_r($_FILES['slot_name']) . "<br/>";
        $targetFile = $targetDir . basename($_FILES["slot_name"]["name"]);
        // echo $targetFile . "<br/>";

        // 파일 타입 확인
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        // echo $fileType . "<br/>";

        $uploadOk = 1;

        // 허용된 파일 확장자인지 확인
        if (!in_array($fileType, $allowedExtensions)) {
            // echo "허용되지 않는 파일 형식입니다.";
            $uploadOk = 0;
        }

        // 파일 업로드를 수행
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["slot_name"]["tmp_name"], $targetFile)) {
                // echo "파일이 업로드되었습니다.";
            } else {
                // echo "파일 업로드 중 오류가 발생했습니다." . $_FILES["slot_name"]["error"];
            }
        }
    }
}
