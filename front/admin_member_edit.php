<?php

if (isset($_GET['user_id'])) {
     $_GET['user_id'];
}


$user_id = $_GET['user_id'];
$user_name = $_GET['user_name'];
$slot_cnt = $_GET['slot_cnt'];
$user_level = $_GET['user_level'];
$reg_dt = $_GET['reg_dt'];
$upd_dt = $_GET['upd_dt'];

include_once('header.php')?>
    <div class="login-form">
        <form method="post" action="<?= URL ?>/login/login.php" id="login-form">

            <input type="hidden" name="action" value="modify" class="input">
            
            <label>ID</label>
            <input type="text" name="user_id" value="<?=$_GET['user_id']?>" readonly  class="input"/>

            <label>PW</label>
            <input type="password" name="user_pwd" placeholder="PW"  class="input"/>

            <label>이름</label>
            <input type="text" name="user_name" value="<?=$_GET['user_name']?>"  class="input"/>

            <!-- 사용자나 관리자일경우 슬롯 갯수 수정 가능 -->
            <?php if ($_SESSION['user_level'] === '사용자' || $_SESSION['user_level'] === '관리자') { ?>

                <label>슬롯개수</label>
                <input type="text" name="slot_cnt" id="slot_cnt" value="<?= $_GET['slot_cnt'] ?>" oninput="validateNumber(this)" maxlength="1" class="input">
            <?php } ?>

            <!-- 관리자일 경우에만 변경가능 -->
            <?php if ($_SESSION['user_level'] === '관리자') { ?>
                <select name="user_level">
                    <option <?php if ($_GET['user_level'] === '미사용자')
                        echo 'selected'; ?>>미사용자</option>
                    <option <?php if ($_GET['user_level'] === '사용자')
                        echo 'selected'; ?>>사용자</option>
                    <option <?php if ($_GET['user_level'] === '관리자')
                        echo 'selected'; ?>>관리자</option>
                </select>
            <?php } ?>

            <button class="button">수정</button>
            <input type="button" onclick="history.back();" value="취소" class="button">
        </form>
    </div>
<?php include_once('footer.php');?>