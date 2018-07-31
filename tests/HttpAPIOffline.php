<?php

class HttpAPIOffline extends HttpAPIRecorder
{

    function get($clientID, $url, $authenticationToken = null) {
        $fileName = hash("sha512",
            $url . ":" . $clientID . ($authenticationToken != null ? ":" . $authenticationToken : ""));
        if (! file_exists("requests/" . $fileName)) {
            return parent::get($clientID, $url, $authenticationToken);
        }
        return json_decode(file_get_contents("requests/" . $fileName));
    }
}