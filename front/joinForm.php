<?php include_once('header.php') ?>

<style>
    body{
        background-color: #375986;

    }
</style>


<div class="margin-top-100"></div>
<?php if ($user_level == '관리자') { ?>
    <div class="login-wrap" style="min-height: 600px;">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label class="tab">관리자 전용 회원가입</label>
            <div class="login-form">
                <form method="post" action="<?= URL ?>/login/login.php" id="login-form">
                    <input type="hidden" name="admin" value="admin">
                    <input type="hidden" name="login&join" value="login&join">
                    <!-- <span>관리자 전용 회원가입</span> -->

                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input type="text" name="user_id" placeholder="ID" class="input" required />
                    </div>

                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input type="password" name="user_pwd" placeholder="PW" class="input" required />
                    </div>

                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input type="text" name="user_name" placeholder="NAME" class="input" required />
                    </div>

                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input type="text" name="slot_cnt" placeholder="슬롯가능수" class="input" onkeyup="numberInput(this)"
                            required />
                    </div>

                    <button class="button" style="width: 100%">회원가입</button>


                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="login-wrap" style="min-height: 600px;">
            <div class="login-html">
                <label class="tab fs_w">Register</label>
                <div class="login-form">

                    <form method="post" action="<?= URL ?>/login/login.php" id="login-form">
                        <input type="hidden" name="login&join" value="login&join">
                        <div class="group">
                        <input type="text" name="mb_id" placeholder="ID" class="input" required />
                        </div>
                        <div class="group">
                        <input type="password" name="mb_pwd" placeholder="PW" class="input" required />
                        </div>
                        <!-- 추가 -->
                        <div class="group">
                        <input type="text" name="mb_name" placeholder="name" class="input" required />
                        </div>
                        <div class="group">
                        <input type="email" name="mb_email" placeholder="email" class="input" required />
                        </div>
                        <div class="group">
                        <input type="text" name="mb_tel" placeholder="tel" class="input" required />
                        </div>
                        <!-- <div class="group">
                        <input type="text" name="mb_id" placeholder="tel" class="input" required />
                        </div> -->
                        
                        <div class="group just_right">
                        <button class="button fs_w">회원가입</button>
                        <input type="button" onclick="home()" class="button fs_w" value="HOME">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php include_once('footer.php'); ?>