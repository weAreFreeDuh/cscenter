<?php 

$filename = 'PhpOffice/PhpSpreadsheet/Writer/Xlsx.php'; // 파일 경로를 지정해주세요

// 파일의 권한 정보를 얻어옵니다
$permissions = fileperms($filename);

// 권한 정보를 8진수로 변환하여 출력합니다
echo 'File permissions: ' . decoct($permissions);

phpinfo();