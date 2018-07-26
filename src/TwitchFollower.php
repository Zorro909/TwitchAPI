<?php

class TwitchFollower extends TwitchUser{
    
    private $followedAt;
    private $loaded = false;
    private $api;
    
    public function __construct($userID, $followedAt, $api){
        $this->id = $userID;
        $this->followedAt = $followedAt;
        $this->api = $api;
    }
    
    private function loadData(){
        if($this->loaded){
            return;
        }
        $user = $this->api->getUserById($this->id);
        $this->login = $user->getLogin();
        $this->displayName = $user->getDisplayName();
        $this->type = $user->getType();
        $this->broadcasterType = $user->getBroadcasterType();
        $this->description = $user->getDescription();
        $this->profileImageUrl = $user->getProfileImageUrl();
        $this->offlineImageUrl = $user->getOfflineImageUrl();
        $this->viewCount = $user->getViewCount();
        $this->email = $user->getEmail();
        $this->loaded = true;
    }
    
    public function getFollowedAt(){
        return $this->followedAt;
    }
    
    /**
     * @return mixed
     */
    public function getLogin()
    {
        if(!$this->loaded)$this->loadData();
        return $this->login;
    }
    
    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        if(!$this->loaded)$this->loadData();
        return $this->displayName;
    }
    
    /**
     * @return mixed
     */
    public function getType()
    {
        if(!$this->loaded)$this->loadData();
        return $this->type;
    }
    
    /**
     * @return mixed
     */
    public function getBroadcasterType()
    {
        if(!$this->loaded)$this->loadData();
        return $this->broadcasterType;
    }
    
    /**
     * @return mixed
     */
    public function getDescription()
    {
        if(!$this->loaded)$this->loadData();
        return $this->description;
    }
    
    /**
     * @return mixed
     */
    public function getProfileImageUrl()
    {
        if(!$this->loaded)$this->loadData();
        return $this->profileImageUrl;
    }
    
    /**
     * @return mixed
     */
    public function getOfflineImageUrl()
    {
        if(!$this->loaded)$this->loadData();
        return $this->offlineImageUrl;
    }
    
    /**
     * @return mixed
     */
    public function getViewCount()
    {
        if(!$this->loaded)$this->loadData();
        return $this->viewCount;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        if(!$this->loaded)$this->loadData();
        return $this->email;
    }
    
    
    
    
    
}