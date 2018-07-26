<?php
namespace zorro909;
class HttpAPI
{

    function __construct()
    {}

    function get($clientID, $url, $authenticationToken=null)
    {
        $curl = curl_init($url);
        $authentication = array(
            'Client-ID: ' . $clientID
        );
        if($authenticationToken!==null){
            $authentication[1] = "Authentication: Bearer " . $authenticationToken;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $authentication);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        return json_decode($data);
    }
}

?>