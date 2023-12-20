<?php include 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= FRONT_CSS_URL ?>/style.css">
    <title>cscenter</title>
    <script src="js/jquery.min.js"></script>
</head>

<body>
    <div class="container">

        <div class="left_menu">

            <?php if ($mb_level == 1) { ?>
                <a href="../login/login.php?logout=1" class="fs_w" style="font-size: 12px;">로그아웃&nbsp; | &nbsp;</a>
                <a href="slot_list.php" class="fs_w" style="font-size: 12px;">고객관리&nbsp; | &nbsp;</a>
                <a href="memberList.php" class="fs_w" style="font-size: 12px;">회원관리&nbsp; | &nbsp;</a>
                <a href="category_edit.php" class="fs_w" style="font-size: 12px;"> 카테고리관리</a>
                <?php if($mb_id === "rainbow85213") { ?>
                    <a href="manager_category.php" class="fs_w" style="font-size: 12px;">&nbsp; | &nbsp;매니저 카테고리 관리</a>
                <?php } ?>
            <?php } ?>

            <?php if ($mb_level == 2) { ?>
                <a href="../login/login.php?logout=1" class="fs_w" style="font-size: 12px;">로그아웃&nbsp; | &nbsp;</a>
                <a href="slot_list.php" class="fs_w" style="font-size: 12px;">고객관리</a>
                <!-- <a href="category_edit.php" class="fs_w" style="font-size: 12px;"> 카테고리관리</a> -->
            <?php } ?>

            <?php if ($mb_level == 3)  { ?> 
                <a href="../login/login.php?logout=1" class="fs_w" style="font-size: 12px;">로그아웃&nbsp; | &nbsp;</a>
                <a href="slot_list.php" class="fs_w" style="font-size: 12px;">고객관리</a>
            <?php } ?> 
        </div>
        <header class="header">

            <label class="fs_w" style="font-size: 32px;">가망고객 관리 시스템<br /></label>
            <?php if ($mb_level == 1) { ?>
                <!-- 팀원 - 파란색 -->
                <label class="fs_w" style="font-size: 12px;">매일 진행상황 업데이트 후 퇴근은 필수입니다</label>
            <?php }
            if ($mb_level == 2) { ?>
                <!-- 중간관리자 - 하늘색 -->
                <label class="fs_w" style="font-size: 12px;">버려지는 가망없이 적극적인 터치와 문제해결</label>
            <?php }
            if ($mb_level == 3) { ?>
                <!-- 관리자 - 보라색 -->
                <label class="fs_w" style="font-size: 12px;">버려지는 가망없이 적극적인 터치와 문제해결<< /label>
                    <?php } ?>

        </header>

        <div class="margin-top-100"></div>