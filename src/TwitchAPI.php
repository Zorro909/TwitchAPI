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

    function getUserByName($name, $authenticationToken = null): TwitchUser
    {
        $requestData = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?login=" . $name, $authenticationToken);
        try {
            $this->verifyData($requestData);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getUserById Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($requestData->data[0])) {
            throw new TwitchAPIException("No User found for the name " . $name);
        }
        $data = $requestData->data[0];
        $user = new TwitchUser($data->id, $data->login, $data->display_name, $data->type, $data->broadcaster_type, $data->description, $data->profile_image_url, $data->offline_image_url, $data->view_count);
        if (isset($data->email)) {
            $user->email = $data->email;
        }
        return $user;
    }

    function getUserById($id, $authenticationToken = null): TwitchUser
    {
        $requestData = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?id=" . $id, $authenticationToken);
        try {
            $this->verifyData($requestData);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getUserById Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($requestData->data[0])) {
            throw new TwitchAPIException("No User found for the id " . $id);
        }
        $data = $requestData->data[0];
        $user = new TwitchUser($data->id, $data->login, $data->display_name, $data->type, $data->broadcaster_type, $data->description, $data->profile_image_url, $data->offline_image_url, $data->view_count);
        if (isset($data->email)) {
            $user->email = $data->email;
        }
        return $user;
    }

    function getVideoByVideoID($videoID)
    {
        $requestData = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?id=" . $videoID);
        try {
            $this->verifyData($requestData);
        } catch (TwitchAPIException $exc) {
            throw new TwitchAPIException("getVideoByVideoID Request invalid", $exc->getCode(), $exc);
        }
        if (! isset($requestData->data[0])) {
            throw new TwitchAPIException("No Video found for the id " . $videoID);
        }
        $data = $requestData->data[0];
        return new TwitchVideo($data->id, $data->user_id, $data->title, $data->description, $data->created_at, $data->published_at, $data->url, $data->thumbnail_url, $data->viewable, $data->view_count, $data->language, $data->type, $data->duration);
    }

    function getVideosByVideoIDArray(array $videoIDS)
    {
        $videoIDString = "";
        $vidsCount = 0;
        foreach ($videoIDS as $id) {
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
            throw new TwitchAPIException((sizeof($videoIDS) - $vidsCount) . " Videos could not be found!");
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
        if ($amount > 100) {
            throw new TwitchAPIException("Maximum Amount of Videos that can be returned by one Request is 100");
        }
        $arguments = $this->buildGetArguments(array(
            "user_id",
            $userID,
            "type",
            $type,
            "sort",
            $sort,
            "period",
            $period,
            "first",
            $amount,
            "after",
            $paginationCursor,
            "language",
            $language
        ));
        $requestData = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?" . $arguments);
        try {
            $this->verifyData($requestData);
        } catch (TwitchAPIException $exc) {
            echo $exc;
            throw new TwitchAPIException("getVideoByUserID Request invalid", $exc->getCode(), $exc);
        }
        $vids = array();
        $vidPointer = 0;
        foreach ($requestData->data as $data) {
            $vids[$vidPointer] = new TwitchVideo($data->id, $data->user_id, $data->title, $data->description, $data->created_at, $data->published_at, $data->url, $data->thumbnail_url, $data->viewable, $data->view_count, $data->language, $data->type, $data->duration);
            $vidPointer ++;
        }
        $vids["pagination"] = $requestData->pagination->cursor;
        return $vids;
    }

    function getVideosByGameID($gameID, $type = "all", $sort = "time", $period = "all", $amount = 20, $paginationCursor = null, $language = null)
    {
        if ($amount > 100) {
            throw new TwitchAPIException("Maximum Amount of Videos that can be returned by one Request is 100");
        }
        $arguments = $this->buildGetArguments(array(
            "game_id",
            $gameID,
            "type",
            $type,
            "sort",
            $sort,
            "period",
            $period,
            "first",
            $amount,
            "after",
            $paginationCursor,
            "language",
            $language
        ));
        $requestData = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/videos?" . $arguments);
        try {
            $this->verifyData($requestData);
        } catch (TwitchAPIException $exc) {
            echo $exc;
            throw new TwitchAPIException("getVideoByGameID Request invalid", $exc->getCode(), $exc);
        }
        $vids = array();
        $vidPointer = 0;
        foreach ($requestData->data as $data) {
            $vids[$vidPointer] = new TwitchVideo($data->id, $data->user_id, $data->title, $data->description, $data->created_at, $data->published_at, $data->url, $data->thumbnail_url, $data->viewable, $data->view_count, $data->language, $data->type, $data->duration);
            $vidPointer ++;
        }
        $vids["pagination"] = $requestData->pagination->cursor;
        return $vids;
    }

    function getExtensionAnalytics($authenticationToken, $extensionID = null)
    {}

    function getGameAnalyticsBuilder($authenticationToken, $gameID = null, $amount = 20, $type = null, $startedAt = null, $endedAt = null)
    {}

    function getBitsLeaderboard($authenticationToken, $count = 10, $period = "all", $started_at = null, $user_id = null)
    {}

    function createClip($authenticationToken, $broadcaster_id, $has_delay = false)
    {}

    function getClipByID($clipID)
    {}

    function getClipsByIDArray(array $clipIDS)
    {
        if (sizeof($clipIDS) > 100) {
            throw new TwitchAPIException("Maximum ID's that can be specified for getClipsByIDArray is 100!");
        }
    }

    function getClipsByBroadcasterID($broadcasterID, $amount = 20, $paginationCursor = null)
    {
        if ($amount > 100) {
            throw new TwitchAPIException("Maximum ID's that can be specified for getClipsByBroadcasterID is 100!");
        }
    }

    function getClipsByGameID($gameID, $amount = 20, $paginationCursor = null)
    {}

    function createEntitlementGrantsUploadURL($authenticationToken, $manifestID)
    {}

    function getGame($id)
    {}

    function getGamesByIDs(array $ids)
    {
        if (sizeof($ids) > 100) {
            throw new TwitchAPIException("A Maximum of 100 Games can be returned by one Request");
        }
    }

    function getGamesByNames(array $names)
    {
        if (sizeof($names) > 100) {
            throw new TwitchAPIException("A Maximum of 100 Games can be returned by one Request");
        }
    }

    function getTopGames($amount = 20, $paginationCursor = null)
    {}

    function getStreamsByCommunityID($communityID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamsByGameID($gameID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamsByUserID($userID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamsByUserLogin($userName, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamMetadataByCommunityID($communityID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamMetadataByGameID($gameID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamMetadataByUserID($userID, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getStreamMetadataByUserLogin($userName, $amount = 20, $language = null, $paginationCursor = null)
    {}

    function getFollowersOfStreamer($streamerID, $amount = 20, $paginationCursor = null)
    {}

    function getFollowsOfUser($userID, $amount = 20, $paginationCursor)
    {}

    function updateUserDescription($authenticationToken, $description)
    {}

    function getUserExtensions($authenticationToken)
    {}

    function getActiveUserExtensionsByAuthenticationToken($authenticationToken)
    {}

    function getActiveUserExtensionsByUserID($userID)
    {}

    function updateUserExtensions($authenticationToken, $extensions)
    {}

    function buildGetArguments(array $arguments): string
    {
        $line = "";
        for ($arg = 0; $arg < sizeof($arguments) + 1; $arg = $arg + 2) {
            if($arguments[$arg+1]===null)continue;
            $line = $line . $arguments[$arg] . "=" . $arguments[$arg + 1] . "&";
        }
        return $line;
    }

    function verifyData($data): bool
    {
        if (isset($data->error)) {
            throw new TwitchAPIException("Invalid Request: Error " . $data->error . " (" . $data->status . ")\nMessage: " . $data->message);
        }
        if ($data->data === null) {
            throw new TwitchAPIException("Invalid Request: No Error was given!");
        }
        return true;
    }
}
?>