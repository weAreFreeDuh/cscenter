<?php

function pageing2($sql, $page = 1, $list, $block_cnt)
{

    $sql = mq($sql);
    $total = mysqli_num_rows($sql); // 회원 총 레코드 수

    // $list = 5; // 한 페이지에 보여줄 개수
    // $block_cnt = 5; // 블록당 보여줄 페이지 개수
    $block_num = ceil($page / $block_cnt); // 현재 페이지 블록 구하기
    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...


    $total_page = ceil($total / $list); // 페이징한 페이지 수
    if ($block_end > $total_page) { // 블록의 마지막 번호가 페이지 수 보다 많다면
        $block_end = $total_page; // 마지막 번호는 페이지 수
    }
    $total_block = ceil($total_page / $block_cnt); // 블럭 총 개수
    $page_start = ($page - 1) * $list; // 페이지 시작

    $pageingDate = array();

    return $pageingDate = array(
        'list' => $list,
        'block_cnt' => $block_cnt,
        'block_num' => $block_num,
        'block_start' => $block_start,
        'block_end' => $block_end,
        'total_page' => $total_page,
        'total_block' => $total_block,
        'page_start' => $page_start,
        'total' => $total,
    );
}

?>