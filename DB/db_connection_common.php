<?php
//if (!defined('site')) exit;
// echo "<h1>Hello World123123</h1>";

// $server_name = "localhost"; // localhost  서버이름

// $user = "site";     // 유저이름
// $password = "1q2w3e00";     // 패스워드

// $port = "3336";     //포트 번호
// $database = "db_site";   //데이터베이스 이름

// $connect = mysqli_connect($server_name, $user, $password, $database);

// mysqli_select_db($connect, $database) or die("DB failed"); // DB 접속 실패시 DB failed 출력

$servername = "54.180.131.137";
$port = 3336;
$username = "site";
$password = "1q2w3e00";
$dbname = "db_site";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";


// $sql_query = "select * from member"; //DB 쿼리문 작성

// $result = mysqli_query($conn, $sql_query);   //쿼리문으로 받은 데이터를 $result에 넣어준다.

// // 넣은 값을 배열화 시킨다.
// while($row = mysqli_fetch_array($result)){

//     echo $row['user_id'];
//     echo "<br/>";
//     echo $row['user_pwd'];
//     echo "<br/>";
//     echo $row['user_name'];
//     echo "<br/>";
//     echo $row['slot_cnt'];
//     echo "<br/>";
//     echo $row['user_level'];
//     echo "<br/>";
//     echo $row['reg_dt'];
//     echo "<br/>";
//     echo $row['upd_dt'];
//     echo "<br/>";

// }


// ... 여기서부터 데이터베이스 쿼리와 작업을 수행할 수 있습니다 ...

// Connection 닫기
//$conn->close();
?>