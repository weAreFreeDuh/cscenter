<?php include 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>


  <!-- <button class="box1" onclick="location.href='login/purpletest.php'">purpletest</button>
        <button class="box2" onclick="location.href='table/DataTable.php'">DataTable</button>
        <button class="box3" onclick="location.href='table/table-responsive.php'">table-responsive</button>
        <hr>
        <button class="box3" onclick="location.href='table/table_dark.php'">table_dark</button>
        <button class="box3" onclick="location.href='table/DataTable.php'">Test3</button>
        <button class="box3" onclick="location.href='table/DataTable.php'">Test3</button> -->


  <!-- <button class="box3" onclick="location.href='front/loginForm2.php'">로그인하기</button> -->
  <!-- <button class="box3" onclick="location.href='front/loginForm.php'">로그인하기1</button>
        <button class="box3" onclick="location.href='front/memberList.php'">회원목록</button>
        <button class="box3" onclick="location.href='front/slot_list.php?user_level=<?= $_SESSION['user_level'] ?>&user_id=<?= $_SESSION['user_id'] ?>'">슬롯목록</button>

        <button class="box3" onclick="location.href='login/login.php?logout=1'">로그아웃</button>

        <hr>
        <?php
        if (isset($_SESSION)) {
          echo "{$_SESSION['user_id']},{$_SESSION['user_name']},{$_SESSION['slot_cnt']},{$_SESSION['user_level']}";
          echo '<button class="box3" onclick="location.href=\'front/slot_upload.php\'">엑셀업로드</button>';
          echo '<button class="box3" onclick="location.href=\'front/slot_upload2.php\'">엑셀업로드2</button>';
          echo '<button class="box3" onclick="location.href=\'front/member_edit.php?user_id=' . $_SESSION['user_id'] . '\'">회원수정</button>';
        } else {
          echo "로그인 아님";
        }


        ?> -->

  <?php
   if(isset($_SESSION['user_id'])){
    header("location:".URL."/front/slot_list.php?user_level=".$_SESSION['user_level']."&user_id=".$_SESSION['user_id']."");
   }else{
    header("location: ".URL."/front/loginForm.php");
   }

  ?>

</body>

</html>