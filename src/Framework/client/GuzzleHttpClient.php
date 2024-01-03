<?php

namespace Acme\Framework\client;

use GuzzleHttp\Client as GuzzleHttp;

class GuzzleHttpClient extends GuzzleHttp
{
    private static GuzzleHttp $instance;

    private const API_BASE_URL = 'https://pokeapi.co/api/v2/';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new GuzzleHttp([
                'base_uri' => self::API_BASE_URL,
                'timeout'  => 5.0,
            ]);
        }

        return self::$instance;
    }
}
