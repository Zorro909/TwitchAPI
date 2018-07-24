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
        return json_decode($data);
    }
}

?>