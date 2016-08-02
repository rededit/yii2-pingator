<?php

namespace  molchanovvg\ping;

class Ping extends Component
{
    public $servers = [
        'molchanovvg\ping\Yandex',
        'molchanovvg\ping\Google',
    ];

    /**
     * @param $siteName
     * @param $homepage
     * @param $url
     * @param $rss
     * @param string $encoding
     * @param null $servers
     */
    public static function send($siteName, $homepage, $url, $rss, $encoding = "UTF-8", $servers = null)
    {
        $servers = self::getServers($servers);
        foreach ($servers as $server) {
            $client = new $server;
            $client->ping($siteName, $homepage, $url, $rss, $encoding = "UTF-8");
        }
    }
    /**
     * @param null|array $servers
     * @return array
     */
    public static function getServers($servers = null)
    {
        if ($servers == null) {
            return array_values(self::$servers);
        } else {
            $result = [];
            foreach ($servers as $k => $server) {
                if (isset(self::$servers[$k])) {
                    $result[] = self::$servers[$k];
                }
            }
            return $result;
        }
    }
}