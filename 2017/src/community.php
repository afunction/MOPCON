<?php
function getAllCommunities()
{

    $lang_zh = json_decode(file_get_contents("locales/community-zh_TW.json"), true);
    $lang_en = json_decode(file_get_contents("locales/community-en.json"), true);
    $main = [
        'zh' => $lang_zh,
        'en' => $lang_en,
    ];

    return getI18n($main);
}
function getSingleCommunity($id)
{
    $lang_zh = json_decode(file_get_contents("locales/community-zh_TW.json"), true);
    $lang_en = json_decode(file_get_contents("locales/community-en.json"), true);
    $main = [
        'zh' => $lang_zh[$id],
        'en' => $lang_en[$id],
    ];

    return getI18n($main);
}