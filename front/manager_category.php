<?php include_once('header.php') ?>

<?php
if (($_SESSION['mb_level'] == 1)) {
} else {
    alert_URL('관리자 전용입니다');
    exit;
}
include_once('backStyle.php')
?>

<style>
    .m-layer { width: 100%; }
    .sm-layer { width: 30%; float: left; }
    .bm-layer { width: 69%; float: right; }
    .manager-category-title {
        float: left;
        margin: 10px 20px 0 10px;
        line-height: 43px;
    }
</style>

<input type="hidden" id="user_level" value="<?= $user_level ?>">
<input type="hidden" id="user_id" value="<?= $user_id ?>">
<div class="m-layer">
    <div class="main sm-layer">
        <div class="table-container">
            <div class="nowrap">
                <div class="manager-category-title fs"> 담보 카테고리 </div>
                <input class="input" type='text' id='warrantCategoryTxt' style="width: 40%; border: 1px solid;">

                <button type="button" id="warrantCategoryBtn" class="button fs_w">추가하기+</button>
            </div>
            <div class="nowrap">
                <table class="table" id="warrantCategoryList" style="margin: 0; width: 100%;">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" class="suject">선택</th>
                        <th scope="col">순서</th>
                        <th scope="col">카테고리명</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;">
                            <button type="button" id="warrantCategoryUpdateBtn" class="button fs_w">수정하기</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="main bm-layer">
        <div class="table-container">
            <div class="nowrap">
                <div class="manager-category-title fs"> 담보명 </div>
                <select id="cust_keyword" class="fs" style="margin: 0 10px; border: 1px solid; padding: 10px 45px;">
                    <?php if ($mb_level == 1 || $mb_level == 2) { ?>
                        <!-- <option value="user_id">소속</option> -->
                        <option value="cust_mbname">작성자</option>
                    <?php } ?>
                </select>
                <input class="input" type='text' id='warrantNameTxt' style="width: 60%; border: 1px solid;">

                <button type="button" id="warrantNameBtn" class="button fs_w">추가하기+</button>
            </div>
            <div class="nowrap">
                <table class="table" id="warrantNameList" style="margin: 0; width: 100%;">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" class="suject">선택</th>
                        <th scope="col">순서</th>
                        <th scope="col">카테고리명</th>
                        <th scope="col">담보명</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            <button type="button" id="warrantNameUpdateBtn" class="button fs_w">수정하기</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(() => {

    });
</script>