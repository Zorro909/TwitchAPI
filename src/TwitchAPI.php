<?php

class TwitchAPI{
	
	private $clientID;
	
	function __construct($clientID) {
		$this->clientID = $clientID;
	}
	
	function getClientID(){
		return $this->clientID;	
	}
	
	function setClientID($clientID){
		$this->clientID = $clientID;
	}
	
	function getStreamer($name){
		return null;
	}
	
}
?>