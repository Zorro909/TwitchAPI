<?php
use PHPUnit\Framework\TestCase;
use zorro909\TwitchAPI;
use zorro909\TwitchFollower;
use zorro909\TwitchGame;
use zorro909\TwitchUser;
use zorro909\TwitchVideo;
include ("HttpAPIRecorder.php");
include ("HttpAPIOffline.php");

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

        $this->assertEquals("48377768", $user->getId());
        $this->assertEquals("zorro909hd", $user->getLogin());
        $this->assertEquals("Zorro909HD", $user->getDisplayName());
        $this->assertEquals("", $user->getType());
        $this->assertEquals("", $user->getBroadcasterType());
        $this->assertEquals("", $user->getDescription());
        $this->assertEquals(
            "https://static-cdn.jtvnw.net/jtv_user_pictures/zorro909hd-profile_image-828810cb0f72710d-300x300.jpeg",
            $user->getProfileImageUrl());
        $this->assertEquals("", $user->getOfflineImageUrl());
        $this->assertEquals("65", $user->getViewCount());
        $this->assertEquals(null, $user->getEmail());
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
        $this->assertTrue(is_string($game->getBoxArtUrl()));
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

        if ($paginationCursor == null) {
            $this->assertEquals("2018-07-30T16:13:09Z", $follows[0]->getFollowedAt());
            $this->assertEquals("130710140", $follows[0]->getId());
            $this->assertEquals("captainigermany", $follows[0]->getLogin());
            $this->assertEquals("CaptainIGermany", $follows[0]->getDisplayName());
            $this->assertEquals("", $follows[0]->getType());
            $this->assertEquals("", $follows[0]->getBroadcasterType());
            $this->assertEquals("", $follows[0]->getDescription());
            $this->assertEquals(
                "https://static-cdn.jtvnw.net/jtv_user_pictures/161e4aed-e6be-4e44-b419-c281f46db833-profile_image-300x300.png",
                $follows[0]->getProfileImageUrl());
            $this->assertEquals("", $follows[0]->getOfflineImageUrl());
            $this->assertEquals("315", $follows[0]->getViewCount());
            $this->assertEquals(null, $follows[0]->getEmail());
        }

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