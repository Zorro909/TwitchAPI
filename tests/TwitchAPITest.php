<?php
use PHPUnit\Framework\TestCase;

$useClientID = getEnv("clientID");
class TwitchAPITest extends TestCase {

	function testAPICanBeCreated(){
	    $this->assertInstanceOf(
			TwitchAPI::class,
		    new TwitchAPI("testID"));
	}
	
	function testCanGetClientID(){
	    $api = new TwitchAPI("testID");
		$this->assertEquals("testID", $api->getClientID());
	}
	
	function testCanSetClientID(){
		$api = new TwitchAPI("testID");
		$api->setClientID("SecondID");
		$this->assertEquals("SecondID", $api->getClientID());
	}

	function testGetUserByName(){
		global $useClientID;
		$api = new TwitchAPI($useClientID);
		$user = $api->getUserByName("Zorro909HD");
		$this->assertNotEquals(null, $user);
		$this->assertInstanceOf(TwitchUser::class, $user);
	}
	
	function testGetUserById(){
	    global $useClientID;
	    $api = new TwitchAPI($useClientID);
	    $user = $api->getUserById("48377768");
	    $this->assertNotEquals(null, $user);
	    $this->assertInstanceOf(TwitchUser::class, $user);
	}
    
	function testGetVideoByVideoID(){
	    global $useClientID;
	    $api = new TwitchAPI($useClientID);
	    $video = $api->getVideoByVideoID("286622904");
	    $this->assertNotEquals(null, $video);
	    $this->assertInstanceOf(TwitchVideo::class, $video);
	}
    
	function testGetVideosByVideoIDArray(){
	    global $useClientID;
	    $api = new TwitchAPI($useClientID);
	    $videos = $api->getVideosByVideoIDArray(array("286622904", "286622905"));
	    $this->assertNotEquals(null, $videos);
	    $this->assertEquals(2, sizeof($videos));
	    $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
	    $this->assertInstanceOf(TwitchVideo::class, $videos[1]);
	}
	
	function testGetVideosByUserID($pagination=null){
	    global $useClientID;
	    $api = new TwitchAPI($useClientID);
	    $videos = $api->getVideosByUserID("47499841", "all", "time", "all", 2, $pagination);
	    $this->assertNotEquals(null, $videos);
	    $this->assertEquals(3, sizeof($videos));
	    $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
	    $this->assertInstanceOf(TwitchVideo::class, $videos[1]);	
	    $this->assertTrue(is_string($videos["pagination"]));
	    if($pagination==null){
	        $this->testGetVideosByUserID($videos["pagination"]);
	    }
	}
	
	function testGetVideosByGameID($pagination=null){
	    global $useClientID;
	    $api = new TwitchAPI($useClientID);
	    $videos = $api->getVideosByGameID("33214", "all", "time", "all", 2, $pagination);
	    $this->assertNotEquals(null, $videos);
	    $this->assertEquals(3, sizeof($videos));
	    $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
	    $this->assertInstanceOf(TwitchVideo::class, $videos[1]);
	    $this->assertTrue(is_string($videos["pagination"]));
	    if($pagination==null){
	        $this->testGetVideosByGameID($videos["pagination"]);
	    }
	}
	
}


?>