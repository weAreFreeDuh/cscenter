<?php 

// 아이디 체크
function idCheck($mb_id){
    global $conn;
    
    $sql = "select mb_id from member";
    $result = mysqli_query($conn, $sql);

    $data = array(); // 배열 초기화
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['mb_id']; // user_id 값을 배열에 추가
    }

    echo print_r($data);

    if (in_array($mb_id, $data)) {
        echo "Duplicate keyword: " . $data . "<br/>";
        return false; 
    }else{
        return true;
    }
}
?>