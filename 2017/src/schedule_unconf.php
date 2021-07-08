<?php
function getScheduleUnconf()
{
    $google_data = json_decode(file_get_contents(__DIR__ . '/../api/schedules_unconf.json'), true);
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
        if (isset($item['gsx$_cpzh4'])) {
            $schedules_assign_data_day1[] = $item['gsx$_cpzh4']['$t'];
        }

        $data['day1'][] = [
            'paintBG' => is_numeric(array_search($item['gsx$_cokwr']['$t'], $paintBG)) ? true : false,
            'colspan' => isset($item['gsx$_cpzh4']) ? 1 : 2,
            'time'    => $item['gsx$day1']['$t'],
            'content' => assignSchedule($schedules_assign_data_day1, $speakers),
        ];

        if ($item['gsx$day2']['$t'] !== '') {
            // R1議程id
            $schedules_assign_data_day2 = [$item['gsx$_ciyn3']['$t']];

            // 如果同一時間點，其他廳有議程的話
            if (isset($item['gsx$_ckd7g'])) {
                $schedules_assign_data_day2[] = $item['gsx$_ckd7g']['$t'];
            }

            $data['day2'][] = [
                'paintBG' => is_numeric(array_search($item['gsx$_ciyn3']['$t'], $paintBG)) ? true : false,
                'colspan' => isset($item['gsx$_ckd7g']) ? 1 : 2,
                'time'    => $item['gsx$day2']['$t'],
                'content' => assignSchedule($schedules_assign_data_day2, $speakers),
            ];
        }
    }

    return $data;
}
