<?php
function getSchedules()
{
    $google_data = json_decode(file_get_contents(__DIR__ . '/../api/schedules.json'), true);
    $google_data = $google_data['feed']['entry'];
    $speakers = getSpeakersOrderByScheduleId();
    $data = [];
    $paintBG = ['休息 Break', '午餐 Lunch', '下午茶 Afternoon tea', 'End'];

    foreach ($google_data as $key => $item) {
        // 跳過議會廳欄位
        if ($key === 0) {
            continue;
        }
        // R1議程id
        $schedules_assign_data_day1 = [$item['gsx$_cokwr']['$t']];

        // 如果同一時間點，其他廳有議程的話
        if (isset($item['gsx$_cre1l'])) {
            $schedules_assign_data_day1[] = $item['gsx$_cpzh4']['$t'];
            $schedules_assign_data_day1[] = $item['gsx$_cre1l']['$t'];
        }

        $data['day1'][] = [
            'paintBG' => is_numeric(array_search($item['gsx$_cokwr']['$t'], $paintBG)) ? true : false,
            'colspan' => isset($item['gsx$_cre1l']) ? 1 : 3,
            'time'    => $item['gsx$day1']['$t'],
            'content' => assignSchedule($schedules_assign_data_day1, $speakers),
        ];

        if ($item['gsx$day2']['$t'] !== '') {
            // R1議程id
            $schedules_assign_data_day2 = [$item['gsx$_ckd7g']['$t']];

            // 如果同一時間點，其他廳有議程的話
            if (isset($item['gsx$_cyevm'])) {
                $schedules_assign_data_day2[] = $item['gsx$_clrrx']['$t'];
                $schedules_assign_data_day2[] = $item['gsx$_cyevm']['$t'];
            }

            $data['day2'][] = [
                'paintBG' => is_numeric(array_search($item['gsx$_ckd7g']['$t'], $paintBG)) ? true : false,
                'colspan' => isset($item['gsx$_cyevm']) ? 1 : 3,
                'time'    => $item['gsx$day2']['$t'],
                'content' => assignSchedule($schedules_assign_data_day2, $speakers),
            ];
        }
    }

    return $data;
}

/**
 * 取得講者及議程資料
 * @return array|mixed
 */
function getSpeakersOrderByScheduleId()
{
    $speakers = getSpeakers();

    $data = [];
    foreach ($speakers as $item) {
        $data[$item['schedule_id']] = [
            'id'             => $item['schedule_id'],
            'title'          => isset($data[$item['schedule_id']]["title"]) ?
                $data[$item['schedule_id']]["title"] . " & " . $item['name'] :
                $item['name'],
            'speaker_id'     => isset($data[$item['schedule_id']]["speaker_id"]) ?
                [$data[$item['schedule_id']]["speaker_id"][0], $item['speaker_id']] :
                [$item['speaker_id']],
            'name'           => isset($data[$item['schedule_id']]["name"]) ?
                [$data[$item['schedule_id']]["name"][0], $item['name']] :
                [$item['name']],
            'type'           => $item['type'],
            'job'            => $item['job'],
            'info'           => $item['info'],
            'picture'        => isset($data[$item['schedule_id']]["picture"]) ?
                [$data[$item['schedule_id']]["picture"][0], $item['picture']] :
                [$item['picture']],
            'facebook'       => $item['facebook'],
            'github'         => $item['github'],
            'blog'           => $item['blog'],
            'website'        => $item['website'],
            'linkedin'       => $item['linkedin'],
            'schedule_topic' => $item['schedule_topic'],
            'schedule_info'  => $item['schedule_info'],
            'video_record'  => $item['video_record'],
            'slide'          => $item['slide'],
        ];
    }

    return $data;
}

/**
 * 依照議程表排序議程順序
 * @param $schedules_assign_data
 * @param $speakers
 * @return array
 */
function assignSchedule($schedules_assign_data, $speakers)
{
    $lang_zh = [];
    $lang_en = [];




    foreach ($schedules_assign_data as $key => $item) {
        if (is_numeric($item)) {
            if (isset($speakers[$item])) {
                $lang_zh[] = array_merge($speakers[$item], [
                    'schedule' => true,
                    'room'     => count($schedules_assign_data) === 1 ? '全廳聯播' : 'R' . ($key + 1),
                ]);
                $lang_en[] = array_merge($speakers[$item], [
                    'schedule' => true,
                    'room'     => count($schedules_assign_data) === 1 ? 'Broadcast' : 'R' . ($key + 1),
                ]);
            } else {
                // 未公布議程
                $lang_zh[] = [
                    'schedule' => false,
                    'content'  => '晚點告訴你 :P',
                ];
                $lang_en[] = [
                    'schedule' => false,
                    'content'  => 'Tell you later :P',
                ];
            }
        } else {
            // 無議程時段
            $lang_zh[] = [
                'schedule' => false,
                'content'  => $item,
            ];
            $lang_en[] = [
                'schedule' => false,
                'content'  => $item,
            ];
        }
    }
    $main = [
        'zh' => $lang_zh,
        'en' => $lang_en,
    ];
    return getI18n($main);

}
