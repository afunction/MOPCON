<?php
function getAllMembers()
{

    $lang_zh = json_decode(file_get_contents("locales/member-zh_TW.json"), true);
    $lang_en = json_decode(file_get_contents("locales/member-en.json"), true);
    $main = [
        'zh' => $lang_zh,
        'en' => $lang_en,
    ];

    return getI18n($main);
}