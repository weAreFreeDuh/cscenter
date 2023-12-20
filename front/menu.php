<div class="menu">
<a href="<?=URL?>">HOME</a>
    <!-- 로그인 할 경우 -->
    <?php if(isset($_SESSION['mb_id'])){ // 로그인했을 경우
    
        echo '<a href="'.URL.'/login/login.php?logout=1">로그아웃</a>';
        // echo '<a href="'.URL.'/front/slot_upload.php">text업로드</a>'; 
        // echo '<a href="'.URL.'/front/slot_upload2.php">엑셀업로드</a>'; 
        // echo '<a href="'.URL.'/front/member_edit.php?user_id="'.$_SESSION['user_id'].'">회원수정</a>'; 
        echo '<a href="'.URL.'/front/category_edit.php">카테고리</a>'; 

        
            // 회원목록;
            echo '<a href="'.URL.'/front/memberList.php">회원목록</a>';
            echo '<a href="'.URL.'/front/slot_list.php?user_level='.$_SESSION['user_level'].'&user_id='.$_SESSION['user_id'].'">모든슬롯목록</a>';
        
            // 슬롯목록;
            echo '<a href="'.URL.'/front/slot_list.php?user_level='.$_SESSION['user_level'].'&user_id='.$_SESSION['user_id'].'">슬롯목록</a>';

        
        
    }else{  // 로그인 안했을 경우 
        // echo '<a href="'.URL.'front/loginForm.php">로그인하기</a>';

    }?>
</div>