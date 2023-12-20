<?php
include_once("../DB/db_connection.php"); // DB 연결
include_once("../common.php"); // gg
include_once("../slot/slotfunction.php");

header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename = excel_customer_list.xls");     //filename = 저장되는 파일명을 설정합니다.
header("Content-Description: PHP4 Generated Data");
//echo $_GET['cust_no'];
$cust_arr = $_GET['cust_no'];
$cust_db_info = json_decode($_GET['cust_db_info'],true);
$cust_ct_info = json_decode($_GET['cust_ct_info'],true);

//echo print_r($cust_db_info);
//echo print_r($cust_ct_info);

if (isset($cust_arr)) {
    $option = " where customer.cust_no IN( " . $cust_arr . ")";
} else {
    $option = "";
}

$join = " JOIN mb_group ON mb_group.gp_no = customer.cust_mbgroup ";
$sql = "SELECT * FROM `customer` $join $option ";

// echo $sql;

$data = array();

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    array_push($data, $row);
}

//echo print_r($data);
// echo print_r($data[0]["gp_name"]);
// echo ($data[0]["gp_name"]);
// echo ($data[0]['gp_name']);

$EXCEL_FILE = "
    <table border='1'>
    <tr>
       <td>소속</td>
       <td>이름</td>
       <td>작성일시</td>
       <td>고객명</td>
       <td>생년월일</td>
       <td>연락처</td>
       <td>디비종류</td>
       <td>병력</td>
       <td>설계심사</td>
       <td>자료준비</td>
       <td>전화예약</td>
       <td>대면예약</td>
       <td>계약완료</td>
    </tr>
    ";

for($i=0;$i<count($data); $i++){
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['gp_name'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_mbname'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_reg_dt'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_name'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_birth'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_tel'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_db'] . "</td>";
$EXCEL_FILE .= "<td class='col'>" . $data[$i]['cust_detail'] . "</td>";
if ($data[$i]['cust_ct1'] == 1) {
    $EXCEL_FILE .= "<td class='col'>V</td>";
} else {
    $EXCEL_FILE .= "<td class='col'></td>";
}
if ($data[$i]['cust_ct2'] == 1) {
    $EXCEL_FILE .= "<td class='col'>V</td>";
} else {
    $EXCEL_FILE .= "<td class='col'></td>";
}
if ($data[$i]['cust_ct3'] == 1) {
    $EXCEL_FILE .= "<td class='col'>V</td>";
} else {
    $EXCEL_FILE .= "<td class='col'></td>";
}
if ($data[$i]['cust_ct4'] == 1) {
    $EXCEL_FILE .= "<td class='col'>V</td>";
} else {
    $EXCEL_FILE .= "<td class='col'></td>";
}
if ($data[$i]['cust_ct5'] == 1) {
    $EXCEL_FILE .= "<td class='col'>V</td>";
} else {
    $EXCEL_FILE .= "<td class='col'></td>";
}
$EXCEL_FILE .= "</tr>";
}
$EXCEL_FILE .= "</table>";
$EXCEL_FILE .= "<br/>";

$EXCEL_FILE .= "<table border='1'>";
for($i=0;$i<count($cust_db_info);$i++){

    $EXCEL_FILE .= "<tr>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_db_info[$i]['value1'] . "</td>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_db_info[$i]['value2'] . "</td>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_db_info[$i]['value3'] . "</td>";
    $EXCEL_FILE .= "</tr>";
}
$EXCEL_FILE .= "</table>";
$EXCEL_FILE .= "<br/>";

$EXCEL_FILE .= "<table border='1'>";
for($i=0;$i<count($cust_ct_info);$i++){

    $EXCEL_FILE .= "<tr>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_ct_info[$i]['value1'] . "</td>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_ct_info[$i]['value2'] . "</td>";
    $EXCEL_FILE .= "<td class='col'>" . $cust_ct_info[$i]['value3'] . "</td>";
    $EXCEL_FILE .= "</tr>";
}
$EXCEL_FILE .= "</table>";



// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
?>