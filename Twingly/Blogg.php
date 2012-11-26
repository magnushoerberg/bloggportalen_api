<?php

class Twingly_Blogg extends Twingly
{
    public static function create($params) {
        return self::_doCreate('/blog/new', $params);
    }
    public static function _doCreate($url, $params)
    {
        $response = Twingly_Http::post($url, $params);

        return $response;
    }
}
