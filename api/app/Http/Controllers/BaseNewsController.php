<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiTrait;

class BaseNewsController extends Controller
{
    use ApiTrait;

    private $rawMap;
    private $columns = ['id', 'date', 'title', 'description', 'link'];
    public function __construct()
    {
        $url = "https://spreadsheets.google.com/feeds/list/" . env($this->year . '_SHEET_KEY') . "/" . env($this->year . '_NEWS_ID') . "/public/values?alt=json";
        $this->rawMap = $this->mapSheetData(json_decode($this->getSheetData($url), true));
    }
    /**
     * 取得 APP news API data
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->returnSuccess('Success.', array_values($this->rawMap));
    }
    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->returnError('Bad request');
        }
        if (isset($this->rawMap[$id])) {
            return $this->returnSuccess('Success.', $this->rawMap[$id]);
        }
        return $this->returnNotFoundError();
    }
    /**
     * request google sheet
     * @param String
     * @return String
     */
    private function getSheetData(string $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 3,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'cache-control: no-cache',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("cURL Error #:$err");
        }

        return $response;
    }
    /**
     * convert array into news data and id map
     * @param Array
     * @return Array
     */
    private function mapSheetData(array $rawArr): array
    {
        $result = [];
        if (!isset($rawArr['feed']['entry'])) {
            return $result;
        }
        array_walk($rawArr['feed']['entry'], function ($subset) use (&$result) {
            $id = $subset['gsx$id']['$t'];
            $subset['gsx$date']['$t'] = strtotime($subset['gsx$date']['$t'] . '+08:00');
            $subset['gsx$id']['$t'] = (int)($subset['gsx$id']['$t']);
            $temp = [];
            foreach ($this->columns as $key => $column) {
                $temp[$column] = $subset["gsx$$column"]['$t'];
            }
            $result[$id] = $temp;
        });
        krsort($result);
        return $result;
    }
}
