<?php

namespace MopCon;

use Predis\Client;

class RedisFactory
{
    private $parameters = [
        'read_write_timeout' => 0.5,
        'socket_timeout' => 0.5,
        'timeout' => 0.5
    ];
    private $options = [
        'replication' => true
    ];
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config.php';
    }

    /**
     * @return Client
     */
    public function create()
    {
        $redis_config = $this->config['redis'];

        return new Client([
            'scheme' => $redis_config['scheme'],
            'host' => $redis_config['host'],
            'port' => $redis_config['port']
        ], $this->options);
    }

    /**
     * 設定 Redis Initial 需要使用到的參數
     * @param array $parameters Redis Connection 參數設定
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    /**
     * 設定 Redis Initial Options
     * @param array $options Redis Connection Options 設定
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
}
