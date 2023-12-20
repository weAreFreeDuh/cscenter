<?php include_once('header.php') ?>



<div class="login-wrap" style="min-height: 600px;">
    <div class="login-html">
        <label class="tab">가망 고객 신규추가</label>

        <form action="<?= URL ?>/slot/slotController.php" method="post">

            <?php if (isset($_SESSION)) { ?>
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <?php } ?>
            <div class="login-form">

                <div class="group">
                    <label for="user" class="label">슬롯명</label>
                    <input type="text" placeholder="슬롯명" name="slot_name" class="input" style="width: 90%" required>
                </div>

                <div class="group">
                    <label for="user" class="label">키워드</label>
                    <input type="text" placeholder="키워드" name="keyword" class="input" style="width: 90%" required>
                </div>
                <div class="group">
                    <label for="user" class="label">아이템 키</label>
                    <input type="text" placeholder="아이템 키" name="item_key" class="input" style="width: 90%" required>
                </div>
                <div class="group">
                    <label for="user" class="label">계약일</label>
                    <input type="date" name="con_st_dt" class="input" style="width: 90%" required>
                </div>
                <button type="submit" name="text_import" class="button">Import</button>

                <input type="button" onclick="history.back();" value="취소" class="button">
            </div>

        </form>
    </div>
</div>


</body>

</html>