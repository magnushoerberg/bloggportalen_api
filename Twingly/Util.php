<?php

class Twingly_Util extends Twingly
{
    public static function throwStatusCodeException($statusCode, $message=null)
    {
        switch($statusCode) {
        case 401:
            throw new Twingly_Exception_Authentication();
            break;
        case 403:
            throw new Twingly_Exception_Authorization($message);
            break;
        case 404:
            throw new Twingly_Exception_NotFound();
            break;
        case 406:
            throw new Twingly_Exception_WrongArgument($message);
            break;
        case 426:
            throw new Twingly_Exception_UpgradeRequired();
            break;
        case 500:
            throw new Twingly_Exception_ServerError();
            break;
        case 503:
            throw new Twingly_Exception_DownForMaintenance();
            break;
        default:
            throw new Twingly_Exception_Unexpected('Unexpected HTTP_RESPONSE #'.$statusCode);
            break;
        }
    }
}
