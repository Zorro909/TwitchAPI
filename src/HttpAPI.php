<?php

class HttpAPI
{

    function __construct()
    {}

    function get($clientID, $url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Client-ID: ' . $clientID
        ));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        return ($httpcode >= 200 && $httpcode < 300) ? json_decode($data) : false;
    }
}