<?php

// 세션시작
session_start();

if(isset($_SESSION['mb_id'])){
    $mb_no = $_SESSION['mb_no'];
    $mb_id = $_SESSION['mb_id'];
    $mb_name = $_SESSION['mb_name'];
    $mb_level = $_SESSION['mb_level'];
    $mb_group = $_SESSION['mb_group'];
}

//현재 날짜
$currentD = date("Y-m-d");
//echo $currentD;

function alert_URL($msg){
    echo
    "
    <script>
    alert('".$msg."');
    document.location.href='".URL."/front/slot_list.php';
    </script>
    ";
}

function alert_joinForm($msg){
    echo
    "
    <script>
    alert('".$msg."');
    document.location.href='".URL."/front/joinForm.php';
    </script>
    ";
}

function alert_loginForm($msg){
    echo
    "
    <script>
    alert('".$msg."');
    document.location.href='".URL."/front/loginForm.php';
    </script>
    ";
}
function alert_memberList($msg){
    echo
    "
    <script>
    alert('".$msg."');
    document.location.href='".URL."/front/memberList.php';
    </script>
    ";
}


//오류코드 정보 수정
// error_reporting(E_ALL & ~E_WARNING);
// ini_set('display_errors', 0);

//////////////////////////////////////// 주소 관맂

define('CSS','/css');
define('JS','/js');
define('FRONT','/front');
define('site','yes');
// echo 123;
// 현재 서버 주소 
$currentSiteURL = 'http';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $currentSiteURL .= 's';
}
$currentSiteURL .= '://' . $_SERVER['HTTP_HOST'];
//  echo 123;
// 현재 서버 주소 URL 정의
define('URL',$currentSiteURL);

// 현재 서버의 CSS주소 URL 정의 
define('CSS_URL',$currentSiteURL.CSS);

// 현재 서버의 JS주소 URL 정의
define('JS_URL',$currentSiteURL.JS);

// Front 폴더의 css주소 url정의
define('FRONT_JS_URL',$currentSiteURL.FRONT.JS);
// Front 폴더의 js주소 url정의
define('FRONT_CSS_URL',$currentSiteURL.FRONT.CSS);
// Front 폴더 url 정의
define('FRONT_URL',$currentSiteURL.FRONT);
// 현재 서버 주소 반환
$serverPath = __DIR__;
define('SERVER',$serverPath);


// @붙이고 하면 오류코드 제거 가능.
// @include ('../member/memberController.php');

# 사이트 접속 정보
// 54.180.131.137:8080

// FTP주소 : cscenter.co.kr
// FTP아이디 : mycscenter
// 패스워드 : rkddkwl0210! (강아지0210!)

// DB HOST : localhost
// DB NAME : mycscenter_godohosting_com
// DB 아이디 : mycscenter
// DB패스워드 : rkddkwl0210! (강아지0210!)

// # DB 정보
// IP : 54.180.131.137
// 포트 :3336
// 아이디 : site
// 비번 : 1q2w3e00
// DB명 : db_site

// $EXECL_FIIE = '';

?>