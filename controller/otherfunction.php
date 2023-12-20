<?php
function availableSlotCount($user_id)
{   
    global $conn;

    // 현재 회원의 정보 가져오기
    $sql_slot_confirm = "select * from member where user_id = '$user_id'";
    $sql_slot_confirm_result = mysqli_query($conn, $sql_slot_confirm); //쿼리문으로 받은 데이터를 $result에 넣어준다.

    // member 정보 담기
    $member = array();
    while ($member_row = mysqli_fetch_assoc($sql_slot_confirm_result)) {
        $member['user_id'] = $member_row['user_id'];
        $member['user_pwd'] = $member_row['user_pwd'];
        $member['user_name'] = $member_row['user_name'];
        $member['slot_cnt'] = $member_row['slot_cnt'];
        $member['user_level'] = $member_row['user_level'];
        $member['reg_dt'] = $member_row['reg_dt'];
        $member['upd_dt'] = $member_row['upd_dt'];
    }

    // 슬롯 넣은 갯수 가져오기
    $sql_slot_count = "select count(*) from slot where user_id = '$user_id' ";
    $sql_slot_count_result = mysqli_query($conn, $sql_slot_count);

    while ($count_row = $sql_slot_count_result->fetch_assoc()) {
        $member_slot_num = $count_row["count(*)"];
    }

    $availableSlotCount = intval($member['slot_cnt']) - intval($member_slot_num);

    return $availableSlotCount;
}

// 인덱스 페이지 메세지 창
function upload_success($msg){
    echo
    "
    <script>
    alert('".$msg."');
    document.location.href='".URL."';
    </script>
    ";
}

// 파일 삭제 함수
function delete_file($filename){
    if (file_exists($filename)) {
        if (unlink($filename)) {
            echo "File deleted successfully.";
        } else {
            echo "Error deleting the file.";
        }
    } else {
        echo "File does not exist.";
    }
}

// slot 전체 값 가져오는 함수
function slot_imfo($idx){
    global $conn;
    $user_id = $_POST['idx'];

    $sql = "select * from slot where idx = '{$user_id}'";
    $result = mysqli_query($conn, $sql);

    while ($slot_row = mysqli_fetch_assoc($result)) {
        $slot['idx'] = $slot_row['idx'];
        $slot['user_id'] = $slot_row['user_id'];
        $slot['keyword'] = $slot_row['keyword'];
        $slot['item_key'] = $slot_row['item_key'];
        $slot['slot_name'] = $slot_row['slot_name'];
        $slot['slot_file'] = $slot_row['slot_file'];
        $slot['reg_dt'] = $slot_row['reg_dt'];
        $slot['upd_dt'] = $slot_row['upd_dt'];
        $slot['con_st_dt'] = $slot_row['con_st_dt'];
        $slot['con_end_dt'] = $slot_row['con_end_dt'];
    }

    return  $slot;
}
?>