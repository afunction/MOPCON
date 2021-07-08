<?php
function getSpeakers($speaker_id = 0)
{
    $google_data = json_decode(file_get_contents(__DIR__ . '/../api/speakers.json'), true);
    $google_data = $google_data['feed']['entry'];
    $lang_zh = [];
    $lang_en = [];

    foreach ($google_data as $item) {
        $lang_zh[$item['gsx$講者編號']['$t']] = [
            'speaker_id'     => $item['gsx$講者編號']['$t'],
            'name'           => $item['gsx$姓名']['$t'],
            'type'           => $item['gsx$類別']['$t'],
            'job'            => $item['gsx$職稱']['$t'],
            'info'           => $item['gsx$個人介紹']['$t'],
            'picture'        => $item['gsx$照片']['$t'],
            'facebook'       => $item['gsx$facebook']['$t'],
            'github'         => $item['gsx$github']['$t'],
            'blog'           => $item['gsx$blog']['$t'],
            'website'        => $item['gsx$website']['$t'],
            'linkedin'       => $item['gsx$linkedin']['$t'],
            'schedule_topic' => $item['gsx$演講主題']['$t'],
            'schedule_info'  => $item['gsx$演講摘要']['$t'],
            'schedule_id'    => $item['gsx$議程編號']['$t'],
            'video_record'   => $item['gsx$禁止錄影']['$t'],
            'slide'          => $item['gsx$slide']['$t'],
        ];

        $lang_en[$item['gsx$講者編號']['$t']] = [
            'speaker_id'     => $item['gsx$講者編號']['$t'],
            'name'           => $item['gsx$姓名en']['$t'],
            'type'           => $item['gsx$類別']['$t'],
            'job'            => $item['gsx$職稱']['$t'],
            'info'           => $item['gsx$個人介紹en']['$t'],
            'picture'        => $item['gsx$照片']['$t'],
            'facebook'       => $item['gsx$facebook']['$t'],
            'github'         => $item['gsx$github']['$t'],
            'blog'           => $item['gsx$blog']['$t'],
            'website'        => $item['gsx$website']['$t'],
            'linkedin'       => $item['gsx$linkedin']['$t'],
            'schedule_topic' => $item['gsx$演講主題en']['$t'],
            'schedule_info'  => $item['gsx$演講摘要en']['$t'],
            'schedule_id'    => $item['gsx$議程編號']['$t'],
            'video_record'   => $item['gsx$禁止錄影']['$t'],
            'slide'          => $item['gsx$slide']['$t'],
        ];
    }

    $main = [
        'zh' => $speaker_id !== 0 ? $lang_zh[$speaker_id] : $lang_zh,
        'en' => $speaker_id !== 0 ? $lang_en[$speaker_id] : $lang_en,
    ];

    return getI18n($main);
}
