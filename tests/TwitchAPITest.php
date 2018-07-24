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
	    $this->assertInstanceOf(TwitchUser::class, $api->getUserById("48377768"));
	}


}


?>