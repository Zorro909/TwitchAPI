<?php

class TwitchVideo
{

    private $id, $user_id, $title, $description, $created_at;

    private $published_at, $url, $thumbnail_url, $viewable, $view_count;

    private $language, $type, $duration;

    function __construct($id, $user_id, $title, $description, $created_at, $published_at, $url, $thumbnail_url, $viewable, $view_count, $language, $type, $duration)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->created_at = $created_at;

        $this->published_at = $published_at;
        $this->url = $url;
        $this->thumbnail_url = $thumbnail_url;
        $this->viewable = $viewable;
        $this->view_count = $view_count;

        $this->language = $language;
        $this->type = $type;
        $this->duration = $duration;
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
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getPublished_at()
    {
        return $this->published_at;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getThumbnail_url()
    {
        return $this->thumbnail_url;
    }

    /**
     * @return mixed
     */
    public function getViewable()
    {
        return $this->viewable;
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
    public function getLanguage()
    {
        return $this->language;
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
    public function getDuration()
    {
        return $this->duration;
    }

}