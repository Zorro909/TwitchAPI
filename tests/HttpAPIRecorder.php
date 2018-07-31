<?php
use zorro909\HttpAPI;

class HttpAPIRecorder extends HttpAPI
{

    function get($clientID, $url, $authenticationToken = null) {
        $this->waitForRateLimit();
        echo "Need to send Request (" . $url . ")";
        $json = parent::get($clientID, $url, $authenticationToken);
        $fileName = hash("sha512",
            $url . ":" . $clientID . ($authenticationToken != null ? ":" . $authenticationToken : ""));
        if(!file_exists("requests")){
            mkdir("requests");
        }
        file_put_contents("requests/" . $fileName, json_encode($json));
        return $json;
    }
}