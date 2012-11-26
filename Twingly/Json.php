<?php
class Twingly_Json extends Twingly
{
    public static function buildArrayFromJson($json)
    {
        $array = array();
        foreach(json_decode($json) AS $item) {
            $array[] = $item;
        }
        return $array;
    }
}
