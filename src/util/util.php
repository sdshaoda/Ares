<?php

//namespace Ares\Util;

/**
 * 解析URL查询字符串
 * @param $qeury
 * @return array|null
 */
$container['queryParse'] = function ($qeury){
    if(empty($qeury)){
        return null;
    }
    $t_query = explode('&', $qeury);

    $queryArr = [];
    foreach ($t_query as $value){
        $t = explode('=', $value);
        if(!empty($t[1])){
            $queryArr[$t[0]] = $t[1];
        }
    }
    return $queryArr;
};
