<?php

namespace App\Http\Controllers;

use App\Service\SessionService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiTrait;

class BaseUnconfController extends Controller
{
    use ApiTrait;

    protected $function = 'unconf';
    private $missingStructure = [
        'isBroadCast' => false,
        'room' => [
            'link_slide' => '',
            'speaker_id' => 0,
            'company' => '',
            'company_e' => '',
            'job_title' => '',
            'job_title_e' => '',
            'summary' => '',
            'summary_e' => '',
            'community_partner' => '',
            'is_keynote' => false,
            'is_online' => false,
            'room' => 'UnConf',
            'floor' => '4F',
            'img' => [
                'web' => '',
                'mobile' => ''
            ],
            'tags' => [],
            'recordable' => true,
            'level' => 'Basic',
            'sponsor_id' => 0
        ]
    ];

    /**
     * fill correct format into json
     */
    public function __construct()
    {
        parent::__construct();
        $this->mapMissingStructure();
    }

    /**
     * return all unconf data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->returnSuccess('success', $this->jsonAry);
    }

    /**
     * return specific tags of unconf data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnconfList()
    {
        $result = [];
        // loop over everyday
        array_walk($this->jsonAry, function ($subset) use (&$result) {
            // loop over every period
            array_walk($subset['period'], function ($unconf) use (&$result) {
                // merge specific data in result
                if (!empty($unconf['room'])) {
                    $result[] = $unconf['room'][0];
                }
            });
        });
        if (empty($result)) {
            return $this->returnNotFoundError();
        }
        return $this->returnSuccess('success', $result);
    }

    /**
     * return specific id of unconf data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return $this->returnError('Bad request');
        }
        $unconfs = $this->unconfIdMap($this->jsonAry);
        if (isset($unconfs[$id])) {
            return $this->returnSuccess('success', $unconfs[$id]);
        }
        return $this->returnNotFoundError();
    }

    /**
     * map all id and unconf conference.
     *
     * we can store result into redis so we don't have to do that over and over again.
     *
     * @return array
     */
    private function unconfIdMap(array $rawArr)
    {
        $result = [];
        // loop over everyday
        array_walk($rawArr, function ($subset) use (&$result) {
            // loop over every period
            array_walk($subset['period'], function ($unconf) use (&$result){
                if (!empty($unconf['room'])) {
                    $result[$unconf['room'][0]['session_id']] = $unconf['room'];
                }
            });
        });

        return $result;
    }

    private function mapMissingStructure()
    {
        // loop over everyday
        foreach ($this->jsonAry as $key => &$subset) {
            // loop over every period
            array_walk($subset['period'], function (&$periodSubset) {
                $result = array_merge_recursive($this->missingStructure, $periodSubset);
                $result['room']['started_at'] = $result['started_at'];
                $result['room']['ended_at'] = $result['ended_at'];
                $room = $result['room'];
                unset($result['room']);
                $result['room'] = [];
                if ($result['event'] === '') {
                    $speaker = SessionService::transportMultipleSpeaker($room);
                    $room['speakers'] = [];
                    $room['speakers'][] = $speaker;
                    $result['room'][] = $room;
                }
                $periodSubset = $result;
            });
        }
    }
}
