<?php

namespace App\Http\Controllers;

use App\Service\SpeakerService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiTrait;

class BaseSpeakerController extends Controller
{
    use ApiTrait;

    protected $function = 'speaker';

    protected $service;

    public function __construct()
    {
        parent::__construct();
        if (env('APP_ENV') === 'production') {
            $session_resource_path = $this->path . 'session.json';
            $tag_group_resource_path = $this->path . 'tag-group.json';
        } else {
            $session_resource_path = $this->path . 'session-dev.json';
            $tag_group_resource_path = $this->path . 'tag-group-dev.json';
        }

        $sessionAry = json_decode(file_get_contents($session_resource_path), true);
        $tagGroupSetting = json_decode(file_get_contents($tag_group_resource_path), true);
        $this->service = new SpeakerService($sessionAry, $tagGroupSetting);
        foreach ($this->jsonAry as &$row) {
            $row = $this->service->parse($row);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->returnSuccess('Success.', $this->jsonAry);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            foreach ($this->jsonAry as $speaker) {
                if ((int) $speaker['speaker_id'] === $id) {
                    return $this->returnSuccess('Success.', $speaker);
                }
            }

            return $this->returnNotFoundError('Not found');
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * @param string $platform
     * @param string $name
     * @return Illuminate\Http\Response
     */
    public function imagesView($platform, $name)
    {
        $dir = $this->imgPath . 'speaker/'. $platform . '/' . $name . '.*';
        $path = glob($dir);
        if (empty($path)) {
            $dir = $this->imgPath . 'volunteers/agenda.*';
            $path = glob($dir);
        }
        $path = end($path);
        $type = mime_content_type($path);
        return (new Response(file_get_contents($path), 200))->header('Content-Type', $type);
    }

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

            return $this->returnSuccess('Success.', $this->service->parseTags(array_values(array_unique($tags))));
        } catch (\Exception $e) {
            $this->returnError($e->getMessage());
        }
    }
}
