<?php

namespace App\Http\Controllers\Year2019;

use App\Http\Controllers\BaseSpeakerController;

class SpeakerController extends BaseSpeakerController
{
    protected $year = 2019;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTags()
    {
        try {
            $tags = [];
            foreach ($this->jsonAry as $speaker) {
                $tags = array_merge($tags, array_column($speaker['tags'], 'name'));
            }

            $outputTags = $this->service->parseTags(array_values(array_unique($tags)));
            foreach ($outputTags as &$tag) {
                // 將 color 替換成 web 的色碼
                // 因 2019 Mobile 及 App 顏色相同，在不修改回傳結構的情況下以此方式處理
                $tag["color"] = $tag["color"]["web"];
            }

            return $this->returnSuccess('Success.', $outputTags);
        } catch (\Exception $e) {
            $this->returnError($e->getMessage());
        }
    }
}
