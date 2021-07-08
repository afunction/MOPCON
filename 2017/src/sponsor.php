<?php
function getSponsors($id = 0)
{
    $google_data = json_decode(file_get_contents(__DIR__ . '/../api/sponsors.json'), true);
    $google_data = $google_data['feed']['entry'];
    $lang_zh = [];
    $lang_en = [];
    $sponsorLevel = ['Tony Stark', 'Bruce Wayne', 'Developer', 'Geek', '特別感謝'];
    foreach ($google_data as $item) {


        $lang_zh[$item['gsx$id']['$t']] = [
            'order'          => $item['gsx$贊助商編號']['$t'],
            'id'             => $item['gsx$id']['$t'],
            'type'           => $item['gsx$贊助商等級']['$t'],
            'name'           => $item['gsx$名稱']['$t'],
            'info'           => $item['gsx$介紹']['$t'],
            'logo'           => $item['gsx$照片']['$t'],
            'website'        => $item['gsx$網址']['$t'],
        ];

        $lang_en[$item['gsx$id']['$t']] = [
            'order'          => $item['gsx$贊助商編號']['$t'],
            'id'             => $item['gsx$id']['$t'],
            'type'           => $item['gsx$贊助商等級']['$t'],
            'name'           => $item['gsx$名稱en']['$t'],
            'info'           => $item['gsx$介紹en']['$t'],
            'logo'           => $item['gsx$照片']['$t'],
            'website'        => $item['gsx$網址']['$t'],
        ];
    }
    $main = [
        'zh' => $id !== 0 ? $lang_zh[$id] : $lang_zh,
        'en' => $id !== 0 ? $lang_en[$id] : $lang_en,
    ];

    return getI18n($main);
}
function getSponsorsByOrder()
{
    $sponsors = getSponsors();

    $data = [];
    foreach ($sponsors as $item) {
        $data[$item['order']] = [
            'id'             => $item['order'],
            'type'           => $item['type'],
            'title'          => isset($data[$item['order']]["name"]) ?
                $data[$item['order']]["name"] . " & " . $item['name'] :
                $item['name'],
            'sponsor_id'     => isset($data[$item['order']]['sponsor_id']) ?
                [$data[$item['order']]["sponsor_id"][0], $item['id']] :
                [$item['id']],

            'logo'        => isset($data[$item['order']]["logo"]) ?
                [$data[$item['order']]["logo"][0], $item['logo']] :
                [$item['logo']],
            'info'        => isset($data[$item['order']]["info"]) ?
                [$data[$item['order']]["info"][0], $item['info']] :
                [$item['info']],

            'website'        => isset($data[$item['order']]["website"]) ?
                [$data[$item['order']]["website"][0], $item['website']] :
                [$item['website']],


        ];
    }

    return $data;
}
