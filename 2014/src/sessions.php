<?php
function sessions($options = []){
    $memcache_ok = function_exists("memcache_connect");
    $force_fetch = isset($options['force_fetch']) ? $options['force_fetch'] : false;

    if ($memcache_ok) {
        $mc = memcache_connect('localhost', 11211);
        if ($mc) {
            $spreadsheet = memcache_get($mc, 'session_spreadsheet');
        }

        if (!$spreadsheet || $force_fetch) {
            $spreadsheet = fetchSessionSpreadsheet();
            memcache_set($mc, 'session_spreadsheet', $spreadsheet, 0, 60*60);
        }
    }

    if (!$spreadsheet) {
        $spreadsheet = fetchSessionSpreadsheet();
    }

    $session_data = parseSessionSpreadsheet($spreadsheet);

    return $session_data;
}

//////////////////////////////////////////////////////////////////////////////////////////

/**
 * 把議程資料依照時間與會議室做先後排序
 */
function sortSession(&$session_data){
    usort($session_data, function($a, $b){
        $a_wins = 1;
        $b_wins = -1;
        $equal = 0;

        // 先比日期
        $date_a = $a['date'];
        $date_b = $b['date'];
        if ($date_a !== $date_b) {
            return ($date_a > $date_b) ? $a_wins : $b_wins;
        }

        // 再比時間
        $time_a = $a['time'];
        $time_b = $b['time'];
        if ($time_a !== $time_b) {
            return ($time_a > $time_b) ? $a_wins : $b_wins;
        }

        // 再比會議室
        $room_a = $a['room'];
        $room_b = $b['room'];
        $order = [
            '全部' => 0,
            '一廳' => 1,
            '二廳' => 2,
            '三廳' => 3
        ];

        $ord_a = $order[$room_a] or PHP_INT_MAX;
        $ord_b = $order[$room_b] or PHP_INT_MAX;
        if ($ord_a !== $ord_b) {
            return ($ord_a > $ord_b) ? $a_wins : $b_wins;
        }
        if ($room_a !== $room_b) {
            return ($room_a > $room_b) ? $a_wins : $b_wins;
        }

        // 都比不出先後就當做一樣，不過不應該到這裡才對...
        return $equal;
    });
}

/**
 * Parse 從 Google Spreadsheet 取回來的 Spreadsheet feed，回傳整理過的議程資料
 */
function parseSessionSpreadsheet($feed_str){
    $spreadsheet_data = json_decode(json_encode(simplexml_load_string($feed_str)),true); // 把 XML 轉成 Array

    // 定義每一行分別是哪種資料
    $field_names = array(
        'A' => 'date',
        'B' => 'time',
        'C' => 'room',
        'D' => 'title',
        'E' => 'desc',
        'F' => 'tag',
        'G' => 'tagColor',
        'H' => 'speakerId',
    );

    $session_data = array();
    foreach ($spreadsheet_data['entry'] as $cell) {
        $cell_id = $cell['title'];
        $c = $cell_id[0]; // column
        $r = substr($cell_id, 1); // row
        $content = trim($cell['content']);

        // 第一列是說明，跳過
        if ($r == 1) {
            continue;
        }

        // 檢查是哪種類型的資料
        $field_name = $field_names[$c];

        // 組合資料
        $r -= 2; // 議程資料從第二行開始，改成 zero based
        $session_data[$r][$field_name] = $content;
    }

    sortSession($session_data);
    return $session_data;
}

/**
 * 取得 Google Spreadsheet 的 Feed。
 * 文件請參考 https://developers.google.com/google-apps/spreadsheets/
 */
function fetchSessionSpreadsheet(){
    // set request header
    $opts = array(
      'http' => array(
        'method' => "GET",
      )
    );
    $ctx = stream_context_create($opts);

    // fetch the feed
    $doc_id = '1st6HxcLFFGmbfwrDyLnccMfjuKHOkSoV_arPHOHM5LM';
    $a = file_get_contents("https://spreadsheets.google.com/feeds/cells/{$doc_id}/1/public/basic", false, $ctx);
    return $a;
}
