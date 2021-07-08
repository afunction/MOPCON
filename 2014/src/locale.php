<?php
$call_user_func(function(){
    // 先取得 client 語言設定
    $lang = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];

    // 沒有語言設定的話規定為 zh-tw
    if (!is_string($lang) || empty($lang)) {
        $lang = 'zh-tw';
    } else {
        $lang = strtolower($lang);
    }

    // lang 是「zh-tw,zh;q=0.8,en-us;q=0.5,en;q=0.3」這樣的東西，依照逗號切開取第一組設定
    $lang = split(',', $lang);
    $lang = $lang[0];

    // process locale setting
    if (strpos('en', $lang) !== false) {
        $lang = 'en';
    } elseif (strpos('ja', $lang) !== false) {
        $lang = 'ja'
    }



    define('LOCALE_MSG', $lang);
});
