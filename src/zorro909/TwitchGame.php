<?php
namespace zorro909;

class TwitchGame
{

    private $gameID, $gameName, $boxArtUrl;

    function __construct($gameID, $gameName, $boxArtUrl) {
        $this->gameID = $gameID;
        $this->gameName = $gameName;
        $this->boxArtUrl = $boxArtUrl;
    }

    /**
     *
     * @return mixed
     */
    public function getGameID() {
        return $this->gameID;
    }

    /**
     *
     * @return mixed
     */
    public function getGameName() {
        return $this->gameName;
    }

    /**
     *
     * @return mixed
     */
    public function getBoxArtUrl() {
        return $this->boxArtUrl;
    }
}