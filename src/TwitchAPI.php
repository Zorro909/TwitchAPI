<?php

class TwitchAPI{
	
	private $clientID;
	private $httpAPI;	

	function __construct($clientID, $httpAPI=null) {
	    if($httpAPI==null){
	        $httpAPI = new HttpAPI();
	    }
	    $this->httpAPI = $httpAPI;
		$this->clientID = $clientID;
	}
	
	function getClientID():string{
		return $this->clientID;	
	}
	
	function setClientID($clientID){
		$this->clientID = $clientID;
	}
	
	function getUserByName($name):?TwitchUser{
	    $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?login=" . $name);
	    if(!$data){
	        return null;
	    }else{
	        if($data->data==null||$data->data[0]==null){
	            return null;
	        }
	        $d = $data->data[0];
	        $user = new TwitchUser($d->id, $d->login, $d->display_name, $d->type, $d->broadcaster_type, $d->description, $d->profile_image_url, $d->offline_image_url, $d->view_count);
	        if(isset($d->email)){
	            $user->email = $d->email;
	        }
            return $user;
	    }
	    return null;
	}
	
	function getUserById($id):?TwitchUser{
	    $data = $this->httpAPI->get($this->clientID, "https://api.twitch.tv/helix/users?id=" . $id);
	    if(!$data){
	        return null;
	    }else{
	        if($data->data==null||$data->data[0]==null){
	            return null;
	        }
	        $d = $data->data[0];
	        $user = new TwitchUser($d->id, $d->login, $d->display_name, $d->type, $d->broadcaster_type, $d->description, $d->profile_image_url, $d->offline_image_url, $d->view_count);
	        if(isset($d->email)){
	            $user->email = $d->email;
	        }
	        return $user;
	    }
	    return null;
	}
	
	function getExtensionAnalytics($extension_id){
		
	}
	
	function getGameAnalyticsBuilder($gameID, $type, $first, $started_at, $ended_at){
		
	}
	
	function getBitsLeaderboard($count=10, $period="all", $started_at=null, $user_id=null){
		
	}
	
	function createClip($broadcaster_id, $has_delay=false){
		
	}
	
}
?>