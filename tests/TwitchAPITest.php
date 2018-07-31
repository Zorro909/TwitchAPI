<?php
use PHPUnit\Framework\TestCase;
use zorro909\TwitchAPI;
use zorro909\TwitchFollower;
use zorro909\TwitchGame;
use zorro909\TwitchUser;
use zorro909\TwitchVideo;
include("HttpAPIRecorder.php");
include("HttpAPIOffline.php");

$useClientID = getEnv("clientID");
$httpAPI = new HttpAPIOffline();

class TwitchAPITest extends TestCase
{

    function testAPICanBeCreated() {
        $this->assertInstanceOf(TwitchAPI::class, new TwitchAPI("testID"));
    }

    function testCanGetClientID() {
        $api = new TwitchAPI("testID");
        $this->assertEquals("testID", $api->getClientID());
    }

    function testCanSetClientID() {
        $api = new TwitchAPI("testID");
        $api->setClientID("SecondID");
        $this->assertEquals("SecondID", $api->getClientID());
    }

    function testGetUserByName() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $user = $api->getUserByName("Zorro909HD");
        $this->assertNotEquals(null, $user);
        $this->assertInstanceOf(TwitchUser::class, $user);
    }

    function testGetUserById() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $user = $api->getUserById("48377768");
        $this->assertNotEquals(null, $user);
        $this->assertInstanceOf(TwitchUser::class, $user);
    }

    function testGetVideoByVideoID() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $video = $api->getVideoByVideoID("286622904");
        $this->assertNotEquals(null, $video);
        $this->assertInstanceOf(TwitchVideo::class, $video);
    }

    function testGetVideosByVideoIDArray() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $videos = $api->getVideosByVideoIDArray(array("286622904","286622905"));
        $this->assertNotEquals(null, $videos);
        $this->assertEquals(2, sizeof($videos));
        $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
        $this->assertInstanceOf(TwitchVideo::class, $videos[1]);
    }

    function testGetVideosByUserID($pagination = null) {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $videos = $api->getVideosByUserID("47499841", "all", "time", "all", 2, $pagination);
        $this->assertNotEquals(null, $videos);
        $this->assertEquals(3, sizeof($videos));
        $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
        $this->assertInstanceOf(TwitchVideo::class, $videos[1]);
        $this->assertTrue(is_string($videos["pagination"]));
        if ($pagination == null) {
            $this->testGetVideosByUserID($videos["pagination"]);
        }
    }

    function testGetVideosByGameID($pagination = null) {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $videos = $api->getVideosByGameID("33214", "all", "time", "all", 2, $pagination);
        $this->assertNotEquals(null, $videos);
        $this->assertEquals(3, sizeof($videos));
        $this->assertInstanceOf(TwitchVideo::class, $videos[0]);
        $this->assertInstanceOf(TwitchVideo::class, $videos[1]);
        $this->assertTrue(is_string($videos["pagination"]));
        if ($pagination == null) {
            $this->testGetVideosByGameID($videos["pagination"]);
        }
    }

    function testGetExtensionAnalytics() {
        $this->fail("Test not implemented");
    }

    function testGetGameAnalyticsBuilder() {
        $this->fail("Test not implemented");
    }

    function testGetBitsLeaderboard() {
        $this->fail("Test not implemented");
    }

    function testCreateClip() {
        $this->fail("Test not implemented");
    }

    function testGetClipByID() {
        $this->fail("Test not implemented");
    }

    function testGetClipsByIDArray() {
        $this->fail("Test not implemented");
    }

    function testGetClipsByBroadcasterID() {
        $this->fail("Test not implemented");
    }

    function testGetClipsByGameID() {
        $this->fail("Test not implemented");
    }

    function testGetCreateEntitlementGrantsUploadURL() {
        $this->fail("Test not implemented");
    }

    function testGetGamesByIDs() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $game = $api->getGame("33214");
        $this->assertNotEquals(null, $game);
        $this->assertInstanceOf(TwitchGame::class, $game);
        $this->assertEquals("Fortnite", $game->getGameName());
    }

    function testGetGameByName() {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $game = $api->getGameByName("Fortnite");
        $this->assertNotEquals(null, $game);
        $this->assertInstanceOf(TwitchGame::class, $game);
        $this->assertEquals("33214", $game->getGameID());
    }

    function testGetTopGames($paginationCursor = null) {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $games = $api->getTopGames(5, $paginationCursor);
        $this->assertNotEquals(null, $games);
        $this->assertInstanceOf(TwitchGame::class, $games[0]);
        $this->assertTrue(is_string($games["pagination"]));
        if ($paginationCursor == null) {
            $this->testGetTopGames($games["pagination"]);
        }
    }

    function testGetStreamsByCommunityID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamsByGameID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamsByUserID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamsByUserLogin() {
        $this->fail("Test not implemented");
    }

    function testGetStreamMetadataByCommunityID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamMetadataByGameID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamMetadataByUserID() {
        $this->fail("Test not implemented");
    }

    function testGetStreamMetadataByUserLogin() {
        $this->fail("Test not implemented");
    }

    function testGetFollowersOfStreamer($paginationCursor = null) {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $follows = $api->getFollowersOfStreamer("47499841", 20, $paginationCursor);
        $this->assertNotEquals(null, $follows);
        $this->assertInstanceOf(TwitchFollower::class, $follows[0]);
        $this->assertInstanceOf(TwitchFollower::class, $follows[1]);
        $this->assertTrue(is_string($follows["pagination"]));
        if ($paginationCursor == null) {
            $this->testGetFollowersOfStreamer($follows["pagination"]);
        }
    }

    function testGetFollowsOfUser($paginationCursor = null) {
        global $useClientID, $httpAPI;
        $api = new TwitchAPI($useClientID, $httpAPI);
        $follows = $api->getFollowsOfUser("47499841", 20, $paginationCursor);
        $this->assertNotEquals(null, $follows);
        $this->assertInstanceOf(TwitchFollower::class, $follows[0]);
        $this->assertInstanceOf(TwitchFollower::class, $follows[1]);
        $this->assertTrue(is_string($follows["pagination"]));
        if ($paginationCursor == null) {
            $this->testGetFollowsOfUser($follows["pagination"]);
        }
    }

    function testUpdateUserDescription() {
        $this->fail("Test not implemented");
    }

    function testGetUserExtensions() {
        $this->fail("Test not implemented");
    }

    function testGetActiveUserExtensionsByAuthenticationToken() {
        $this->fail("Test not implemented");
    }

    function testGetActiveUserExtensionsByUserID() {
        $this->fail("Test not implemented");
    }

    function updateUserExtensions() {
        $this->fail("Test not implemented");
    }
}

?>