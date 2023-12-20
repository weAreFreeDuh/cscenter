<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #3e94ec;
        font-family: "Roboto", helvetica, arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        text-rendering: optimizeLegibility;
    }

    a {
        color: inherit;
        text-decoration: none
    }

    .login-wrap {
        width: 100%;
        margin: auto;
        max-width: 525px;
        min-height: 500px;
        position: relative;

        box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
    }

    .login-html {
        width: 100%;
        height: 100%;
        position: absolute;
        padding: 90px 70px 50px 70px;
        background: rgba(40, 57, 101, .9);
    }

    .tab {
        border-bottom: 2px solid transparent;
        font-size: 22px;
        margin-right: 15px;
        padding-bottom: 5px;
        margin: 0 15px 10px 0;
        display: inline-block;
        color: #fff;
        border-color: #1161ee;
    }

    .input {
        border: none;
        padding: 15px 20px;
        border-radius: 25px;
        background: rgba(255, 255, 255, .1);
        width: 100%;
        color: #fff;
        display: block;
        box-sizing: border-box;

    }

    .label {
        color: #aaa;
        font-size: 12px;
        width: 100%;
        display: block;
        text-transform: uppercase;
        box-sizing: border-box;
    }

    .button {
        background: #1161ee;
        border: none;
        padding: 15px 20px;
        border-radius: 25px;
        width: 100%;
        color: #fff;
        display: block;
        text-transform: uppercase;
    }

    .group {
        margin-bottom: 15px;
    }

    .login-form {
        min-height: 345px;
        position: relative;
        /* perspective: 1000px;
        transform-style: preserve-3d; */
    }
</style>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label class="tab">Sign In</label>

            <div class="login-form">
                <!-- <div class="sign-in-htm"> -->
                <div class="group">
                    <label for="user" class="label">Username</label>
                    <input id="user" type="text" class="input">
                </div>

                <div class="group">
                    <label for="pass" class="label">Password</label>
                    <input id="pass" type="password" class="input" data-type="password">
                </div>
                <div class="group">
                    <!-- <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label> -->
                </div>
                <div class="group">
                    <input type="submit" class="button" value="Sign In">
                </div>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <!-- <a href="#forgot">Forgot Password?</a> -->
                </div>
                <!-- </div> -->

            </div>
        </div>
    </div>
</body>

</html>