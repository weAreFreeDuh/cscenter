<!-- 견적서 요청 팝업 -->
<div id="popup" class="popup">
    <p class="fs flex_center">고객 입력</p>
    <form action="../slot/slotController.php" method="POST" id="member_import">

    <input type="hidden" name="action" id="action" value="customer_import">
    <input type="hidden" name="cust_no" id="cust_no" value="">
    <input type="hidden" name="cust_mbname" value="<?=$mb_name?>">
    <input type="hidden" name="cust_mbgroup" value="<?=$mb_group?>">
    <input type="hidden" name="cust_mb_no" value="<?=$mb_no?>">
    
    

    <div class="PopUp_input_wrap">
        <div class="input-box">
            <p class="input-title">고객명</p>
            <input type="text" class="input company_name" name="cust_name" id="cust_name" placeholder="고객명">
        </div>
        <div class="input-box">
            <p class="input-title">생년월일</p>
            <input type="text" class="input company_name" name="cust_birth" id="cust_birth" placeholder="생년월일">
        </div>
        <div class="input-box">
            <p class="input-title">연락처</p>
            <input type="text" class="input company_name" name="cust_tel" id="cust_tel" placeholder="연락처">
        </div>
        <div class="input-box">
            <p class="input-title">디비종류</p>
            <!-- <input type="text" class="input company_name" name="cust_db" id="cust_db" placeholder="디비종류"> -->
            <select name="cust_db" id="cust_db" class="input company_name" style="margin : 0px;">
                
            </select>
        </div>
        <div class="input-box" style="border-radius: 24px; border: solid 1px #e4e4e4; box-shadow: 0 4px 0px 0 rgba(0, 0, 0, 0.24);">
            
            <!-- <input id="company_name" type="text" class="input" name="cust_db" placeholder="디비종류"> -->
            <div style="margin-left: 30px" class="category_check">
            <span class="ct0">설계심사</span><input type="checkbox" name="cust_ct1" id="cust_ct1" value="1">
            <span class="ct1">설계심사</span><input type="checkbox" name="cust_ct2" id="cust_ct2" value="1">
            <span class="ct2">설계심사</span><input type="checkbox" name="cust_ct3" id="cust_ct3" value="1">
            <span class="ct3">설계심사</span><input type="checkbox" name="cust_ct4" id="cust_ct4" value="1">
            <span class="ct4">설계심사</span><input type="checkbox" name="cust_ct5" id="cust_ct5" value="1">
            </div>
        </div>
        <div class="input-box repo">
            <p class="input-title">병력</p>
            <textarea class="textarea" placeholder="병력" name="cust_detail" id="cust_detail"></textarea>
        </div>
        
    </div>
    <div class="PopUp_btn_wrap just_right">
        
        <input type="button" id="close" class="button fs_w popUpClose" value="닫기">
        <input type="submit" id="popupSubmitBtn" class="button fs_w" value="확인">
        
    </div>
    </form>
</div>


