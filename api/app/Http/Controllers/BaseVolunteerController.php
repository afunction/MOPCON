<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiTrait;

class BaseVolunteerController extends Controller
{
    use ApiTrait;
    protected $function = 'volunteer';
    /**
     * 志願者主頁
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = [];
        $result['volunteer'] = array_map(function ($value) {
            $value['photo'] = url($value['photo']);
            unset($value['introduction'], $value['introduction_en'], $value['members'], $value['facebook'], $value['twitter'], $value['instagram'], $value['telegram'], $value['event']);
            return $value;
        }, $this->jsonAry);

        return $this->returnSuccess('success', $result);
    }
    /**
     * 志工團隊
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->returnError('Bad request');
        }
        $result = $this->searchTargetById($this->jsonAry, $id);
        if (is_null($result)) {
            return $this->returnNotFoundError();
        }
        return $this->returnSuccess('success', $result);
    }
    /**
     * 查詢images
     *
     * @param string $name
     * @return object
     */
    public function imagesView($name)
    {
        $dir = $this->imgPath . 'volunteers/' . $name . '.*';
        $path = glob($dir);
        $path = end($path);
        if (empty($path)) {
            return $this->returnNotFoundError();
        }
        $type = mime_content_type($path);
        return (new Response(file_get_contents($path), 200))->header('Content-Type', $type);
    }

    /**
     * 由 id 取出特定社群
     *
     * @param array $dataset
     * @param integer $targetId
     * @return array
     */
    private function searchTargetById($dataset, $targetId)
    {
        $result = array_filter($dataset, function ($subset) use ($targetId) {
            if ((int)$subset['id'] === (int)$targetId) {
                return true;
            }
        });
        $result = array_pop($result);
        if (isset($result['photo']) && $result['photo'] !== '') {
            $result['photo'] = url($result['photo']);
        }
        if (isset($result['introduction_en']) && $result['introduction_en'] === '') {
            $result['introduction_en'] = $result['introduction'];
        }
        unset($result['id']);
        return $result;
    }
}
