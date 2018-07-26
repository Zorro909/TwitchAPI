<?php
namespace zorro909;
class TwitchUser
{

    private $id, $login, $displayName, $type, $broadcasterType, $description, $profileImageUrl;

    private $offline_image_url, $viewCount;
    public $email;

    function __construct($id, $login, $displayName, $type, $broadcasterType, 
        $description, $profileImageUrl, $offlineImageUrl, $viewCount)
    {
        $this->id = $id;
        $this->login = $login;
        $this->displayName = $displayName;
        $this->type = $type;
        $this->broadcasterType = $broadcasterType;
        $this->description = $description;
        $this->profileImageUrl = $profileImageUrl;
        $this->viewCount = $viewCount;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getBroadcasterType()
    {
        return $this->broadcasterType;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getProfileImageUrl()
    {
        return $this->profileImageUrl;
    }

    /**
     * @return mixed
     */
    public function getOfflineImageUrl()
    {
        return $this->offline_image_url;
    }

    /**
     * @return mixed
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}

?>