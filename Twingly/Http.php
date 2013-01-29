<?php

/**
 * Twingly wrapper for curl
 * */

class Twingly_Http
{
    public static function get($path)
    {
        $response = self::_doRequest('GET', $path);
        return self::_handleResponse($response);
    }

    public static function post($path, $params = null)
    {
        $response = self::_doRequest('POST', $path, self::_buildJson($params));
        return self::_handleResponse($response);
    }
    private static function _buildJson($params) {
        return json_encode($params);
    }

    private static function _handleResponse($response) 
    {
        if($response['status'] === 200) {
            return Twingly_Json::buildArrayFromJson($response['body']);
        } else {
            Twingly_Util::throwStatusCodeException($response['status']);
        }
    }
    private static function _doRequest($httpVerb, $path, $requestBody = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $httpVerb);
        curl_setopt($curl, CURLOPT_URL, Twingly_Configuration::baseUrl() . $path);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json',
            'User-Agent: Twingly PHP Library ' . Twingly_Configuration::API_VERSION,
            'X-ApiVersion: ' . Twingly_Configuration::API_VERSION
        ));
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, Twingly_Configuration::twinglyId() . ':' . Twingly_Configuration::twinglyApiKey());

        if (Twingly_Configuration::sslOn()) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_CAINFO, Twingly_Configuration::caFile());
            curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        }

        if(!empty($requestBody)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (Twingly_Configuration::sslOn() && $httpStatus == 0) {
            throw new Twingly_Exception_SSLCertificate();
        }
        return array('status' => $httpStatus, 'body' => $response);
    }
}
