<?php
// $servername = "54.180.131.137";
// $port = 3336;
// $username = "site";
// $password = "1q2w3e00";
// $dbname = "db_site";

$servername = "localhost";
// $port = 3336;
$username = "mycscenter";
$password = "rkddkwl0210!";
$dbname = "mycscenter_godohosting_com";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function mq($sql){
    global $conn;
    return $conn->query($sql);
}



// $sql_query = "select * from category";
// $result = mysqli_query($conn, $sql_query);

// while($row = mysqli_fetch_array($result)){
//     echo $row['ct_name'];
//     echo "<br/>";
//     echo $row['ct_value'];
//     echo "<br/>";
// }

// echo "Connected successfully";


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

// echo print_r($row);


// ... 여기서부터 데이터베이스 쿼리와 작업을 수행할 수 있습니다 ...

// Connection 닫기
//$conn->close();

?>