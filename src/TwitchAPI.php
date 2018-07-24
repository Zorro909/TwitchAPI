<?php

class TwitchAPI
{

    private $clientID;

    private $httpAPI;

    function __construct($clientID, $httpAPI = null)
    {
        if ($httpAPI == null) {
            $httpAPI = new HttpAPI();
        }
        $this->httpAPI = $httpAPI;
        $this->clientID = $clientID;
    }

    function getClientID(): string
    {
        return $this->clientID;
    }

    function setClientID($clientID)
    {
        $this->clientID = $clientID;
    }

    function getUserByName($name): TwitchUser
    {
        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?login=" . $name);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getUserById Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($data->data[0])) {
            throw new TwitchAPIException("No User found for the name " . $name);
        }
        $d = $data->data[0];
        $user = new TwitchUser($d->id, $d->login, $d->display_name, $d->type, $d->broadcaster_type, $d->description, $d->profile_image_url, $d->offline_image_url, $d->view_count);
        if (isset($d->email)) {
            $user->email = $d->email;
        }
        return $user;
    }

    function getUserById($id): TwitchUser
    {
        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?id=" . $id);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getUserById Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($data->data[0])) {
            throw new TwitchAPIException("No User found for the id " . $id);
        }
        $d = $data->data[0];
        $user = new TwitchUser($d->id, $d->login, $d->display_name, $d->type, $d->broadcaster_type, $d->description, $d->profile_image_url, $d->offline_image_url, $d->view_count);
        if (isset($d->email)) {
            $user->email = $d->email;
        }
        return $user;
    }

    function getVideoByVideoID($videoID)
    {
        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?id=" . $videoID);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getVideoByVideoID Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($data->data[0])) {
            throw new TwitchAPIException("No Video found for the id " . $id);
        }
        $d = $data->data[0];
        return new TwitchVideo($d->id, $d->user_id, $d->title, $d->description, $d->created_at, $d->published_at, $d->url, $d->thumbnail_url, $d->viewable, $d->view_count, $d->language, $d->type, $d->duration);
    }

    function getVideosByVideoIDArray($videoIDs)
    {
        $videoIDString = "";
        $vidsCount = 0;
        foreach ($videoIDs as $id) {
            if (strpos($videoIDString, $id) !== false) {
                continue;
            }
            $videoIDString = $videoIDString . "," . $id;
            $vidsCount ++;
        }
        $videoIDString = substr($videoIDString, 1);

        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?id=" . $videoIDString);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getVideosByVideoIDArray Request invalid", $exc->getCode(), $exc);
        }
        if (sizeof($data->data) != $vidsCount) {
            throw new TwitchAPIException((sizeof($videoIDs) - $vidsCount) . " Videos could not be found!");
        } 
        $vids = array();
        $i = 0;
        foreach ($data->data as $d) {
            $vids[$i] = new TwitchVideo($d->id, $d->user_id, $d->title, $d->description, $d->created_at, $d->published_at, $d->url, $d->thumbnail_url, $d->viewable, $d->view_count, $d->language, $d->type, $d->duration);
            $i ++;
        }
        return $vids;
    }

    function getVideosByUserID($userID, $type = "all", $sort = "time", $period = "all", $amount = 20, $paginationCursor = null, $language = null)
    {
        $arguments = "user_id=" . $userID . "&";
        $arguments = $arguments . "type=" . $type . "&";
        $arguments = $arguments . "sort=" . $sort . "&";
        $arguments = $arguments . "period=" . $period . "&";
        $arguments = $arguments . "first=" . $amount . "&";
        if ($paginationCursor !== null) {
            $arguments = $arguments . "after=" . $paginationCursor . "&";
        }
        if ($language !== null) {
            $arguments = $arguments . "language=" . $language;
        }
        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?" . $arguments);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            echo $exc;
            throw new TwitchAPIException("getVideoByUserID Request invalid", $exc->getCode(), $exc);
        }
        $vids = array();
        $i = 0;
        foreach ($data->data as $d) {
            $vids[$i] = new TwitchVideo($d->id, $d->user_id, $d->title, $d->description, $d->created_at, $d->published_at, $d->url, $d->thumbnail_url, $d->viewable, $d->view_count, $d->language, $d->type, $d->duration);
            $i ++;
        }
        $vids["pagination"] = $data->pagination->cursor;
        return $vids;
    }

    function getVideosByGameID($gameID, $type = "all", $sort = "time", $period = "all", $amount = 20, $paginationCursor = null, $language = null)
    {
        $arguments = "game_id=" . $gameID . "&";
        $arguments = $arguments . "type=" . $type . "&";
        $arguments = $arguments . "sort=" . $sort . "&";
        $arguments = $arguments . "period=" . $period . "&";
        $arguments = $arguments . "first=" . $amount . "&";
        if ($paginationCursor !== null) {
            $arguments = $arguments . "after=" . $paginationCursor . "&";
        }
        if ($language !== null) {
            $arguments = $arguments . "language=" . $language;
        }
        $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?" . $arguments);
        try {
            $this->verifyData($data);
        } catch (TwitchAPIException $exc) {
            echo $exc;
            throw new TwitchAPIException("getVideoByGameID Request invalid", $exc->getCode(), $exc);
        }
        $vids = array();
        $i = 0;
        foreach ($data->data as $d) {
            $vids[$i] = new TwitchVideo($d->id, $d->user_id, $d->title, $d->description, $d->created_at, $d->published_at, $d->url, $d->thumbnail_url, $d->viewable, $d->view_count, $d->language, $d->type, $d->duration);
            $i ++;
        }
        $vids["pagination"] = $data->pagination->cursor;
        return $vids;
    }
    
    function getExtensionAnalytics($extension_id)
    {}

    function getGameAnalyticsBuilder($gameID, $type, $first, $started_at, $ended_at)
    {}

    function getBitsLeaderboard($count = 10, $period = "all", $started_at = null, $user_id = null)
    {}

    function createClip($broadcaster_id, $has_delay = false)
    {}

    function verifyData($data): bool
    {
        if (isset($data->error)) {
            throw new TwitchAPIException("Invalid Request: Error " . $data->error . " (" . $data->status . ")\nMessage: " . $data->message);
        }
        if ($data->data===null) {
            throw new TwitchAPIException("Invalid Request: No Error was given!");
        }
        return true;
    }
}
?>