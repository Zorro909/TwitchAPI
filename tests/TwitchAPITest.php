<?php

use PHPUnit\Framework\TestCase;

class TwitchAPITest extends TestCase {

	function testCanBeCreated(){
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

	function testGetStreamer(){
		$api = new TwitchAPI("testID");
		$this->assertNotEquals(null, $api->getStreamer("Zorro909HD"));
	}


}


?>