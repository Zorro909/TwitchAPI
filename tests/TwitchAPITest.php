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
	
	function testGetExtensionAnalytics(){
	    $this->fail("Test not implemented");	    
	}
	
	function testGetGameAnalyticsBuilder(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetBitsLeaderboard(){
	    $this->fail("Test not implemented");	 
	}
	
	function testCreateClip(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetClipByID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetClipsByIDArray(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetClipsByBroadcasterID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetClipsByGameID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetCreateEntitlementGrantsUploadURL(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetGame(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetGamesByIDs(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetGamesByNames(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetTopGames(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamsByCommunityID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamsByGameID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamsByUserID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamsByUserLogin(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamMetadataByCommunityID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamMetadataByGameID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamMetadataByUserID(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetStreamMetadataByUserLogin(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetFollowersOfStreamer(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetFollowsOfUser(){
	    $this->fail("Test not implemented");	 
	}
	
	function testUpdateUserDescription(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetUserExtensions(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetActiveUserExtensionsByAuthenticationToken(){
	    $this->fail("Test not implemented");	 
	}
	
	function testGetActiveUserExtensionsByUserID(){
	    $this->fail("Test not implemented");	 
	}
	
	function updateUserExtensions(){
	    $this->fail("Test not implemented");	 
	}
	
}


?>