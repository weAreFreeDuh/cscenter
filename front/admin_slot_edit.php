<?php
include_once('header.php');
if (isset($_GET['user_id'])) {
    $_GET['user_id'];
}
$idx = $_GET['idx'];
$slot_name = $_GET['slot_name'];
$user_id = $_GET['user_id'];
$keyword = $_GET['keyword'];
$item_key = $_GET['item_key'];
// $slot_name = $_GET['slot_name'];
$reg_dt = $_GET['reg_dt'];
$upd_dt = $_GET['upd_dt'];
$con_st_dt = $_GET['con_st_dt'];
$con_end_dt = $_GET['con_end_dt'];

// echo $con_end_dt . "<br/>";
// echo $currentD . "<br/>";

if (isset($con_end_dt)) {
    $date = $con_end_dt;
} else {
    $date = $con_end_dt;
}

?>
<div class="login-form">
    <form method="post" action="<?= URL ?>/slot/slotController.php" id="login-form">

        <input type="hidden" name="action" value="modify">
        <input type="hidden" name="idx" value="<?= $idx ?>">
        <label>아이디</label>
        <input type="text" name="user_id" value="<?= $user_id ?>" readonly class="input" />

        <label>슬롯명</label>
        <input type="text" name="slot_name" value="<?= $slot_name ?>" class="input" />

        <label>keyword</label>
        <input type="text" name="keyword" value="<?= $keyword ?>" class="input" />

        <label>item_key</label>
        <input type="text" name="item_key" value="<?= $item_key ?>" readonly class="input" />

        <!-- <label>계약일</label>
        <input type="date" name="con_st_dt" class="input"> -->
        <?php if ($_SESSION['user_level'] == '관리자') { ?>
            <label>만료일</label>
            <input type="button" onclick="formattedDate(30)" value="+30일" class="button">
            <input type="button" onclick="formattedDate(365)" value="+1년" class="button">
            <input type="date" name="con_end_dt" class="input" id="con_end_dt" value="<?= $date ?>">

        <?php } ?>

        <button class="button">수정</button>
        <input type="button" onclick="history.back();" value="취소" class="button">
    </form>

</div>
</body>
<script>
    function validateNumber(input) {
        var value = input.value;
        var newValue = value.replace(/[^1-9]/g, ''); // 1부터 9까지의 숫자만 남기기

        if (newValue !== value) {
            input.value = newValue; // 수정된 값으로 입력 필드 업데이트
        }
    }

    function formattedDate(Day) {
        var currentDate = new Date($('#con_end_dt').val());
        console.log("currentDate "+currentDate);

        var futureDate = currentDate;
        console.log("Day"+Day);
        futureDate.setDate(currentDate.getDate() + Day); // Day만큼 덧셈
        console.log("futureDate "+futureDate);

        // 2023-09-02 출력방법
        var year = futureDate.getFullYear();
        var month = ("0" + (futureDate.getMonth() + 1)).slice(-2); // 0부터 시작하므로 1을 더해줌
        var day = ("0" + futureDate.getDate()).slice(-2);

        var formattedDate = year + "-" + month + "-" + day;
        console.log("formattedDate "+formattedDate);

        // 값넣기
        $("#con_end_dt").val(formattedDate);
        console.log("con_end_dt  "+con_end_dt);
        console.log("#################################");
    }
</script>

</html>