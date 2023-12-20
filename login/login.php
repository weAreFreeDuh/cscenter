<?php
include_once("../DB/db_connection.php"); // DB 연결
include_once("./password.php"); // 패스워드 암호화
include_once("./loginFunction.php"); // 패스워드 암호화
include_once("./common.php"); // 패스워드 암호화

session_start(); // 세션을 쓰기 위해 설정해줘야하는 session.


$arr = array(); // 배열 변수 생성
$arr = $_POST; // POST 형식으로 받은 변수 배열화
echo print_r($_POST); // 받은 총 변수 설정
$current_datetime = date("Y-m-d H:i:s");

if (isset($_POST['login&join']) && $_POST['login&join'] == "login&join") {
    // 회원가입시
    if (count($arr) >= 4) { // 받은 배열 수가 3개보다 많을 경우 회원가입 시

        // 현재 날짜
        echo 12312312;
        $mb_id = trim($_POST["mb_id"]);
        $mb_pwd = trim($_POST["mb_pwd"]);
        $mb_name = trim($_POST["mb_name"]);
        $mb_email = trim($_POST["mb_email"]);
        echo $mb_id.$mb_pwd.$mb_name.$mb_email;
        // 하이폰 추가
        $phoneNumber = trim($_POST["mb_tel"]);
        $formattedPhoneNumber = preg_replace("/(\d{3})(\d{4})(\d{4})/", "$1-$2-$3", $phoneNumber);
        $mb_tel = $formattedPhoneNumber;

        // 회원 승인
        $mb_approval = 0;
        
        // 가입 , 수정 날 저장
        $mb_reg_dt = $current_datetime;
        $mb_upd_dt = $current_datetime;
        
        // memPassword 해쉬화 하기
        $hash_user_pwd = password_hash($mb_pwd, PASSWORD_BCRYPT);

        if (isset($_POST['admin']) && $_POST['admin'] == "admin") {
            // 문자를 숫자로 변경하기
            $slot_cnt = intval($_POST['slot_cnt']);
            // 사용자 환경 변경
            $user_level = '사용자';

            if (idCheck($user_id)) {
                $sql_query = "Insert into member (mb_id,mb_pwd,mb_name,mb_email,mb_tel,mb_approval,mb_reg_dt,mb_upd_dt) " .
                "values ('$mb_id','$hash_user_pwd','$mb_name','$mb_email','$mb_tel','$mb_approval','$mb_reg_dt','$mb_upd_dt')";
            } else {
                alert_joinForm('이미 있는 아이디입니다.');
            }
        } else {
            if (idCheck($mb_id)) {
                
                $sql_query = "Insert into member (mb_id,mb_pwd,mb_name,mb_email,mb_tel,mb_approval,mb_reg_dt,mb_upd_dt) " .
                    "values ('$mb_id','$hash_user_pwd','$mb_name','$mb_email','$mb_tel','$mb_approval','$mb_reg_dt','$mb_upd_dt')";
                
            } else {
                alert_joinForm('이미 있는 아이디입니다.');
            }
        }



        // $result = $conn->query($sql_query);

        if ($conn->query($sql_query) === TRUE) {
             echo "Record inserted successfully";
        } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        alert_URL('회원가입에 성공하였습니다.');
    } // if count($arr)>3
    else { // 로그인 시
        $mb_id = $_POST["mb_id"];
        $mb_pwd = $_POST["mb_pwd"];

        $result = mysqli_query($conn, "SELECT * FROM member WHERE mb_id = '$mb_id' ");
       
        $array = mysqli_fetch_array($result); // DB에서 받은 값을 배열에 넣는다.
        

        $hash_password = $array['mb_pwd']; // DB 내 패스워드 받기
        $mb_approval = $array['mb_approval']; // 유저의 사용허가 상태확인

        if ($mb_approval == 0) {
            alert_loginForm('승인 대기중 입니다.');
            
        } else {
            if (password_verify($mb_pwd, $hash_password)) { // 비밀번호가 일치하는지 비교합니다. 

                foreach ($array as $key => $val) {
                    if (!is_numeric($key)) {
                        if ($key != 'mb_pwd') { // key 값이 'mb_pwd'가 아닐 때만 $_SESSION에 넣음
                            $_SESSION[$key] = $val;
                        }
                    }
                }
                alert_URL('로그인 성공');
            } else { // 비밀번호 불 일치
                alert_loginForm('아아디, 패스워드가 틀립니다.');
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "modify") {
    // echo "modify <br/>";
    // echo print_r($_POST) . "<br/>";

    $user_id = trim($_POST["user_id"]);
    $user_name = trim($_POST["user_name"]);
    $slot_cnt = trim($_POST["slot_cnt"]);

    $user_level = trim($_POST["user_level"]);

    $upd_dt = $current_datetime;

    $sql_query = "UPDATE member
    SET user_name = '$user_name', slot_cnt = '$slot_cnt',user_level = '$user_level', upd_dt = '$upd_dt'
    WHERE user_id = '$user_id'";

    // 비밀번호 변경하고 싶을 시
    if (!empty($_POST["user_pwd"]) && $_POST["user_pwd"] !== null) {
        $user_pwd = trim($_POST["user_pwd"]);

        // memPassword 해쉬화 하기
        $hash_user_pwd = password_hash($user_pwd, PASSWORD_BCRYPT);

        $sql_query = "UPDATE member
        SET user_name = '$user_name', slot_cnt = '$slot_cnt',user_level = '$user_level', upd_dt = '$upd_dt', user_pwd = '$hash_user_pwd'
        WHERE user_id = '$user_id'";

    }

    if ($conn->query($sql_query) === TRUE) {
        // echo "Record inserted successfully";
         alert_URL("회원수정 성공");
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        alert_URL("회원수정 실패");
    }
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: " . URL . "");
    exit;
}

if (isset($_POST['member_import']) && $_POST['member_import'] == "member_changePw") {
    $mb_no_pw = trim($_POST["mb_no_pw"]);
    $mb_pwd = trim($_POST["mb_pwd"]);

    $hash_user_pwd = password_hash($mb_pwd, PASSWORD_BCRYPT);
    $sql = "Update member set mb_pwd = '$hash_user_pwd' where mb_no = $mb_no_pw";
    $result = mq($sql);
    if ($result) {
        alert_memberList("비밀번호 변경완료.");
    }else{
        alert_memberList("오류가 발생하였습니다.");
    }
}

if (isset($_GET["reset"]) && $_GET["reset"] == "1"){
    echo "reset";
$mb_pwd = "0000";

$hash_user_pwd = password_hash($mb_pwd, PASSWORD_BCRYPT);
$sql = "Update member set mb_pwd = '$hash_user_pwd' where mb_no = 1";
$result = mq($sql);
if ($result) {
    alert_loginForm(" 관리자 비밀번호 변경완료.");
}else{
    alert_loginForm("오류가 발생하였습니다.");
}

}
?>