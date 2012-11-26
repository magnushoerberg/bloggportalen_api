<?php
class Twingly_TopList extends Twingly
{
    const AUTHORIZING              = 'authorizing';
    const AUTHORIZED               = 'authorized';

    public static function getPrivate($limit = 10)
    {
        print($params);
        $url = "/private?limit=" . $limit;
        $response = Twingly_Http::get($url);
        return $response;
    }
    public static function getProfessional($limit =  10)
    {
        $url = "/professional?limit=" . $limit;
        $response = Twingly_Http::get($url);
        return $response;
    }
}