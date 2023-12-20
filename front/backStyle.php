<style>
    /* 팀원 - 파란색 */
    <?php if ($mb_level == 1) { ?>
        body {
        background-color: #8e77a3;
    }
    

    <?php }if ($mb_level == 2) { ?>
    /* 중간관리자 - 하늘색 */
    body {
        background-color: #7dc2d0;
    }

    <?php }if ($mb_level == 3) { ?>
    /* 관리자 - 보라색 */
    body {
        background-color: #375986;
    }
    <?php }?>
</style>
