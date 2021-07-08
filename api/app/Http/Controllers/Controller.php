<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    protected $year;
    protected $function = null;
    protected $jsonAry;
    protected $path = __DIR__ . '/../../../resource/assets/json/';
    protected $imgPath = __DIR__ . '/../../../resource/assets/images/';

    public function __construct()
    {
        $env = getenv('APP_ENV') ? getenv('APP_ENV') : 'production';

        if (!$this->year) {
            // 預設帶系統年度
            $this->year = date('Y');
        }
        $this->path = $this->path . $this->year . '/';
        $this->imgPath = $this->imgPath . $this->year . '/';

        if (getenv('RESOURCE_PATH')) {
            // 主要設計給測試使用
            $path = getenv('RESOURCE_PATH');
            if (!file_exists($path)) {
                throw new NotFoundHttpException('Resource Path not found');
            }

            $this->path = $path;
        }

        if ($this->function) {
            $filePath = $this->path . $this->function;
            if ($env === 'develop') {
                $filePath .= '-dev';
            }
            $filePath .= '.json';
            if (!file_exists($filePath)) {
                throw new NotFoundHttpException('Resource file not found');
            }
            $this->jsonAry = json_decode(file_get_contents($filePath), true);
        }
    }
}
