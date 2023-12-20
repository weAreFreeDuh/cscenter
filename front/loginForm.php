<?php include_once('header.php') ?>
<style>
    body{
        background-color: #375986;

    }
</style>


<div class="margin-top-100"></div>

<div class="login-wrap">
    <div class="login-html">
        <label class="tab fs_w">Login</label>
        <div class="login-form">
            <form method="post" action="<?= URL ?>/login/login.php" id="login-form">

                <input type="hidden" name="login&join" value="login&join">

                <div class="group">
                    <input type="text" name="mb_id" placeholder="ID" class="input" />
                </div>
                <div class="group">
                    
                    <input type="password" name="mb_pwd" placeholder="PW" class="input" />
                </div>

                <div class="group just_right">
                    <input type="submit" value="접속하기" class="button fs_w">
                    <input type="button"onclick="location.href='<?= FRONT_URL ?>/joinForm.php'"
                    value="회원가입" class="button fs_w">
                </div>
                
            </form>
        </div>
    </div>

</div>

<div class="margin-top-200"></div>


<?php include_once('footer.php') ?>