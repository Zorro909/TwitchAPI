<?php

class TwitchUser
{

    private $id, $login, $display_name, $type, $broadcaster_type, $description, $profile_image_url;

    private $offline_image_url, $view_count;
    public $email;

    function __construct($id, $login, $display_name, $type, $broadcaster_type, 
        $description, $profile_image_url, $offline_image_url, $view_count)
    {
        $this->id = $id;
        $this->login = $login;
        $this->display_name = $display_name;
        $this->type = $type;
        $this->broadcaster_type = $broadcaster_type;
        $this->description = $description;
        $this->profile_image_url = $profile_image_url;
        $this->view_count = $view_count;
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
    public function getDisplay_name()
    {
        return $this->display_name;
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
        return $this->broadcaster_type;
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
    public function getProfile_image_url()
    {
        return $this->profile_image_url;
    }

    /**
     * @return mixed
     */
    public function getOffline_image_url()
    {
        return $this->offline_image_url;
    }

    /**
     * @return mixed
     */
    public function getView_count()
    {
        return $this->view_count;
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